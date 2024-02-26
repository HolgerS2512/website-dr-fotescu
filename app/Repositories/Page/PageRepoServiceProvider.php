<?php

namespace App\Repositories\Http;


use Illuminate\Support\ServiceProvider;


class PageRepoServiceProvider extends ServiceProvider
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
    $this->app->bind('App\Repositories\Page\PageRepository', 'App\Repositories\Page\PageRepository');
  }
}
