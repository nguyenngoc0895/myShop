<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function categories(){
        return $this->hasMany('App\Model\Category', 'parent_id');
    }
}
