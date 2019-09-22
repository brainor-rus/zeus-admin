<?php

namespace Zeus\Admin\Cms\Models;

use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Kalnoy\Nestedset\NodeTrait;

class ZeusAdminTerm extends Model
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
        'type', 'title', 'slug', 'description','template', 'parent_id', '_lft', '_rgt', 'depth', 'created_at', 'updated_at'
    ];

    public function customFields()
    {
        return $this->morphMany('Zeus\Admin\Cms\Models\ZeusAdminCustomFieldData', 'customable', 'customable_type', 'customable_id', 'id');
    }

    public function scopeTags($query)
    {
        return $query->where('type', 'tag');
    }

    public function scopeCategories($query)
    {
        return $query->where('type', 'category');
    }

    public function scopeOfferCategories($query)
    {
        return $query->where('type', 'offer_category');
    }
}
