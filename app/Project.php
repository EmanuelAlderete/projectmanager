<?php

namespace App;

use App\Todolist;
use App\Institution;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title', 'description', 'authors',
        'type_project_id', 'user_id', 'subject',
        'teacher_id', 'deadline', 'subtitle', 'website',
        'institution_id', 'course_id', 'teacher_name', 'status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function institution() {
        return $this->belongsTo(Institution::class);
    }

    public function todolists() {
        return $this->hasMany(Todolist::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function typeProject() {
        return $this->belongsTo(TypeProject::class);
    }
}
