<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkpoint extends Model
{
    protected $fillable = [
        'project_id', 'title', 'message', 'annex', 'status'
    ];

    public function todolists() {
        return $this->hasMany(Todolist::class);
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function feedback() {
        return $this->hasOne(Feedback::class);
    }
}
