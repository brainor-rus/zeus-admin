<?php
/**
 * Created by PhpStorm.
 * User: Артем
 * Date: 19.06.2019
 * Time: 08:52
 */

namespace Zeus\Admin\SectionBuilder\Form\Panel\Fields;
use Illuminate\Support\Facades\View;
use Zeus\Admin\SectionBuilder\Form\Panel\Fields\BaseField\FormFieldBase;

class Related extends FormFieldBase
{
    private $name, $label, $columns;

    public function __construct($name, $label, $columns)
    {
        $this->setName($name);
        $this->setLabel($label);
        $this->setColumns($columns);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * @param mixed $columns
     */
    public function setColumns($columns)
    {
        $this->columns = $columns;
        return $this;
    }

    public function render($relatedRows = [])
    {
        $name = $this->getName();
        $label = $this->getLabel();
        $columns = $this->getColumns();
        $relatedName = $this->getRelatedName();

        return View::make('zeusAdmin::SectionBuilder/Form/Fields/related')
            ->with(compact(
                'name',
                'label',
                'columns',
                'relatedRows',
                'relatedName'
            ));
    }
}