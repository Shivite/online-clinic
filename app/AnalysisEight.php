<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnalysisEight extends Model
{

    protected $fillable = [
      "patient_id",
      "_token",
      "first_disease",

      ];

    public function patient() //relationship tested running @ tinker
    {
       return $this->belongsTo('App\Patient');
    }
}
