<div class="card card-info collapsed-card">
    <div class="card-header">
        <h3 class="card-title">New Prescriptions</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
            </button>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body" style="display: none;">
        <form role="form" id="newprescription" action="{{route('doctor.patient.prescription')}}" method="POST">
            @csrf
            <input type="hidden" value="{{$patient->id}}" name="patientId" />
            <textarea class="form-control" style="min-width: 100%" name="prescription" required></textarea>
            <button type="submit" class="btn btn-block btn-info btn-flat">Save</button>

        </form>
    </div>
    <!-- /.card-body -->
</div>