<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectGroupCampaign extends Model
{
    /**
     * Disable timestamps
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = ['project_group_id', 'name', 'status', 'date_start'];

    public function projectGroup()
    {
        return $this->belongsTo('App\ProjectGroup');
    }
}
