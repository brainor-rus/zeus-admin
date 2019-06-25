<?php

namespace Zeus\Admin\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Cviebrock\EloquentSluggable\Sluggable;

class ZeusAdminMenuElement extends Model
{
    use Sluggable, NodeTrait {
        NodeTrait::replicate as replicateNode;
        Sluggable::replicate as replicateSlug;
    }

    public function replicate(array $except = null)
    {
        $instance = $this->replicateNode($except);
        (new SlugService())->slug($instance, true);

        return $instance;
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'description', 'menu_id', 'status', 'url',
        'parent_id', '_lft', '_rgt', 'depth', 'created_at', 'updated_at'
    ];
    public function menu()
    {
        return $this->belongsTo('Zeus\Admin\Cms\Models\ZeusAdminMenu', 'id', 'menu_id');
    }
}
