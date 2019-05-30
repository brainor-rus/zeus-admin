<?php
/**
 * class: BRCommerce
 * nameSpace: Zeus\Admin\Plugins\BRCommerce\Providers
 */
namespace Zeus\Admin\Plugins\BRCommerce\Providers;

use Illuminate\Support\ServiceProvider;
use Zeus\Admin\Plugins\BRCommerce\Navigation\PluginNavigation;
use Zeus\Admin\Plugins\BrainorPay\Helpers\Payment;
use Zeus\Admin\Plugins\BrainorPay\Helpers\GetData;

class BRCommerce extends ServiceProvider
{
    public $navigation;

    public function __construct(\Illuminate\Contracts\Foundation\Application  $app=null)
    {
        $this->navigation = PluginNavigation::getPluginNav();
        parent::__construct($app);
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */

    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../../../../config/zeusAdmin.php', 'zeusAdmin');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'BRCommerce');
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/zeusAdmin/BRCommerce'),
            __DIR__.'/../resources/js' => public_path('packages/zeusAdmin/js')
        ]);
        $this->loadMigrationsFrom(__DIR__.'/../Migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->bind('Payment', Payment::class);
//        $this->app->bind('GetData', GetData::class);
    }
}