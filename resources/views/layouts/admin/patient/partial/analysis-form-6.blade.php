<div class="row">
    <div class="col-md-12">
        <h5 class="mt-4 mb-2 label-heading">
            <i class="fas fa-medkit info"> MOTHER's FAMILY ANALYSIS </i>
        </h5>
        <br>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Grandfather's abnormalites (If any)</label>
            <textarea class="form-control" rows="3" placeholder="Enter Information Here"
                name="m_gm_f_disease">{{(isset($patient->analysisSixth->m_gm_f_disease)) ? $patient->analysisSixth->m_gm_f_disease: '' }}</textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Grandfather's cause of death</label>
            <textarea class="form-control" rows="3" placeholder="Enter Information Here"
                name="m_gm_f_death_cause">{{(isset($patient->analysisSixth->m_gm_f_death_cause)) ? $patient->analysisSixth->m_gm_f_death_cause: '' }}</textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Grandmother's abnormalites (If any)</label>
            <textarea class="form-control" rows="3" placeholder="Enter Information Here"
                name="m_gm_disease">{{(isset($patient->analysisSixth->m_gm_disease)) ? $patient->analysisSixth->m_gm_disease: '' }}</textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Grandmother cause of death</label>
            <textarea class="form-control" rows="3" placeholder="Enter Information Here"
                name="m_gm_death_cause">{{(isset($patient->analysisSixth->m_gm_death_cause)) ? $patient->analysisSixth->m_gm_death_cause: '' }}</textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Mother's abnormaties (If any)</label>
            <textarea class="form-control" rows="3" placeholder="Enter Information Here"
                name="m_f_disease">{{(isset($patient->analysisSixth->m_f_disease)) ? $patient->analysisSixth->m_f_disease: '' }}</textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Mother's cause of death</label>
            <textarea class="form-control" rows="3" placeholder="Enter Information Here"
                name="m_f_death_cause">{{(isset($patient->analysisSixth->m_f_death_cause)) ? $patient->analysisSixth->m_f_death_cause: '' }}</textarea>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Sibling's abnormalites (If any)</label>
            <textarea class="form-control" rows="3" placeholder="Enter Information Here"
                name="m_u_disease">{{(isset($patient->analysisSixth->m_u_disease)) ? $patient->analysisSixth->m_u_disease: '' }}</textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Sibling's cause of death</label>
            <textarea class="form-control" rows="3" placeholder="Enter Information Here"
                name="m_u_death_cause">{{(isset($patient->analysisSixth->m_u_death_cause)) ? $patient->analysisSixth->m_u_death_cause: '' }}</textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Aunty Disease</label>
            <textarea class="form-control" rows="3" placeholder="Enter Information Here"
                name="m_a_disease">{{(isset($patient->analysisSixth->m_a_disease)) ? $patient->analysisSixth->m_a_disease: '' }}</textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Aunty Cause Of Death</label>
            <textarea class="form-control" rows="3" placeholder="Enter Information Here"
                name="m_a_death_cause">{{(isset($patient->analysisSixth->m_a_death_cause)) ? $patient->analysisSixth->m_a_death_cause: '' }}</textarea>
        </div>
    </div>
</div>