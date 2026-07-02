# Laravel SMS Gateway SMS.ir Driver

SMS.ir driver package for [`misaf/laravel-sms-gateway`](https://github.com/misaf/laravel-sms-gateway).

## Installation

```bash
composer require misaf/laravel-sms-gateway misaf/laravel-sms-gateway-smsir
```

Laravel package discovery registers `Misaf\LaravelSmsGatewaySmsIr\SmsIrSmsGatewayServiceProvider` automatically.

## Usage

Set the default driver when this provider should be used by default:

```env
SMS_GATEWAY_DRIVER=smsir
```

Then configure the provider credentials in `config/services.php` and use the shared facade:

```php
use Misaf\LaravelSmsGateway\Facade\SmsGateway;

SmsGateway::driver('smsir')->request();
```

## Testing

```bash
composer test
composer analyse
```

## License

MIT