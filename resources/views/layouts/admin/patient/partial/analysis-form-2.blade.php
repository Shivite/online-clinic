<div class = "row">
  <div class = "col-md-6">
    <div class="form-group">
      <label>Tongue Layer </label>
      <select id="tongue_layer" class="form-control @error('tongue_layer') is-invalid @enderror" name = "tongue_layer"  >
        <option {{ (isset($patient->analysisSecond->tongue_layer) && $patient->analysisSecond->tongue_layer == 'dirty') ? 'selected': '' }} value = "dirty">Dirty</option>
        <option {{ (isset($patient->analysisSecond->tongue_layer) && $patient->analysisSecond->tongue_layer == 'clean') ? 'selected': '' }} value = "clean">Clean</option>
        <option {{ (isset($patient->analysisSecond->tongue_layer) && $patient->analysisSecond->tongue_layer == 'notsure') ? 'selected': '' }} value = "notsure">Not Sure</option>
      </select>
    </div>
  </div>
  <div class = "col-md-6">
    <div class="form-group">
      <label>Thirst </label>
      <select id="thirst" class="form-control @error('thirst') is-invalid @enderror" name = "thirst"  >
        <option {{ (isset($patient->analysisSecond->thirst) && $patient->analysisSecond->thirst == 'more') ? 'selected': '' }} value = "more">More</option>
        <option {{ (isset($patient->analysisSecond->thirst) && $patient->analysisSecond->thirst == 'medium') ? 'selected': '' }} value = "medium">Medium</option>
        <option {{ (isset($patient->analysisSecond->thirst) && $patient->analysisSecond->thirst == 'less') ? 'selected': '' }} value = "less">Less</option>
        <option {{ (isset($patient->analysisSecond->thirst) && $patient->analysisSecond->thirst == 'nil') ? 'selected': '' }} value = "nil">Nil</option>
        <option {{ (isset($patient->analysisSecond->thirst) && $patient->analysisSecond->thirst == 'notsure') ? 'selected': '' }} value = "notsure">Not Sure</option>
      </select>
    </div>
  </div>
</div>

<div class = "row">
  <div class = "col-md-12">
    <h5 class="mt-4 mb-2 label-heading">
      <i class="fas fa-medkit info">  SWEET NATURE </i>
    </h5><br>
  </div>

  <div class = "col-md-6">
    <div class="form-group">
      <label>Tongue Layer </label>
      <select id="tongue_layer" class="form-control @error('tongue_layer') is-invalid @enderror" name = "tongue_layer"  >
        <option {{ (isset($patient->analysisSecond->tongue_layer) && $patient->analysisSecond->tongue_layer == 'dirty') ? 'selected': '' }} value = "dirty">Dirty</option>
        <option {{ (isset($patient->analysisSecond->tongue_layer) && $patient->analysisSecond->tongue_layer == 'clean') ? 'selected': '' }} value = "clean">Clean</option>
        <option {{ (isset($patient->analysisSecond->tongue_layer) && $patient->analysisSecond->tongue_layer == 'notsure') ? 'selected': '' }} value = "notsure">Not Sure</option>
      </select>
    </div>
  </div>
  <div class = "col-md-6">
    <div class="form-group">
      <label>Thirst </label>
      <select id="thirst" class="form-control @error('thirst') is-invalid @enderror" name = "thirst"  >
        <option {{ (isset($patient->analysisSecond->thirst) && $patient->analysisSecond->thirst == 'more') ? 'selected': '' }} value = "more">More</option>
        <option {{ (isset($patient->analysisSecond->thirst) && $patient->analysisSecond->thirst == 'medium') ? 'selected': '' }} value = "medium">Medium</option>
        <option {{ (isset($patient->analysisSecond->thirst) && $patient->analysisSecond->thirst == 'less') ? 'selected': '' }} value = "less">Less</option>
        <option {{ (isset($patient->analysisSecond->thirst) && $patient->analysisSecond->thirst == 'nil') ? 'selected': '' }} value = "nil">Nil</option>
        <option {{ (isset($patient->analysisSecond->thirst) && $patient->analysisSecond->thirst == 'unquenchable') ? 'selected': '' }} value = "unquenchable">Unquenchable</option>
        <option {{ (isset($patient->analysisSecond->thirst) && $patient->analysisSecond->thirst == 'notsure') ? 'selected': '' }} value = "notsure">Not Sure</option>
      </select>
    </div>
  </div>
</div>

