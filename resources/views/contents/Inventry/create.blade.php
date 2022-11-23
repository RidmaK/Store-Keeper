@extends('dashboard.dashboard')

@section('mainContent')
<div class="container-fluid py-4">
    <div class="row"><div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">weekend</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">Inventory</p>
            <h4 class="mb-0">ADD</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
            <form  class="text-start" method="POST" action="{{ route('product.store') }}">
                @csrf
                <input type="hidden" name="customer_id" id="customer_id" value="{{ request()->id }}">
                <div class="input-group input-group-outline my-3 is-filled">
                <label class="form-label">Item Name</label>
                <input type="text" name="name" class="form-control">
                </div>
                <div class="input-group input-group-outline my-3 is-filled">
                <label class="form-label">Description</label>
                <textarea type="text" name="description" class="form-control"></textarea>
                </div>
                <div class="input-group input-group-outline my-3 is-filled">
                    <select class="form-control input-group input-group-outline my-3 is-filled js-example-basic-single" required name="category" id="category" onchange="getRate()">
                        <option value="">Select Category</option>
                        @foreach ($categories as $key => $category )
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                      </select>
                </div>
                <input type="hidden" name="rate" id="rate">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-check form-switch d-flex align-items-center mb-3">
                        <input class="form-check-input" type="checkbox" id="check_recondition" name="check_recondition" onchange="setReconditionWeight()">
                        <label class="form-check-label mb-0 ms-3" for="check_recondition">Recondition</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                            <div class="input-group input-group-outline my-3 is-filled weight_recondition" style="display: none">
                            <label class="form-label">Weight (Kg)</label>
                            <input type="number" step="any" name="weight_recondition" id="weight_recondition" class="form-control" onchange="calReconditionPrice()">
                            </div>
                    </div>
                    <div class="col-md-3">
                            <div class="input-group input-group-outline my-3 is-filled price_recondition" style="display: none">
                            <label class="form-label">Price (LKR)</label>
                            <input type="number" step="any" name="price_recondition" id="price_recondition" class="form-control">
                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-check form-switch d-flex align-items-center mb-3">
                        <input class="form-check-input" type="checkbox" id="check_reusable" name="check_reusable" onchange="setReusableWeight()">
                        <label class="form-check-label mb-0 ms-3" for="check_reusable">Reusable</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                            <div class="input-group input-group-outline my-3 is-filled weight_reusable" style="display: none">
                            <label class="form-label">Weight (Kg)</label>
                            <input type="number" step="any"  name="weight_reusable" id="weight_reusable" class="form-control" onchange="calReusablePrice()">
                            </div>
                    </div>
                    <div class="col-md-3">
                            <div class="input-group input-group-outline my-3 is-filled price_reusable" style="display: none">
                            <label class="form-label">Price (LKR)</label>
                            <input type="number" step="any" name="price_reusable" id="price_reusable" class="form-control">
                            </div>
                    </div>
                </div>
                <div class="text-center">
                <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">ADD</button>
                </div>
            </form>
        </div>
      </div>
    </div>
    </div>
  </div>
@endsection
@section('scripts')
  <script type="text/javascript">
    function setReconditionWeight(){
        if($('#check_recondition').prop('checked')){
            $('.weight_recondition').show();
            $('#weight_recondition').val('');
            $('.price_recondition').show();
            calReconditionPrice();
        }else{
            $('.weight_recondition').hide();
            $('.price_recondition').hide();
        }
    }

    function setReusableWeight(){
        if($('#check_reusable').prop('checked')){
            $('.weight_reusable').show();
            $('#weight_reusable').val('');
            $('.price_reusable').show();
            calReusablePrice();
        }else{
            $('.weight_reusable').hide();
            $('.price_reusable').hide();
        }
    }

    function calReconditionPrice(){
        console.log();
        var rate = $('#rate').val();
        var total = rate * (parseFloat($('#weight_recondition').val()))
        $('#price_recondition').val(total);
    }

    function calReusablePrice(){
        var rate = $('#rate').val();
        var total = rate * (parseFloat($('#weight_reusable').val()))
        $('#price_reusable').val(total);
    }


    function getRate() {
        $.ajax({
            type: "GET",
            url: "{!! route('category.getRate') !!}",
            data: {
                'category' : $('#category').val(),
            }, // serializes the form's elements.
            success: function(data)
            {
                $('#rate').val(data.category.rate);
                calReconditionPrice();
                calReusablePrice();
            }
        });
    }
  </script>

@endsection
