<div class = "row">
  <div class = "col-md-12">
    <h5 class="mt-4 mb-2 label-heading">
      <i class="fas fa-medkit info">  PATIENT DISEASE ANALYSES [PRESENT RECORDS] </i>
    </h5><br>
  </div>
  <div class = "col-md-12">
    <div class="form-group">
        <label>Mention Your Recent Disease And Symptoms With Aprox Age And Date Wise</label>
        <textarea class="form-control" rows="3" placeholder="Enter Information Here" name = "first_disease">{{(isset($patient->analysisEight->first_disease)) ? $patient->analysisEight->first_disease: '' }}</textarea>
    </div>
  </div>
</div>
