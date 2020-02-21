<?php
/**
 * Created by PhpStorm.
 * User: Артем
 * Date: 02.10.2018
 * Time: 13:04
 */

namespace Zeus\Admin\SectionBuilder\Form\Panel;


use Zeus\Admin\SectionBuilder\Meta\Meta;
use Illuminate\Support\Facades\View;
use Zeus\Admin\Section;

class PanelForm
{
    private $columns,
            $meta,
            $showButtons = true,
            $showTopButtons = false,
            $attributes,
            $copyable = false;

    public function __construct($columns)
    {
        $this->setColumns($columns);
        $this->meta = new Meta;
    }

    /**
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param mixed $attributes
     * @return $this
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
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
     * @return mixed
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * @param mixed $columns
     */
    public function setColumns($columns): void
    {
        $this->columns = $columns;
    }

    /**
     * @param mixed $meta
     * @return DisplayTable
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;
        return $this;
    }

    /**
     * @return bool
     */
    public function isShowButtons()
    {
        return $this->showButtons;
    }

    /**
     * @return bool
     */
    public function isShowTopButtons()
    {
        return $this->showTopButtons;
    }

    /**
     * @param bool $showButtons
     * @return PanelForm
     */
    public function setShowButtons($showButtons)
    {
        $this->showButtons = $showButtons;
        return $this;
    }

    /**
     * @param bool $showTopButtons
     * @return PanelForm
     */
    public function setShowTopButtons($showTopButtons)
    {
        $this->showTopButtons = $showTopButtons;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCopyable(): bool
    {
        return $this->copyable;
    }

    /**
     * @param bool $copyable
     * @return PanelForm
     */
    public function setCopyable(bool $copyable): PanelForm
    {
        $this->copyable = $copyable;

        return $this;
    }

    public function render($modelPath, $sectionName, Section $firedSection, $id = null, $copyId = null, $pluginData = null)
    {
        $columns = $this->getColumns();
        $model = new $modelPath();
        $action = 'create';

        if(isset($id)) {
            $model = $model->where('id', $id)->firstOrFail();
            $action = 'edit';
        } elseif(isset($copyId)) {
            $model = $model->where('id', $copyId)->firstOrFail();
        }

        if(!empty($pluginData)) {
            $rc = new \ReflectionClass($firedSection);
            $params['{sectionName}'] = $rc->getShortName();
            if(isset($id))
            {
                $params['{id}'] = $id;
                $params['{action}'] = 'edit';
            }

            $pluginData = array_map(function ($datum) use ($params) {
                return strtr($datum, $params);
            }, $pluginData);
        }

        $showButtons = self::isShowButtons();
        $showTopButtons = self::isShowTopButtons();
        $attributes = $this->getAttributes();
        $copyable = $this->isCopyable();

        $response = View::make('zeusAdmin::SectionBuilder/Form/Panel/panel')
            ->with(compact(
                'model',
                'columns',
                'sectionName',
                'action',
                'id',
                'pluginData',
                'showButtons',
                'showTopButtons',
                'attributes',
                'copyable'
            ));

        return $response;
    }
}
