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
                <p class="text-sm mb-0 text-capitalize">Company</p>
                <h4 class="mb-0">Registration</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
                <form  class="text-start" method="POST" action="{{ route('company.update',$company->id) }}">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="input-group input-group-outline my-3 is-filled">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" id="name" required class="form-control" value="{{ $company->name }}">
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>
  </div>

@endsection
