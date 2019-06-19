<?php
/**
 * Created by PhpStorm.
 * User: Артем
 * Date: 03.10.2018
 * Time: 12:38
 */

namespace Zeus\Admin\SectionBuilder\Form\FormAction;


use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Zeus\Admin\Helpers\ZeusAdminHelper;
use Zeus\Admin\Cms\Helpers\CustomFieldsHelper;
use Zeus\Admin\Cms\Models\ZeusAdminCustomFieldData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Http\Request;

class FormAction
{
    public static function save(Model $model, Request $request)
    {
        foreach ($model->getAttributes() as $name => $attribute) {
            $model->{$name} = $request->{$name} ?? $model->{$name};
        }
        $model->save();
    }

    public static function saveBelongsToRelations(Model $model, Request $request)
    {
        foreach (ZeusAdminHelper::getModelRelationships($model) as $name => $relation) {
            if ($model->{$name}() instanceof BelongsTo && $request->has($name)) {
//                $request->{$name}->save();
                $model->{$name}()->associate($request->{$name});
            }
        }
    }

    public static function saveBelongsToManyRelations(Model $model, Request $request)
    {
        foreach (ZeusAdminHelper::getModelRelationships($model) as $name => $relation) {
            if ($model->{$name}() instanceof BelongsToMany && $request->has($name)) {
//                $request->{$name}->save();
                $model->{$name}()->sync($request->{$name});
            }
        }
    }

    public static function saveHasOneRelations(Model $model, Request $request)
    {
        foreach (ZeusAdminHelper::getModelRelationships($model) as $name => $relation) {
            if ($model->{$name}() instanceof HasOneOrMany && $request->has($name) && isset($request->{$name})) {
                if (is_array($request->{$name}) || $request->{$name} instanceof \Traversable) {
                    $model->{$name}()->saveMany($request->{$name});
                } else {
                    $related = $model->{$name}()->getModel();
                    $model->{$name}()->save($related::findOrFail($request->{$name}));
                }
            }
        }
    }

    public static function saveCustomFields(Model $model, Request $request)
    {
        $modelRelations = ZeusAdminHelper::getModelRelationships($model);
        if(array_key_exists('customFields',$modelRelations)){
            if ($model->customFields() instanceof MorphMany && $request->has('custom_fields') && isset($request->custom_fields)) {
                if (is_array($request->custom_fields) || $request->custom_fields instanceof \Traversable) {
                    foreach ($request->custom_fields as $customFieldId=>$customFieldDataValue){
                        $modelClass = get_class($model);
                        if(empty($customFieldDataValue)) {
                            ZeusAdminCustomFieldData::where([
                                ['customable_type', $modelClass],
                                ['customable_id', $model->id],
                                ['field_id', $customFieldId]
                            ])->delete();
                        } else {
                            ZeusAdminCustomFieldData::updateOrInsert(
                                [
                                    'customable_type' => $modelClass,
                                    'customable_id' => $model->id,
                                    'field_id' => $customFieldId
                                ],
                                ['value' => $customFieldDataValue]
                            );
                        }
                    }
                }
            }
        }
    }

    public static function saveRelated(Model $model, $relatedRows = []) {
        if(!isset($relatedRows)) {
            return;
        }

        foreach($relatedRows as $relation => $datas) {
            $foreignModel = $datas['foreignModel'];
            $foreignKey = $datas['foreignKey'];

            if($model->{$relation}() instanceof HasMany) {
                $newModels = [];

                if(isset($datas['rows'])) {
                    foreach($datas['rows'] as $row) {
                        $relatedModel = new $foreignModel();

                        foreach($row as $field => $value) {
                            if($field === $foreignKey) {
                                continue;
                            }

                            $relatedModel->{$field} = $value;
                        }

                        $newModels[] = $relatedModel;
                    }
                }

                $model->{$relation}()->delete();
                $model->{$relation}()->saveMany($newModels);
            }

            // todo Другие типы связей?
        }
    }
}