<?php
/**
 * Created by PhpStorm.
 * User: Артем
 * Date: 10.10.2018
 * Time: 11:54
 */

namespace Zeus\Admin\Cms\Helpers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class TemplatesHelper
{
    public static function getTemplates($type)
    {
        $templatesDirectory = $type == 'page' ? config('zeusAdmin.cms_pages_templates_path') : config('zeusAdmin.cms_posts_templates_path');

        switch ($type) {
            case 'page':
                $templatesDirectory = config('zeusAdmin.cms_pages_templates_path');
                break;
            case 'post':
                $templatesDirectory = config('zeusAdmin.cms_posts_templates_path');
                break;
            case 'term':
                $templatesDirectory = config('zeusAdmin.cms_terms_templates_path');
                break;
        }

        $templatesDirectory = Config::get('view.paths')[0] . '/' . str_replace('.', '/', $templatesDirectory);
        $templates = [];
        if ($handle = opendir($templatesDirectory)) {
            while (false !== ($file = readdir($handle))) {
                if(preg_match("|.php|",$file)){
                    $docComments = array_filter(
                        token_get_all( file_get_contents( $templatesDirectory.'/'.$file ) ), function($entry) {
                            return $entry[0] == T_DOC_COMMENT;
                        }
                    );
                    $fileDocComment = array_shift( $docComments )[1];
                    $commentRows = explode("\n", $fileDocComment);
                    foreach ($commentRows as $commentRow){
                        if(stripos($commentRow,':' )){
                            $commentRowParams = explode(":", $commentRow);
                            $commentParams[trim(ltrim(trim($commentRowParams[0]),'*'))]= trim($commentRowParams[1]);
                        }
                    }
                    if(isset($commentParams)) {
                        if (isset($commentParams['class'])) {
                            if($commentParams['class'] == 'ZeusAdmin' . Str::studly($type) . 'Template')
                            {
                                $templates[basename($file, ".blade.php")] = $commentParams['title'];
                            }
                        }
                    }
                }
            }
            closedir($handle);
        }

        return $templates;
    }
}
