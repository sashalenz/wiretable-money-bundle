<?php

namespace Sashalenz\WiretableMoneyBundle;

use Illuminate\Support\ServiceProvider;
use Sashalenz\WiretableMoneyBundle\Fields\MoneyField;

class WiretableMoneyBundleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/resources/views', 'wiretable-money-bundle');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/resources/views' => $this->app->resourcePath('views/vendor/wiretable-money-bundle'),
            ], 'wiretable-money-bundle:views');
        }

        $this->loadViewComponentsAs('wiretable-money-bundle', [
            MoneyField::class
        ]);
    }
}
