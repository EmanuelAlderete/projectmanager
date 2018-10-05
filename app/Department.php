<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //  main_department: 1-Exatas | 2-Humanas | 3-Biologicas
    protected $fillable = [
        'name', 'label', 'icon', 'main_department'
    ];
}
