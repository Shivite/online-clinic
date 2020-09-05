<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalysisFourth extends Model
{
  protected $fillable = [
    "_token",
  "patient_id",
  "periodic_mental",
  "hobby",
  "afraid",
  "fear",
  "anger",
  "control_anger",
  "speak_hurt",
  "alone",
  "event_joy",
  "saddened",
  "noticed",
  "curriculam",
  "embarrassing",
  "conclussion",
  "fairful_object",
  ];

  public function patient() //relationship tested running @ tinker
  {
     return $this->belongsTo('App\Patient');
  }
  
}