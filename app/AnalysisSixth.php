<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalysisSixth extends Model
{
  protected $fillable = [
    "patient_id",
    "_token",
    "m_gm_f_disease",
    "m_gm_f_death_cause",
    "m_gm_disease",
    "m_gm_death_cause",
    "m_f_disease",
    "m_f_death_cause",
    "m_u_disease",
    "m_u_death_cause",
    "m_a_disease",
    "m_a_death_cause",
    ];

  public function patient() //relationship tested running @ tinker
  {
     return $this->belongsTo('App\Patient');
  }

}
