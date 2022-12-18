@extends('master.index')

@section('mainContent')
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
                @can('user-create')

                  <div class="btn-group">
                    <button type="button" data-toggle="modal" data-target="#modal-default" data-backdrop="static" data-keyboard="false" class="btn btn-primary float-end" class="btn btn-default">{{ __('Add New Order +') }}</button>
                    <button type="button" data-toggle="modal" data-target="#modal-import" data-backdrop="static" data-keyboard="false" class="btn btn-success float-end" class="btn btn-default">{{ __('Order Import +') }}</button>
                    <a class="btn btn-warning"
                    href="{{ route('order.export-orders') }}">
                            Export Order Data
                    </a>
                  </div>
                @endcan
                <x-flash-message type="success" key="success" />
                <x-flash-message type="error" key="error" />
              </div>
                <div class="card-header">
                  <p>filters</p>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                    <label>Product</label>
                    <select class="form-control" id="product_filter" name="product_filter">
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
                    <select class="form-control" id="stage_filter" name="stage_filter">
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
                    <th>Created</th>
                    <th width="200px">Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th width="200px">Stage</th>
                    <th>Source</th>
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
            <div class="card">
                <form  class="text-start" id="updateOrderDetails">
                    @csrf
                <div class="card-header">
                    <h1 style="float: left;" id="name">Name</h1>
                    <input type="hidden" class="form-control" id="id" name="id" >
                    <input type="hidden" class="form-control" id="type" name="type" value="1">
                    <div class="card-tools">
                        <span class="badge bg-danger is_deleted" style="display: none">DELETED</span><span class="badge bg-success is_converted" style="display: none">Converted</span>

                        <a onclick="export_excel()" class="btn btn-tool btn-sm">
                            <i class="fas fa-download"></i>
                          </a>
                      </div>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    <strong><i class="fas fa-phone mr-1"></i> Phone</strong>

                    <p class="text-muted" id="phone">
                      B.S. in Computer Science from the University of Tennessee at Knoxville
                    </p>
                    <hr>
                    <strong><i class="fas fa-envelope mr-1"></i> Email</strong>

                    <p class="text-muted" id="email">
                      B.S. in Computer Science from the University of Tennessee at Knoxville
                    </p>

                    <hr>

                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>

                    <p class="text-muted" id="address">Malibu, California</p>

                    <hr>

                    <strong><i class="far fa-file-alt mr-1"></i> Source</strong>

                    <p class="text-muted" id="source">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                    <hr>

                    <strong><i class="fas fa-bullseye mr-1"></i> Stage</strong>
                    <div class="form-group">
                        <select class="form-control" id="stage" name="stage">
                            @foreach (config('constants.stages') as $key => $stage)
                            <option value="{{ $key }}">{{ $stage }}</option>
                            @endforeach
                        </select>
                      </div>
                    <hr>

                    <strong><i class="fas fa-location-arrow mr-1"></i> District</strong>

                    <div class="form-group">
                        <input type="text" class="form-control" id="district" name="district" placeholder="Enter ...">
                    </div>
                    <hr>

                    <strong><i class="fas fa-address-book mr-1"></i> Description</strong>

                    <div class="form-group">
                        <textarea class="form-control" readonly id="description" name="description" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                    <hr>

                    <strong><i class="fas fa-bookmark mr-1"></i> COD</strong>

                    <input type="text" class="form-control" id="cod" name="cod" placeholder="Enter ...">
                    <hr>

                    <strong><i class="fas fa-balance-scale mr-1"></i> Actual Value</strong>

                    <input type="text" class="form-control" id="actual_value" name="actual_value" placeholder="Enter ...">
                  </div>
                  <div class="card-footer">
                    <button type="button" onclick="updateOrderDetails()" class="btn btn-primary submit">Submit</button>
                </div>
                </form>
                <!-- /.card-body -->
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


  <div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Order Form</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  class="text-start" method="POST" id="quickForm" action="{{ route('order.store') }}">
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
                <div class="form-group">
                <label for="exampleInputName">Full Name</label>
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
                    <label for="exampleInputAddress">Address</label>
                    <textarea class="form-control" id="exampleInputAddress" name="address" rows="3" placeholder="Enter ..."></textarea>
                </div>
                <div class="form-group">
                <label for="exampleInputDistrict">District</label>
                <input type="text" name="district" class="form-control" id="exampleInputDistrict" placeholder="Enter phone">
                </div>
                <div class="form-group">
                    <label for="exampleInputDescription">Description</label>
                    <textarea class="form-control" id="exampleInputDescription" name="description" rows="3" placeholder="Enter ..."></textarea>
                </div>
                <div class="form-group">
                    <label>Stage</label>
                    <select class="form-control" id="stage" name="stage">
                        @foreach (config('constants.stages') as $key => $stage)
                        <option value="{{ $key }}">{{ $stage }}</option>
                        @endforeach
                    </select>
                  </div>
                <div class="form-group">
                <label for="exampleInputCOD">COD</label>
                <input type="text" name="cod" class="form-control" id="exampleInputCOD" placeholder="Enter phone">
                </div>
                <div class="form-group">
                <label for="exampleInputActual">Actual Value</label>
                <input type="text" name="actual_value" class="form-control" id="exampleInputActual" placeholder="Enter phone">
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary hide">Submit</button>
        </div>
    </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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
              { data: 'created_at', name: 'created_at', orderable: false, searchable: false },
              { data: 'name', name: 'full_name', orderable: true, searchable: true },
              { data: 'email', name: 'email', orderable: false, searchable: true },
              { data: 'phone', name: 'phone', orderable: true, searchable: true },
              { data: 'stages', name: 'stage', orderable: true, searchable: true },
              { data: 'source', name: 'source', orderable: true, searchable: true },
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
        function deleteproduct(event,form_id) {
            event.preventDefault();
            $.confirm({
            title: 'Confirm?',
                content: 'Are you sure you want to delete this record?',
                type: 'blue',
                buttons: {
                    Okey: {
                        text: 'confirm',
                        btnClass: 'btn-blue',
                        action: function () {
                            $(`#${form_id}`).submit();
                        }
                    },
                    cancel: {
                        text: 'cancel',
                        btnClass: 'btn-red',
                        action: function () {
                        }
                    }
                }
            });
        }

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
                    $('#id').val(data.id);
                    $('#name').html(data.full_name);
                    $('#phone').html(data.phone);
                    $('#email').html(data.email);
                    $('#address').html(data.address);
                    $('#source').html(data.source);
                    $('#description').val(data.description);
                    $('#district').val(data.district);
                    $('#cod').val(data.cod);
                    $('#actual_value').val(data.actual_value);
                    selectElement('stage', data.stage);
                    if(data.stage == 2){
                        $('.is_converted').show();
                        $('.is_deleted').hide();
                    }else if(data.stage == 5){
                        $('.is_deleted').show();
                        $('.is_converted').hide();
                    }else{
                        $('.is_converted').hide();
                        $('.is_deleted').hide();
                    }

                }
            });
        }

        function updateOrderDetails(){

        var data = $('#updateOrderDetails').serialize();
        $.ajax({
            type: "PUT",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            async: false,
            url: '{!! route('order.update',1) !!}',
            data: $('#updateOrderDetails').serialize(),
            success: function (data) {
                    Swal.fire({
                        type: "success",
                        title: 'Order details updated successfully',
                        text: '',
                        confirmButtonClass: 'btn btn-success',
                    }).then((value)=>{
                        // window.location.href="company_return_notes/view"
                        getOrder(data.id)
                        $('#example1').DataTable().ajax.reload();
                    })
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

