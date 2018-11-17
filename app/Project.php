<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title', 'description', 'authors', 'type_project_id', 'user_id'
    ];

    public function typeProject() {
        return $this->belongsTo(TypeProject::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
