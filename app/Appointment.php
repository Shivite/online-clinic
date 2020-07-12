<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
  public function doctor() //relationship tested running @ tinker
  {
     return $this->belongsTo('App\Doctor');
  }
}
