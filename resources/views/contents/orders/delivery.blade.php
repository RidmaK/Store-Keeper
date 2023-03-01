@extends('master.index')

@section('mainContent')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Delivery - {{ strtoupper(request()->segment(2)) }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Delivery</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->

            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    @if (request()->segment(2) == 'out')
                    <th width="20%">Dealer</th>
                    @endif
                    <th width="20%">Product</th>
                    <th width="15%">Unit Price</th>
                    <th width="15%">MRP</th>
                    <th width="10%">Qty</th>
                    <th width="20%">Total</th>
                    <th width="20%">Transaction On</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if (!empty($data))

                        @foreach ($data as $key => $d)
                        <tr>
                             @if (request()->segment(2) == 'out')
                            <td >{{ strLimit($d->dealer->contact_person) }}</td>
                            @endif
                            <td >{{ strLimit($d->product->name) }}</td>
                            <td>{{ $d->product->unit_price }}</td>
                            <td>{{ $d->product->mrp }}</td>
                            <td>{{ $d->qty}}</td>
                            <td>{{ number_format($d->qty * $d->product->unit_price,2)}}</td>
                            <td>{{ $d->created_at}}</td>
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
                    @if (request()->segment(2) == 'out')
                    <th width="20%">Dealer</th>
                    @endif
                    <th width="20%">Product</th>
                    <th width="15%">Unit Price</th>
                    <th width="15%">MRP</th>
                    <th width="10%">Qty</th>
                    <th width="20%">Total</th>
                    <th width="20%">Transaction On</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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
          <h4 class="modal-title">Product Import</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form action="{{ route('product.importProductExcel') }}" method="POST" enctype="multipart/form-data" class="form form-horizontal">
          @csrf

        <div class="modal-body">
            <div class="card-body">
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
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
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
    </script>
    @endsection

