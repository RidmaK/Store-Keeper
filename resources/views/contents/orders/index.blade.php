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
          <div class="col-8">
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                @can('user-create')

                <div class="btn-group">
                    <button type="button" data-toggle="modal" data-target="#modal-default" data-backdrop="static" data-keyboard="false" class="btn btn-primary float-end" style="margin-right: 27px;" class="btn btn-default">{{ __('Add New Order +') }}</button>
                    <form action="{{ route('order.import') }}" method="POST" enctype="multipart/form-data" class="form form-horizontal">
                    @csrf
                    <button class="file btn btn-danger" style="position: relative;overflow: hidden;">
                        CHOOSE FILE
                        <input type="file" id="file-upload" name="file" style="position: absolute;font-size: 50px;opacity: 0;right: 0;top: 0;"/>
                    </button>

                    <input type="hidden" value="region_file" name="db_file" id="db_file">
                    <button type="submit" class="btn btn-default">Upload</button>

                </form>
                  </div>
                  <div class="card-tools">
                    {{-- <a href="#" class="btn btn-tool btn-sm">
                      <i class="fas fa-download"></i>
                    </a> --}}
                    <a class="btn btn-warning"
                    href="{{ route('order.export-orders') }}">
                            Export Order Data
                    </a>
                  </div>

                @endcan
                <x-flash-message type="success" key="success" />
                <x-flash-message type="error" key="error" />

              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="text-align: center">
                        <input type="checkbox" id="flowcheckall" value="" />&nbsp;All
                    </th>
                    <th>Created</th>
                    <th width="200px">Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th width="200px">Stage</th>
                    <th>Source</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if (!empty($data))

                        @foreach ($data as $key => $order)
                        <tr>
                            <td>
                                <div style="text-align:center">
                                    <input type="checkbox" id="chk_order" name="chk_order" value="{{ $order->id }}">
                                </div>
                            </td>
                            <td>{{ $order->created_at }}</td>
                            <td class="clickable-row" ><a onclick="getOrder({{ $order->id }})" style="cursor: pointer;" class="cm-status success">{{strLimit($order->full_name)}}</a></td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->phone }}</td>
                            <td>
                                <div class="form-group">
                                <select class="form-control" id="stage_{{ $order->id }}" name="stage_{{ $order->id }}" onchange="setStage({{ $order->id }})">
                                    @foreach (config('constants.stages') as $key => $stage)
                                    <option value="{{ $key }}" {{ $order->stage == $key ? 'selected' : '' }}>{{ $stage }}</option>
                                    @endforeach
                                </select>
                              </div>
                            </td>
                            <td>{{ $order->source }}</td>
                        </tr>
                        @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-danger text-center">No records found</td>
                            </tr>
                        @endif
                  </tbody>
                  <tfoot>
                  <tr>
                    <th></th>
                    <th>Created</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Stage</th>
                    <th>Source</th>
                  </tr>
                  </tfoot>
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
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter ..."></textarea>
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
@endsection
@section('scripts')
<Script>

$(function () {
    getOrder(1);
    $("#example1").DataTable();

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
                        location.reload();
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
                        // window.location.href="company_return_notes/view"
                        // location.reload();
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

