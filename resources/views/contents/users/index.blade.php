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
          <div class="col-12">
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
                    <th width="70%">Name</th>
                    <th>Email</th>
                    <th>Permission Groups</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if (!empty($data))

                        @foreach ($data as $key => $user)
                        <tr>
                            <td class="clickable-row" ><a href="{{ route('user.show',encrypt($user->id)) }}">{{strLimit($user->name)}}</a></td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @php
                                    $roles = $user->roles()->get();
                                @endphp
                                @if(!empty($roles))
                                    @foreach($roles as $v)
                                        <label class="cm-status success">{{ $v->display_name }}</label>
                                    @endforeach
                                @endif
                            </td>
                            <td> @if($user->status == 1 )
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
                    <th width="70%">Name</th>
                    <th>Email</th>
                    <th>Permission Groups</th>
                    <th>Status</th>
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

