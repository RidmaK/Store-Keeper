@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        {{ __('Create Sub Category') }}
                        <a href="{{route('sub_category.index')}}" class="btn btn-primary float-end">
                            {{ __('Back to List') }}
                        </a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('sub_category.store') }}" method="POST">
                            @csrf
                            <div class="flex flex-wrap mt-3">
                                <label for="pro_sc_name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                    {{ __('Sub Category Name') }}:
                                </label>

                                <input id="pro_sc_name" type="text" class="form-input w-full @error('pro_sc_name')  border-red-500 @enderror"
                                    name="pro_sc_name" value="{{ old('pro_sc_name') }}" required autocomplete="pro_sc_name" autofocus>

                                @error('pro_sc_name')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="flex flex-wrap mt-3">
                                <label for="pro_sc_code" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                    {{ __('Sub Category Code') }}:
                                </label>

                                <input id="pro_sc_code" type="text" class="form-input w-full @error('pro_sc_code')  border-red-500 @enderror"
                                    name="pro_sc_code" value="{{ old('pro_sc_code') }}" required autocomplete="pro_sc_code" autofocus>

                                @error('pro_sc_code')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="flex flex-wrap mt-3">
                                <label for="pro_sc_short_name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                    {{ __('Sub Category Short Name') }}:
                                </label>

                                <input id="pro_sc_short_name" type="text" class="form-input w-full @error('pro_sc_short_name')  border-red-500 @enderror"
                                    name="pro_sc_short_name" value="{{ old('pro_sc_short_name') }}" required autocomplete="pro_sc_short_name" autofocus>

                                @error('pro_sc_short_name')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                                @enderror
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
