<div class = "row">

  <div class = "col-md-6">
    <label for="email">Profile Picture</label>
    <div class="direct-chat-msg">
      @if($user->hasRole('doctor'))
      @php $profilePic = asset('storage/doctor/profile/'.$user->doctor->profile_pic); @endphp
      @php $sign = asset('storage/doctor/profile/'.$user->doctor->sign); @endphp
      @else
        @php $imgPath = asset('storage/patient/doctor/'.$user->doctor->profile_pic); @endphp
      @endif
      <img class="direct-chat-img" src="{{ $profilePic }}" alt=""> &nbsp;&nbsp;&nbsp;
      <input id = "profile_pic" type="file" class = "lock_items" name = "profile_pic">
    </div>
  </div>
  <div class = "col-md-6">
    <label for="email">Signature</label>
    <div class="direct-chat-msg">
      <img class="direct-chat-img" src="{{ $sign }}" alt=""> &nbsp;&nbsp;&nbsp;
      <input type="file"  id="sign"  class ="lock_items" name = "sign">
    </div>
  </div>
</div>
<div class = "row">
    <div class = "col-md-6">
      <div class="form-group">
        <label for="Name">Name</label>
        <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}">
      </div>
    </div>
    <div class = "col-md-6">
      <div class="form-group">
        <label for="email">email</label>
        <input id="email" type="email" class="form-control" name="email" placeholder="Enter email" value="{{ $user->email }}" disabled label="Not allowed to change email.">
      </div>
  </div>
</div>
<div class = "row">
    <div class = "col-md-6">
      <div class="form-group">
        <label for="Name">specialization</label>
        <input id="specialization" type="text" class="form-control" name="specialization" value="{{ $user->doctor->specialization }}">
      </div>
    </div>
    <div class = "col-md-6">
      <div class="form-group">
        <label for="email">About</label>
        <input id="about" type="text-area" class="form-control" name="about" value="{{ $user->doctor->about }}">
      </div>
  </div>
</div>
