<div class = "row">
  <div class = "col-md-6">
    <div class="form-group">
      <label>Blood Group </label>
      <select id="blood_group" class="form-control @error('blood_group') is-invalid @enderror" name = "blood_group"  >
        <option {{ (isset($patient->analysisFirst->blood_group) && $patient->analysisFirst->blood_group == 'A+') ? 'selected': '' }} value = "A+">A RhD positive (A+)</option>
        <option {{ (isset($patient->analysisFirst->blood_group) && $patient->analysisFirst->blood_group == 'A-') ? 'selected': '' }} value = "A-">A RhD positive (A-)</option>
        <option {{ (isset($patient->analysisFirst->blood_group) && $patient->analysisFirst->blood_group == 'B+') ? 'selected': '' }} value = "B+">A RhD positive (B+)</option>
        <option {{ (isset($patient->analysisFirst->blood_group) && $patient->analysisFirst->blood_group == 'B-') ? 'selected': '' }} value = "B-">A RhD positive (B-)</option>
        <option {{ (isset($patient->analysisFirst->blood_group) && $patient->analysisFirst->blood_group == 'O+') ? 'selected': '' }} value = "O+">A RhD positive (O+)</option>
        <option {{ (isset($patient->analysisFirst->blood_group) && $patient->analysisFirst->blood_group == 'O-') ? 'selected': '' }} value = "O-">A RhD positive (O-)</option>
        <option {{ (isset($patient->analysisFirst->blood_group) && $patient->analysisFirst->blood_group == 'AB+') ? 'selected': '' }} value = "AB+">AB RhD positive (AB+)</option>
        <option {{ (isset($patient->analysisFirst->blood_group) && $patient->analysisFirst->blood_group == 'AB-') ? 'selected': '' }} value = "AB-">AB RhD positive (AB-)</option>

      </select>
    </div>
  </div>
  <div class = "col-md-6">
    <div class="form-group">
      <label>Does Patient Suffer More In Winter/Summer?</label>
      <select id="season_suffer" class="form-control @error('season_suffer') is-invalid @enderror" name = "season_suffer"  >
        <option {{ (isset($patient->analysisFirst->season_suffer) && $patient->analysisFirst->season_suffer == 'winter') ? 'selected': '' }} value = "winter">Winter</option>
        <option {{ (isset($patient->analysisFirst->season_suffer) && $patient->analysisFirst->season_suffer == 'summer') ? 'selected': '' }} value = "summer">Summer</option>
      </select>
    </div>
  </div>
</div>


<div class = "row">
  <div class = "col-md-12">
    <h5 class="mt-4 mb-2 label-heading">
      <i class="fas fa-medkit info">  SMPTOMS - 1 </i>
    </h5><br>
  </div>
  <div class = "col-md-6">
    <div class="form-group">
      <label>Effected Areas</label>
      <input id="s1_effected_areas" type="text" class="form-control @error('s1_effected_areas') is-invalid @enderror" name="s1_effected_areas" value="{{(isset($patient->analysisFirst->s1_effected_areas)) ? $patient->analysisFirst->s1_effected_areas: '' }}" >
    </div>
  </div>
  <div class = "col-md-6">
    <div class="form-group">
      <label>Sensations</label>
      <input id="s1_sensations" type="text" class="form-control @error('s1_sensations') is-invalid @enderror" name="s1_sensations" value="{{(isset($patient->analysisFirst->s1_sensations)) ? $patient->analysisFirst->s1_sensations: '' }}" >
    </div>
  </div>
</div>


<div class = "row">
  <div class = "col-md-6">
    <div class="form-group">
      <label>When symptoms increases or decreases</label>
      <input id="s1_increas_decrease" type="text" class="form-control @error('s1_increas_decrease') is-invalid @enderror" name="s1_increas_decrease" value="{{(isset($patient->analysisFirst->s1_increas_decrease)) ? $patient->analysisFirst->s1_increas_decrease: '' }}" placeholder="Do Mention The Time" >
    </div>
  </div>
  <div class = "col-md-6">
    <div class="form-group">
      <label>Another Related Symptoms</label>
      <input  type="text" id="s1_related_symptoms" class="form-control @error('s1_related_symptoms') is-invalid @enderror" name="s1_related_symptoms" value="{{(isset($patient->analysisFirst->s1_related_symptoms)) ? $patient->analysisFirst->s1_related_symptoms: '' }}"  >
    </div>
  </div>
