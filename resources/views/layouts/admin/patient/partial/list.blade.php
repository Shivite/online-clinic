<!-- /.card-header -->
<div class="card-body">
  <table id="data-listing" class="table table-bordered table-striped">
    <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Email</th>
      <th>Department</th>
      <th>Action</th>
    </tr>
    </thead>
    <tbody>
      @foreach( $patients as $patient)
        <tr>
          <th scope="row"> {{ $patient->id }} </th>
          <td> {{ ucwords($patient->name) }} </td>
          <td> {{ $patient->email }} </td>
          <td> {{ ucwords(implode(', ', $patient->user->departments()->get()->pluck('name')->toArray())) }} </td>
          <td>
              @if(Auth::user()->hasAnyRole(['admin','staff']))
                <a href = "{{ route('admin.patient.edit', $patient->id)}}" type="button" class="btn btn-info float-left"><i class="fas fa-edit"></i>  </a> &nbsp;
              @endif

              <!-- <form action = "{{ route('admin.patient.destroy', $patient) }}" method="POST" class=" float-left">
                @csrf
                {{ method_field("DELETE")}}
                 -->
                <!-- @can('delete-users')
                &nbsp
                  <button  type = "submit" class="btn btn-danger"><i class="fas fa-trash"></i></button></a>
                @endcan -->
              <!-- </form> -->

          </td>
        </tr>
      @endforeach

    </tbody>
    <tfoot>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Email</th>
      <th>Role</th>
      <th>Action</th>
    </tr>
    </tfoot>
  </table>
</div>
<!-- /.card-body -->
