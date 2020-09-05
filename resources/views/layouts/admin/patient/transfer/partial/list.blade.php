<!-- /.card-header -->
<div class="card-body">
    <table id="data-listing" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Transfer By</th>
                <th>New Department</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $patients as $patient)
            <tr>
                <th scope="row"> {{ $patient->id }} </th>
                <td> {{ ucwords($patient->name) }} </td>
                <td> {{ $patient->docName }} </td>
                <td> {{ ucwords(implode(', ', $patient->user->departments()->get()->pluck('name')->toArray())) }} </td>
                <td>
                    @if(Auth::user()->hasAnyRole(['admin']))
                    <a href="{{ route('admin.approve.deptchange', $patient->id)}}" type="button"
                        class="btn btn-info float-left"><i class="fas fa-user"></i> </a> &nbsp;
                    @endif

                    <form action="{{ route('admin.approve.deptchange', $patient->id) }}" method="POST"
                        class=" float-left">
                        @csrf
                        <button type="submit" class="btn btn-info"><i class="fas fa-trash"></i></button></a>
                    </form>


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