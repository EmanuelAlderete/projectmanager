<?php

namespace App;

use App\Course;
use App\Project;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $fillable = [
        'name', 'about', 'address'
    ];

    public function courses() {
        return $this->belongsToMany(Course::class);
    }

    public function projects() {
        return $this->belongsToMany(Project::class);
    }
}
