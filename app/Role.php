<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
    ];


    /**
     * 特定の役割を持つのユーザーを取得
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
