<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'image_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * ユーザの権限を取得
     */
    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    /**
    * ユーザの画像を取得
    */
    public function image()
    {
        return $this->belongsTo('App\Image');
    }

    /**
    * パスワードの暗号化
    */
    public function setPasswordAttribute($password)
    {
        if ($password == '') {
            unset($this->attributes['password']);
        } else {
            $this->attributes['password'] = bcrypt($password);
        }
    }

}
