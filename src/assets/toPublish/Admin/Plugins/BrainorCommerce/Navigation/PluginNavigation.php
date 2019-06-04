<?php

namespace App\Admin\Plugins\BrainorCommerce\Navigation;

class PluginNavigation
{

    private $pluginNav;

    public function __construct()
    {
        $this->pluginNav = [
            [
                'url' => '/'.config('zeusAdmin.admin_url').'/BrainorCommerce',
                'icon' => 'fas fa-users',
                'text' => 'BrainorCommerce',
                'noDirect' => true,
                'nodes' => [
                    [
                        'url' => '/zeusAdmin/BrainorCommerce/BrainorCommerceOffers',
                        'icon' => 'fas fa-address-book',
                        'iconText' => 'Т',
                        'text' => 'Товары'
                    ],
                    [
                        'url' => '/zeusAdmin/BrainorCommerce/BrainorCommerceCategories',
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