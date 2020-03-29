<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectGroup extends Model
{
    /**
     * Disable timestamps
     *
     * @var bool
     */
    public $timestamps = false;

    protected $fillable = ['project_id', 'name', 'budget'];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function projectGroupCampaign()
    {
        return $this->hasMany('App\ProjectGroupCampaign');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function($projectGroup) {
            $projectGroup->projectGroupCampaign()->delete();
        });
    }
}
