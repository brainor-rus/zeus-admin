<?php

namespace Zeus\Admin\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class ZeusAdminMenu extends Model
{
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
        'title', 'slug', 'description','class', 'order', 'created_at', 'updated_at'
    ];

    public function elements()
    {
        return $this->hasMany('Zeus\Admin\Cms\Models\ZeusAdminMenuElement', 'menu_id', 'id');
    }
}
