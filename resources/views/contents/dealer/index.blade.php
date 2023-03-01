@extends('master.index')

@section('mainContent')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dealer</h1>
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
          <div class="col-12">
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                @can('dealer-create')
                    <div class="btn-group">
                        <a href="{{route('dealer.create')}}" class="btn btn-primary">
                            {{ __('Add New Dealer +') }}
                        </a>
                        <button type="button" data-toggle="modal" data-target="#modal-import" data-backdrop="static" data-keyboard="false" class="btn btn-success float-end" class="btn btn-default">{{ __('Dealer Import +') }}</button>
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
                    <th width="20%">Service Dealer</th>
                    <th width="20%">Contact Person</th>
                    <th width="20%">Phone</th>
                    <th width="20%">District</th>
                    <th width="20%"> Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if (!empty($data))

                        @foreach ($data as $key => $dealer)
                        <tr>
                            <td>{{strLimit($dealer->service_dealer)}}</td>
                            <td class="clickable-row" ><a href="{{ route('dealer.show',encrypt($dealer->id)) }}">{{strLimit($dealer->contact_person)}}</a></td>

                            <td>{{strLimit($dealer->phone)}}</td>
                            <td>{{strLimit($dealer->district)}}</td>
                            <td> @if($dealer->status == 1 )
                                <span class='cm-status success'>Enabled</span>
                            @else
                                <span
                                class='cm-status danger'>Disabled</span>
                                @endif</td>
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
                    <th width="20%">Service Dealer</th>
                    <th width="20%">Contact Person</th>
                    <th width="20%">Phone</th>
                    <th width="20%">District</th>
                    <th width="20%"> Status</th>
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
          <h4 class="modal-title">Dealer Import</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form action="{{ route('dealer.importExcel') }}" method="POST" enctype="multipart/form-data" class="form form-horizontal">
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
        function deletedealer(event,form_id) {
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

