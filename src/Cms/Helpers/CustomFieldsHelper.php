<?php

namespace App\Http\Helpers\Posts\Helpers;

namespace Zeus\Admin\Cms\Helpers;

use Zeus\Admin\Cms\Models\ZeusAdminCustomFieldGroupCondition;
use Zeus\Admin\Cms\Models\ZeusAdminCustomFieldGroup;
use Zeus\Admin\Cms\Models\ZeusAdminCustomField;
use Zeus\Admin\Cms\Models\ZeusAdminCustomFieldData;

use Zeus\Admin\SectionBuilder\Form\Panel\Fields\BaseField\FormField;

class CustomFieldsHelper
{
    /**
     * @param $args = [
     *      [
     *          'condition_parameter'=>'post_type',
     *          'condition_value'=>'page'
     *      ]
     * @return mixed
     */
    public static function getCustomFieldGroupsByCondition($args)
    {
        return ZeusAdminCustomFieldGroup::with(
                array(
                    'fields',
                    'fields.data' => function ($query) use ($args){
                        $query->where([
                            ['customable_type', $args['customable_type']],
                            ['customable_id', $args['customable_id']]
                        ]);
                    },
                )
            )
            ->whereHas('conditions', function ($query) use($args) {
                $query->where('condition_type', 'in');
                $query->where('condition_parameter', $args['condition_parameter']);
                $query->where('condition_value', $args['condition_value']);
            })
            ->whereDoesntHave('conditions', function ($query) use($args) {
                $query->where('condition_type', 'not_in');
                $query->where('condition_parameter', $args['condition_parameter']);
                $query->where('condition_value', $args['condition_value']);
            })
            ->get();
    }
    /**
     * @param $args = [
     *      [
     *          'customable_id'=>'1',
     *          'customable_type'=>'App\Posts'
     *          'condition_parameter'=>'post_type',
     *          'condition_value'=>'post'
     *      ]
     * @return mixed
     */
    public static function getCustomFieldsByRelated($args) {
        return ZeusAdminCustomField::with('data')
            ->whereHas('data', function ($query) use($args) {
                $query->where('customable_id', $args['customable_id']);
                $query->where('customable_type', $args['customable_type']);
            })
            ->whereDoesntHave('group.conditions', function ($query) use($args) {
                $query->where('condition_type', 'not_in');
                $query->where('condition_parameter', $args['condition_parameter']);
                $query->where('condition_value', $args['condition_value']);
            })
            ->get();
    }

    /**
     * @param $args = [
     *      [
     *          'customable_id'=>'1',
     *          'customable_type'=>'App\Posts'
     *          'condition_parameter'=>'post_type',
     *          'condition_value'=>'post'
     *      ]
     * @return mixed
     */
    public static function generateCustomFields($customFieldGroups) {
        if($customFieldGroups->count()>0){
            foreach ($customFieldGroups as $group){
                foreach ($group->fields as $field){
                    $customFields[$field->order] = FormField::{$field->type}('customField.value',$field->name);
                }
            }
        }
    }
}
