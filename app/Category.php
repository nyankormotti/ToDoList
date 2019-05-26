<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded =  array('id');

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
}
