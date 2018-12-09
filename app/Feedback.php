<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'user_id', 'checkpoint_id', 'message', 'rating'
    ];

    public function user() {
        $this->belongsTo(User::class);
    }

    public function checkpoint() {
        $this->belongsTo(Checkpoint::class);
    }
}
