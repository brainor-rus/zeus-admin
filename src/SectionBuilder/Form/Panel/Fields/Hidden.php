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

class Hidden extends FormFieldBase
{
    private $name, $value;

    public function __construct($name)
    {
        $this->setName($name);
        $this->setFormIgnore(false);
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }


    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }


    public function render()
    {
        $name = $this->getName();
        $value = $this->getValue();
        $relatedName = $this->getRelatedName();
        $formIgnore = $this->getFormIgnore();
        $dataAttributes = $this->getDataAttributes();
        $classes = $this->getClasses();

        return View::make('zeusAdmin::SectionBuilder/Form/Fields/hidden')
            ->with(compact(
                'name',
                'value',
                'relatedName',
                'formIgnore',
                'dataAttributes',
                'classes'
            ));
    }
}