<?php

namespace Zeus\Admin\Plugins\BRCommerce\Navigation;

class PluginNavigation
{

    private $pluginNav;

    public function __construct()
    {
        $this->pluginNav = [
            [
                'url' => '/'.config('zeusAdmin.admin_url').'/BRCommerce',
                'icon' => 'fas fa-users',
                'text' => 'BRCommerce',
                'noDirect' => true,
                'nodes' => [
                    [
                        'url' => '/zeusAdmin/BRCommerce/BROffers',
                        'icon' => 'fas fa-address-book',
                        'iconText' => 'Т',
                        'text' => 'Товары'
                    ],
                    [
                        'url' => '/zeusAdmin/BRCommerce/BRCategories',
                        'icon' => 'fas fa-address-book',
                        'iconText' => 'К',
                        'text' => 'Категории'
                    ]
                ]
            ]
        ];
    }

    public static function getPluginNav(){
        return (new self)->pluginNav;
    }

}