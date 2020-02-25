<?php

namespace Zeus\Admin\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Zeus\Admin\Helpers\ZeusAdminHelper;
use Zeus\Admin\SectionBuilder\Display\Custom\DisplayCustom;
use Zeus\Admin\SectionBuilder\Form\FormAction\FormAction;
use Zeus\Admin\SectionBuilder\Meta\Meta;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Image;

use Zeus\Admin\Section;
use Zeus\Admin\Navigation\NavigationManager;
use Zeus\Admin\Cms\Models\ZeusAdminFile;

class ZeusAdminController extends Controller
{

    public function getIndex()
    {
        return view('zeusAdmin::spa');
    }

    public function getDashboard()
    {
        return response()->json([
                'html' => View::make('zeusAdmin::dashboard')->render(),
                'meta' => [
                    'title' => 'Главная'
                ]
            ]
        );
    }

    public function getSidebarMenu(\Illuminate\Contracts\Foundation\Application  $app)
    {
        $navigation = NavigationManager::returnNavigation($app);
        $navigation = ZeusAdminHelper::getAvailableNavigation($navigation);

        return response()->json($navigation);
    }

    public function getDisplay(Section $section, $sectionName, $pluginData = null, Request $request)
    {
        $display = $section->fireDisplay($sectionName, [$request], $pluginData['sectionPath'] ?? null);
        $meta = $display->getMeta();
        $sectionModelSettings = $section->getSectionSettings(Str::studly($sectionName), $pluginData['sectionPath'] ?? null);

        $firedSection = $section->getSectionByName($sectionName, $pluginData['sectionPath'] ?? null);

        if($firedSection->isCheckAccess() && Auth::user()->cant('display', [get_class($firedSection), $sectionName])) {
            return $this->render("Доступ запрещён");
        }

        if($display instanceof DisplayCustom) {
            $results = $display->render($firedSection, $pluginData);
        } else {
            $results = $display->render($sectionModelSettings['model'] ?? config('zeusAdmin.base_models_path') . Str::studly(strtolower(Str::singular($sectionName))), $firedSection, $pluginData, $request);
        }

        $html = $results['view'];

        $pagination = [];
        if(!isset($results['isCustom']) && !($results['data'] instanceof Collection)) {
            $pagination = [
                'total' => $results['data']->total(),
                'per_page' => $results['data']->perPage(),
                'current_page' => $results['data']->currentPage(),
                'last_page' => $results['data']->lastPage(),
                'from' => $results['data']->firstItem(),
                'to' => $results['data']->lastItem()
            ];
        }

        $meta = [
            'title' => $sectionModelSettings['title'],
            'scripts' => $meta->getScripts(),
            'styles' => $meta->getStyles(),
        ];

        return $this->render($html,$pagination,$meta);
    }

    public function getCreate(Section $section, $sectionName, $pluginData = null, Request $request)
    {
        $firedSection = $section->getSectionByName($sectionName, $pluginData['sectionPath'] ?? null);
        if(isset($firedSection)) {
            if($firedSection->isCheckAccess() && Auth::user()->cant('create', [get_class($firedSection), $sectionName])) {
                return $this->render("Доступ запрещён");
            }

            if ($firedSection->isCreatable()) {
                $display = $section->fireCreate(Str::studly($sectionName), [], $pluginData['sectionPath'] ?? null);
                $meta = $display->getMeta();
                $sectionModelSettings = $section->getSectionSettings(Str::studly($sectionName), $pluginData['sectionPath'] ?? null);

                $html = $display->render(
                    $sectionModelSettings['model'] ?? config('zeusAdmin.base_models_path') . Str::studly(strtolower(Str::singular($sectionName))),
                    $sectionName,
                    $firedSection,
                    null,
                    $request->get('copy'),
                    $pluginData
                );

                $meta = [
                    'title' => $sectionModelSettings['title'] . '| Новая запись',
                    'scripts' => $meta->getScripts(),
                    'styles' => $meta->getStyles(),
                ];

                return $this->render($html, '', $meta);
            }
            else{
                return $this->render("Создание в этой секции невозможно");
            }
        } else
        {
            return $this->render("Секция не найдена");
        }
    }

    public function getEdit(Section $section, $sectionName, $id, $pluginData = null)
    {
        $firedSection = $section->getSectionByName($sectionName, $pluginData['sectionPath'] ?? null);
        if(isset($firedSection)) {
            if($firedSection->isCheckAccess() && Auth::user()->cant('edit', [get_class($firedSection), $sectionName])) {
                return $this->render("Доступ запрещён");
            }

            if ($firedSection->isEditable()) {
                $display = $section->fireEdit(Str::studly($sectionName), [$id], $pluginData['sectionPath'] ?? null);
                $meta = $display->getMeta();
                $sectionModelSettings = $section->getSectionSettings(Str::studly($sectionName), $pluginData['sectionPath'] ?? null);

                $html = $display->render($sectionModelSettings['model'] ?? config('zeusAdmin.base_models_path') . Str::studly(strtolower(Str::singular($sectionName))), $sectionName, $firedSection, $id, $pluginData);
                $meta = [
                    'title' => $sectionModelSettings['title'] . '| Редактирование',
                    'scripts' => $meta->getScripts(),
                    'styles' => $meta->getStyles(),
                ];

                return $this->render($html, '', $meta);
            }
            else{
                return $this->render("Редактирование этой секции невозможно.");
            }
        }
    }

