<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 08.06.2019
 * Time: 9:15
 */

namespace Zeus\Admin\SectionBuilder\Form\Panel\Fields\BaseField;


class FormFieldBase
{
    protected $helpBlock, $row, $relatedName, $formIgnore, $dataAttributes, $classes, $isSystem;

    /**
     * @return mixed
     */
    public function getHelpBlock()
    {
        return $this->helpBlock;
    }

    /**
     * @return mixed
     */
    public function getIsSystem()
    {
        return $this->isSystem;
    }

    /**
     * @param mixed $isSystem
     */
    public function setIsSystem($isSystem)
    {
        $this->isSystem = $isSystem;
        return $this;
    }

    /**
     * @param mixed $helpBlock
     */
    public function setHelpBlock($helpBlock)
    {
        $this->helpBlock = $helpBlock;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRow()
    {
        return $this->row;
    }

    /**
     * @param mixed $row
     */
    public function setRow($row)
    {
        $this->row = $row;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRelatedName()
    {
        return $this->relatedName;
    }

    /**
     * @param mixed $relatedName
     */
    public function setRelatedName($relatedName)
    {
        $this->relatedName = $relatedName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFormIgnore()
    {
        return $this->formIgnore;
    }

    /**
     * @param mixed $formIgnore
     */
    public function setFormIgnore($formIgnore)
    {
        $this->formIgnore = $formIgnore;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDataAttributes()
    {
        return $this->dataAttributes;
    }

    /**
     * @param mixed $dataAttributes
     */
    public function setDataAttributes($dataAttributes)
    {
        $this->dataAttributes = $dataAttributes;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * @param mixed $classes
     */
    public function setClasses($classes)
    {
        $this->classes = $classes;
        return $this;
    }

}