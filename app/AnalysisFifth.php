<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalysisFifth extends Model
{
  protected $fillable = [
    "patient_id",
    "_token",
    "f_gm_f_disease",
    "f_gm_f_death_cause",
    "f_gm_disease",
    "f_gm_death_cause",
    "f_f_disease",
    "f_f_death_cause",
    "f_u_disease",
    "f_u_death_cause",
    "f_a_disease",
    "f_a_death_cause",
    ];

  public function patient() //relationship tested running @ tinker
  {
     return $this->belongsTo('App\Patient');
  }
}
