<?php

namespace Zeus\Admin\Cms\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Cviebrock\EloquentSluggable\Sluggable;

class ZeusAdminPost extends Model
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
        'type', 'title', 'slug', 'description', 'content', 'status', 'url',
        'parent_id', '_lft', '_rgt', 'depth', 'user_id', 'template', 'thumb', 'comment_on', 'published_at', 'created_at', 'updated_at'
    ];

    public function getDefaultUrlAttribute($withCategory = false)
    {
        foreach ($this->ancestors as $ancestor)
        {
            $ancestors[] = $ancestor->slug;
        }
        $ancestors[] = $this->slug;

        $url = '';
        foreach ($ancestors as $ancestor)
        {
            $url .= ('/' . $ancestor);
        }

        if($withCategory)
        {
            $url = '/' . ($this->categories->last()->slug ?? 'not-category') . $url;
        }

        return $url;
    }

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

    public function comments()
    {
        return $this->morphToMany('Zeus\Admin\Cms\Models\ZeusAdminComment', 'zeus_admin_commentable', 'zeus_admin_commentables', 'zeus_admin_commentable_id', 'zeus_admin_comment_id');
    }

    public function scopePages($query)
    {
        return $query->where('type', 'page');
    }

    public function scopePosts($query)
    {
        return $query->where('type', 'post');
    }
}
