# Readme

## Введение

Заполнить значение переменных в файле `run.php` своими значениями.

```php
$authEmail = "";
$authKey = "";
```

## authEmail

Email под которым зарегистрирован аккаунт в системе cloudflare

## authKey

- Прямая ссылка для получения: <https://dash.cloudflare.com/profile/api-tokens>

**Если не получилось**:

- Справа сверху иконка профиля -> Preferences -> API Tokens -> Global API Key -> View

## Как проверить

- Переходим на [Google Dns](https://dns.google/query?name=example.com&rr_type=HTTPS&ecs=)

- Указываем название домена и нажимаем кнопку

- Смотрим на код ответа

В нем не должно присутствовать значений вида `ech=AEX+blablabla`. Если нет - то все ок

## Ссылки

[Блокировка CloudFlare от РКН серия 2](https://antiddos24.ru/blog/blokirovka-cloudflare-roskomnadzor-seriya-2) (Спасибо автору статьи!)
