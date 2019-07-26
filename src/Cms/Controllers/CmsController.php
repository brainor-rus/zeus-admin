<?php

namespace Zeus\Admin\Cms\Controllers;

use Zeus\Admin\Cms\Helpers\CMSHelper;
use Zeus\Admin\Cms\Helpers\MenuHelper;
use Zeus\Admin\Cms\Models\ZeusAdminPost;
use Zeus\Admin\Cms\Providers\Cms;
use Zeus\Admin\Controllers\ZeusAdminController;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

use Zeus\Admin\Cms\Models\ZeusAdminFile;
use Zeus\Admin\Cms\Models\ZeusAdminMenu;
use Zeus\Admin\Cms\Models\ZeusAdminMenuElement;
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
        'cancelUrl' => '',
    ];

    // Направляет CMS секции на кастомные, если таковые заданы в конфиге
    private function makeCustomSection($sectionName) {
        $srcSectionName = $sectionName;
        $isCustom = false;

        switch ($sectionName) {
            case 'ZeusAdminComments':
                if(!empty(config('zeusAdmin.cms_comments_section'))) {
                    $sectionName = config('zeusAdmin.cms_comments_section');
                    $isCustom = true;
                }
                break;

            case 'ZeusAdminFiles':
                if(!empty(config('zeusAdmin.cms_files_section'))) {
                    $sectionName = config('zeusAdmin.cms_files_section');
                    $isCustom = true;
                }
                break;

            case 'ZeusAdminMenus':
                if(!empty(config('zeusAdmin.cms_menus_section'))) {
                    $sectionName = config('zeusAdmin.cms_menus_section');
                    $isCustom = true;
                }
                break;

            case 'ZeusAdminPages':
                if(!empty(config('zeusAdmin.cms_pages_section'))) {
                    $sectionName = config('zeusAdmin.cms_pages_section');
                    $isCustom = true;
                }
                break;

            case 'ZeusAdminPosts':
                if(!empty(config('zeusAdmin.cms_posts_section'))) {
                    $sectionName = config('zeusAdmin.cms_posts_section');
                    $isCustom = true;
                }
                break;

            case 'ZeusAdminTags':
                if(!empty(config('zeusAdmin.cms_tags_section'))) {
                    $sectionName = config('zeusAdmin.cms_tags_section');
                    $isCustom = true;
                }
                break;

            case 'ZeusAdminTerms':
                if(!empty(config('zeusAdmin.cms_terms_section'))) {
                    $sectionName = config('zeusAdmin.cms_terms_section');
                    $isCustom = true;
                }
                break;

            default: break;
        }

        if($isCustom) {
            $this->pluginData['sectionPath'] = config('zeusAdmin.user_path') . '\\Sections\\';
            $this->pluginData['deleteUrl'] = '/' . config('zeusAdmin.admin_url') . "/cms/{$srcSectionName}";
            $this->pluginData['redirectUrl'] = '/' . config('zeusAdmin.admin_url') . "/cms/{$srcSectionName}/{id}/{action}";
            $this->pluginData['cancelUrl'] = '/' . config('zeusAdmin.admin_url') . "/cms/{$srcSectionName}";
        }

        return $sectionName;
    }

    public function __construct(\Illuminate\Contracts\Foundation\Application $app)
    {
        $this->app = $app;
        $this->pluginData['deleteUrl'] = '/' . config('zeusAdmin.admin_url') . '/cms/{sectionName}';
        $this->pluginData['redirectUrl'] = '/' . config('zeusAdmin.admin_url') . '/cms/{sectionName}/{id}/{action}';
        $this->pluginData['cancelUrl'] = '/' . config('zeusAdmin.admin_url') . '/cms/{sectionName}';
    }

    public function showRouteRedirect(Section $section, $sectionName, Request $request)
    {
        $sectionName = $this->makeCustomSection($sectionName);
        $mainController = new ZeusAdminController;
        return $mainController->getDisplay($section, $sectionName, $this->pluginData,  $request);
    }

    public function createRouteRedirect(Section $section, $sectionName)
    {
        $sectionName = $this->makeCustomSection($sectionName);
        $mainController = new ZeusAdminController;

        return $mainController->getCreate($section, $sectionName, $this->pluginData);
    }

    public function editRouteRedirect(Section $section, $sectionName, $id)
    {
        $sectionName = $this->makeCustomSection($sectionName);
        $mainController = new ZeusAdminController;

        return $mainController->getEdit($section, $sectionName, $id, $this->pluginData);
    }

    public function createActionRouteRedirect(Section $section, $sectionName, Request $request)
    {
        $sectionName = $this->makeCustomSection($sectionName);
        $mainController = new ZeusAdminController;

        return $mainController->createAction($section, $sectionName, $request, $this->pluginData);
    }

    public function editActionRouteRedirect(Section $section, $sectionName, $id, Request $request)
    {
        $sectionName = $this->makeCustomSection($sectionName);
        $mainController = new ZeusAdminController;

        return $mainController->editAction($section, $sectionName, $id, $request);
    }

    public function deleteActionRouteRedirect(Section $section, $sectionName, $id, Request $request)
    {
        $sectionName = $this->makeCustomSection($sectionName);
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
        $modelPath = config('zeusAdmin.page_model') ?? ZeusAdminPost::class;

        $page = $modelPath::where([
            ['type', 'page'],
            ['slug', $slug]
        ]);
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
        $modelPath = config('zeusAdmin.post_model') ?? ZeusAdminPost::class;

        $post = $modelPath::where([
            ['type', 'post'],
            ['slug', $slug]
        ]);
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
            $newFile->title = $filename;
            $newFile->alt = $filename;
            if(!empty($request->uuid)) {
                $newFile->uuid = $request->uuid;
            }

            $newFile->save();
            if(strstr($fileMime, "image/")){
                $thumbPath = $destinationPath.'/'.$filename.'-200x200'.'.'.$extension;
                Image::make($newFilePath)->fit(200)->save($thumbPath);
            }

            if($request->get('g') === '1') {
                return $newFile->uuid;
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

    public function menuElementCreate(Request $request)
    {
        $newMenuElement = new ZeusAdminMenuElement;

        $newMenuElement->menu_id = $request->menu_id;
        $newMenuElement->title = $request->title;
        $newMenuElement->slug = $request->slug;
        $newMenuElement->url = $request->url;
        $newMenuElement->description = $request->description;

        switch ($request->tree_type) {
            case "root":
                $newMenuElement->makeRoot();
                break;

            case "before":
                $neighbor = ZeusAdminMenuElement::where('id',$request->tree_neighbor)->first();
                $newMenuElement->beforeNode($neighbor);

            case "after":
                $neighbor = ZeusAdminMenuElement::where('id',$request->tree_neighbor)->first();
                $newMenuElement->afterNode($neighbor);
                break;

            case "inside":
                $parent = ZeusAdminMenuElement::where('id',$request->parent_id)->first();
                $newMenuElement->parent_id = $parent->id;
                break;
        }

        $newMenuElement->save();

        $elementsTree = MenuHelper::getMenuTreeById($request->menu_id);

        return view('zeusAdmin::SectionBuilder.Form.Fields.Menu.TreeOutput.Sortable.main')->with(compact('elementsTree'));
    }

    public function menuElementEdit(Request $request)
    {
        $updateArray ['title'] = $request->title;
        $updateArray ['slug'] = $request->slug;
        $updateArray ['url'] = $request->url;
        $updateArray ['description'] = $request->description;

        $newMenuElement =  ZeusAdminMenuElement::where('id', $request->element_id)->update($updateArray);

        $elementsTree = MenuHelper::getMenuTreeById($request->menu_id);

        return view('zeusAdmin::SectionBuilder.Form.Fields.Menu.TreeOutput.Sortable.main')->with(compact('elementsTree'));
    }

    public function menuElementDelete(Request $request)
    {
        $newMenuElement =  ZeusAdminMenuElement::where('id', $request->element_id)->delete();

        $elementsTree = MenuHelper::getMenuTreeById($request->menu_id);

        return view('zeusAdmin::SectionBuilder.Form.Fields.Menu.TreeOutput.Sortable.main')->with(compact('elementsTree'));
    }

    public function menuElementsReorder(Request $request)
    {

        $movingElement = ZeusAdminMenuElement::where('id', $request->id)->first();

        var_dump($request->parent_id .'-'.$request->next_id .'-'.$request->id);

        if ($request->parent_id == 'root') {
            $movingElement->makeRoot();
        } else {
            if ($request->parent_id != $movingElement->parent_id) {
                $newParent = ZeusAdminMenuElement::where('id', $request->parent_id)->first();
                $movingElement->appendToNode($newParent)->save();
            }
        }

        if ($request->next_id != 'undefined' && $request->next_id != '') {
            $rightNode = ZeusAdminMenuElement::where('id', $request->next_id)->first();
            $movingElement->beforeNode($rightNode)->save();
        } else{
            if ($request->parent_id != 'root') {
                $parentNode = ZeusAdminMenuElement::where('id', $request->parent_id)->first();
                $movingElement->appendToNode($parentNode)->save();
            }
        }
    }

    public function categoryElementCreate(Request $request)
    {
        $newMenuElement = new ZeusAdminMenuElement;

        $newMenuElement->menu_id = $request->menu_id;
        $newMenuElement->title = $request->title;
        $newMenuElement->slug = $request->slug;
        $newMenuElement->url = $request->url;
        $newMenuElement->description = $request->description;

        switch ($request->tree_type) {
            case "root":
                $newMenuElement->makeRoot();
                break;

            case "before":
                $neighbor = ZeusAdminMenuElement::where('id',$request->tree_neighbor)->first();
                $newMenuElement->beforeNode($neighbor);

            case "after":
                $neighbor = ZeusAdminMenuElement::where('id',$request->tree_neighbor)->first();
                $newMenuElement->afterNode($neighbor);
                break;

            case "inside":
                $parent = ZeusAdminMenuElement::where('id',$request->parent_id)->first();
                $newMenuElement->parent_id = $parent->id;
                break;
        }

        $newMenuElement->save();

        $elementsTree = MenuHelper::getMenuTreeById($request->menu_id);

        return view('zeusAdmin::SectionBuilder.Form.Fields.Menu.TreeOutput.Sortable.main')->with(compact('elementsTree'));
    }

    public function categoryElementEdit(Request $request)
    {
        $updateArray ['title'] = $request->title;
        $updateArray ['slug'] = $request->slug;
        $updateArray ['url'] = $request->url;
        $updateArray ['description'] = $request->description;

        $newMenuElement =  ZeusAdminMenuElement::where('id', $request->element_id)->update($updateArray);

        $elementsTree = MenuHelper::getMenuTreeById($request->menu_id);

        return view('zeusAdmin::SectionBuilder.Form.Fields.Menu.TreeOutput.Sortable.main')->with(compact('elementsTree'));
    }

    public function categoryElementDelete(Request $request)
    {
        $newMenuElement =  ZeusAdminMenuElement::where('id', $request->element_id)->delete();

        $elementsTree = MenuHelper::getMenuTreeById($request->menu_id);

        return view('zeusAdmin::SectionBuilder.Form.Fields.Menu.TreeOutput.Sortable.main')->with(compact('elementsTree'));
    }

    public function categoryElementsReorder(Request $request)
    {
        dd($request);

        $movingElement = ZeusAdminMenuElement::where('id', $request->id)->first();

        var_dump($request->parent_id .'-'.$request->next_id .'-'.$request->id);

        if ($request->parent_id == 'root') {
            $movingElement->makeRoot();
        } else {
            if ($request->parent_id != $movingElement->parent_id) {
                $newParent = ZeusAdminMenuElement::where('id', $request->parent_id)->first();
                $movingElement->appendToNode($newParent)->save();
            }
        }

        if ($request->next_id != 'undefined' && $request->next_id != '') {
            $rightNode = ZeusAdminMenuElement::where('id', $request->next_id)->first();
            $movingElement->beforeNode($rightNode)->save();
        } else{
            if ($request->parent_id != 'root') {
                $parentNode = ZeusAdminMenuElement::where('id', $request->parent_id)->first();
                $movingElement->appendToNode($parentNode)->save();
            }
        }
    }
}
