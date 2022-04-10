@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        {{ __('Create Category') }}
                        <a href="{{route('category.index')}}" class="btn btn-primary float-end">
                            {{ __('Back to List') }}
                        </a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('category.store') }}" method="POST">
                            @csrf
                            <div class="flex flex-wrap mt-3">
                                <label for="pro_mc_name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                    {{ __('Category Name') }}:
                                </label>

                                <input id="pro_mc_name" type="text" class="form-input w-full @error('pro_mc_name')  border-red-500 @enderror"
                                    name="pro_mc_name" value="{{ old('pro_mc_name') }}" required autocomplete="pro_mc_name" autofocus>

                                @error('pro_mc_name')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="flex flex-wrap mt-3">
                                <label for="pro_mc_code" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                    {{ __('Category Code') }}:
                                </label>

                                <input id="pro_mc_code" type="text" class="form-input w-full @error('pro_mc_code')  border-red-500 @enderror"
                                    name="pro_mc_code" value="{{ old('pro_mc_code') }}" required autocomplete="pro_mc_code" autofocus>

                                @error('pro_mc_code')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>
                            <div class="flex flex-wrap mt-3">
                                <label for="pro_mc_short_name" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                    {{ __('Category Short Name') }}:
                                </label>

                                <input id="pro_mc_short_name" type="text" class="form-input w-full @error('pro_mc_short_name')  border-red-500 @enderror"
                                    name="pro_mc_short_name" value="{{ old('pro_mc_short_name') }}" required autocomplete="pro_mc_short_name" autofocus>

                                @error('pro_mc_short_name')
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
