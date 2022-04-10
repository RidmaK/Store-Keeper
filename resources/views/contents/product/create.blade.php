@extends('layouts.app')

@section('style')
{{-- <link rel="stylesheet" href="{{ assets('jquery-file-upload/styles.css') }}"> --}}
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        {{ __('Create Product') }}
                        <a href="{{route('product.index')}}" class="btn btn-primary float-end">
                            {{ __('Back to List') }}
                        </a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="flex flex-wrap mt-3">
                                <label for="pro_name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                    {{ __('Product Name') }}:
                                </label>

                                <input id="pro_name" type="text" class="form-input w-full @error('pro_name')  border-red-500 @enderror"
                                    name="pro_name" value="{{ old('pro_name') }}" required autocomplete="pro_name" autofocus>
                            </div>
                            <div class="flex flex-wrap mt-3">
                                <label for="pro_code" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                    {{ __('Product Code') }}:
                                </label>

                                <input id="pro_code" type="text" class="form-input w-full @error('pro_code')  border-red-500 @enderror"
                                    name="pro_code" value="{{ old('pro_code') }}" required autocomplete="pro_code" autofocus>
                            </div>
                            <div class="flex flex-wrap mt-3">
                                <label for="pro_short_name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                    {{ __('Product Short Name') }}:
                                </label>

                                <input id="pro_short_name" type="text" class="form-input w-full @error('pro_short_name')  border-red-500 @enderror"
                                    name="pro_short_name" value="{{ old('pro_short_name') }}" required autocomplete="pro_short_name" autofocus>
                            </div>
                            <div class="flex flex-wrap mt-3">
                                <label for="pro_description" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                    {{ __('Product Description') }}:
                                </label>
                                <textarea
                                    class="
                                      form-control
                                      block
                                      w-full
                                      px-3
                                      py-1.5
                                      text-base
                                      font-normal
                                      text-gray-700
                                      bg-white bg-clip-padding
                                      border border-solid border-gray-300
                                      rounded
                                      transition
                                      ease-in-out
                                      m-0
                                      focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
                                    "
                                    id="pro_description"
                                    name="pro_description"
                                    rows="3"
                                    placeholder="Description"
                                  ></textarea>
                            </div>
                            <div class="flex flex-wrap mt-3">
                                <label for="pro_mc_ids" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                    {{ __('Product Main Category') }}:
                                </label>

                                <select id='pro_mc_ids'  class="select2 form-control-sm" name='pro_mc_ids[]' onchange="loadSubCategory()" style="width: 100%" multiple required>
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
                                                    onclick="selectAllItems();"  value="all">
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
                                                    onclick="clearAllItems();" value="none">
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

                                <select id='pro_sc_ids'  class="select2 form-control-sm" name='pro_sc_ids[]' multiple style="width: 100%" required>
                                    <option value="">Select Sub Category</option>
                                    {{-- @foreach ($sub_categories as $sub_category)
                                    <option value="{{$sub_category->pro_sc_id}}">{{$sub_category->pro_sc_name}}
                                    </option>
                                    @endforeach --}}

                                  </select>
                            </div>
                            <div class="form-group mt-4 mb-4">
                                <!-- The fileinput-button span is used to style the file input field as button -->
                                <span class="btn btn-success fileinput-button">
                                <i class="glyphicon glyphicon-plus"></i>
                                <span>Select file...</span>
                                    <!-- The file input field used as target for the file upload widget -->
                                <input type="file"  name="images" multiple>
                            </span>
                                <div id="files" class="files"></div>
                                <input type="text" name="uploaded_file_name" id="uploaded_file_name" hidden>
                                <br>
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
{{-- <script src="{{ assets('jquery-file-upload/js/vendor/jquery.ui.widget.js') }}"></script>
<script src="{{ assets('jquery-file-upload/js/jquery.iframe-transport.js') }}"></script>
<script src="{{ assets('jquery-file-upload/js/jquery.fileupload.js') }}"></script> --}}
<script>
    $(document).ready(function() {
        $('#select_pro').prop('disabled', !$('#select_pro').prop('disabled'));

        // selectAllItems();

         $("#pro_mc_ids").select2({
                    closeOnSelect:false,
                    theme: "classic"
         });
         $("#pro_sc_ids").select2({
                    closeOnSelect:false,
                    theme: "classic"
         });

   });

   function selectAllItems(){
        $("#pro_mc_ids > option").prop("selected","selected");
        $("#pro_mc_ids").trigger("change");

    }
    function clearAllItems(){
            $("#pro_mc_ids > option").prop("selected",false);
            $("#pro_mc_ids").trigger("change");
            loadSubCategory();
    }

    function loadSubCategory(){
        var categories = $('#pro_mc_ids').val();
        $.ajax({
          method: "GET",
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          async: false,
          url:"{{ url('load-sub-category') }}",
          data: { id: categories },
          success: function (data) {
            $('#pro_sc_ids').empty();
            $('#pro_sc_ids').append('<option value="">Select Sub Category</option>');
                for(var i = 0; i < data.length; i++){
                    $('#pro_sc_ids').append('<option value="'+data[i].pro_mc_id+','+data[i].pro_sc_id+'">'+data[i].pro_sc_name+' ( '+data[i].pro_mc_name+' ) '+'</option>');
                }
          }
      })
    }

    var max_uploads = 5

    $(function () {
        'use strict';

        // Change this to the location of your server-side upload handler:
        var url = 'server/upload.php';
        $('#fileupload').fileupload({
            type: "GET",
            url:"{{ url('category-show',) }}",
            dataType: 'html',
            done: function (e, data) {

                if(data['result'] == 'FAILED'){
                    alert('Invalid File');
                }else{
                    $('#uploaded_file_name').val(data['result']);
                    $('#uploaded_images').append('<div class="uploaded_image"> <input type="text" value="'+data['result']+'" name="uploaded_image_name[]" id="uploaded_image_name" hidden> <img src="server/uploads/'+data['result']+'" /> <a href="#" class="img_rmv btn btn-danger"><i class="fa fa-times-circle" style="font-size:48px;color:red"></i></a> </div>');

                    if($('.uploaded_image').length >= max_uploads){
                        $('#select_file').hide();
                    }else{
                        $('#select_file').show();
                    }
                }

                $('#progress .progress-bar').css(
                    'width',
                    0 + '%'
                );

                $.each(data.result.files, function (index, file) {
                    $('<p/>').text(file.name).appendTo('#files');
                });

            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css(
                    'width',
                    progress + '%'
                );
            }
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
    });

    $( "#uploaded_images" ).on( "click", ".img_rmv", function() {
        $(this).parent().remove();
        if($('.uploaded_image').length >= max_uploads){
            $('#select_file').hide();
        }else{
            $('#select_file').show();
        }
    });
</script>
@endsection

