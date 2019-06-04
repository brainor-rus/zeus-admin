<?php
/**
 * class: BrainorCommerce
 * nameSpace: App\Admin\Plugins\BrainorCommerce\Providers
 */
namespace App\Admin\Plugins\BrainorCommerce\Providers;

use Illuminate\Support\ServiceProvider;
use App\Admin\Plugins\BrainorCommerce\Navigation\PluginNavigation;
use App\Admin\Plugins\BrainorPay\Helpers\Payment;
use App\Admin\Plugins\BrainorPay\Helpers\GetData;

class BrainorCommerce extends ServiceProvider
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
        $this->mergeConfigFrom(base_path().'/vendor/brainor-rus/zeus-admin/config/zeusAdmin.php', 'zeusAdmin');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'BrainorCommerce');
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/zeusAdmin/BrainorCommerce'),
            __DIR__.'/../resources/js' => public_path('packages/zeusAdmin/js/BrainorCommerce')
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