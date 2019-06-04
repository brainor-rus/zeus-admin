<?php

namespace App\Providers;


use Zeus\Admin\Cms\Helpers\CMSHelper;
use Zeus\Admin\Cms\Helpers\CustomFieldsHelper;
use Illuminate\Support\ServiceProvider;

class CMSHelpersProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('CMS', CMSHelper::class);
        $this->app->bind('CustomFields', CustomFieldsHelper::class);
    }
}
