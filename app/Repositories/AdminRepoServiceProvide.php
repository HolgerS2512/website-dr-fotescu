<?php

namespace App\Repositories\Head;


use Illuminate\Support\ServiceProvider;


class HeadRepoServiceProvide extends ServiceProvider
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
    $this->app->bind('App\Repositories\AdminInterface', 'App\Repositories\AdminInterface');
    $this->app->bind('App\Repositories\HeadAdminInterface', 'App\Repositories\HeadAdminInterface');
    $this->app->bind('App\Repositories\ContentAdminInterface', 'App\Repositories\ContentAdminInterface');
  }
}
