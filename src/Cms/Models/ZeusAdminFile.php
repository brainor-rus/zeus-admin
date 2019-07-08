<?php

namespace Zeus\Admin\Cms\Models;

use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Model;

class ZeusAdminFile extends Model
{
    use Uuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mime', 'extension', 'url', 'base_url', 'path', 'size', 'title', 'alt', 'description', 'uuid'
    ];

    public function terms()
    {
        return $this->morphToMany('Zeus\Admin\Cms\Models\ZeusAdminTerm', 'zeus_admin_termable', 'zeus_admin_termables', 'zeus_admin_termable_id', 'zeus_admin_term_id');
    }

    public function tags()
    {
        return $this->morphToMany('Zeus\Admin\Cms\Models\ZeusAdminTag', 'zeus_admin_termable', 'zeus_admin_termables', 'zeus_admin_termable_id', 'zeus_admin_term_id')->where('type', 'tag');
    }

    public function categories()
    {
        return $this->morphToMany('Zeus\Admin\Cms\Models\ZeusAdminTerm', 'zeus_admin_termable', 'zeus_admin_termables', 'zeus_admin_termable_id', 'zeus_admin_term_id')->where('type', 'category');
    }
}
