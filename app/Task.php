<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'description', 'status', 'todolist_id'
    ];

    public function todolist() {
        return $this->belongsTo(Todolist::class);
    }
}
