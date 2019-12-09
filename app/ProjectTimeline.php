<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class ProjectTimeline extends Model
{
    use NodeTrait;
    
    protected $fillable = [
        'project_id', 'description', 'date_start', 'date_end', 'date_done', 'user_done_id', 'status', 'user_assign_id', 'created_by', 'updated_by',
    ];

    public function done_by()
    {
        return $this->belongsTo('App\User', 'user_done_id');
    }

    public function assigned_to()
    {
        return $this->belongsTo('App\User', 'user_assign_id');
    }

    public function started_by()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function status()
    {
        if ($this->date_done) {
            return "Done";
        } else {
            return "Pending";
        }
    }

    public function comments()
    {
        return $this->hasMany('App\ProjectTimelineComment', 'project_timelines_id');
    }
}
