<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $fillable = [
        'name', 'about', 'address'
    ];

    public function courses() {
        return $this->belongsToMany(Course::class);
    }
}
