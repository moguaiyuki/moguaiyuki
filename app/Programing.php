<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Programing extends Model
{
    use Sluggable;

    protected $fillable = [
        'title', 'content', 'user_id', 'image_id', 'is_published', 'slug', 'slug_title'
    ];

    /**
     * Programingの画像を取得
     */
    public function image()
    {
        return $this->belongsTo('App\Image');
    }

    /**
     * Programingのタグを取得
     */
    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }

    /**
    * Programing記事の投稿者を取得
    */
    public function user()
    {
        return $this->belongsTo('App\User');
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
                'source' => 'slug_title'
            ]
        ];
    }
}