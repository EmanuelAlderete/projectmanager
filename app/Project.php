<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title', 'description', 'authors', 'type_project_id', 'user_id', 'subject', 'teacher_id', 'deadline'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function courses() {
        return $this->hasMany(Course::class);
    }

    public function departments() {
        return $this->hasMany(Department::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function typeProject() {
        return $this->belongsTo(TypeProject::class);
    }
}
