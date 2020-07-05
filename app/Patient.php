<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $guarded = [];

    public function user() //relationship tested running @ tinker
    {
       return $this->belongsTo('App\User');
    }

    public function reports(){
      return $this->belongsToMany('App\Report');
    }


}
