<?php

namespace Zeus\Admin\Cms\Models;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class ZeusAdminCustomFieldGroup extends Model
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
        'name',  'slug', 'description', 'position', 'order'
    ];

    public function conditions()
    {
        return $this->hasMany(ZeusAdminCustomFieldGroupCondition::class, 'group_id', 'id');
    }

    public function fields()
    {
        return $this->hasMany(ZeusAdminCustomField::class, 'group_id', 'id');
    }

}
