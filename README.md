# Laravel SMS Gateway SMS.ir Driver

SMS.ir SMS gateway driver for [`misaf/laravel-sms-gateway`](https://github.com/misaf/laravel-sms-gateway).

## Installation

```bash
composer require misaf/laravel-sms-gateway-smsir
```

Laravel package discovery registers the driver service provider automatically.

## Configuration

```env
SMS_GATEWAY_DRIVER=smsir
SMS_GATEWAY_SMSIR_APIKEY=your-api-key
```

```php
// config/services.php
'smsir' => [
    'api_key' => env('SMS_GATEWAY_SMSIR_APIKEY'),
    'base_url' => env('SMS_GATEWAY_SMSIR_BASE_URL', 'https://api.sms.ir/v1/'),
],
```

## Driver Behavior

| Option | Value |
| --- | --- |
| Driver name | `smsir` |
| Default base URL | `https://api.sms.ir/v1/` |
| `send()` endpoint | `POST send/bulk` |
| Authentication | `X-API-KEY` header when `services.smsir.api_key` is configured |
| Payload | Sent directly to SMS.ir |

## Usage

```php
use Misaf\LaravelSmsGateway\Facade\SmsGateway;

$response = SmsGateway::driver('smsir')->send([
    'mobile'  => '09123456789',
    'message' => 'Hello from sms.ir',
]);
```

The payload is passed directly to SMS.ir, so use the fields expected by the SMS.ir API.

Use `request()` when you need direct access to Laravel's HTTP client:

```php
$request = SmsGateway::driver('smsir')->request();
```

## Testing

```bash
composer test
composer analyse
```

## License

MIT
