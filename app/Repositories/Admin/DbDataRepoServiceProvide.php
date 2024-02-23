<?php

namespace App\Repositories\Admin;


use Illuminate\Support\ServiceProvider;


class DbDataRepoServiceProvide extends ServiceProvider
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
    $this->app->bind('App\Repositories\Admin\DbDataInterface', 'App\Repositories\Admin\DbDataInterface');
    $this->app->bind('App\Repositories\Admin\HeadInterface', 'App\Repositories\Admin\HeadInterface');
    $this->app->bind('App\Repositories\Admin\ContentInterface', 'App\Repositories\Admin\ContentInterface');
  }
}
