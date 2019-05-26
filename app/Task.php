<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded =  array('id');

    public function getTaskName()
    {
        return $this->task_name;
    }

    public function category()
    {
        return $this->belongsTo('App\Category','category_id','id');
    }
}
