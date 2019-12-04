<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectTimelineComment extends Model
{
    protected $fillable = [
        'project_timelines_id', 'message', 'created_by', 'updated_by',
    ];

    public function project_timeline()
    {
        return $this->belongsTo('App\ProjectTimeline', 'project_timelines_id');
    }
}
