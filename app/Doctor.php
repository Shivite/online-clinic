<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = ['user_id'];

    public function user() //relationship tested running @ tinker
    {
       return $this->belongsTo('App\User');
    }

}
