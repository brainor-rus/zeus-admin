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
    protected $helpBlock;

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


}