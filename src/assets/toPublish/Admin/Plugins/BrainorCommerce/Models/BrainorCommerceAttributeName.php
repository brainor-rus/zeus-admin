<?php

namespace App;

namespace Zeus\Admin\Plugins\BRCommerce\Models;

use Zeus\Admin\Cms\Models\BRTag;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Zeus\Admin\Cms\Models\ZeusAdminTerm;

class BrainorCommerceAttributeName extends Model
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function values()
    {
        return $this->hasMany(BrainorCommerceAttributeValue::class, 'attribute_name_id', 'id');
    }

    public function first_value()
    {
        return $this->hasOne(BrainorCommerceAttributeValue::class, 'attribute_name_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->hasOne(ZeusAdminTerm::class, 'id', 'category_id');
    }
}
