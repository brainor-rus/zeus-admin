<?php

namespace Zeus\Admin\Plugins\BRCommerce\Navigation;

class PluginNavigation
{

    private $pluginNav;

    public function __construct()
    {
        $this->pluginNav = [
            [
                'url' => '/'.config('bradmin.admin_url').'/BRCommerce',
                'icon' => 'fas fa-users',
                'text' => 'BRCommerce',
                'noDirect' => true,
                'nodes' => [
                    [
                        'url' => '/bradmin/BRCommerce/BROffers',
                        'icon' => 'fas fa-address-book',
                        'iconText' => 'Т',
                        'text' => 'Товары'
                    ],
                    [
                        'url' => '/bradmin/BRCommerce/BRCategories',
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