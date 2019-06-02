<?php

namespace Zeus\Admin\Plugins\BrainorPay\Controllers;

use Zeus\Admin\Controllers\ZeusAdminController;
use Zeus\Admin\Section;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class BrainorPayController extends Controller
{
    private $pluginData = [
        'redirectUrl' => ''
    ];

    public function __construct()
    {
        $this->pluginData['redirectUrl'] = '/' . config('zeusAdmin.admin_url') . '/pay/{sectionName}';
    }

    public function showRouteRedirect(Section $section, $sectionName, Request $request)
    {
        $mainController = new ZeusAdminController;

        return $mainController->getDisplay($section, $sectionName, $this->pluginData, $request);
    }

    public function createRouteRedirect(Section $section, $sectionName)
    {
        $mainController = new ZeusAdminController;

        return $mainController->getCreate($section, $sectionName, $this->pluginData);
    }

    public function editRouteRedirect(Section $section, $sectionName, $id)
    {
        $mainController = new ZeusAdminController;

        return $mainController->getEdit($section, $sectionName, $id, $this->pluginData);
    }

    public function createActionRouteRedirect(Section $section, $sectionName, Request $request)
    {
        $mainController = new ZeusAdminController;

        return $mainController->createAction($section, $sectionName, $request);
    }

    public function editActionRouteRedirect(Section $section, $sectionName, $id, Request $request)
    {
        $mainController = new ZeusAdminController;

        return $mainController->editAction($section, $sectionName, $id, $request);
    }

    public function deleteActionRouteRedirect(Section $section, $sectionName, $id, Request $request)
    {
        $mainController = new ZeusAdminController;

        return $mainController->deleteAction($section, $sectionName, $id, $request);
    }
}
