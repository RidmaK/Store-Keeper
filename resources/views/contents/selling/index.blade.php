@extends('dashboard.dashboard')

@section('mainContent')
<div class="container-fluid py-4">
<div class="row">
    <div class="card">
        <div class="card-body px-0 pb-2">
            <div class="table-responsive">
                <x-flash-message type="success" key="success" />
                <x-flash-message type="error" key="error" />
                <a href="{{route('selling.create')}}" class="btn btn-primary float-end" style="margin-right: 27px;">
                    {{ __('Add New') }}
                </a>
                <table class="table align-items-center mb-0" id="myTable">
                    <thead>
                        <tr>
                        <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                        <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer</th>
                        <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Factory</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Category</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Rate</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Weight Recondition (Kg)</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price Recondition (LKR)</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Weight Recycling (Kg)</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price Recycling (LKR)</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Price (LKR)</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($sellings) > 0)
                            @foreach ($sellings as $selling)
                            <tr>
                                <th class="text-start" scope="row">{{$selling->date ?? "-"}}</th>
                                <th class="text-start" scope="row">{{$selling->customer->name ?? "-"}}</th>
                                <th class="text-start" scope="row">{{$companies[$selling->customer->customer_type] ?? "-"}}</th>
                                <td class="text-center">{{$categories[$selling->category] ?? "-"}}</td>
                                <td class="text-center">{{$selling->rate ?? "-"}}</td>
                                <td class="text-center">{{(float)$selling->weight_recondition ?? 'N/A'}}</td>
                                <td class="text-center">{{$selling->price_recondition ?? 'N/A'}}</td>
                                <td class="text-center">{{(float)$selling->weight_reusable ?? 'N/A'}}</td>
                                <td class="text-center">{{$selling->price_reusable ?? 'N/A'}}</td>
                                <td class="text-center">{{number_format($selling->price_reusable + $selling->price_recondition, 2) ?? "-"}}</td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                            {{-- <a href="{{url('selling/show', $selling->id)}}" class="btn btn-outline-primary">
                                                {{ __('View') }}
                                            </a>
                                            <a href="{{route('selling.edit', $selling->id)}}" class="btn btn-outline-primary">
                                                {{ __('Edit') }}
                                            </a> --}}
                                            <a type="button" onclick="deleteselling(event,'delete-form-{{$selling->id}}')" class="btn btn-outline-danger">
                                                {{ __('Delete') }}
                                            </a>
                                    </div>
                                    <form id="delete-form-{{$selling->id}}" action="{{ route('selling.destroy', $selling->id) }}" method="POST" class="d-none">
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

        if('{!! count($sellings) !!}' > 0){
            $('#myTable').DataTable();
        }
    } );
        function deleteselling(event,form_id) {
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

