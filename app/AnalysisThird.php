<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalysisThird extends Model
{
  protected $fillable = [
    "patient_id",
    "desire_food",
    "greedy_food",
    "ideal_food",
    "donot_tolerate_food",
    "season_increase",
    "season_like",
    "cloth_choice",
    "inflamanation",
    "bedsheet",
    "periodic_symptoms",
    "moon",
    "sun",
    "thunderstrom",
    "seeside_area",
    "while_reading",
    "while_writing",
    "while_thinking",
    "while_listening",
    "while_practicing",
    "_token ",
  ];


    public function patient() //relationship tested running @ tinker
    {
       return $this->belongsTo('App\Patient');
    }

}
