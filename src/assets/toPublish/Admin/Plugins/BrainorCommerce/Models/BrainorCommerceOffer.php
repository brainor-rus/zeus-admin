<?php

namespace Zeus\Admin\Plugins\BrainorCommerce\Models;

use Zeus\Admin\Cms\Models\ZeusAdminTag;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Zeus\Admin\Cms\Models\ZeusAdminTerm;

class BrainorCommerceOffer extends Model
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
                'source' => 'name'
            ]
        ];
    }

    protected $fillable = [
        'name', 'slug', 'discount', 'price', 'category_id', 'visible', 'description', 'article', 'producer_id'
    ];

    public function category()
    {
        return $this->hasOne(ZeusAdminTerm::class, 'id', 'category_id');
    }

    public function attribute_names()
    {
        return $this->hasMany(BrainorCommerceAttributeName::class)
            ->orderBy('order')
            ->orderBy('name');
    }

    public function attribute_value()
    {
        return $this->hasMany(BrainorCommerceAttributeValue::class);
    }
}
