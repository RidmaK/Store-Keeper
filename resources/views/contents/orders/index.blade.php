@extends('master.index')

@section('mainContent')
<style>
    .select2-container--default.select2-container--focus .select2-selection--multiple, .select2-container--default.select2-container--focus .select2-selection--single {
    border-color: #80bdff;
    height: auto;
}
    .select2-container--default.select2-container .select2-selection--multiple, .select2-container--default.select2-container .select2-selection--single {
    height: 37px;
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Orders</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Orders</li>
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
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <x-flash-message type="success" key="success" />
                <x-flash-message type="error" key="error" />
              </div>
                <div class="card-header">
                  <p>filters</p>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                    <label>Product</label>
                    <select class="select2 js-example-responsive js-states form-control" style="height:auto" id="product_filter" name="product_filter">
                        <option value="0">select</option>
                      @foreach ($product as $key => $item)
                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                    <label>Stage</label>
                    <select class="form-control" id="stage_filter" name="stage_filter" onchange="changeHandler()">
                      <option value="0">select</option>
                        @foreach (config('constants.stages') as $key => $stage)
                        <option value="{{ $key }}">{{ $stage }}</option>
                        @endforeach
                    </select>
                  </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="exampleInputDistrict">From</label>
                      <input type="date" class="form-control" id="p-from-date" name="p-from-date">
                  </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="exampleInputDistrict">To</label>
                      <input type="date" class="form-control" id="p-to-date" name="p-to-date">
                  </div>
                  </div>
                </div>
                <div class="row test">
                  <button type="button" id="result" class="btn btn-primary " style="float: right">Search</button>
                </div>
              </div>

              <!-- /.card-header -->
              <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="150px">Created</th>
                    <th width="200px">Name</th>
                    {{-- <th>Email</th> --}}
                    <th>Unit Price</th>
                    <th width="200px">Qty</th>
                    <th>Description</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-4">
            <div class="row">
            <div class="col-12">
                <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">IN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">OUT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-return" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Return</a>
                    </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                        <form  class="text-start" id="updateStockInDetails">
                                @csrf
                            <div class="card-header">
                                <h1 style="float: left;" id="name">Name</h1>
                                <input type="hidden" class="form-control" id="id" name="id" >
                                <input type="hidden" class="form-control" id="type" name="type" value="in">
                                <div class="card-tools">
                                    <span class="badge bg-danger is_deleted" style="display: none">DELETED</span><span class="badge bg-success is_converted" style="display: none">Converted</span>

                                    <a onclick="export_excel()" class="btn btn-tool btn-sm">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong> Unit Price</strong>

                                <p class="text-muted" id="unit_price">
                                B.S. in Computer Science from the University of Tennessee at Knoxville
                                </p>
                                <hr>
                                <strong>MRP</strong>

                                <p class="text-muted" id="mrp">
                                B.S. in Computer Science from the University of Tennessee at Knoxville
                                </p>

                                <hr>

                                <strong>Current Stock</strong>

                                <p class="text-muted" id="qty">Malibu, California</p>

                                <hr>

                                <strong> Description</strong>

                                <div class="form-group">
                                    <textarea class="form-control" readonly id="description" name="description" rows="3" placeholder="Enter ..."></textarea>
                                </div>
                                <hr>
                                <strong> In Qty</strong>

                                <input type="text" class="form-control in_qty" id="qty" name="qty" placeholder="Enter ...">
                            </div>
                            <div class="card-footer">
                                <button type="button" onclick="updateStockInDetails()" class="btn btn-primary submit">Submit</button>
                            </div>
                            </form>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                        <form  class="text-start" id="updateStockOutDetails">
                                @csrf
                            <div class="card-header">
                                <h1 style="float: left;" id="name1">Name</h1>
                                <input type="hidden" class="form-control" id="id1" name="id" >
                                <input type="hidden" class="form-control" id="type" name="type" value="out">
                                <div class="card-tools">
                                    <span class="badge bg-danger is_deleted" style="display: none">DELETED</span><span class="badge bg-success is_converted" style="display: none">Converted</span>

                                    <a onclick="export_excel()" class="btn btn-tool btn-sm">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong> Unit Price</strong>

                                <p class="text-muted" id="unit_price1">
                                B.S. in Computer Science from the University of Tennessee at Knoxville
                                </p>
                                <hr>
                                <strong>MRP</strong>

                                <p class="text-muted" id="mrp1">
                                B.S. in Computer Science from the University of Tennessee at Knoxville
                                </p>

                                <hr>

                                <strong>Current Stock</strong>

                                <p class="text-muted" id="qty1">Malibu, California</p>

                                <hr>

                                <strong> Description</strong>

                                <div class="form-group">
                                    <textarea class="form-control" readonly id="description1" name="description" rows="3" placeholder="Enter ..."></textarea>
                                </div>
                                <hr>

                                <div class="form-group">
                                    <label for="exampleInputName">Dealer</label>
                                    <select class="form-control select2" id="dealer" name="dealer">
                                    @foreach ($dealers as $key => $item)
                                    <option value="{{ $item->id }}">{{ $item->contact_person }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <hr>
                                <strong> Out Qty</strong>

                                <input type="text" class="form-control out_qty" id="qty" name="qty" placeholder="Enter ...">

                            </div>
                            <div class="card-footer">
                                <button type="button" onclick="updateStockOutDetails()" class="btn btn-primary submit">Submit</button>
                            </div>
                            </form>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-return" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                        <form  class="text-start" id="updateStockWarrentyDetails">
                                @csrf
                            <div class="card-header">
                                <h1 style="float: left;" id="name2">Name</h1>
                                <input type="hidden" class="form-control" id="id2" name="id" >
                                <input type="hidden" class="form-control" id="type" name="type" value="out">
                                <div class="card-tools">
                                    <span class="badge bg-danger is_deleted" style="display: none">DELETED</span><span class="badge bg-success is_converted" style="display: none">Converted</span>

                                    <a onclick="export_excel()" class="btn btn-tool btn-sm">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong> Unit Price</strong>

                                <p class="text-muted" id="unit_price2">
                                B.S. in Computer Science from the University of Tennessee at Knoxville
                                </p>
                                <hr>
                                <strong>MRP</strong>

                                <p class="text-muted" id="mrp2">
                                B.S. in Computer Science from the University of Tennessee at Knoxville
                                </p>

                                <hr>

                                <strong>Current Stock</strong>

                                <p class="text-muted" id="qty2">Malibu, California</p>

                                <hr>

                                <strong> Description</strong>

                                <div class="form-group">
                                    <textarea class="form-control" readonly id="description2" name="description" rows="3" placeholder="Enter ..."></textarea>
                                </div>
                                <hr>
                                <hr>
                                <strong> Return Qty</strong>

                                <input type="text" class="form-control out_qty" id="qty" name="qty" placeholder="Enter ...">

                            </div>
                            <div class="card-footer">
                                <button type="button" onclick="updateStockWarrentyDetails()" class="btn btn-primary submit">Submit</button>
                            </div>
                            </form>
                    </div>
                    </div>
                </div>
                <!-- /.card -->
                </div>
            </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <div class="modal fade" id="modal-import">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Order Import</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form action="{{ route('order.import') }}" method="POST" enctype="multipart/form-data" class="form form-horizontal">
          @csrf

        <div class="modal-body">
            <div class="card-body">
                <div class="form-group">
                  <label>Product</label>
                  <select class="form-control" id="product" name="product">
                    @foreach ($product as $key => $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>
                <button class="file btn btn-danger" style="position: relative;overflow: hidden;">
                    CHOOSE FILE
                    <input type="file" id="file-upload" name="file" style="position: absolute;font-size: 50px;opacity: 0;right: 0;top: 0;"/>
                </button>

            </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="hidden" value="region_file" name="db_file" id="db_file">
          <button type="submit" class="btn btn-default">Upload</button>
        </div>
    </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@endsection
@section('scripts')
<Script>
$(function () {

    getOrder(1);

  });
  $(document).ready(function() {
      var table1 = appDataTable('#example1',{
          serverSide: true,
          searching: true,
          ajax: {
              url: "{!! route('order.data') !!}",
              data: function (d) {
                        d.product = $("#product_filter  option:selected").text(),
                        d.stage = $('#stage_filter').val(),
                        d.from_date = $('#p-from-date').val(),
                        d.to_date = $('#p-to-date').val()
                    }
          },

          columns: [
              { data: 'updated_at', name: 'updated_at', orderable: false, searchable: false },
              { data: 'name', name: 'full_name', orderable: true, searchable: true },
            //   { data: 'email', name: 'email', orderable: false, searchable: true },
              { data: 'unit_price', name: 'unit_price', orderable: true, searchable: true },
              { data: 'qty', name: 'qty', orderable: true, searchable: true },
              { data: 'description', name: 'description', orderable: true, searchable: true },
              { data: 'updated_at', name: 'updated_at', orderable: false, searchable: true, visible: false }
          ],
          order: [
              [0, "desc"]
          ]
      });

      $("#result").click(function () {
        table1.draw();
            });
  });


        $("#flowcheckall").click(function () {
            var checkBox = document.getElementById("flowcheckall");
            $('#example1 tbody input[type="checkbox"]').prop('checked', this.checked);
        });

        function getOrder(id){
            $.ajax({
                type: "GET",
                url: "{!! route('order.getOrderDetails') !!}",
                data: {
                    'id' : id,
                }, // serializes the form's elements.
                success: function(data)
                {
                    $('#id').val(data.id ?? id);
                    $('#name').html(data.name);
                    $('#unit_price').html(data.unit_price);
                    $('#mrp').html(data.mrp);
                    $('#qty').html(data.qty + data.in_qty - data.out_qty);
                    $('#description').val(data.description);

                    $('#id1').val(data.id ?? id);
                    $('#name1').html(data.name);
                    $('#unit_price1').html(data.unit_price);
                    $('#mrp1').html(data.mrp);
                    $('#qty1').html(data.qty + data.in_qty - data.out_qty);
                    $('#description1').val(data.description);

                    $('#id2').val(data.id ?? id);
                    $('#name2').html(data.name);
                    $('#unit_price2').html(data.unit_price);
                    $('#mrp2').html(data.mrp);
                    $('#qty2').html(data.qty + data.in_qty - data.out_qty);
                    $('#description2').val(data.description);

                }
            });
        }

        function updateStockInDetails(){

        var data = $('#updateStockInDetails').serialize();
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            async: false,
            url: '{!! route('order.updateStockInDetails',"in") !!}',
            data: $('#updateStockInDetails').serialize(),
            success: function (data) {
                    Swal.fire({
                        type: "success",
                        title: 'Stock Added successfully',
                        text: '',
                        confirmButtonClass: 'btn btn-success',
                    }).then((value)=>{
                        // window.location.href="company_return_notes/view"
                        getOrder(data.id)
                        $('#example1').DataTable().ajax.reload();
                        $('.in_qty').empty();
                        $('.out_qty').empty();
                    })

                }
        })
        }

        function updateStockWarrentyDetails(){

        var data = $('#updateStockWarrentyDetails').serialize();
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            async: false,
            url: '{!! route('order.updateStockWarrentyDetails',"in") !!}',
            data: $('#updateStockWarrentyDetails').serialize(),
            success: function (data) {
                    Swal.fire({
                        type: "success",
                        title: 'Stock Return successfully',
                        text: '',
                        confirmButtonClass: 'btn btn-success',
                    }).then((value)=>{
                        // window.location.href="company_return_notes/view"
                        getOrder(data.id)
                        $('#example1').DataTable().ajax.reload();
                        $('.in_qty').empty();
                        $('.out_qty').empty();
                    })

                }
        })
        }

        function updateStockOutDetails(){

        var data = $('#updateStockOutDetails').serialize();
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            async: false,
            url: '{!! route('order.updateStockOutDetails',"out") !!}',
            data: $('#updateStockOutDetails').serialize(),
            success: function (data) {
                    console.log(data);
                    if(data.status == true){
                        Swal.fire({
                            type: "success",
                            title: 'Stock Out successfully',
                            text: '',
                            confirmButtonClass: 'btn btn-success',
                        }).then((value)=>{
                            // window.location.href="company_return_notes/view"
                            getOrder(data.id)
                            $('#example1').DataTable().ajax.reload();
                            $('.in_qty').empty();
                            $('.out_qty').empty();
                        })
                    }else{
                        Swal.fire({
                            type: "error",
                            title: 'Out Of Stock',
                            text: '',
                            confirmButtonClass: 'btn btn-success',
                        });
                    }
                }
        })
        }

        function setStage(id){
        var stage = $('#stage_'+id).val();
        $.ajax({
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            async: false,
            url: '{!! route('order.setStage') !!}',
            data: {
                stage :stage,
                id :id,
            },
            success: function (data) {
                    Swal.fire({
                        type: "success",
                        title: 'Stage change as '+data.stage+' successfully',
                        text: '',
                        confirmButtonClass: 'btn btn-success',
                    }).then((value)=>{
                      $('#example1').DataTable().ajax.reload();
                        getOrder(id);
                    })
                }
        })
        }
    </script>

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
          address: {
            required: true,
          },
          email: {
            required: false,
            email: true,
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
          address: {
            required: "Please enter an Address",
          },
          email: {
            email: "Please enter a valid email address"
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

        $('#roles').change(function(){
            $(this).valid()
        });

      $('.hide').click(function(event){
        event.preventDefault()
        if($('#quickForm').valid()){
            $('#quickForm').submit();
        }
    });
    });


    function export_excel(){
        $id =$('#id').val();
        var url = '{{route("order.export-order", ":id")}}';
        url = url.replace(':id', $id);
        window.location.replace(url);
    }
      </script>
    @endsection

