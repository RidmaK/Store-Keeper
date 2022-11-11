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
                <form  class="text-start" method="POST" action="{{ route('customer.update',$customer->id) }}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="input-group input-group-outline my-3 is-filled">
                    <label class="form-label">Customer Name</label>
                    <input type="text" name="name" id="name" required class="form-control" value="{{ $customer->name }}">
                    </div>
                    <div class="input-group input-group-outline my-3 is-filled">
                    <label class="form-label">Customer Address 1</label>
                    <input type="text" name="address1" required class="form-control" value="{{ $customer->address1 }}">
                    </div>
                    <div class="input-group input-group-outline my-3 is-filled">
                    <label class="form-label">Customer Address 2</label>
                    <input type="text" name="address2" class="form-control" value="{{ $customer->address2 }}">
                    </div>
                    <div class="input-group input-group-outline my-3 is-filled">
                    <select class="form-control input-group input-group-outline my-3 is-filled js-example-basic-single" required name="city" >
                        <option value="">Select City</option>
                        @foreach ($cities as $key => $city )
                        <option value="{{ $key + 1 }}" value="{{ ($customer->city == $key + 1) ? 'selected' : ''  }}">{{ $city }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="input-group input-group-outline my-3 is-filled">
                    <label class="form-label">Phone No</label>
                    <input type="number"  name="phone"  required class="form-control" value="{{ $customer->phone }}">
                    </div>
                    <div class="input-group input-group-outline my-3 is-filled">
                    <label class="form-label">Type</label>
                    <input type="text" name="type" required class="form-control" value="{{ $customer->type }}">
                    </div>
                    <div class="text-center">
                    {{-- <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">ADD</button> --}}
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>
  </div>

@endsection