<div class = "row">
  <div class = "col-md-6">
    <div class="form-group">
      <label>Sweeting Increase The Pain</label>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="sweet_increase_pain" value="yes" >
        <label class="form-check-label">Yes</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="sweet_increase_pain" value="no" checked>
        <label class="form-check-label">No</label>
      </div>
    </div>
  </div>
  <div class = "col-md-6">
    <div class="form-group">
      <label>Sweeting Reduce The Pain</label>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="sweet_reduce_pain" value="yes" >
        <label class="form-check-label">Yes</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="sweet_reduce_pain" value="no" checked>
        <label class="form-check-label">No</label>
      </div>
    </div>
  </div>

</div>
<div class = "row">
  <div class = "col-md-6">
    <div class="form-group">
      <label>Sweet Tedency </label>
      <select id="sweet_tendency" class="form-control @error('sweet_tendency') is-invalid @enderror" name = "sweet_tendency"  >
        <option {{ (isset($patient->analysisSecond->sweet_tendency) && $patient->analysisSecond->sweet_tendency == 'more') ? 'selected': '' }} value = "more">More</option>
        <option {{ (isset($patient->analysisSecond->sweet_tendency) && $patient->analysisSecond->sweet_tendency == 'medium') ? 'selected': '' }} value = "medium">Medium</option>
        <option {{ (isset($patient->analysisSecond->sweet_tendency) && $patient->analysisSecond->sweet_tendency == 'less') ? 'selected': '' }} value = "less">Less</option>
        <option {{ (isset($patient->analysisSecond->sweet_tendency) && $patient->analysisSecond->sweet_tendency == 'nil') ? 'selected': '' }} value = "nil">Nil</option>
        <option {{ (isset($patient->analysisSecond->sweet_tendency) && $patient->analysisSecond->sweet_tendency == 'notsure') ? 'selected': '' }} value = "notsure">Not Sure</option>
      </select>
    </div>
  </div>
  <div class = "col-md-6">
    <div class="form-group">
      <label>Appetite </label>
      <select id="appetite" class="form-control @error('appetite') is-invalid @enderror" name = "appetite"  >
        <option {{ (isset($patient->analysisSecond->appetite) && $patient->analysisSecond->appetite == 'more') ? 'selected': '' }} value = "more">More</option>
        <option {{ (isset($patient->analysisSecond->appetite) && $patient->analysisSecond->appetite == 'medium') ? 'selected': '' }} value = "medium">Medium</option>
        <option {{ (isset($patient->analysisSecond->appetite) && $patient->analysisSecond->appetite == 'less') ? 'selected': '' }} value = "less">Less</option>
        <option {{ (isset($patient->analysisSecond->appetite) && $patient->analysisSecond->appetite == 'nil') ? 'selected': '' }} value = "nil">Nil</option>
        <option {{ (isset($patient->analysisSecond->appetite) && $patient->analysisSecond->appetite == 'notsure') ? 'selected': '' }} value = "notsure">Not Sure</option>
      </select>
    </div>
  </div>
</div>



<div class = "row">
  <div class = "col-md-12">
    <h5 class="mt-4 mb-2 label-heading">
      <i class="fas fa-medkit info">  BATHING NATURE </i>
    </h5><br>
  </div>
  <div class = "col-md-6">
    <div class="form-group">
      <label>Bathing Tendency </label>
      <select id="bath_tendency" class="form-control @error('bath_tendency') is-invalid @enderror" name = "bath_tendency"  >
        <option {{ (isset($patient->analysisSecond->bath_tendency) && $patient->analysisSecond->bath_tendency == 'more') ? 'selected': '' }} value = "more">More</option>
        <option {{ (isset($patient->analysisSecond->bath_tendency) && $patient->analysisSecond->bath_tendency == 'medium') ? 'selected': '' }} value = "medium">Medium</option>
        <option {{ (isset($patient->analysisSecond->bath_tendency) && $patient->analysisSecond->bath_tendency == 'less') ? 'selected': '' }} value = "less">Less</option>
        <option {{ (isset($patient->analysisSecond->bath_tendency) && $patient->analysisSecond->bath_tendency == 'nil') ? 'selected': '' }} value = "nil">Nil</option>
        <option {{ (isset($patient->analysisSecond->bath_tendency) && $patient->analysisSecond->bath_tendency == 'notsure') ? 'selected': '' }} value = "notsure">Not Sure</option>
      </select>
    </div>
  </div>
  <div class = "col-md-6">
    <div class="form-group">
      <label>Desire To Bath In Winter</label>
      <select id="bath_desire" class="form-control @error('bath_desire') is-invalid @enderror" name = "bath_desire"  >
        <option {{ (isset($patient->analysisSecond->bath_desire) && $patient->analysisSecond->bath_desire == 'more') ? 'selected': '' }} value = "more">More</option>
        <option {{ (isset($patient->analysisSecond->bath_desire) && $patient->analysisSecond->bath_desire == 'medium') ? 'selected': '' }} value = "medium">Medium</option>
        <option {{ (isset($patient->analysisSecond->bath_desire) && $patient->analysisSecond->bath_desire == 'less') ? 'selected': '' }} value = "less">Less</option>
        <option {{ (isset($patient->analysisSecond->bath_desire) && $patient->analysisSecond->bath_desire == 'nil') ? 'selected': '' }} value = "nil">Nil</option>
        <option {{ (isset($patient->analysisSecond->bath_desire) && $patient->analysisSecond->bath_desire == 'notsure') ? 'selected': '' }} value = "notsure">Not Sure</option>
      </select>
    </div>
  </div>
