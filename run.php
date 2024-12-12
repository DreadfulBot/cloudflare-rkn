<?php

echo "Disabling cloudflare ECH for all zones...\n";

// Учетные данные Cloudflare
$authEmail = "";
$authKey = "";

// Функция для выполнения HTTP-запроса
function makeRequest($url, $method = 'GET', $data = null) {
    global $authEmail, $authKey;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "X-Auth-Email: $authEmail",
        "X-Auth-Key: $authKey",
        "Content-Type: application/json"
    ]);

    if ($data) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

// 1. Получаем список всех зон
$zonesResponse = makeRequest("https://api.cloudflare.com/client/v4/zones?per_page=100");

if (isset($zonesResponse['result'])) {
    foreach ($zonesResponse['result'] as $zone) {
        $zoneId = $zone['id'];

        // 2. Отключаем ECH для каждой зоны
        $url = "https://api.cloudflare.com/client/v4/zones/$zoneId/settings/ech";
        $data = ["value" => "off"];
        $updateResponse = makeRequest($url, 'PATCH', $data);

        if (isset($updateResponse['success']) && $updateResponse['success']) {
            echo "ECH disabled for zone ID: $zoneId\n";
        } else {
            echo "Failed to disable ECH for zone ID: $zoneId\n";
        }
    }
} else {
    echo "Failed to retrieve zones\n";
}
