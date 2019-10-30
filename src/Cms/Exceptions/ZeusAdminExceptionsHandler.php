<?php

namespace Zeus\Admin\Cms\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

use Zeus\Admin\Cms\Helpers\CMSHelper;
use Zeus\Admin\Cms\Controllers\CmsController;

class ZeusAdminExceptionsHandler extends ExceptionHandler
{
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if($exception instanceof NotFoundHttpException || $exception instanceof MethodNotAllowedHttpException)
        {
            $localeField = config('zeusAdmin.locale_field') ?? 'locale';

            if($request->hasCookie($localeField)) {
                // Get cookie
                $cookieLang = $request->cookie('locale');
                // Set locale
                app()->setLocale($cookieLang);
            }

            $postExistenceCheck = CMSHelper::getByUrl($request->getPathInfo());//Trying to get page
            if($postExistenceCheck && $postExistenceCheck->type !== 'page'){$postExistenceCheck = null;}

            if(!$postExistenceCheck){////Trying to get post or categoryPage
                $uri_segments = explode('/', $request->getPathInfo());
                if(count($uri_segments) == 3){//it is post
                    $postExistenceCheck = CMSHelper::getByUrl('/' . $uri_segments[2]);//Trying to get post
                    if($postExistenceCheck){
                        $postHaveCategoryConnection = $postExistenceCheck->categories->where('slug', $uri_segments[1])->first(); //checking if post has category from url
                        if(!$postHaveCategoryConnection){$postExistenceCheck = null;}
                    }
                }
                if(count($uri_segments) == 2){//it is category
                    $termExistenceCheck = CMSHelper::getTermBySlug($uri_segments[1]);//Trying to get term (any type)
                    if($termExistenceCheck) {
                        $controllerData = CmsController::showTerm($termExistenceCheck->slug);
                        if ($request->isMethod('post')) {
                            return response()->json(
                                array(
                                    'data' => $controllerData['data']['term'],
                                    'meta' => $controllerData['meta']['meta'],
                                    'html' => View::make($controllerData['view'])->with(compact($controllerData['data']))->render()
                                ), 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                                JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
                        }else{
                            return response()->view($controllerData['view'], $controllerData['data']);
                        }
                    }
                }
            }

            if($postExistenceCheck){
                switch ($postExistenceCheck->type) {
                    case 'page':
                        $method = 'showPage';
                        break;
                    case 'post':
                        $method = 'showPost';
                        break;
                }
            }
            if(isset($method)){
                if($postExistenceCheck->status !== 'published'){
                    return response()->view('errors.404', [], 404);
                }

                $controllerData = CmsController::{$method}($postExistenceCheck->slug);
                if ($request->isMethod('post')) {
                    return response()->json(
                        array(
                            'data' => $controllerData['data']['page'] ?? $controllerData['data']['post'],
                            'meta' => $controllerData['meta']['meta'],
                            'html' => View::make($controllerData['view'])->with($controllerData['data'])->render()
                        ), 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                        JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
                }else{
                    return response()->view($controllerData['view'], $controllerData['data']);
                }
            }
        }
        return parent::render($request, $exception);
    }
}
