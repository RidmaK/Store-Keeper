@extends('master.index')

@section('mainContent')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">User Registration Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  class="text-start" method="POST" id="quickForm" action="{{ route('user.store') }}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputName" placeholder="Enter Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPhone">Phone</label>
                    <input type="text" name="phone" class="form-control" id="exampleInputPhone" placeholder="Enter phone">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1Confirm">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" id="exampleInputPassword1Confirm" placeholder="Confirm Password">
                  </div>
                 <div class="form-group">
                    <label>Role</label>
                    <div class="select2-purple">
                      <select class="select2" multiple="multiple" name="roles[]" data-placeholder="Select a Role" data-dropdown-css-class="select2-purple" style="width: 100%;">
                        @foreach ($roles as $key =>$role)
                            <option value="{{ $key }}">{{ $role }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" name="status"  id="customSwitch1">
                      <label class="custom-control-label" for="customSwitch1">Status</label>
                    </div>
                  </div>
                  <div class="form-group mb-0">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                      <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="button" class="btn btn-primary submit">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
        </div>
    <!-- /.row -->
    </div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
@endsection
@section('scripts')
<script type="text/javascript">
$(function () {
  //Initialize Select2 Elements
  $('.select2').select2()

//Initialize Select2 Elements
$('.select2bs4').select2({
  theme: 'bootstrap4'
})
  $('#quickForm').validate({
    rules: {
      name: {
        required: true,
      },
      phone: {
        required: true,
      },
      roles: {
        required: true,
      },
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 8
      },
      confirm_password: {
        required: true,
        minlength: 8
      },
      terms: {
        required: true
      },
    },
    messages: {
      name: {
        required: "Please enter a name",
        email: "Please enter a valid name"
      },
      phone: {
        required: "Please enter a phone number",
        email: "Please enter a valid phone number"
      },
      role: {
        required: "Please select role",
        email: "Please enter a valid phone number"
      },
      email: {
        required: "Please enter a email address",
        email: "Please enter a valid email address"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 8 characters long"
      },
      confirm_password: {
        required: "Please provide a confirm password",
        minlength: "Your password must be at least 8 characters long"
      },
      terms: "Please accept our terms"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });

  $('.submit').click(function(event){
    event.preventDefault()
    if($('#quickForm').valid()){
        $('#quickForm').submit();
    }
});
});
  </script>

@endsection
