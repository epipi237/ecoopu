<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Payum\LaravelPackage\Storage\EloquentStorage;

class payumServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        
        //  $this->app->resolving('payum.builder', function(\Payum\Core\PayumBuilder $payumBuilder) {
        // $payumBuilder
        // // this method registers filesystem storages, consider to change them to something more
        // // sophisticated, like eloquent storage
        // ->addDefaultStorages()
        // ->addStorage(Payment::class, new EloquentStorage(Payment::class))
        // ->addGateway('paypal_ec', [
        //     'factory' => 'paypal_express_checkout',
        //     'username' => 'ngambsastephane_api1.gmail.com',
        //     'password' => '78RY4QN9DJE7FJXJ',
        //     'signature' => 'AOYbd7klks-8uGvr.XOfP49uLJRGA-oW8dWXTQdWXMO9hAEnxWk-bpCx',
        //     'sandbox' => true
        // ]);
        // });

        //fake
        //   $this->app->resolving('payum.builder', function(\Payum\Core\PayumBuilder $payumBuilder) {
        // $payumBuilder
        // // this method registers filesystem storages, consider to change them to something more
        // // sophisticated, like eloquent storage
        // ->addDefaultStorages()
        // ->addStorage(Payment::class, new EloquentStorage(Payment::class))
        // ->addGateway('paypal_ec', [
        //     'factory' => 'paypal_express_checkout',
        //     'username' => 'ngambsastephane-facilitator_api1.gmail.com',
        //     'password' => 'SKU587Y9PEY29A73',
        //     'signature' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31AUYKM8TVb9eGNBNzGoer8hjdgtnO',
        //     'sandbox' => true
        // ]);
        // });

        $this->app->resolving('payum.builder', function(\Payum\Core\PayumBuilder $payumBuilder) {
        $payumBuilder
        // this method registers filesystem storages, consider to change them to something more
        // sophisticated, like eloquent storage
        ->addDefaultStorages()
        ->addStorage(Payment::class, new EloquentStorage(Payment::class))
        ->addGateway('paypal_ec', [
            'factory' => 'paypal_express_checkout',
            'username' => 'adelphine2000_api2.yahoo.com',
            'password' => 'UH2K6L8FY52JAERJ',
            'signature' => 'Ai1PaghZh5FmBLCDCTQpwG8jB264A0gItRtAIKm5b9lFM6U4KzTGHUBE',
            'sandbox' => true
        ]);
        });


          $this->app->resolving('payum.builder', function(\Payum\Core\PayumBuilder $payumBuilder) {
        $payumBuilder       
        ->addDefaultStorages()
        ->addStorage(Payment::class, new EloquentStorage(Payment::class))
        ->addGateway('offline', [
            'factory' => 'offline',
            'username' => 'EDIT ME',
            'password' => 'EDIT ME',
            'signature' => 'EDIT ME',
            'sandbox' => true
        ]);
        });

    //     $this->app->resolving('payum.builder', function(\Payum\Core\PayumBuilder $payumBuilder) {
    //     $payumBuilder 
    // ->addDefaultStorages()
    // ->addGateway('authorize_net', [
    //     'factory' => 'authorize_net_aim',
    //     'login_id' => 'enbumkur',
    //     'transaction_key' => '@elsie062892',
    //     'sandbox' => false,
    //     ]);
    //     });
 
    }
}
