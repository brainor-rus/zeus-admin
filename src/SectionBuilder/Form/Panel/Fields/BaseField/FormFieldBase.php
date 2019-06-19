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
    protected $helpBlock, $row, $relatedName;

    /**
     * @return mixed
     */
    public function getHelpBlock()
    {
        return $this->helpBlock;
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

}