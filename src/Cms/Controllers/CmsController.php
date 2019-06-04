<?php

namespace Zeus\Admin\Cms\Controllers;

use Zeus\Admin\Cms\Helpers\CMSHelper;
use Zeus\Admin\Cms\Providers\Cms;
use Zeus\Admin\Controllers\ZeusAdminController;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

use Zeus\Admin\Cms\Models\ZeusAdminFile;
use Carbon\Carbon;
use Image;
use Zeus\Admin\Section;
use SEO;


class CmsController extends Controller
{
    private $pluginData = [
        'sectionPath' => 'Zeus\Admin\Cms\Sections\\',
        'redirectUrl' => '',
        'deleteUrl' => '',
    ];

    public function __construct(\Illuminate\Contracts\Foundation\Application $app)
    {
        $this->app = $app;
        $this->pluginData['deleteUrl'] = '/' . config('zeusAdmin.admin_url') . '/cms/{sectionName}';
        $this->pluginData['redirectUrl'] = '/' . config('zeusAdmin.admin_url') . '/cms/{sectionName}/{id}/{action}';

    }

    public function showRouteRedirect(Section $section, $sectionName, Request $request)
    {
        $mainController = new ZeusAdminController;
        return $mainController->getDisplay($section, $sectionName, $this->pluginData,  $request);
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

        return $mainController->createAction($section, $sectionName, $request, $this->pluginData);
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
    public function parseUrl($path)
    {
        if (strpos($path, '/') == false) {
            $slug = $path;
        } else {
            $url_elements = explode("/", $path);
            $slug = array_pop($url_elements);
        }

        $args = [
            'slug' => $slug,
        ];
        $page = CMSHelper::getQueryBuilder($args);
        $data = $page->first();

        if(!$data)
        {
            abort(404, 'Страница не найдена');
        }
//        dd($data);
        if($data->type == 'post'){
            $teplate = 'post';
            $teplateFolder = config('zeusAdmin.cms_posts_templates_path');
        }elseif($data->type == 'page')
        {
            $teplate = 'page';
            $teplateFolder = config('zeusAdmin.cms_pages_templates_path');
        }
        if($data->template){
            $teplate = $data->template;
        }

        $templatePath = $teplateFolder . '.' . $teplate;
        if(!View::exists($templatePath))
        {
            throw new \Exception('Шаблон ' . $templatePath . ' не найден');
        }

        SEO::setTitle('Home');
        SEO::setDescription('This is my page description');
        SEO::addKeyword(['key1', 'key2', 'key3']);
        
        return view($templatePath)->with(compact('data'));
    }

    public static function showPage($slug)
    {
        $args = [
            'type' => 'page',
            'slug' => $slug,
        ];
        $page = CMSHelper::getQueryBuilder($args);
        $page = $page->first();

        if(!$page)
        {
            abort(404, 'Страница не найдена');
        }

        if($page->template){
            $teplate = $page->template;
        }else{
            $teplate = 'page';
        }
        $templatePath = config('zeusAdmin.cms_pages_templates_path') . '.' . $teplate;
        if(!View::exists($templatePath))
        {
            throw new \Exception('Шаблон ' . $templatePath . ' не найден');
        }

        return [
            'view'=>$templatePath,
            'data'=>compact('page')
        ];
    }

    public static function showPost($slug)
    {
        $args = [
            'type' => 'post',
            'slug' => $slug,
        ];
        $post = CMSHelper::getQueryBuilder($args);
        $post = $post->first();

        if(!$post)
        {
            abort(404, 'Запись не найдена');
        }
        if($post->status !== 'published')
        {
            abort(404, 'Запись не найдена');
        }

        if($page->template){
            $teplate = $post->template;
        }else{
            $teplate = 'post';
        }

        $templatePath = config('zeusAdmin.cms_posts_templates_path') . '.' . $teplate;
        if(!View::exists($templatePath))
        {
            throw new \Exception('Шаблон ' . $templatePath . ' не найден');
        }

        return [
            'view'=>$templatePath,
            'data'=>compact('post')
        ];
    }

    public function fileUpload(Request $request)
    {
        $file = $request->file('file');
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $day = Carbon::now()->day;
        $timestamp = Carbon::now()->format('YmdHis');
        $pathPart='/uploads/'.$year.'/'.$month.'/'.$day;
        $destinationPath = public_path().''.$pathPart;
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }
        $originalFilename = $file->getClientOriginalName();
        $basename = preg_replace('/\.\w+$/', '', $originalFilename);
        $extension = $file->getClientOriginalExtension();
        $filename = $basename;
        if (file_exists(''.$destinationPath.'/'.$filename.'.'.$extension)) {
            $filename = $basename.'-'.$timestamp;
        }
        $resultFileName = str_replace(' ', '_', $filename.'.'.$extension);
        $fileMime = $file->getMimeType();
        $fileSize = $file->getSize();
        $upload_success = $file->move($destinationPath, $resultFileName);
        $newFilePath = $destinationPath.'/'.$resultFileName;
        if ($upload_success) {
            $url = $pathPart.'/'.$resultFileName;
            $base_url = $pathPart.'/'.$filename;
            $newFile = new ZeusAdminFile;

            $newFile->mime = $fileMime;
            $newFile->url = $url;
            $newFile->base_url = $base_url;
            $newFile->extension = $extension;
            $newFile->path = $destinationPath;
            $newFile->size = $fileSize;

            $newFile->save();
            if(strstr($fileMime, "image/")){
                $thumbPath = $destinationPath.'/'.$filename.'-200x200'.'.'.$extension;
                Image::make($newFilePath)->fit(200)->save($thumbPath);
            }
            return response()->json(
                [
                    'success' => 200,
                ]
            );
        } else {
            return response()->json(
                [
                    'error' => 400,
                ]
            );
        }
    }
}
