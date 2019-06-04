<?php

namespace Zeus\Admin\Cms\Models;

use Illuminate\Database\Eloquent\Model;

class ZeusAdminCustomFieldData extends Model
{

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
        return $this->belongsTo(ZeusAdminCustomField::class, 'id', 'field_id');
    }
}
