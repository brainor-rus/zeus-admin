<?php
/**
 * Created by PhpStorm.
 * User: Артем
 * Date: 02.10.2018
 * Time: 13:36
 */

namespace Zeus\Admin\SectionBuilder\Form\Panel\Fields;


use Illuminate\Support\Facades\View;
use Zeus\Admin\SectionBuilder\Form\Panel\Fields\BaseField\FormFieldBase;

class Gallery extends DropZone
{

    public function __construct($label, $id = null)
    {
        $name = 'zagallery';
        $id = $id ?? $name;
        $url = route('zeusAdmin.cms.file-upload', ['g=1']);

        parent::__construct($name, $label, $id, $url);
    }

    public function render($model = null)
    {
        $name = $this->getName();
        $label = $this->getLabel();
        $id = $this->getId();
        $url = $this->getUrl();
        $helpBlock = $this->getHelpBlock();
        $relatedName = $this->getRelatedName();
        $formIgnore = $this->getFormIgnore();
        $dataAttributes = $this->getDataAttributes();
        $classes = $this->getClasses();

        return View::make('zeusAdmin::SectionBuilder/Form/Fields/gallery')
            ->with(compact(
                'name',
                'label',
                'id',
                'url',
                'helpBlock',
                'relatedName',
                'formIgnore',
                'dataAttributes',
                'classes',
                'model'
            ));
    }
}