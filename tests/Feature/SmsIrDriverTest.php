<?php

declare(strict_types=1);

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Misaf\LaravelSmsGateway\Facade\SmsGateway;

test('can send request through smsir driver', function (): void {
    config()->set('sms_gateway.default', 'smsir');
    config()->set('services.smsir.api_key', 'smsir-api-key');

    Http::fake([
        'https://api.sms.ir/v1/send' => Http::response([
            'status'  => 1,
            'message' => 'ok',
        ], 200),
    ]);

    $response = SmsGateway::driver()->request()
        ->post('send', [
            'mobile'  => '09123456789',
            'message' => 'Hello from sms.ir',
        ])
        ->json();

    Http::assertSent(function (Request $request): bool {
        return 'https://api.sms.ir/v1/send' === $request->url()
            && $request->hasHeader('X-API-KEY', 'smsir-api-key')
            && '09123456789' === $request['mobile']
            && 'Hello from sms.ir' === $request['message'];
    });

    expect($response['status'])->toBe(1);
});

test('does not send api key header when smsir api key is missing', function (): void {
    config()->set('sms_gateway.default', 'smsir');

    Http::fake([
        'https://api.sms.ir/v1/send' => Http::response([
            'status'  => 1,
            'message' => 'ok',
        ], 200),
    ]);

    SmsGateway::driver()->request()
        ->post('send', [
            'mobile'  => '09123456789',
            'message' => 'Hello from sms.ir',
        ]);

    Http::assertSent(function (Request $request): bool {
        return 'https://api.sms.ir/v1/send' === $request->url()
            && ! $request->hasHeader('X-API-KEY');
    });
});
