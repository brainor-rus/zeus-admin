<?php


namespace Zeus\Admin\Cms\Helpers;


use Zeus\Admin\Cms\Models\ZeusAdminMenuElement;

class TreeHelper
{
    public static function getTreeById($id,$model)
    {
        $elementsTree = $model::where('id', $id)->get()->toTree();
        return $elementsTree;
    }
}
