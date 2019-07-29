<?php

namespace Zeus\Admin\Cms\Models;

use Illuminate\Database\Eloquent\Model;

class ZeusAdminCustomFieldData extends Model
{
    protected $table = 'zeus_admin_custom_field_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'value', 'field_id', 'description', 'customable_id', 'customable_type'
    ];

    public function field()
    {
        return $this->belongsTo(ZeusAdminCustomField::class, 'field_id', 'id');
    }

    public function getFieldSlugAttribute()
    {
        return $this->field()->first()->slug;
    }

    public function getGroupSlugAttribute()
    {
        return $this->field()->first()->group()->first()->slug;
    }
}
