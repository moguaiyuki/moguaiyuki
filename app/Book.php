<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title', 'author', 'image_id', 'status', 'is_bookshelf', 'yonda', 'amazon_url',
    ];

    /**
     *　本の画像を取得
     */
    public function image()
    {
        return $this->belongsTo('App\Image');
    }

    /**
    * 本のレビューを取得
    */
    public function review()
    {
        return $this->hasOne('App\BookReview');
    }


}