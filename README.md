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
],
```

## Usage

```php
use Misaf\LaravelSmsGateway\Facade\SmsGateway;

$response = SmsGateway::driver('smsir')->send([
    'mobile'  => '09123456789',
    'message' => 'Hello',
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
