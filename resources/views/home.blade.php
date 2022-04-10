@extends('layouts.app')

@section('content')
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full sm:px-6">

        @if (session('status'))
            <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">
            <div class="w-full px-4 py-4">
                <div class="container px-4">
                    <div class="row gx-5">

                      <div class="col row mt-4 mb-4">
                        <label for="pro_mc_id" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                            {{ __('Main Categories') }}:
                        </label>
                        @foreach($categories as $category)
                        <div class="col-md-4">
                                <div class="vs-checkbox-con vs-checkbox-primary">

                                    <input type="checkbox" style="align:left;"  name="check_[]" id="check_{{$category->pro_mc_id}}"
                                    onclick="serchByCategories({{$category->pro_mc_id}});">
                                    <input type="hidden" id="category_id">
                                    <span class="vs-checkbox">
                                    <span class="vs-checkbox--check">
                                        <i class="vs-icon feather icon-check"></i>
                                    </span>
                                    </span>
                                    <span class=" mr-auto" >{{$category->pro_mc_name}}</span>
                                </div>
                            </div>

                      @endforeach
                      </div>
                      <div class="col">
                        <div class="flex flex-wrap mt-3 mb-3">
                            <label for="pro_sc_ids" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                {{ __('Sub Category') }}:
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
                      </div>
                    </div>
                  </div>
                <div class="input-group stylish-input-group">
                    <input type="text" id="txtSearch" name="txtSearch" class="form-control"  placeholder="Search..." onkeyup="search()">
                    <span class="input-group-addon">
                        <button type="submit">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
                <div id="result">
                    <div class="row">
                    @if (count($productCategories) > 0)
                    @foreach ($productCategories as $product)
                    <div class="col-md-4 mt-4 mb-4">
                            <div class="rounded overflow-hidden shadow-lg">
                                <img class="w-full" src="{{public_path('/'.$product[0]->url)}}" />

                              <div class="px-6 py-4">
                                <div class="font-bold text-xl mb-2">{{ $product[0]->pro_name }}</div>
                                <p class="text-gray-700 text-base">
                                    {{ $product[0]->pro_description }}
                                </p>
                                <div class="flex item-center mt-2">
                                    <svg class="w-5 h-5 fill-current text-gray-700" viewBox="0 0 24 24">
                                      <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z"/>
                                    </svg>
                                    <svg class="w-5 h-5 fill-current text-gray-700" viewBox="0 0 24 24">
                                      <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z"/>
                                    </svg>
                                    <svg class="w-5 h-5 fill-current text-gray-700" viewBox="0 0 24 24">
                                      <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z"/>
                                    </svg>
                                    <svg class="w-5 h-5 fill-current text-gray-500" viewBox="0 0 24 24">
                                      <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z"/>
                                    </svg>
                                    <svg class="w-5 h-5 fill-current text-gray-500" viewBox="0 0 24 24">
                                      <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z"/>
                                    </svg>
                                  </div>
                                  <div class="flex item-center justify-between mt-3">
                                    <h1 class="text-gray-700 font-bold text-xl">${{ $product[0]->price }}</h1>
                                    <a href="{{url('display-product', $product[0]->pro_id)}}" class="px-3 py-2 bg-gray-800 text-white text-xs font-bold uppercase rounded"> {{ __('View') }}</a>
                                  </div>
                              </div>
                            </div>
                        </div>
                    @endforeach
                    @endif
                </div>
            </div>
            </div>
        </section>
    </div>
</main>
@endsection
@section('scripts')
<script type="application/javascript">
    $(document).ready(function(){
        $("#pro_sc_ids").select2({
                    closeOnSelect:false,
                    theme: "classic"
         });
    });

    function search(){
        var text = $('#txtSearch').val();
        var category_id = $('#category_id').val();
        console.log(category_id);
        console.log("category_id");
            $.ajax({

                type:"GET",
                url: '/product-search',
                data: {text: $('#txtSearch').val(),category_id:category_id},
                success: function(data) {
                    var x=1;
                    console.log(data);
                    var items = `<div class="row">`
                    $.each(data, function (index, item) {
                    //    items += "<option value=" + item.id + ">" + item.label + "</option>";
                       items += `
                       <div class="col-md-4  mt-4 mb-4">
                    <div class="rounded overflow-hidden shadow-sm">
                        <img class="w-full" src="storage/${item[0].url}" />                      <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">${item[0].pro_name}</div>
                        <p class="text-gray-700 text-base">
                            ${item[0].pro_description}
                        </p>
                        <div class="flex item-center mt-2">
                            <svg class="w-5 h-5 fill-current text-gray-700" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z"/>
                            </svg>
                            <svg class="w-5 h-5 fill-current text-gray-700" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z"/>
                            </svg>
                            <svg class="w-5 h-5 fill-current text-gray-700" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z"/>
                            </svg>
                            <svg class="w-5 h-5 fill-current text-gray-500" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z"/>
                            </svg>
                            <svg class="w-5 h-5 fill-current text-gray-500" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z"/>
                            </svg>
                            </div>
                            <div class="flex item-center justify-between mt-3">
                                <h1 class="text-gray-700 font-bold text-xl">$${item[0].price}</h1>
                            <a href="/display-product/${item[0].pro_id}" class="px-3 py-2 bg-gray-800 text-white text-xs font-bold uppercase rounded"> {{ __('View') }}</a>
                            </div>
                      </div>

                  </div>
                </div>`;
                     x++;
                   });
                   items +=`</div>`;
                   $('#result').empty();
                   $('#result').append(items);
                 }
            });
    }
    function selectAllScItems(){
        $("#pro_sc_ids > option").prop("selected","selected");
        $("#pro_sc_ids").trigger("change");

    }
    function clearAllScItems(){
            $("#pro_sc_ids > option").prop("selected",false);
            $("#pro_sc_ids").trigger("change");
    }
    const category_ids =[];
    function serchByCategories($id){
        var checkedValue = document.getElementById('check_' + $id).checked;
        console.log(checkedValue);

        if (checkedValue === true) {

            category_ids.push($id);
            $('#category_id').val(category_ids);
                search();
        }else{
            $('#category_id').val('');
            search();
        }
    }
    </script>
@endsection
