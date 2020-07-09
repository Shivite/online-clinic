<div class = "row">
  <div class = "col-md-12">
    <h5 class="mt-4 mb-2 label-heading">
      <i class="fas fa-medkit info">  MODALITY OF MENTAL SYMPTOMS </i>
    </h5><br>
  </div>

  <div class = "col-md-6">
    <div class="form-group">
      <label>When The Symtoms Of Mental Disease Increase/Decrease</label>
      <select id="periodic_mental" class="form-control @error('periodic_mental') is-invalid @enderror" name = "periodic_mental"  >
        <option {{ (isset($patient->analysisFourth->periodic_mental) && $patient->analysisFourth->periodic_mental == 'week') ? 'selected': '' }} value = "week">Weekly</option>
        <option {{ (isset($patient->analysisFourth->periodic_mental) && $patient->analysisFourth->periodic_mental == 'month') ? 'selected': '' }} value = "month">Monthly</option>
        <option {{ (isset($patient->analysisFourth->periodic_mental) && $patient->analysisFourth->periodic_mental == 'year') ? 'selected': '' }} value = "year">Yearly</option>
        <option {{ (isset($patient->analysisFourth->periodic_mental) && $patient->analysisFourth->periodic_mental == 'anyseason') ? 'selected': '' }} value = "anyseason">Any Season</option>
      </select>
    </div>
  </div>
  <div class = "col-md-6">
    <div class="form-group">
      <label>What Is Your Hobby</label>
      <input id="hobby" type="text" class="form-control @error('hobby') is-invalid @enderror" name="hobby" value="{{(isset($patient->analysisFourth->hobby)) ? $patient->analysisFourth->hobby: '' }}" >
    </div>
  </div>
  <div class = "col-md-6">
    <div class="form-group">
      <label>What Are You Afraid Of?</label>
      <input id="afraid" type="text" class="form-control @error('afraid') is-invalid @enderror" name="afraid" value="{{(isset($patient->analysisFourth->afraid)) ? $patient->analysisFourth->afraid: '' }}" >
    </div>
  </div>
  <div class = "col-md-6">
    <div class="form-group">
      <label>What Type Of Fear?</label>
      <input id="fear" type="text" class="form-control @error('fear') is-invalid @enderror" name="fear" value="{{(isset($patient->analysisFourth->fear)) ? $patient->analysisFourth->fear: '' }}" >
    </div>
  </div>
</div>
<div class = "row">
  <div class = "col-md-6">
    <div class="form-group">
      <label>What Type Of Your Anger?</label>
      <input id="anger" type="text" class="form-control @error('anger') is-invalid @enderror" name="anger" value="{{(isset($patient->analysisFourth->anger)) ? $patient->analysisFourth->anger: '' }}" >
    </div>
  </div>
  <div class = "col-md-6">
    <div class="form-group">
      <label>How Do you Control Your Self When You Are Angry?</label>
      <input id="control_anger" type="text" class="form-control @error('control_anger') is-invalid @enderror" name="control_anger" value="{{(isset($patient->analysisFourth->control_anger)) ? $patient->analysisFourth->control_anger: '' }}" >
    </div>
  </div>
</div>


<div class = "row">
  <div class = "col-md-6">
    <div class="form-group">
      <label>What Is Your Reaction hen Someone Speak With Hurt?</label>
      <input id="speak_hurt" type="text" class="form-control @error('speak_hurt') is-invalid @enderror" name="speak_hurt" value="{{(isset($patient->analysisFourth->speak_hurt)) ? $patient->analysisFourth->speak_hurt: '' }}" >
    </div>
  </div>
  <div class = "col-md-6">
    <div class="form-group">
      <label>What Do You Think About, When You Are Alone?</label>
      <input id="alone" type="text" class="form-control @error('alone') is-invalid @enderror" name="alone" value="{{(isset($patient->analysisFourth->alone)) ? $patient->analysisFourth->alone: '' }}" >
    </div>
  </div>
</div>



<div class = "row">
  <div class = "col-md-6">
    <div class="form-group">
      <label>What Event In Your Life Given You Most Joy?</label>
      <input id="event_joy" type="text" class="form-control @error('event_joy') is-invalid @enderror" name="event_joy" value="{{(isset($patient->analysisFourth->event_joy)) ? $patient->analysisFourth->event_joy: '' }}" >
    </div>
  </div>
  <div class = "col-md-6">
    <div class="form-group">
      <label>What Event In Your Life Saddened You Most Joy?</label>
      <input id="saddened" type="text" class="form-control @error('saddened') is-invalid @enderror" name="saddened" value="{{(isset($patient->analysisFourth->saddened)) ? $patient->analysisFourth->saddened: '' }}" >
    </div>
  </div>
</div>
<div class = "row">
  <div class = "col-md-6">
    <div class="form-group">
      <label>After Which Event You Noticed Your Disease?</label>
      <input id="noticed" type="text" class="form-control @error('noticed') is-invalid @enderror" name="noticed" value="{{(isset($patient->analysisFourth->noticed)) ? $patient->analysisFourth->noticed: '' }}" >
    </div>
  </div>
  <div class = "col-md-6">
    <div class="form-group">
      <label>What Is Your Desireness In Term Of Extra Curriculam Activities?</label>
      <input id="curriculam" type="text" class="form-control @error('curriculam') is-invalid @enderror" name="curriculam" value="{{(isset($patient->analysisFourth->curriculam)) ? $patient->analysisFourth->curriculam: '' }}" >
    </div>
  </div>
</div>
<div class = "row">
  <div class = "col-md-6">
    <div class="form-group">
      <label>Your Reaction When Your Get Conclussion From Any Person?</label>
      <input id="conclussion" type="text" class="form-control @error('conclussion') is-invalid @enderror" name="conclussion" value="{{(isset($patient->analysisFourth->conclussion)) ? $patient->analysisFourth->conclussion: '' }}" >
    </div>
  </div>
  <div class = "col-md-6">
    <div class="form-group">
      <label>What Is The Fairful Objec Of Your Life? <br/></label>
      <input id="fairful_object" type="text" class="form-control @error('fairful_object') is-invalid @enderror" name="fairful_object" value="{{(isset($patient->analysisFourth->fairful_object)) ? $patient->analysisFourth->fairful_object: '' }}" >
    </div>
  </div>
</div>
