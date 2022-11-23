@extends('dashboard.dashboard')

@section('mainContent')
<div class="container-fluid py-4">
<div class="row">
    <div class="card">
        <div class="card-body px-0 pb-2">
            <div class="table-responsive">
                <x-flash-message type="success" key="success" />
                <x-flash-message type="error" key="error" />
                {{-- <a href="{{route('product.create')}}" class="btn btn-primary float-end" style="margin-right: 27px;">
                    {{ __('Add New') }}
                </a> --}}
                <table class="table align-items-center mb-0" id="myTable">
                    <thead>
                        <tr>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Category</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Weight Recondition (Kg)</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total Weight Reusable (Kg)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($products) > 0)
                            @foreach ($products as $product)
                            <tr>
                                <td class="text-center">{{$categories[$product->category] ?? "-"}}</td>
                                <td class="text-center">{{(float)$product->sum_weight_recondition ?? 'N/A'}}</td>
                                <td class="text-center">{{(float)$product->sum_weight_reusable ?? 'N/A'}}</td>
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

        if('{!! count($products) !!}' > 0){
            $('#myTable').DataTable();
        }
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

