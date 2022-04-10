@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        {{ __('Price Allocation') }}
                        <a href="{{route('price_allocation.index')}}" class="btn btn-primary float-end">
                            {{ __('Back to List') }}
                        </a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('price_allocation.store') }}" method="POST">
                            @csrf

                            <div class="flex flex-wrap mt-3">
                                <label for="pro_id" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                    {{ __('Product') }}:
                                </label>

                                <select id='pro_id'  class="select2 form-control-sm" name='pro_id'  style="width: 100%" required>
                                    <option value="">Select Product</option>
                                    @foreach ($products as $product)
                                    <option value="{{$product->pro_id}}">{{$product->pro_name}}
                                    </option>
                                    @endforeach

                                  </select>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group text-center">
                                    <table class="table table-striped table-bordered first">
                                        <thead class="thead-custom">
                                            <tr>
                                                <th style="text-align: center">&nbsp</th>
                                                <th style="text-align: center">PRICE CODE</th>
                                                <th style="text-align: center">PRICE</th>
                                                <th style="text-align: center">END DATE</th>
                                                <th style="text-align: center">&nbsp</th>
                                            </tr>
                                        </thead>
                                        <tbody id="price">
                                            <tr id="tr_1">
                                                <td style="text-align: center">
                                                    <span class="text-green-600" style="cursor: pointer; font-size:18px" onclick="gen_item();">
                                                        <i class="bi bi-plus-square-fill" ></i>
                                                    </span>
                                                </td>
                                                <td>
                                                    <input type="text" id="price_code_1" name="price_code_1" class="col-md-12 form-control form-control-sm" autocomplete="off" required />
                                                </td>
                                                <td>
                                                    <input type="text" id="price_1" name="price_1" class="col-md-12 form-control form-control-sm" autocomplete="off" required />
                                                </td>
                                                <td>
                                                    <input type="date" id="date_to_1" name="date_to_1" class="col-md-12 form-control form-control-sm" autocomplete="off" required />
                                                </td>
                                                <td style="text-align: center">
                                                    <span class="text-red-600" style="cursor: pointer; font-size:18px" onclick="remove_item('1');">
                                                        <i class="bi bi-x-square-fill"></i>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <input type="hidden" id="item_count" name="item_count" value="1" />
                                        <input type="hidden" id="delete_item_count" name="delete_item_count" value="1" />
                                    </table>
                                </div>
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
            $("#pro_id").select2({
                        closeOnSelect:true,
                        theme: "classic"
            });

        });

         /* GENERATE NEW ROW */
    function gen_item(){
        var num = parseFloat($('#item_count').val()) + 1;
        $('#item_count').val(num);
        var delete_count = parseFloat($('#delete_item_count').val()) + 1;
        $('#delete_item_count').val(delete_count);
        $('#price').append('<tr class="even pointer" id="tr_' + num + '">'
                + '<td style="text-align: center">'
                    + '<span class="text-green-600" style="cursor: pointer; font-size:18px" onclick="gen_item();">'
                    +     '<i class="bi bi-plus-square-fill"></i>'
                    + '</span>'
                + '</td>'
                + '<td>'
                    +'<input type="text" id="price_code_' + num + '" name="price_code_' + num + '" class="col-md-12 form-control form-control-sm" autocomplete="off" required />'
                + '</td>'
                + '<td>'
                    +'<input type="text" id="price_' + num + '" name="price_' + num + '" class="col-md-12 form-control form-control-sm" autocomplete="off" required />'
                + '</td>'
                + '<td>'
                    +'<input type="date" id="date_to_' + num + '" name="date_to_' + num + '" class="col-md-12 form-control form-control-sm" autocomplete="off" required />'
                + '</td>'
                + '<td style="text-align: center">'
                    + '<span class="text-red-600" style="cursor: pointer; font-size:18px" onclick="remove_item('+ num +');">'
                    +    '<i class="bi bi-x-square-fill"></i>'
                    + '</span>'
                + '</td>'
                + '</tr>');
    }

    /*REMOVE GENERATED ROW*/
    function remove_item(num) {
        $('#tr_' + num).remove();
        var num = parseFloat($('#delete_item_count').val()) - 1;
        $('#delete_item_count').val(num);
        if (num == 0) {
            gen_item();
        }
    }
    </script>
@endsection
