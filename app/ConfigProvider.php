<?php

namespace App;

use Illuminate\Support\ServiceProvider;

class ConfigProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Repositories\CarrinhoRepositoryInterface',
            'App\Repositories\CarrinhoRepository'
        );
    }
}
