<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    protected $fillable = [
        'content', 'status', 'user_id' //0-Disponível | 1-Andamento | 2-Concluído
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

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
}
