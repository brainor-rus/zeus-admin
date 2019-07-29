<?php

namespace Zeus\Admin\Cms\Models;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class ZeusAdminCustomField extends Model
{
    use Sluggable {
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
                'source' => 'name'
            ]
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'type', 'group_id', 'description', 'value', 'placeholder', 'html', 'options', 'required', 'order'
    ];

    public function group()
    {
        return $this->belongsTo(ZeusAdminCustomFieldGroup::class, 'group_id', 'id');
    }

    public function data()
    {
        return $this->hasMany(ZeusAdminCustomFieldData::class, 'field_id', 'id');
    }
}
