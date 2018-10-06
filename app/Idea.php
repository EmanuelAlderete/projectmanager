<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    protected $fillable = [
        'content', 'status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function courses() {
        return $this->belongsToMany(Course::class);
    }

    public function departments() {
        return $this->belongsToMany(Department::class);
    }
}
