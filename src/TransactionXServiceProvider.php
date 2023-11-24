<?php

namespace RajenTrivedi\TransactionX;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use RajenTrivedi\TransactionX\Commands\TransactionXCommand;

class TransactionXServiceProvider extends PackageServiceProvider
{
    public function boot()
    {
        $this->registerMiddleware($this->app['router']);
    }

    protected function registerMiddleware($router)
    {
        $router->aliasMiddleware('transaction-x', \RajenTrivedi\TransactionX\Middleware\TransactionMiddleware::class);
    }
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('transaction-x')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_transaction-x_table')
            ->hasCommand(TransactionXCommand::class);
    }
}
