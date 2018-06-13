<?php

namespace FiguredBlog;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->visible_at ===  null){
                $model->visible_at = date('Y-m-d H:i:s');
            }
            $model->slug = str_slug($model->title . $model->id);
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $fillable = [
        'visible_at', 'title', 'body',
    ];
}
