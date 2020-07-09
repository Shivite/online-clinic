<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $guarded = [];

    public function user() //relationship tested running @ tinker
    {
       return $this->belongsTo('App\User');
    }

    public function reports(){
      return $this->belongsToMany('App\Report');
    }

    public function analysisFirst() //relationship tested running @ tinker
    {
       return $this->hasOne('App\AnalysisFirst');
    }

    public function analysisSecond() //relationship tested running @ tinker
    {
       return $this->hasOne('App\AnalysisSecond');
    }

    public function analysisThird() //relationship tested running @ tinker
    {
       return $this->hasOne('App\AnalysisThird');
    }

    public function analysisFourth() //relationship tested running @ tinker
    {
       return $this->hasOne('App\AnalysisFourth');
    }


    public function analysisFifth() //relationship tested running @ tinker
    {
       return $this->hasOne('App\AnalysisFifth');
    }

    public function analysisSixth() //relationship tested running @ tinker
    {
       return $this->hasOne('App\AnalysisSixth');
    }

    public function analysisSeventh() //relationship tested running @ tinker
    {
       return $this->hasOne('App\AnalysisSeventh');
    }

    public function analysisEight() //relationship tested running @ tinker
    {
       return $this->hasOne('App\AnalysisEight');
    }



}
