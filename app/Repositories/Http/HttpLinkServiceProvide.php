<?php

namespace App\Repositories\Http;


use Illuminate\Support\ServiceProvider;


class HttpLinkServiceProvide extends ServiceProvider
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
    $this->app->bind('App\Repositories\Http\GetPageLinkInterface', 'App\Repositories\Http\GetPageLinkInterface');
  }
}
