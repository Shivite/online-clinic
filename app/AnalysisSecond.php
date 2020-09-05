<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalysisSecond extends Model
{

  protected $fillable = [
    "patient_id",
    "tongue_layer",
    "thirst",
    "sweet_increase_pain",
    "sweet_tendency",
    "appetite",
    "bath_tendency",
    "bath_desire",
    "sweet_reduce_pain",
    "during_sleep",
    "position_sleep",
    'after_sleep',
    "frequency",
    "character",
    "U_frequency",
    "U_character",
    '_token',
  ];

  public function patient() //relationship tested running @ tinker
  {
     return $this->belongsTo('App\Patient');
  }

}