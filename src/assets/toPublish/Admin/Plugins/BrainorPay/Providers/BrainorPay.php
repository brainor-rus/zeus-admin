<?php
/**
 * class: BrainorPay
 * nameSpace: App\Admin\Plugins\BrainorPay\Providers
 */
namespace App\Admin\Plugins\BrainorPay\Providers;

use Illuminate\Support\ServiceProvider;
use App\Admin\Plugins\BrainorPay\Navigation\PluginNavigation;
use App\Admin\Plugins\BrainorPay\Helpers\Payment;
use App\Admin\Plugins\BrainorPay\Helpers\GetData;

class BrainorPay extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'brainorPay');
        $this->publishes([__DIR__.'/../resources/views' => resource_path('views/zeusAdmin/brainorPay')]);
        $this->loadMigrationsFrom(__DIR__.'/../Migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Payment', Payment::class);
        $this->app->bind('GetData', GetData::class);
    }
}