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
                <input type="hidden" name="customer_id" id="customer_id" value="{{ request()->id }}">
                <div class="input-group input-group-outline my-3 is-filled">
                <label class="form-label">Item Name</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name }}">
                </div>
                <div class="input-group input-group-outline my-3 is-filled">
                <label class="form-label">Description</label>
                <textarea type="text" name="description" class="form-control" value="{{ $product->description }}"></textarea>
                </div>
                <div class="input-group input-group-outline my-3 is-filled">
                <label class="form-label">Item Category</label>
                <input type="text" name="category" class="form-control" value="{{ $product->category }}">
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
                {{-- <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">ADD</button> --}}
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
    $( document ).ready(function() {

        const userRole = '<?php echo json_encode($userRole) ?? '[]' ?>';

        var arrUserRole = $.parseJSON(userRole); //convert to javascript array
        console.log()
        var splasrolesArray = new Array();
        for (i = 0; i < arrUserRole.length; ++i) {
            splasrolesArray.push(arrUserRole[i]);
        }
        $('select[name="roles[]"]').val(splasrolesArray).change();
    });
  </script>

@endsection
