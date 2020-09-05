<div class="row">
    <div class="col-md-12">
        <h5 class="mt-4 mb-2 label-heading">
            <i class="fas fa-medkit info"> FATHER'S FAMILY ANALYSIS </i>
        </h5>
        <br>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Grandfather's abnormalities (If any)</label>
            <textarea class="form-control" rows="3" placeholder="Enter Information Here"
                name="f_gm_f_disease">{{(isset($patient->analysisFifth->f_gm_f_disease)) ? $patient->analysisFifth->f_gm_f_disease: '' }}</textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Grandfather's Cause Of Death</label>
            <textarea class="form-control" rows="3" placeholder="Enter Information Here"
                name="f_gm_f_death_cause">{{(isset($patient->analysisFifth->f_gm_f_death_cause)) ? $patient->analysisFifth->f_gm_f_death_cause: '' }}</textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Grandmother abnormalities (If any)</label>
            <textarea class="form-control" rows="3" placeholder="Enter Information Here"
                name="f_gm_disease">{{(isset($patient->analysisFifth->f_gm_disease)) ? $patient->analysisFifth->f_gm_disease: '' }}</textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Grandmother's cause Of death</label>
            <textarea class="form-control" rows="3" placeholder="Enter Information Here"
                name="f_gm_death_cause">{{(isset($patient->analysisFifth->f_gm_death_cause)) ? $patient->analysisFifth->f_gm_death_cause: '' }}</textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Father's abnormalities (If any)</label>
            <textarea class="form-control" rows="3" placeholder="Enter Information Here"
                name="f_f_disease">{{(isset($patient->analysisFifth->f_f_disease)) ? $patient->analysisFifth->f_f_disease: '' }}</textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Father's cause of death</label>
            <textarea class="form-control" rows="3" placeholder="Enter Information Here"
                name="f_f_death_cause">{{(isset($patient->analysisFifth->f_f_death_cause)) ? $patient->analysisFifth->f_f_death_cause: '' }}</textarea>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Sibling's abnormalities (If any)</label>
            <textarea class="form-control" rows="3" placeholder="Enter Information Here"
                name="f_u_disease">{{(isset($patient->analysisFifth->f_u_disease)) ? $patient->analysisFifth->f_u_disease: '' }}</textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Sibling's cause of death</label>
            <textarea class="form-control" rows="3" placeholder="Enter Information Here"
                name="f_u_death_cause">{{(isset($patient->analysisFifth->f_u_death_cause)) ? $patient->analysisFifth->f_u_death_cause: '' }}</textarea>
        </div>
    </div>
</div>