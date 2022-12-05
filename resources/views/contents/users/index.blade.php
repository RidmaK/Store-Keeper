@extends('dashboard.index')

@section('mainContent')
<div class="container-fluid py-4">
<div class="row">
    <div class="card">
        <div class="card-body px-0 pb-2">
            <div class="table-responsive">
                <x-flash-message type="success" key="success" />
                <x-flash-message type="error" key="error" />
                @can('user-create')
                <a href="{{route('user.create')}}" class="btn btn-primary float-end" style="margin-right: 27px;">
                    {{ __('Add User +') }}
                </a>
                @endcan

                <table class="table table-bordered" id="usersListTable" style="width: 100% !important;">
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

