<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    public function department(){
      return $this->belongsTo('App\User');
    }
}
