@extends('master.index')

@section('mainContent')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><a onclick="history.back()"><i class="fa fa-chevron-left" style="margin-right: 20px;cursor: pointer;" aria-hidden="true"></i></a>Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product</li>
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
                <h3 class="card-title">Product Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  class="text-start" method="POST" id="quickForm" action="{{ route('product.store') }}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputName" placeholder="Enter Name">
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
