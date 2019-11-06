<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use Storage;
use League\Flysystem\Filesystem;
use League\Flysystem\Sftp\SftpAdapter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);

        
        Storage::extend('storage1', function ($app, $config) {
            return new Filesystem(new SftpAdapter($config));
        });
        Storage::extend('storage2', function ($app, $config) {
            return new Filesystem(new SftpAdapter($config));
        });
        Storage::extend('storage3', function ($app, $config) {
            return new Filesystem(new SftpAdapter($config));
        }); 
    }
}
