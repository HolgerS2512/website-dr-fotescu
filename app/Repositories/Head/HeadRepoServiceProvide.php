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
    $this->app->bind('App\Repositories\Head\HeadAdminInterface', 'App\Repositories\Head\HeadAdminInterface');
  }
}
