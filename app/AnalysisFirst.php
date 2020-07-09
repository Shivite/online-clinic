<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalysisFirst extends Model
{
  protected $fillable = [
    "patient_id",
    "blood_group",
    "season_suffer",
    "s1_effected_areas",
    "s1_sensations",
    "s1_increas_decrease",
    "s1_related_symptoms",
    "s2_effected_areas",
    "s2_sensations",
    "s2_increas_decrease",
    "s2_related_symptoms",
    "s3_effected_areas",
    "s3_sensations",
    "s3_increas_decrease",
    "s3_related_symptoms",
      '_token',
  ];

  public function patient() //relationship tested running @ tinker
  {
     return $this->belongsTo('App\Patient');
  }
}
