@extends('master.index')

@section('mainContent')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><a onclick="history.back()"><i class="fa fa-chevron-left" style="margin-right: 20px;cursor: pointer;" aria-hidden="true"></i></a>Dealer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dealer</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Dealer Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  class="text-start" method="POST" id="quickForm" action="{{ route('dealer.store') }}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputName">Service Dealer</label>
                    <input type="text" name="service_dealer" class="form-control" id="exampleInputName" placeholder="Enter Service Dealer">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName">Contact Person</label>
                    <input type="text" name="contact_person" class="form-control" id="exampleInputName" placeholder="Enter Contact Person">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName">Phone</label>
                    <input type="text" name="phone" class="form-control" id="exampleInputName" placeholder="Enter Phone">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName">Address</label>
                    <input type="text" name="address" class="form-control" id="exampleInputName" placeholder="Enter Address">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName">district</label>
                    <input type="text" name="district" class="form-control" id="exampleInputName" placeholder="Enter Name">
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
      service_dealer: {
        required: true,
      },
      contact_person: {
        required: true,
      },
      phone: {
        required: true,
      },
      address: {
        required: true,
      },
      district: {
        required: true,
      },
    },
    messages: {
      name: {
        required: "Please enter a name",
        email: "Please enter a valid name"
      },
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
