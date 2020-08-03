<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    public function patient() //relationship tested running @ tinker
    {
        return $this->belongsTo('App\Patient');
    }
}