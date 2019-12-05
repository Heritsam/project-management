<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'username', 'password', 'user_group_id', 'status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function group()
    {
        return $this->belongsTo('App\UserGroup', 'user_group_id');
    }

    public function projects()
    {
        return $this->hasMany('App\Project', 'created_by');
    }

    public function contributes()
    {
        return $this->hasMany('App\ProjectContributor');
    }

    public function comments()
    {
        return $this->hasMany('App\ProjectTimelineComment', 'created_by');
    }
}
