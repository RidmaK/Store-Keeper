@extends('dashboard.dashboard')

@section('mainContent')
<div class="container-fluid py-4">
    <div class="row"><div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">weekend</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">Selling</p>
            <h4 class="mb-0">ADD</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
            <form  class="text-start" id="form" class="form" method="POST" action="{{ route('selling.store') }}">
                @csrf
                <div class="input-group input-group-outline my-3 is-filled">
                <label class="form-label">Phone No</label>
                <input type="number"  name="phone" id="phone"  required class="form-control" onchange="checkAvailability()">
                </div>
                <div class="input-group input-group-outline my-3 is-filled">
                <label class="form-label">Customer Name</label>
                <input type="text" name="name" id="name" required class="form-control">
                </div>
                <div class="input-group input-group-outline my-3 is-filled">
                <label class="form-label">Customer Address 1</label>
                <input type="text" name="address1" id="address1" required class="form-control">
                </div>
                <div class="input-group input-group-outline my-3 is-filled">
                    <select class="form-control input-group input-group-outline my-3 is-filled js-example-basic-single" required name="category" id="category" onchange="getRate()">
                        <option value="">Select Category</option>
                        @foreach ($categories as $key => $category )
                        <option value="{{ $key }}">{{ $category }}</option>
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
                            <label class="form-label">Available Stock (Kg)</label>
                            <input type="number" step="any" name="available_recondition" id="available_recondition" class="form-control">
                            <input type="hidden" step="any" name="recondition" id="recondition" class="form-control">
                            </div>
                    </div>
                    <div class="col-md-3">
                            <div class="input-group input-group-outline my-3 is-filled weight_recondition" style="display: none">
                            <label class="form-label">Weight (Kg)</label>
                            <input type="number" step="any" name="weight_recondition" id="weight_recondition" class="form-control" onchange="calReconditionPrice()" value="0">
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
                            <label class="form-label">Available Stock (Kg)</label>
                            <input type="number" step="any" name="available_reusable" id="available_reusable" class="form-control">
                            <input type="hidden" step="any" name="reusable" id="reusable" class="form-control">
                            </div>
                    </div>
                    <div class="col-md-3">
                            <div class="input-group input-group-outline my-3 is-filled weight_reusable" style="display: none">
                            <label class="form-label">Weight (Kg)</label>
                            <input type="number" step="any"  name="weight_reusable" id="weight_reusable" class="form-control" onchange="calReusablePrice()" value="0">
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
                <button type="submit" id="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">ADD</button>
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
                url: "{!! route('category.getRate') !!}",
                data: {
                    'category' : $('#category').val(),
                }, // serializes the form's elements.
                success: function(data)
                {
                    $('#rate').val(data.category.rate);
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
