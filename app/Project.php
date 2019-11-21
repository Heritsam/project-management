<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{   
    protected $fillable = [
        'name', 'date_start', 'date_due', 'status', 'created_by', 'updated_by',
    ];

    protected $dates = [
        'date_start', 'date_due',
    ];

    public function contributors()
    {
        return $this->hasMany('App\ProjectContributor');
    }

    public function timelines()
    {
        return $this->hasMany('App\ProjectTimeline');
    }

    public function started_by()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}
