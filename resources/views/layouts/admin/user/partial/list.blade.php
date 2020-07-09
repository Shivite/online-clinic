<!-- /.card-header -->
<div class="card-body">
  <table id="data-listing" class="table table-bordered table-striped">
    <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Email</th>
      <th>Role</th>
      <th>Action</th>
    </tr>
    </thead>
    <tbody>
      @foreach( $users as $user)
        <tr>
          <th scope="row"> {{ $user->id }} </th>
          <td> {{ ucwords($user->name) }} </td>
          <td> {{ $user->email }} </td>
          <td> {{ ucwords(implode(', ', $user->roles()->get()->pluck('name')->toArray())) }} </td>
          <td>
            @if(Auth::user()->hasRole(['admin']))
                <a href = "{{ route('admin.users.edit', $user->id)}}" type="button" class="btn btn-info float-left"><i class="fas fa-edit"></i>  </a> &nbsp;

              <form action = "{{ route('admin.users.destroy', $user) }}" method="POST" class=" float-left">
                @csrf
                {{ method_field("DELETE")}}
                &nbsp
                  <button  type = "submit" class="btn btn-danger"><i class="fas fa-trash"></i></button></a>
              </form>
              @endif
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
