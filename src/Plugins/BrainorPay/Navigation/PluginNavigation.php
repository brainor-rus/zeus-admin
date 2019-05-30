<?php

namespace Zeus\Admin\Plugins\BrainorPay\Navigation;

class PluginNavigation
{

    private $pluginNav;

    public function __construct()
    {
        $this->pluginNav = [
            [
                'url' => '/'.config('zeusAdmin.admin_url').'/pay',
                'icon' => 'fas fa-users',
                'text' => 'Оплата',
                'noDirect' => true,
                'nodes' => [
                    [
                        'url' => '/zeusAdmin/pay/BrainorPayBanks',
                        'icon' => 'fas fa-address-book',
                        'iconText' => 'Б',
                        'text' => 'Банки'
                    ],
                    [
                        'url' => '/zeusAdmin/pay/BrainorPayBankResponses',
                        'icon' => 'fas fa-address-book',
                        'iconText' => 'ОБ',
                        'text' => 'Ответы банков',
                    ],
                    [
                        'url' => '/zeusAdmin/pay/BrainorPayCommissions',
                        'icon' => 'fas fa-address-book',
                        'iconText' => 'КБ',
                        'text' => 'Коммиссии банков'
                    ],
                    [
                        'url' => '/zeusAdmin/pay/BrainorPayStatistics',
                        'icon' => 'fas fa-address-book',
                        'iconText' => 'СБ',
                        'text' => 'Статистика'
                    ],
                    [
                        'url' => '/zeusAdmin/pay/BrainorPayStatisticParts',
                        'icon' => 'fas fa-address-book',
                        'iconText' => 'СД',
                        'text' => 'Статистика (доп)'
                    ]
                ]
            ]
        ];
    }

    public static function getPluginNav(){
        return (new self)->pluginNav;
    }

}