    public function createAction(Section $section, $sectionName, Request $request)
    {
        $class = $section->getSectionByName($sectionName, $request->pluginData['sectionPath'] ?? null);

        if($class->isCheckAccess() && Auth::user()->cant('create', [get_class($class), $sectionName])) {
            abort(403);
        }

        if(isset($request->pluginData['redirectUrl']))
        {
            $params['{sectionName}'] = $sectionName;
            $params['{action}'] = 'edit';
            $pluginUrl = strtr($request->pluginData['redirectUrl'], $params);
        }
        $redirectUrl = $pluginUrl ?? '/' . config('zeusAdmin.admin_url') . '/' . $sectionName;

        if(!isset($class)) { abort(500); }
        if ($class->isCreatable()) {
            $relatedRows = $request->get('related');
            $zagallery = $request->get('zagallery');
            $request->offsetUnset('zagallery');

            $request->offsetUnset('_token');
            $request->offsetUnset('related');
            $sectionModelSettings = $section->getSectionSettings(Str::studly($sectionName), $request->pluginData['sectionPath'] ?? null);
            $modelPath = $sectionModelSettings['model'] ?? config('zeusAdmin.base_models_path') . Str::studly(strtolower(Str::singular($sectionName)));
            $request->offsetUnset('pluginData');

            $model = new $modelPath;
            $attrFields = Schema::getColumnListing($model->getTable());

            $class->beforeSave($request, $model);

            $model = $model::create($request->only($attrFields));

            $relationFields = array_keys(ZeusAdminHelper::getModelRelationships($model));
            $ignore = null;
            if(isset($model->zeusAdminIgnore) && is_array($model->zeusAdminIgnore) && count($model->zeusAdminIgnore) > 0) {
                $ignore = $model->zeusAdminIgnore;
                $relationFields = array_diff($relationFields, $ignore);
            }

            $model = $model->where('id', $model->id)
                ->when(isset($relationFields), function ($query) use ($relationFields) {
                    $query->with($relationFields);
                })
                ->first();


            //        FormAction::save($model, $request);
            FormAction::saveBelongsToRelations($model, $relationFields, $request);
            FormAction::saveBelongsToManyRelations($model, $relationFields, $request);
            FormAction::saveHasOneRelations($model, $relationFields, $request);
            FormAction::saveRelated($model, $relationFields, $relatedRows);
            FormAction::saveGallery($model, $zagallery);
            FormAction::saveCustomFields($model, $relationFields, $request);

            $class->afterSave($request, $model);

            if(isset($pluginUrl)) {
                $params['{id}'] = $model->id;
                $pluginUrl = strtr($pluginUrl, $params);
                $redirectUrl = $pluginUrl;
            } else {
                $redirectUrl = "$redirectUrl/$model->id/edit";
            }

            return response()->json([
                    'data' => [
                        'code' => 0,
                        'message' => "Запись №$model->id успешно создана",
                        'class' => 'success'
                    ],
                    'redirect' => [
                        'url' => $redirectUrl
                    ]
                ]
            );
        }
    }

