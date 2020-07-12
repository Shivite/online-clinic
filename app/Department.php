<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function diseases(){
      return $this->belongsToMany('App\Disease');
    }

    public function users(){
      return $this->belongsToMany('App\User');
    }
}
