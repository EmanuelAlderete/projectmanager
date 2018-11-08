<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

    protected $fillable = ['user_id', 'idea_id'];
    protected $dates = ['deleted_at'];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function idea() {
        return $this->belongsTo(Idea::class);
    }
}
