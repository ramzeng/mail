<?php

/*
 * This file is part of the shiran/easyexmail.
 *
 * (c) shiran <iymiym@icloud.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Shiran\EasyExMail;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(EasyExMail::class, function () {
            return new EasyExMail([
                'corpId' => config('services.EasyExMail.id'),
                'corpSecret' => config('services.EasyExMail.secret'),
            ]);
        });

        $this->app->alias(EasyExMail::class, 'EasyExMail');
    }

    public function provides()
    {
        return [EasyExMail::class, 'EasyExMail'];
    }
}
