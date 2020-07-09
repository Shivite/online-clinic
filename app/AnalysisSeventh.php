<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalysisSeventh extends Model
{
  protected $fillable = [
    "patient_id",
    "first_disease",
    "additional_disease",
    '_token',
  ];

  public function patient() //relationship tested running @ tinker
  {
     return $this->belongsTo('App\Patient');
  }

}
