<?php

declare(strict_types=1);

namespace Misaf\LaravelSmsGatewaySmsIr;

use Illuminate\Contracts\Foundation\Application;
use Misaf\LaravelSmsGateway\SmsGatewayManager;
use Misaf\LaravelSmsGatewaySmsIr\Drivers\SmsIrDriver;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

final class SmsIrSmsGatewayServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('laravel-sms-gateway-smsir');
    }

    public function packageRegistered(): void
    {
        $this->app->afterResolving(SmsGatewayManager::class, function (SmsGatewayManager $manager, Application $app): void {
            $manager->extend('smsir', fn(): SmsIrDriver => $app->make(SmsIrDriver::class));
        });

        if ($this->app->bound('sms-gateway')) {
            $this->app->make('sms-gateway')->extend('smsir', fn(Application $app): SmsIrDriver => $app->make(SmsIrDriver::class));
        }
    }
}
