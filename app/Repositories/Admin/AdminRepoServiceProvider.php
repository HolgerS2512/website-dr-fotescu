<?php

namespace App\Repositories\Admin;


use Illuminate\Support\ServiceProvider;


class AdminRepoServiceProvider extends ServiceProvider
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
    $this->app->bind('App\Repositories\Admin\SetDbDataRepository', 'App\Repositories\Admin\SetDbDataRepository');
    $this->app->bind('App\Repositories\Admin\HandleLayoutRepository', 'App\Repositories\Admin\HandleLayoutRepository');
  }
}
