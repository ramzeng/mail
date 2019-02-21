<?php
/**
 * Created by PhpStorm.
 * User: moon
 * Date: 2019-02-21
 * Time: 18:04
 */

namespace Shiran\EasyExMail;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(EasyExMail::class, function(){
            return new EasyExMail(config('services.EasyExMail.id'), config('services.EasyExMail.secret'));
        });

        $this->app->alias(EasyExMail::class, 'EasyExMail');
    }

    public function provides()
    {
        return [EasyExMail::class, 'EasyExMail'];
    }
}