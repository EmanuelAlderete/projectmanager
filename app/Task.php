<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'description', 'status', 'checkpoint_id'
    ];

    public function checkpoint() {
        return $this->belongsTo(Checkpoint::class);
    }
}
