@extends('layouts.app')

@section('style')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                    <!--Card 1-->
                    <div class="flex flex-wrap mt-3">
                        <a href="{{route('product.index')}}" class="btn btn-primary float-end">
                            {{ __('Back to List') }}
                        </a>
                    </div>
                    @if (count($product) > 0)
                    <div class="rounded overflow-hidden shadow-lg  mt-3 mb-3">
                        <img class="w-full" src="https://www.focusmedicaleyecentre.co.uk/wp-content/uploads/2019/10/maui-jim-2.jpg" alt="Mountain">

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
                      </div>

                      <div class="px-6 pt-4 pb-2">
                          @foreach ($productCategory as $productCate)
                          <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#{{ $productCate->pro_sc_name.' ( '.$productCate->pro_mc_name.' ) ' }}</span>
                          @endforeach
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
