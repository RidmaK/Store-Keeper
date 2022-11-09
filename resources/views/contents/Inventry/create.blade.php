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
                <div class="input-group input-group-outline my-3">
                <label class="form-label">Item Name</label>
                <input type="text" name="name" class="form-control">
                </div>
                <div class="input-group input-group-outline my-3">
                <label class="form-label">Description</label>
                <textarea type="text" name="description" class="form-control"></textarea>
                </div>
                <div class="input-group input-group-outline my-3">
                <label class="form-label">Item Category</label>
                <input type="email" name="email" class="form-control">
                </div>
                <div class="input-group input-group-outline my-3">
                <label class="form-label">Weight</label>
                <input type="email" name="email" class="form-control">
                </div>
                <div class="input-group input-group-outline my-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control">
                </div>
                <div class="input-group input-group-outline mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
                </div>
                <div class="form-check form-switch d-flex align-items-center mb-3">
                <input class="form-check-input" type="checkbox" id="rememberMe" checked>
                <label class="form-check-label mb-0 ms-3" for="rememberMe">Reusable</label>
                </div>
                <div class="form-check form-switch d-flex align-items-center mb-3">
                <input class="form-check-input" type="checkbox" id="rememberMe" checked>
                <label class="form-check-label mb-0 ms-3" for="rememberMe">Reusable</label>
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
