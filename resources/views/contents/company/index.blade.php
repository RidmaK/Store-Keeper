@extends('dashboard.dashboard')

@section('mainContent')
<div class="container-fluid py-4">
<div class="row" style="margin-left: 10px;margin-right: 10px;">
    <div class="card">
        <div class="card-body px-0 pb-2">
            <div class="table-responsive">
                <x-flash-message type="success" key="success" />
                <x-flash-message type="error" key="error" />
                @can('company-create')
                <a href="{{route('company.create')}}" class="btn btn-primary float-end" style="margin-right: 27px;">
                    {{ __('Add New') }}
                </a>
                @endcan
                <table class="table align-items-center mb-0" id="myTable">
                <thead>
                    <tr>
                    <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($companies) > 0)
                        @foreach ($companies as $company)
                        <tr>
                            <th class="text-start" scope="row">{{$company->name  ?? "-"}}</th>
                            <td class="text-center">
                                @if ($company->status == 1)
                                <span class="bg-green-300 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">ACTIVE</span>
                                @else
                                <span class="bg-red-300 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">INACTIVE</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    @can('company-list')
                                        <a href="{{url('company/show', $company->id)}}" class="btn btn-outline-primary">
                                            {{ __('View') }}
                                        </a>
                                    @endcan
                                    @can('company-edit')
                                        <a href="{{route('company.edit', $company->id)}}" class="btn btn-outline-primary">
                                            {{ __('Edit') }}
                                        </a>
                                    @endcan
                                    @can('company-delete')
                                        <a type="button" onclick="deletecompany(event,'delete-form-{{$company->id}}')" class="btn btn-outline-danger">
                                            {{ __('Delete') }}
                                        </a>
                                    @endcan
                                </div>
                                <form id="delete-form-{{$company->id}}" action="{{ route('company.destroy', $company->id) }}" method="POST" class="d-none">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                </form>
                            </td>
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
        if('{!! count($companies) !!}' > 0){
            $('#myTable').DataTable();
        }
    } );
    function deletecompany(event,form_id) {
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
