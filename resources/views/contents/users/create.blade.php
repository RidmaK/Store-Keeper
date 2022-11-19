@extends('dashboard.dashboard')

@section('mainContent')
<div class="container-fluid py-4">
    <div class="row"><div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">weekend</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">User</p>
            <h4 class="mb-0">ADD</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
            <form  class="text-start" method="POST" action="{{ route('user.store') }}">
                @csrf
                <div class="input-group input-group-outline my-3 is-filled">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control">
                </div>
                <div class="input-group input-group-outline my-3 is-filled">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control">
                </div>
                <div class="input-group input-group-outline my-3 is-filled">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control">
                </div>
                <div class="input-group input-group-outline my-3 is-filled">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control">
                </div>
                <div class="input-group input-group-outline my-3 is-filled">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="confirm-password" class="form-control">
                </div>
                <div class="input-group input-group-outline my-3 is-filled">
                <select class="form-control input-group input-group-outline my-3 is-filled js-example-basic-single" placeholder="Select User Groups" required name="roles[]" id="roles" multiple>
                    @foreach ($roles as $key =>$role)
                        <option value="{{ $key }}">{{ $role }}</option>
                    @endforeach
                </select>
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

@endsection
