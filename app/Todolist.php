<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todolist extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'deadline', 'priority', 'description', 'project_id'
    ];

    protected $dates = ['deleted_at'];

    public function tasks() {
        return $this->hasMany(Task::class);
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }
}
