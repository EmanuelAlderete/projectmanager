<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name', 'label', 'area', 'degree_id'
    ];

    public function degree() {
        return $this->belongsTo(Degree::class);
    }

    public function users() {
        return $this->hasMany(User::class);
    }

    public function ideas() {
        return $this->belongsToMany(Idea::class);
    }

    public function institutions() {
        return $this->belongsToMany(Institution::class);
    }

    public function projects() {
        return $this->hasMany(Project::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
}