    public function editAction(Section $section, $sectionName, Request $request, $id)
    {
        $class = $section->getSectionByName($sectionName, $request->pluginData['sectionPath'] ?? null);

        if($class->isCheckAccess() && Auth::user()->cant('edit', [get_class($class), $sectionName])) {
            abort(403);
        }

        if(isset($request->pluginData['redirectUrl']))
        {
            $params['{sectionName}'] = $sectionName;
            $params['{action}'] = 'edit';
            $pluginUrl = strtr($request->pluginData['redirectUrl'], $params);
        }
        $redirectUrl = $pluginUrl ?? '/' . config('zeusAdmin.admin_url') . '/' . $sectionName;
        if(!isset($class)) { abort(500); }
        if ($class->isEditable()) {
            $relatedRows = $request->get('related');
            $zagallery = $request->get('zagallery');

            $request->offsetUnset('_token');
            $request->offsetUnset('related');
            $request->offsetUnset('zagallery');

            $sectionModelSettings = $section->getSectionSettings(Str::studly($sectionName), $request->pluginData['sectionPath'] ?? null);
            $modelPath = $sectionModelSettings['model'] ?? config('zeusAdmin.base_models_path') . Str::studly(strtolower(Str::singular($sectionName)));
            $request->offsetUnset('pluginData');

            $model = new $modelPath;
            $relationFields = array_keys(ZeusAdminHelper::getModelRelationships($model));
            $ignore = null;
            if(isset($model->zeusAdminIgnore) && is_array($model->zeusAdminIgnore) && count($model->zeusAdminIgnore) > 0) {
                $ignore = $model->zeusAdminIgnore;
                $relationFields = array_diff($relationFields, $ignore);
            }

            $model = $model->where('id', $id)
                ->when(isset($relationFields), function ($query) use ($relationFields) {
                    $query->with($relationFields);
                })
                ->first();

            $class->beforeSave($request, $model);

            FormAction::save($model, $ignore, $request);
            FormAction::saveBelongsToRelations($model, $relationFields, $request);
            FormAction::saveBelongsToManyRelations($model, $relationFields, $request);
            FormAction::saveHasOneRelations($model, $relationFields, $request);
            FormAction::saveRelated($model, $relationFields, $relatedRows);
            FormAction::saveGallery($model, $zagallery);
            FormAction::saveCustomFields($model, $relationFields, $request);


            $class->afterSave($request, $model);

            //        $modelPath::where('id', $id)->update($request->all());

            if(isset($pluginUrl)) {
                $params['{id}'] = $model->id;
                $pluginUrl = strtr($pluginUrl, $params);
                $redirectUrl = $pluginUrl;
            } else {
                $redirectUrl = "$redirectUrl/$model->id/edit";
            }

            return response()->json([
                    'data' => [
                        'code' => 0,
                        'message' => "Запись №$model->id успешно обновлена",
                        'class' => 'success'
                    ],
                    'redirect' => [
                        'url' => $redirectUrl
                    ]
                ]
            );
        }
    }

    public function deleteAction(Section $section, $sectionName, $id, Request $request)
    {
        $sectionModelSettings = $section->getSectionSettings($sectionName, $request->pluginData['sectionPath'] ?? null);
        $modelPath = $sectionModelSettings['model'] ?? config('zeusAdmin.base_models_path') . Str::studly(strtolower(Str::singular($sectionName)));
        $model = new $modelPath;
        $class = $section->getSectionByName($sectionName, $request->pluginData['sectionPath'] ?? null);
        if(!isset($class)) { abort(500); }

        if($class->isCheckAccess() && Auth::user()->cant('delete', [get_class($class), $sectionName])) {
            abort(403);
        }

        if(isset($request->pluginData['deleteUrl']))
        {
            $params['{sectionName}'] = $sectionName;
            $pluginUrl = strtr($request->pluginData['deleteUrl'], $params);
        }
        $redirectUrl = $pluginUrl ?? '/'.config('zeusAdmin.admin_url').'/'.$sectionName;
        if($class->isDeletable()){
            $class->beforeDelete($request, $id);
            $model->where('id', $id)->delete();
            return response()->json([
                    'data' => [
                        'code'=>0,
                        'message'=>'Успешно',
                        'class'=>'success'
                    ],
                    'redirect' => [
                        'url' => $redirectUrl
                    ]
                ]
            );
        }
        else{
            return response()->json([
                    'data' => [
                        'code'=>500,
                        'message'=>'Ошибка',
                        'class'=>'error'
                    ],
                    'redirect' => [
                        'url' => $redirectUrl
                    ]
                ]
            );
        }
    }

    public function render($html, $pagination=null, $meta=null)
    {
        return response()->json([
                'html' => View::make('zeusAdmin::content.general')->with(compact('html'))->render(),
                'data' => [
                    'pagination' => $pagination ?? '',
                ],
                'meta' => $meta ?? ''
            ]
        );
    }

    public function getImage($path){
        return response()->file(base_path() . '/zeusAdmin/images/' . $path);
    }

    public function postEdit()
    {

    }

    public function imageList(Request $request)
    {
        $files = ZeusAdminFile::
//            when(
//                $request->has('fileType'),
//                function ($query) use ($request) {
//                    return $query->where('mime','ilike','%'.$request->fileType.'%');
//                }
//            )
        limit($request->quantity)
            ->offset($request->requestCount*$request->quantity)
            ->orderBy('created_at','DESC')
            ->get();
        $requestCount = $request->requestCount+1;
        $wrapperId = $request->wrapperId;
        if ($request->requestCount > 0){
            return view('zeusAdmin::SectionBuilder.Form.Fields.InsertMedia.imagesListElements')->with(compact('files','requestCount','wrapperId'));
        }
        else{
            return view('zeusAdmin::SectionBuilder.Form.Fields.InsertMedia.imagesList')->with(compact('files','requestCount','wrapperId'));
        }
    }

}
