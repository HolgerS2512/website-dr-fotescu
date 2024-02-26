<?php

namespace App\Repositories\Http;


use Illuminate\Support\ServiceProvider;


class HttpRepoServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap the application services.
   *
   * @return void
   */
  public function boot()
  {
  }


  /**
   * Register the application services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind('App\Repositories\Http\UrlVariablesRepository', 'App\Repositories\Http\UrlVariablesRepository');
  }
}
