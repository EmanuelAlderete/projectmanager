<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    //  main_branch: 1-Exatas | 2-Humanas | 3-Biologicas
    protected $fillable = [
        'name', 'label', 'icon', 'main_branch'
    ];
}
