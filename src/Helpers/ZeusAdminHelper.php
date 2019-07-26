<?php
/**
 * Created by PhpStorm.
 * User: Артем
 * Date: 10.10.2018
 * Time: 11:54
 */

namespace Zeus\Admin\Helpers;

use Illuminate\Support\Facades\Auth;
use ReflectionClass;
use ReflectionMethod;
use Illuminate\Database\Eloquent\Relations\Relation;
use Zeus\Admin\Section;

class ZeusAdminHelper
{
    public static function getModelRelationships($model) {
        $relationships = [];


        foreach((new ReflectionClass($model))->getMethods(ReflectionMethod::IS_PUBLIC) as $method)
        {
            if ($method->class != get_class($model) ||
                !empty($method->getParameters()) ||
                $method->getName() == __FUNCTION__) {
                continue;
            }

            try {
                $return = $method->invoke($model);

                if ($return instanceof Relation) {

                    $relationships[$method->getName()] = [
                        'type' => (new ReflectionClass($return))->getShortName(),
                        'model' => (new ReflectionClass($return->getRelated()))->getName()
                    ];
                }
            } catch(\Exception $e) {}
        }

        return $relationships;
    }

    private static function checkSectionAccess($el) {
        $section = new Section(app());
        $sectionName = basename($el['url']);

        if(isset($el['sectionPath'])) {
            $firedSection = new $el['sectionPath'](app());
        } else {
            $firedSection = $section->getSectionByName($sectionName, null);
        }


        if($firedSection->isCheckAccess() && Auth::user()->cant('display', [get_class($firedSection), $sectionName])) {
            return false;
        }

        return true;
    }

    public static function getAvailableNavigation($navigation) {
        $navigation = array_map(function ($el) { // Помечаем недоступные секции как null
            if(isset($el['nodes'])) {
                $el['nodes'] = self::getAvailableNavigation($el['nodes']);
                if(count($el['nodes'])) {
                    $el['nodes'] = array_filter($el['nodes']);
                }

                return count($el['nodes']) ? $el : null;
            }

            if(!isset($el['url']) || !self::checkSectionAccess($el)) {
                return null;
            }

            return $el;
        }, $navigation);

        $navigation = array_filter($navigation); // убирает все null из массива

        return $navigation;
    }
}