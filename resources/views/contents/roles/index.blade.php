@extends('master.index')

@section('mainContent')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users Groups</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users Groups</li>
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
                @can('role-create')
                <a href="{{route('role.create')}}" class="btn btn-primary float-end" style="margin-right: 27px;">
                    {{ __('Add New User Group +') }}
                </a>
                <x-flash-message type="success" key="success" />
                <x-flash-message type="error" key="error" />

                @endcan
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>No of users</th>
                  </tr>
                  </thead>
                  <tbody>
                    @if (!empty($roles))

                    @foreach ($roles as $key => $role)

                    <tr>
                        <td width="85%"><a href="{{ route('role.edit',encrypt($role->id)) }}">{{strLimit($role->display_name)}}</a></td>
                        <td width="15%">{{ count($role->users) }}</td>

                    </tr>


                    @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-danger text-center">No records found</td>
                        </tr>
                    @endif
                  </tbody>
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
    $("#example2").dataTable();
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

