@extends('dashboard.dashboard')

@section('mainContent')
<div class="container-fluid py-4">
    <div class="row">
        <div class="row">
            <h2 style="margin-bottom: 20px;">Overall</h2>
            @foreach ($products as $stock)
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-3">
                <div class="card">
                  <div class="card-header p-3 pt-2">
                    <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                      <i class="material-icons opacity-10">person</i>
                    </div>
                    <div class="text-end pt-1">
                      <p class="text-sm mb-0 text-capitalize">{{ $categories[$stock->category] }}</p>
                      <h4 class="mb-0">{{ (float)$stock->weight_recondition + (float)$stock->weight_reusable  }} Kg</h4>
                    </div>
                  </div>
                  <hr class="dark horizontal my-0">
                  <div class="card-footer p-3">
                    @php
                        $total = 0;
                        $total = (float)$stock->weight_recondition + (float)$stock->weight_reusable;
                    @endphp
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+{{ number_format((float)$stock->weight_recondition / $total * 100, 2, '.', '');  }}% </span>Recondition -> <strong>{{ (float)$stock->weight_recondition }} Kg</strong></p>
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+{{ number_format((float)$stock->weight_reusable / $total * 100, 2, '.', '');  }}% </span>Recycling -> <strong>{{ (float)$stock->weight_reusable }} Kg</strong></p>
                  </div>
                </div>
              </div>
            @endforeach
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

