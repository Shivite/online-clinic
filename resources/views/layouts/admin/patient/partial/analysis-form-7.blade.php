<div class="row">
    <div class="col-md-12">
        <h5 class="mt-4 mb-2 label-heading">
            <i class="fas fa-medkit info"> PATIENT PAST HISTORY ANALYSIS </i>
        </h5>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Mention the first disease you had and in what age. write in details.</label>
            <textarea class="form-control" rows="3" placeholder="Enter Information Here"
                name="first_disease">{{(isset($patient->analysisSeventh->first_disease)) ? $patient->analysisSeventh->first_disease: '' }}</textarea>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Mention if any other disease you had and in what ages. Write in detials.</label>
            <textarea class="form-control" rows="3" placeholder="Enter Information Here"
                name="additional_disease">{{(isset($patient->analysisSeventh->m_gm_disease)) ? $patient->analysisSeventh->m_gm_disease: '' }}</textarea>
        </div>
    </div>
</div>