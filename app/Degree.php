<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    protected $fillable = [
        'name', 'label'
    ];

    public function courses() {
        return $this->hasMany(Course::class);
    }
}
