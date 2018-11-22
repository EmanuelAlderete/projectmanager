<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name'
    ];

    public function departments() {
        return $this->belongsToMany(Department::class);
    }

    public function projects() {
        return $this->belongsToMany(Project::class);
    }
}
