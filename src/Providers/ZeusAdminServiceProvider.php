<?php

namespace Zeus\Admin\Providers;

use Illuminate\Support\ServiceProvider;
use Zeus\Admin\Plugins\PluginManager;

class ZeusAdminServiceProvider extends ServiceProvider
{
    public $allPluginsNavigation = [];
    public $allPluginsCmsData = [];

    public function __construct(\Illuminate\Contracts\Foundation\Application  $app=null)
    {
       $this->allPluginsNavigation;
       $this->allPluginsCmsData;
        parent::__construct($app);
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */

    public function boot()
    {
        // load config
        $this->mergeConfigFrom(__DIR__.'/../../config/zeusAdmin.php', 'zeusAdmin');

        // load routes
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');

        // load view files
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'zeusAdmin');

        
        // publish files
        $this->publishes([
//            __DIR__.'/../../resources/views' => resource_path('views/zeusAdmin'),
            __DIR__.'/../../public/packages/zeusAdmin' => public_path('packages/zeusAdmin'),
            __DIR__.'/../assets/toPublish/Admin' => app_path('Admin'),
            __DIR__.'/../assets/toPublish/uploads' => public_path('uploads'),
            __DIR__.'/../assets/toPublish/views/zeusAdmin' => resource_path('views/zeusAdmin'),
            __DIR__.'/../../config/zeusAdmin.php' => config_path('zeusAdmin.php'),
        ]);

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // load config
        $this->mergeConfigFrom(__DIR__.'/../../config/zeusAdmin.php', 'zeusAdmin');

        /*
        * Register the service provider for the dependency.
        */

//        $this->app->register('Intervention\Image\ImageServiceProvider');

        /*
        * Create aliases for the dependency.
        */

//        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
//        $loader->alias('Image', 'Intervention\Image\Facades\Image');

        $this->app->singleton('PluginManager', function($app)
        {
            return new PluginManager();
        });

        $pluginManager = $this->app->make('PluginManager');

        // Register other plugin Service Providers in a loop here
        foreach ($pluginManager->getInstalledPlugins() as $pluginProviders)
        {
            foreach ($pluginProviders['providers'] as $pluginProvider)
            {
                $this->app->register($pluginProvider['nameSpace'].'\\'.$pluginProvider['class']);

                $pluginData = $this->app->{$pluginProvider['nameSpace'].'\\'.$pluginProvider['class']};

                if(isset($pluginData->navigation)){
                    $this->allPluginsNavigation = array_merge($this->allPluginsNavigation,$pluginData->navigation);
                }
                if(isset($pluginData->cmsData)){
                    $this->allPluginsCmsData = array_merge($this->allPluginsCmsData,$pluginData->cmsData);
                }
            }
        }
        $this->app->bind('PluginsData', function(){
            return [
                'PluginsNavigation'=>$this->allPluginsNavigation,
                'CmsData'=>$this->allPluginsCmsData,
            ];
        });

        //CMS
        $this->app->register('Zeus\Admin\Cms\Providers\Cms');

        $pluginData = $this->app->{'Zeus\Admin\Cms\Providers\Cms'};

        if(isset($pluginData->navigation)){
            $this->allPluginsNavigation = array_merge($this->allPluginsNavigation,$pluginData->navigation);
        }
        if(isset($pluginData->cmsData)){
            $this->allPluginsCmsData = array_merge($this->allPluginsCmsData,$pluginData->cmsData);
        }
        //END CMS
    }
}