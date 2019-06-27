<?php
/**
 * Created by PhpStorm.
 * User: Artem
 * Date: 04.12.2018
 * Time: 12:28
 */
namespace Zeus\Admin\SectionBuilder\Filter\Types;
use Illuminate\Support\Facades\View;

class BSelect extends Select
{
    protected $dataAttributes;

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

    public function render()
    {
        $name = $this->getName();
        $options = $this->getOptions();
        $isLike = $this->isLike();
        $dataAttributes = $this->getDataAttributes();

        return View::make('zeusAdmin::SectionBuilder/Filter/bselect')
            ->with(compact(
                'name',
                'options',
                'isLike',
                'dataAttributes'
            ));
    }
}