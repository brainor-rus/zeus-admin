<?php

namespace Zeus\Admin\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class ZeusAdminTag extends ZeusAdminTerm
{
    protected $table = 'zeus_admin_terms';

    use Sluggable;

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
        'type', 'title', 'slug', 'description', 'template', 'parent_id', '_lft', '_rgt', 'depth', 'created_at', 'updated_at'
    ];
}
