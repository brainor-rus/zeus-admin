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

class BSelect extends Select
{
    public function render($value = null)
    {
        $name = $this->getName();
        $label = $this->getLabel();
        $required = $this->getRequired();
        $readonly = $this->getReadonly();
        $options = $this->getOptions();
        $helpBlock = $this->getHelpBlock();
        $relatedName = $this->getRelatedName();
        $formIgnore = $this->getFormIgnore();
        $dataAttributes = $this->getDataAttributes();
        $classes = $this->getClasses();
        $defaultSelected = $this->getDefaultSelected();

        return View::make('zeusAdmin::SectionBuilder/Form/Fields/bootstrap-select')
            ->with(compact(
                'name',
                'label',
                'value',
                'required',
                'readonly',
                'options',
                'helpBlock',
                'relatedName',
                'formIgnore',
                'dataAttributes',
                'classes',
                'defaultSelected'
            ));
    }
}