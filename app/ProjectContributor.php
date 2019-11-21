<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectContributor extends Model
{
    protected $fillable = [
        'project_id', 'user_id', 'created_by', 'updated_by',
    ];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