</div>



<div class = "row">
  <div class = "col-md-12">
    <h5 class="mt-4 mb-2 label-heading">
      <i class="fas fa-medkit info">  SMPTOMS - 2 </i>
    </h5><br>
  </div>
  <div class = "col-md-6">
    <div class="form-group">
      <label>Effected Areas</label>
      <input id="s2_effected_areas" type="text" class="form-control @error('s2_effected_areas') is-invalid @enderror" name="s2_effected_areas" value="{{(isset($patient->analysisFirst->s2_effected_areas)) ? $patient->analysisFirst->s2_effected_areas: '' }}" >
    </div>
  </div>
  <div class = "col-md-6">
    <div class="form-group">
      <label>Sensations</label>
      <input id="s2_sensations" type="text" class="form-control @error('s2_sensations') is-invalid @enderror" name="s2_sensations" value="{{(isset($patient->analysisFirst->s2_sensations)) ? $patient->analysisFirst->s2_sensations: '' }}" >
    </div>
  </div>
</div>


<div class = "row">
  <div class = "col-md-6">
    <div class="form-group">
      <label>When symptoms increases or decreases</label>
      <input id="s2_increas_decrease" type="text" class="form-control @error('s2_increas_decrease') is-invalid @enderror" name="s2_increas_decrease" value="{{(isset($patient->analysisFirst->s2_increas_decrease)) ? $patient->analysisFirst->s2_increas_decrease: '' }}" placeholder="Do Mention The Time" >
    </div>
  </div>
  <div class = "col-md-6">
    <div class="form-group">
      <label>Another Related Symptoms</label>
      <input  type="text" id="s2_related_symptoms" class="form-control @error('s2_related_symptoms') is-invalid @enderror" name="s2_related_symptoms" value="{{(isset($patient->analysisFirst->s2_related_symptoms)) ? $patient->analysisFirst->s2_related_symptoms: '' }}"  >
    </div>
  </div>
</div>



<div class = "row">
  <div class = "col-md-12">
    <h5 class="mt-4 mb-2 label-heading">
      <i class="fas fa-medkit info">  SMPTOMS - 3 </i>
    </h5><br>
  </div>
  <div class = "col-md-6">
    <div class="form-group">
      <label>Effected Areas</label>
      <input id="s3_effected_areas" type="text" class="form-control @error('s3_effected_areas') is-invalid @enderror" name="s3_effected_areas" value="{{(isset($patient->analysisFirst->s3_effected_areas)) ? $patient->analysisFirst->s3_effected_areas: '' }}" >
    </div>
  </div>
  <div class = "col-md-6">
    <div class="form-group">
      <label>Sensations</label>
      <input id="s3_sensations" type="text" class="form-control @error('s3_sensations') is-invalid @enderror" name="s3_sensations" value="{{(isset($patient->analysisFirst->s3_sensations)) ? $patient->analysisFirst->s3_sensations: '' }}" >
    </div>
  </div>
</div>


<div class = "row">
  <div class = "col-md-6">
    <div class="form-group">
      <label>When symptoms increases or decreases</label>
      <input id="s3_increas_decrease" type="text" class="form-control @error('s3_increas_decrease') is-invalid @enderror" name="s3_increas_decrease" value="{{(isset($patient->analysisFirst->s3_increas_decrease)) ? $patient->analysisFirst->s3_increas_decrease: '' }}" placeholder="Do Mention The Time" >
    </div>
  </div>
  <div class = "col-md-6">
    <div class="form-group">
      <label>Another Related Symptoms</label>
      <input  type="text" id="s3_related_symptoms" class="form-control @error('s3_related_symptoms') is-invalid @enderror" name="s3_related_symptoms" value="{{(isset($patient->analysisFirst->s3_related_symptoms)) ? $patient->analysisFirst->s3_related_symptoms: '' }}"  >
    </div>
  </div>
</div>
