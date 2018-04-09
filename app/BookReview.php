<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class BookReview extends Model
{
    use Sluggable;

    protected $fillable = [
        'book_id', 'title', 'content', 'status', 'user_id', 'slug'
    ];

    /**
     * Bookを取得
     */
    public function book()
    {
        return $this->belongsTo('App\Book');
    }

    /**
     * Userを取得
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
                'source' => 'title'
            ]
        ];
    }
}