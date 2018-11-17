<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeProject extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public function projects() {
        return $this->hasMany(Project::class);
    }

}
