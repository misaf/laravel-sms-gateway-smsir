<?php

declare(strict_types=1);

namespace Misaf\LaravelSmsGatewaySmsIr;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Misaf\LaravelSmsGateway\SmsGatewayManager;
use Misaf\LaravelSmsGatewaySmsIr\Drivers\SmsIrDriver;

final class SmsIrSmsGatewayServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->callAfterResolving(SmsGatewayManager::class, function (SmsGatewayManager $manager): void {
            $manager->extend('smsir', fn(Application $app): SmsIrDriver => $app->make(SmsIrDriver::class));
        });
    }
}
