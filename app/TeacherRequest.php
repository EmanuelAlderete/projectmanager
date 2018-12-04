<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherRequest extends Model
{
    protected $fillable = [
        'document', 'cpf', 'registry', 'user_id', 'status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
