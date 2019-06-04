<?php

namespace Zeus\Admin\Cms\Models;

use Illuminate\Database\Eloquent\Model;

class ZeusAdminCustomFieldGroupCondition extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_id', 'condition_type', 'condition_parameter', 'condition_value'
    ];

    public function group()
    {
        return $this->belongsTo(ZeusAdminCustomFieldGroup::class, 'id', 'group_id');
    }
}
