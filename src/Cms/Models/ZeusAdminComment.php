<?php

namespace Zeus\Admin\Cms\Models;

use Illuminate\Database\Eloquent\Model;

class ZeusAdminComment extends Model
{
    protected $fillable = [
        'id', 'user_id', 'email', 'fio', 'ip', 'text', 'rating', 'visible', 'moderate'
    ];
}
