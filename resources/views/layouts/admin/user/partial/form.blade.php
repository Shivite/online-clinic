<div class = "row">
    <div class = "col-md-6">
      <div class="form-group">
        <label for="Name">Name</label>
        <input id="name" type="text" class="form-control" name="name">
      </div>
    </div>
    <div class = "col-md-6">
      <div class="form-group">
        <label for="email">email</label>
        <input id="email" type="email" class="form-control" name="email" value="" placeholder="Enter email" >
      </div>
  </div>
</div>

<div class = "row">
  <div class = "col-md-6">
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" name="password" class="form-control" id="password" placeholder="Password">
    </div>
  </div>
  <div class = "col-md-6">
    <div class="form-group">
      <label for="password_confirmation">Retype Password</label>
      <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Retype Password">
    </div>
  </div>
</div>
<div class = "row">
  <div class = "col-md-6">
    <div class="form-group">
    <label>Role</label>
    <select id="role" class="form-control @error('name') is-invalid @enderror" name = "role" required >
      @foreach($roles as $role)
        <option value="{{ $role->id }}">{{ ucwords($role->name) }}</option>
      @endforeach
    </select>
  </div>
  </div>

  <div class = "col-md-6">
    <div class="form-group">
    <label>Department</label>
    <select id="department" class="form-control" name = "department" required >
      @foreach($departments as $department)
        <option value="{{ $department->id }}">{{ ucwords($department->name) }}</option>
      @endforeach
    </select>
    </div>
  </div>
</div>
  <div class = "row">
  <div class = "col-md-6">
  </div>
