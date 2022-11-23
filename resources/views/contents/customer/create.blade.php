@extends('dashboard.dashboard')

@section('mainContent')
<div class="container-fluid py-4">
    <div class="row">
        <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">weekend</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Customer</p>
                <h4 class="mb-0">Registration</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <form  class="text-start" method="POST" action="{{ route('customer.store') }}">
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
                    <label class="form-label">Customer Address 2</label>
                    <input type="text" name="address2" id="address2" class="form-control">
                    </div>
                    <div class="input-group input-group-outline my-3 is-filled">
                    <select class="form-control input-group input-group-outline my-3 is-filled js-example-basic-single" required name="city" id="city" >
                        <option value="">Select City</option>
                        @foreach ($cities as $key => $city )
                        <option value="{{ $key}}">{{ $city }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="input-group input-group-outline my-3 is-filled">
                        <select class="form-control input-group input-group-outline my-3 is-filled js-example-basic-single" required name="type" id="type" >
                            <option value="">Select Company</option>
                            @foreach ($companies as $key => $company )
                            <option value="{{ $company->name }}">{{ $company->name }}</option>
                            @endforeach
                          </select>
                    </div>
                    <div class="text-center">
                    <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">NEXT</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>
  </div>
@endsection
@section('scripts')
  <Script>
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
                $('#city').val(data.city);
                $('#type').val(data.type);
            }
        });
    }
</script>
@endsection
