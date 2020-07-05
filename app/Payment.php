<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  public function user() //relationship tested running @ tinker
  {
     return $this->belongsTo('App\User');
  }
}
