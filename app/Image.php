<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'path',
    ];

    protected $uploads_path = "/images/";

    /**
    * 画像のユーザを取得
    */
    public function user()
    {
        return $this->hasOne('App\User');
    }

    /**
    * pathの値取得時にパスを変更して取得
    */
    public function getPathAttribute($path)
    {
        return $this->uploads_path . $path;
    }
}
