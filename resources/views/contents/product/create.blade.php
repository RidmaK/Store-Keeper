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
        <div class="col-md-8">
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
                  <div class="form-group">
                    <label for="exampleInputName">Part Number</label>
                    <input type="text" name="part_number" class="form-control" id="exampleInputName" placeholder="Enter Part Number">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName">Category</label>
                    <select class="form-control" id="category" name="category">
                      <option value="0">select</option>
                      @foreach ($categories as $key => $item)
                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName">Unit Price</label>
                    <input type="text" name="unit_price" class="form-control" id="exampleInputName" placeholder="Enter Unit Price">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName">MRP</label>
                    <input type="text" name="mrp" class="form-control" id="exampleInputName" placeholder="Enter MRP">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputName">Open Stock</label>
                    <input type="text" name="qty" class="form-control" id="exampleInputName" placeholder="Enter Open Stock">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputDescription">Description</label>
                    <textarea class="form-control" id="exampleInputDescription" name="description" rows="3" placeholder="Enter ..."></textarea>
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
      part_number: {
        required: true,
      },
      category: {
        required: true,
      },
      unit_price: {
        required: true,
      },
      description: {
        required: true,
      },
      qty: {
        required: true,
      },
      mrp: {
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
