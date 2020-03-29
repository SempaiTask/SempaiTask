<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * Disable timestamps
     *
     * @var bool
     */
    public $timestamps = false;


    protected $fillable = ['active', 'website', 'name'];

    public function projectGroup()
    {
        return $this->hasMany('App\ProjectGroup');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function($project) {
            $project->projectGroup()->delete();
        });
    }
}
