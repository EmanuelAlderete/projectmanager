<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name'
    ];

    public function projects() {
        return $this->belongsToMany(Project::class);
    }

    public function courses() {
        return $this->belongsToMany(Course::class);
    }
}
