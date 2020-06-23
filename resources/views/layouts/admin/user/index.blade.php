@extends('app')
@section('title','Users List')

@section('content')
    @include('layouts.partials.adminmenu')
    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
              <div class="card card-info">
                <div class="card-header ui-sortable-handle" style="cursor: move;">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  <b>Users List</b>
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a href="{{route('admin.users.create')}}" class="btn-border  btn-sm" href="">Add User</a>
                    </li>
                  </ul>
                </div>
              </div>
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

                              @can('edit-users')
                                <a href = "{{ route('admin.users.edit', $user->id)}}" type="button" class="btn btn-info float-left"><i class="fas fa-edit"></i>  </a> &nbsp;
                              @endcan

                              <form action = "{{ route('admin.users.destroy', $user) }}" method="POST" class=" float-left">
                                @csrf
                                {{ method_field("DELETE")}}
                                @can('delete-users')
                                &nbsp
                                  <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                @endcan
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
              </div>
              <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>

</div>

@endsection
@section('pagespecificscripts')
  <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}" defer></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}" defer></script>
  <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}" defer></script>
  <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}" defer></script>
  <script src="{{ asset('js/custom.js') }}" defer></script>
@stop
