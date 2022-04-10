@extends('layouts.app')

@section('style')
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        {{ __('Category Allocation') }}
                        <a href="{{route('category_allocation.index')}}" class="btn btn-primary float-end">
                            {{ __('Back to List') }}
                        </a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('category_allocation.store') }}" method="POST">
                            @csrf
                            <div class="flex flex-wrap mt-3">
                                <label for="pro_mc_ids" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                    {{ __('Product Main Category') }}:
                                </label>

                                <select id='pro_mc_ids'  class="select2 form-control-sm" name='pro_mc_ids[]' style="width: 100%" multiple required>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->pro_mc_id}}">{{$category->pro_mc_name}}
                                    </option>
                                    @endforeach

                                  </select>
                                  <ul class="list-unstyled mb-0 mt-3">
                                    <li class="d-inline-block mr-2">
                                        <fieldset>
                                            <div class="vs-radio-con">
                                                <input type="radio" name="show_type"
                                                    onclick="selectAllMcItems();"  value="all">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="">All</span>
                                            </div>
                                        </fieldset>
                                    </li>
                                    <li class="d-inline-block mr-2">
                                        <fieldset>
                                            <div class="vs-radio-con">
                                                <input type="radio" name="show_type"
                                                    onclick="clearAllMcItems();" value="none">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="">None</span>
                                            </div>
                                        </fieldset>
                                    </li>
                                </ul>
                            </div>
                            <div class="flex flex-wrap mt-3">
                                <label for="pro_sc_ids" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                    {{ __('Product Sub Category') }}:
                                </label>

                                <select id='pro_sc_ids'  class="select2 form-control-sm" name='pro_sc_ids[]' style="width: 100%" multiple required>
                                    @foreach ($sub_categories as $sub_category)
                                    <option value="{{$sub_category->pro_sc_id}}">{{$sub_category->pro_sc_name}}
                                    </option>
                                    @endforeach

                                  </select>
                                  <ul class="list-unstyled mb-0 mt-3">
                                    <li class="d-inline-block mr-2">
                                        <fieldset>
                                            <div class="vs-radio-con">
                                                <input type="radio" name="show_type"
                                                    onclick="selectAllScItems();"  value="all">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="">All</span>
                                            </div>
                                        </fieldset>
                                    </li>
                                    <li class="d-inline-block mr-2">
                                        <fieldset>
                                            <div class="vs-radio-con">
                                                <input type="radio" name="show_type"
                                                    onclick="clearAllScItems();" value="none">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="">None</span>
                                            </div>
                                        </fieldset>
                                    </li>
                                </ul>
                            </div>
                            <div class="flex flex-wrap mt-3 mt-3 mb-3">
                                <button type="submit"
                                    class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700 sm:py-4">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {

         $("#pro_mc_ids").select2({
                    closeOnSelect:false,
                    theme: "classic"
         });
         $("#pro_sc_ids").select2({
                    closeOnSelect:false,
                    theme: "classic"
         });

   });

   function selectAllMcItems(){
        $("#pro_mc_ids > option").prop("selected","selected");
        $("#pro_mc_ids").trigger("change");

    }
    function clearAllMcItems(){
            $("#pro_mc_ids > option").prop("selected",false);
            $("#pro_mc_ids").trigger("change");
    }
   function selectAllScItems(){
        $("#pro_sc_ids > option").prop("selected","selected");
        $("#pro_sc_ids").trigger("change");

    }
    function clearAllScItems(){
            $("#pro_sc_ids > option").prop("selected",false);
            $("#pro_sc_ids").trigger("change");
    }

</script>
@endsection

