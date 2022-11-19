@extends('dashboard.dashboard')

@section('mainContent')
<div class="container-fluid py-4">
<div class="row">
    <div class="card">
        <div class="card-body px-0 pb-2">
            <div class="table-responsive">
                <x-flash-message type="success" key="success" />
                <x-flash-message type="error" key="error" />
                <a href="{{route('user-group.create')}}" class="btn btn-primary float-end" style="margin-right: 27px;">
                    {{ __('Add New') }}
                </a>

                <table class="table table-bordered" id="rolesListTable">
                    <thead>
                        <tr>
                            <th width="5%" style="display: none;">ID</th>
                            <th width="85%">Name</th>
                            <th width="15%">No of users</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $i = 0;
                        @endphp
                        @if (!empty($roles))

                        @foreach ($roles as $key => $role)

                        <tr>
                            <td width="5%" style="display: none;">{{ ++$i }}</td>
                            <td width="85%"><a href="{{ route('user-group.edit',encrypt($role->id)) }}">{{strLimit($role->display_name)}}</a></td>
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
            </div>
        </div>
    </div>
      </div>

      @endsection
      @section('scripts')
      <Script>

    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
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

