<?php

namespace Zeus\Admin\Plugins\BrainorPay\Navigation;

class PluginNavigation
{

    private $pluginNav;

    public function __construct()
    {
        $this->pluginNav = [
            [
                'url' => '/'.config('bradmin.admin_url').'/pay',
                'icon' => 'fas fa-users',
                'text' => 'Оплата',
                'noDirect' => true,
                'nodes' => [
                    [
                        'url' => '/bradmin/pay/BrainorPayBanks',
                        'icon' => 'fas fa-address-book',
                        'iconText' => 'Б',
                        'text' => 'Банки'
                    ],
                    [
                        'url' => '/bradmin/pay/BrainorPayBankResponses',
                        'icon' => 'fas fa-address-book',
                        'iconText' => 'ОБ',
                        'text' => 'Ответы банков',
                    ],
                    [
                        'url' => '/bradmin/pay/BrainorPayCommissions',
                        'icon' => 'fas fa-address-book',
                        'iconText' => 'КБ',
                        'text' => 'Коммиссии банков'
                    ],
                    [
                        'url' => '/bradmin/pay/BrainorPayStatistics',
                        'icon' => 'fas fa-address-book',
                        'iconText' => 'СБ',
                        'text' => 'Статистика'
                    ],
                    [
                        'url' => '/bradmin/pay/BrainorPayStatisticParts',
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