<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @property string name
 * @property string description
 * @property string avatar
 * @property string email
 * @package App
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAvatar()
    {
        if (empty($this->avatar)) {
            return '//placehold.it/128x128';
        }

        return "/uploads/avatars/{$this->avatar}";
    }

    public function getAvatarPath()
    {
        return public_path("/uploads/avatars/{$this->avatar}");
    }

    public function removeAvatar()
    {
        if (file_exists($this->getAvatarPath())) {
            return unlink($this->getAvatarPath()) && $this->avatar = '';
        }

        $this->avatar = '';
        return true;
    }
}
