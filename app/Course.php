<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name', 'label', 'icon'
    ];

    public function degree() {
        return $this->belongsTo(Degree::class);
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function institutions() {
        return $this->belongsToMany(Institution::class);
    }

    public function ideas() {
        return $this->belongsToMany(Idea::class);
    }
}
