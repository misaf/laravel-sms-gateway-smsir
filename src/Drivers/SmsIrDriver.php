<?php

declare(strict_types=1);

namespace Misaf\LaravelSmsGatewaySmsIr\Drivers;

use Illuminate\Http\Client\PendingRequest;
use Misaf\LaravelSmsGateway\SmsGatewayDriver;

final class SmsIrDriver extends SmsGatewayDriver
{
    protected function driverName(): string
    {
        return 'smsir';
    }

    protected function defaultGateway(): string
    {
        return 'https://api.sms.ir/v1/';
    }

    protected function apiKeyHeader(): string
    {
        return $this->serviceConfigString('api_key_header', 'X-API-KEY');
    }

    protected function configureRequest(PendingRequest $request): PendingRequest
    {
        return $request->acceptJson();
    }
}
