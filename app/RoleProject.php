<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleProject extends Model
{
    protected $fillable = [
        'user_id', 'role_id', 'project_id'
    ];

    public function user() {
        return $this->hasOne(User::class);
    }

    public function role() {
        return $this->hasOne(Role::class);
    }

    public function project() {
        return $this->hasOne(Project::class);
    }
}
