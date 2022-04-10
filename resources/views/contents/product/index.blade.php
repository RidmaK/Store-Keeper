@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        {{ __('PRODUCTS') }}
                        <x-flash-message type="success" key="success" />
                        <x-flash-message type="error" key="error" />
                        <a href="{{route('product.create')}}" class="btn btn-primary float-end">
                            {{ __('Add New') }}
                        </a>
                    </div>

                    <div class="card-body">

                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th width="10%" class="text-center">ID</th>
                                    <th width="20%">Product Name</th>
                                    <th width="20%">Product Code</th>
                                    <th width="10%">Product Short Name</th>
                                    <th width="10%">Status</th>
                                    <th width="20%" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($products) > 0)
                                    @foreach ($products as $product)
                                    <tr>
                                        <th class="text-center" scope="row">{{$product->pro_id}}</th>
                                        <td class="text-srart">{{$product->pro_name}}</td>
                                        <td class="text-srart">{{$product->pro_code}}</td>
                                        <td class="text-srart">{{$product->pro_short_name}}</td>
                                        <td class="text-srart">
                                            @if ($product->status == 1)
                                            <span class="bg-green-300 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">ACTIVE</span>
                                            @else
                                            <span class="bg-red-300 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">INACTIVE</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{url('display-product', $product->pro_id)}}" class="btn btn-outline-primary">
                                                        {{ __('View') }}
                                                    </a>
                                                    <a href="{{route('product.edit', $product->pro_id)}}" class="btn btn-outline-primary">
                                                        {{ __('Edit') }}
                                                    </a>
                                                    <a type="button" onclick="deleteCategory(event,'delete-form-{{$product->pro_id}}')" class="btn btn-outline-danger">
                                                        {{ __('Delete') }}
                                                    </a>
                                            </div>
                                            <form id="delete-form-{{$product->pro_id}}" action="{{ route('product.destroy', $product->pro_id) }}" method="POST" class="d-none">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-danger text-center">No records found</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <div class="mt-4 d-flex justify-content-end">
                            {!! $products->onEachSide(0)->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<Script>
    function deleteCategory(event,form_id) {
        event.preventDefault();
        $.confirm({
        title: 'Confirm?',
            content: 'Are you sure you want to delete this record?',
            type: 'blue',
            buttons: {
                Okey: {
                    text: 'confirm',
                    btnClass: 'btn-blue',
                    action: function () {
                        $(`#${form_id}`).submit();
                    }
                },
                cancel: {
                    text: 'cancel',
                    btnClass: 'btn-red',
                    action: function () {

                    }
                }
            }
        });
    }

</script>
@endsection
