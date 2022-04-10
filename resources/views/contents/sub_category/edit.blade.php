@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        {{ __('Edit Sub Category ' ) }}
                        <span class="bg-blue-300 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-900">{{ $sub_category->pro_sc_name }}</span>

                        <a href="{{route('sub_category.index')}}" class="btn btn-primary float-end">
                            {{ __('Back to List') }}
                        </a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('sub_category.update',$sub_category->pro_sc_id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="id" value="{{ $sub_category->pro_sc_id }}">
                            <div class="flex flex-wrap mt-3">
                                <label for="pro_sc_name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                    {{ __('Sub Category Name') }}:
                                </label>

                                <input id="pro_sc_name" type="text" class="form-input w-full @error('pro_sc_name')  border-red-500 @enderror"
                                    name="pro_sc_name" value="{{ $sub_category->pro_sc_name }}" required autocomplete="pro_sc_name" autofocus>
                            </div>
                            <div class="flex flex-wrap mt-3">
                                <label for="pro_sc_code" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                    {{ __('Sub Category Code') }}:
                                </label>

                                <input id="pro_sc_code" type="text" class="form-input w-full @error('pro_sc_code')  border-red-500 @enderror"
                                    name="pro_sc_code" value="{{ $sub_category->pro_sc_code }}" required autocomplete="pro_sc_code" autofocus>
                            </div>
                            <div class="flex flex-wrap mt-3">
                                <label for="pro_sc_short_name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                    {{ __('Sub Category Short Name') }}:
                                </label>

                                <input id="pro_sc_short_name" type="text" class="form-input w-full @error('pro_sc_short_name')  border-red-500 @enderror"
                                    name="pro_sc_short_name" value="{{ $sub_category->pro_sc_short_name }}" required autocomplete="pro_sc_short_name" autofocus>
                            </div>
                            <div class="flex flex-wrap mt-3">
                                <label for="status" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                    {{ __('Status') }}:
                                </label>

                                <select id='status'  class="select2 form-control-sm" name='status' style="width: 100%" required>
                                    <option value="1">ACTIVE</option>
                                    <option value="0">INACTIVE</option>

                                  </select>
                            </div>
                            <div class="flex flex-wrap mt-3 mt-3 mb-3">
                                <button type="submit"
                                    class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700 sm:py-4">
                                    {{ __('UPDATE') }}
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
         $("#status").select2({
                    closeOnSelect:true,
                    theme: "classic"
         });

   });
    </script>
@endsection
