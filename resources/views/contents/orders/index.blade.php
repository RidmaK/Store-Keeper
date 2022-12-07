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
                <a href="{{route('user.create')}}" class="btn btn-primary float-end" style="margin-right: 27px;">
                    {{ __('Add New User +') }}
                </a>
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
                    <th>Stage</th>
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
                            <td></td>
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
                <div class="card-header">
                    <h1 id="name">Name</h1>
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

@endsection
@section('scripts')
<Script>

$(function () {
    getOrder(1);
    $("#example1").DataTable({
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
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
                    $('#name').html(data.full_name);
                    $('#phone').html(data.phone);
                    $('#email').html(data.email);
                    $('#address').html(data.address);
                    $('#source').html(data.source);
                    $('#description').val(data.description);
                    $('#stage').html(data.stage);

                }
            });
        }
    </script>
    @endsection

