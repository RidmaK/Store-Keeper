@extends('dashboard.dashboard')

@section('mainContent')
<div class="container-fluid py-4">
<div class="row">
    <div class="card">
        <div class="card-body px-0 pb-2">
            <div class="table-responsive">
                <a href="{{route('product.create')}}" class="btn btn-primary float-end" style="margin-right: 27px;">
                    {{ __('Add New') }}
                </a>
                <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Companies</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Members</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Budget</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Completion</th>
                    </tr>
                </thead>
                </table>
            </div>
        </div>
    </div>
</div>
  </div>
@endsection
