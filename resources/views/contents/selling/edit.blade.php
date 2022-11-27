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
            <form  class="text-start" method="POST" action="{{ route('product.update',$product->id) }}">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="customer_id" id="customer_id" value="{{ $product->customer->id }}">
                <div class="input-group input-group-outline my-3 is-filled">
                <label class="form-label">Item Name</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name }}">
                </div>
                <div class="input-group input-group-outline my-3 is-filled">
                <label class="form-label">Description</label>
                <textarea type="text" name="description" class="form-control" value="{{ $product->description }}"></textarea>
                </div>
                <div class="input-group input-group-outline my-3 is-filled">
                    <select class="form-control input-group input-group-outline my-3 is-filled js-example-basic-single" required name="category" id="category" >
                        <option value="">Select Category</option>
                        @foreach ($categories as $key => $category )
                        <option value="{{ $category->id }}" {{ $product->category == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                      </select>
                </div>


                <div class="input-group input-group-outline my-3 is-filled date">
                    <label class="form-label">Date</label>
                    <input type="date" step="any" name="date" id="date" class="form-control" onchange="getRate()">
                    </div>
                    <div class="input-group input-group-outline my-3 is-filled rate">
                    <label class="form-label">Rate</label>
                    <input type="number" step="any" name="rate" id="rate" class="form-control" value="0">
                    </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-check form-switch d-flex align-items-center mb-3">
                        <input class="form-check-input" type="checkbox" id="check_recondition" name="check_recondition" onchange="setReconditionWeight()" {{ $product->weight_recondition != '' ? 'checked' : '' }}>
                        <label class="form-check-label mb-0 ms-3" for="check_recondition">Recondition</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                            <div class="input-group input-group-outline my-3 is-filled weight_recondition">
                            <label class="form-label">Weight (Kg)</label>
                            <input type="number" step="0.2" name="weight_recondition" id="weight_recondition" class="form-control" value="{{ $product->weight_recondition }}" onchange="calReconditionPrice()" >
                            </div>
                    </div>
                    <div class="col-md-3">
                            <div class="input-group input-group-outline my-3 is-filled price_recondition">
                            <label class="form-label">Price (LKR)</label>
                            <input type="number" step="0.2" name="price_recondition" id="price_recondition" class="form-control" value="{{ $product->price_recondition }}">
                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-check form-switch d-flex align-items-center mb-3">
                        <input class="form-check-input" type="checkbox" id="check_reusable" name="check_reusable" onchange="setReusableWeight()" {{ $product->weight_reusable != '' ? 'checked' : '' }}>
                        <label class="form-check-label mb-0 ms-3" for="check_reusable">Reusable</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                            <div class="input-group input-group-outline my-3 is-filled weight_reusable">
                            <label class="form-label">Weight (Kg)</label>
                            <input type="number" step="0.2"  name="weight_reusable" id="weight_reusable" class="form-control" value="{{ $product->weight_reusable }}" onchange="calReusablePrice()">
                            </div>
                    </div>
                    <div class="col-md-3">
                            <div class="input-group input-group-outline my-3 is-filled price_reusable">
                            <label class="form-label">Price (LKR)</label>
                            <input type="number" step="0.2" name="price_reusable" id="price_reusable" class="form-control" value="{{ $product->price_reusable }}">
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
@section('scripts')
  <script type="text/javascript">
    function setReconditionWeight(){
        if($('#check_recondition').prop('checked')){
            $('.weight_recondition').show();
            $('#weight_recondition').val('');
            $('.price_recondition').show();
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
        }else{
            $('.weight_reusable').hide();
            $('.price_reusable').hide();
        }
    }


    function getRate() {
        if($('#phone').val() != ''){
            $.ajax({
                type: "GET",
                url: "{!! route('category.getSellingRate') !!}",
                data: {
                    'category' : $('#category').val(),
                    'date' : $('#date').val(),
                }, // serializes the form's elements.
                success: function(data)
                {
                    if(data.category != null){
                    $('#rate').val(data.category.rate);
                    }
                    $('#available_reusable').val(data.availabile_weight_reusable);
                    $('#reusable').val(data.availabile_weight_reusable);
                    $('#available_recondition').val(data.availabile_weight_recondition);
                    $('#recondition').val(data.availabile_weight_recondition);
                    calReconditionPrice();
                    calReusablePrice();
                }
            });
        }else{
            $.alert({
                    title: 'Alert!',
                    type: 'red',
                    content: 'Please enter Phone Number!',
                });
        }
    }

    function checkAvailability() {


        $.ajax({
            type: "GET",
            url: "{!! route('customer.checkAvailability') !!}",
            data: {
                'phone' : $('#phone').val(),
            }, // serializes the form's elements.
            success: function(data)
            {
                $('#name').val(data.name);
                $('#address1').val(data.address1);
                $('#address2').val(data.address2);
            }
        });
    }



    function calReconditionPrice(){
        console.log(parseFloat($('#weight_recondition').val()));
        var rate = $('#rate').val();
        var total = rate * (parseFloat($('#weight_recondition').val()))
        $('#price_recondition').val(total);
        if($('#weight_recondition').val() != ''){
            var x =parseFloat($('#recondition').val()) - parseFloat($('#weight_recondition').val());
            if(x > 0){
                $('#available_recondition').val(parseFloat($('#recondition').val()) - parseFloat($('#weight_recondition').val()));
            }else{
                $.alert({
                    title: 'Alert!',
                    type: 'red',
                    content: 'Out Of Stock!',
                });
            $('#available_recondition').val(parseFloat($('#recondition').val()));
            $('#weight_recondition').val('');
            $('#price_recondition').val('');
            }

        }else{
            $('#available_recondition').val(parseFloat($('#recondition').val()));
        }
    }

    function calReusablePrice(){
        var rate = $('#rate').val();
        var total = rate * (parseFloat($('#weight_reusable').val()))
        $('#price_reusable').val(total);
        if($('#weight_reusable').val() != ''){

            var y =parseFloat($('#reusable').val()) - parseFloat($('#weight_reusable').val());
            if(y > 0){
                $('#available_reusable').val(parseFloat($('#reusable').val()) - parseFloat($('#weight_reusable').val()));
            }else{

                $.alert({
                    title: 'Alert!',
                    type: 'red',
                    content: 'Out Of Stock!',
                });
            $('#available_reusable').val(parseFloat($('#reusable').val()));
            $('#weight_reusable').val('');
            $('#price_reusable').val('');
            }

        }else{
            $('#available_reusable').val(parseFloat($('#reusable').val()));
        }
    }

  </script>

@endsection