</div>



<div class = "row">
  <div class = "col-md-12">
    <h5 class="mt-4 mb-2 label-heading">
      <i class="fas fa-medkit info">  SLEEP NATURE </i>
    </h5><br>
  </div>
  <div class = "col-md-6">
    <div class="form-group">
      <label>Sweeting Reduce The Pain</label>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="sweet_reduce_pain" value="good" >
        <label class="form-check-label">Good</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="sweet_reduce_pain" value="bad" checked>
        <label class="form-check-label">Bad</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="sweet_reduce_pain" value="notsure" checked>
        <label class="form-check-label">Not Sure</label>
      </div>
    </div>
  </div>
  <div class = "col-md-6">
    <div class="form-group">
      <label>During Sleep Symptoms</label>
            <input id="during_sleep" type="text" class="form-control @error('during_sleep') is-invalid @enderror" name="during_sleep" value="{{(isset($patient->analysisSecond->during_sleep)) ? $patient->analysisSecond->during_sleep: '' }}" >
    </div>
  </div>
</div>
<div class="row">
<div class = "col-md-6">
  <div class="form-group">
    <label>Position Of Sleep</label>
      <input id="position_sleep" type="text" class="form-control @error('position_sleep') is-invalid @enderror" name="position_sleep" value="{{(isset($patient->analysisSecond->position_sleep)) ? $patient->analysisSecond->position_sleep: '' }}" >
  </div>
</div>
</div>


<div class = "row">
  <div class = "col-md-12">
    <h5 class="mt-4 mb-2 label-heading">
      <i class="fas fa-medkit info">  STOOL </i>
    </h5><br>
  </div>

  <div class = "col-md-6">
    <div class="form-group">
      <label>Frequency</label>
      <input id="frequency" type="text" class="form-control @error('frequency') is-invalid @enderror" name="frequency" value="{{(isset($patient->analysisSecond->frequency)) ? $patient->analysisSecond->frequency: '' }}" placeholder="Do Mention The Time" >
    </div>
  </div>
  <div class = "col-md-6">
    <div class="form-group">
      <label>Character</label>
      <input  type="text" id="character" class="form-control @error('character') is-invalid @enderror" name="character" value="{{(isset($patient->analysisSecond->character)) ? $patient->analysisSecond->character: '' }}"  >
    </div>
  </div>
</div>

<div class = "row">
  <div class = "col-md-12">
    <h5 class="mt-4 mb-2 label-heading">
      <i class="fas fa-medkit info">  URINE </i>
    </h5><br>
  </div>

  <div class = "col-md-6">
    <div class="form-group">
      <label>U_frequency</label>
      <input id="U_frequency" type="text" class="form-control @error('U_frequency') is-invalid @enderror" name="U_frequency" value="{{(isset($patient->analysisSecond->U_frequency)) ? $patient->analysisSecond->U_frequency: '' }}" placeholder="Do Mention The Time" >
    </div>
  </div>
  <div class = "col-md-6">
    <div class="form-group">
      <label>U_character</label>
      <input  type="text" id="U_character" class="form-control @error('U_character') is-invalid @enderror" name="U_character" value="{{(isset($patient->analysisSecond->U_character)) ? $patient->analysisSecond->U_character: '' }}"  >
    </div>
  </div>
</div>
