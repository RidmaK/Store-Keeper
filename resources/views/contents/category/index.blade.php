@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        {{ __('CATEGORY') }}
                        <x-flash-message type="success" key="success" />
                        <x-flash-message type="error" key="error" />
                        <a href="{{route('category.create')}}" class="btn btn-primary float-end">
                            {{ __('Add New') }}
                        </a>
                    </div>

                    <div class="card-body">

                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th width="10%" class="text-center">ID</th>
                                    <th width="20%">Category Name</th>
                                    <th width="20%">Category Code</th>
                                    <th width="10%">Category Short Name</th>
                                    <th width="10%">Status</th>
                                    <th width="20%" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($categories) > 0)
                                    @foreach ($categories as $category)
                                    <tr>
                                        <th class="text-center" scope="row">{{$category->pro_mc_id}}</th>
                                        <td class="text-srart">{{$category->pro_mc_name}}</td>
                                        <td class="text-srart">{{$category->pro_mc_code}}</td>
                                        <td class="text-srart">{{$category->pro_mc_short_name}}</td>
                                        <td class="text-srart">
                                            @if ($category->status == 1)
                                            <span class="bg-green-300 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">ACTIVE</span>
                                            @else
                                            <span class="bg-red-300 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">INACTIVE</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm" role="group">
                                                    <a onclick="viewCategory(event,'{{$category->pro_mc_id}}')" class="btn btn-outline-primary">
                                                        {{ __('View') }}
                                                    </a>
                                                    <a href="{{route('category.edit', $category->pro_mc_id)}}" class="btn btn-outline-primary">
                                                        {{ __('Edit') }}
                                                    </a>
                                                    <a type="button" onclick="deleteCategory(event,'delete-form-{{$category->pro_mc_id}}')" class="btn btn-outline-danger">
                                                        {{ __('Delete') }}</a>
                                            </div>
                                            <form id="delete-form-{{$category->pro_mc_id}}" action="{{ route('category.destroy', $category->pro_mc_id) }}" method="POST" class="d-none">
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
                            {!! $categories->onEachSide(0)->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_rep_details" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row justify-content-center mb-2">
                        <div class="col-md-4">
                            <label for="pro_mc_id" class="form-label">ID</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="pro_mc_id" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center mb-2">
                        <div class="col-md-4">
                            <label for="pro_mc_name" class="form-label">Category Name</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="pro_mc_name" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center mb-2">
                        <div class="col-md-4">
                            <label for="pro_mc_code" class="form-label">Category Code</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="pro_mc_code" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row justify-content-center mb-2">
                        <div class="col-md-4">
                            <label for="pro_mc_short_name" class="form-label">Category Short Name</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="pro_mc_short_name" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <button type="button" data-bs-toggle="modal" id="launch_modal" data-bs-target="#modal_rep_details" class="d-none"></button>

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

    function viewCategory(event,id) {
        $.ajax({
            type: "GET",
            url:"{{ url('category-show',) }}"+"/"+id,
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function (response) {
                $('#pro_mc_id').val(response.pro_mc_id);
                $('#pro_mc_name').val(response.pro_mc_name);
                $('#pro_mc_code').val(response.pro_mc_code);
                $('#pro_mc_short_name').val(response.pro_mc_short_name);
                $('#launch_modal').click();
            }
        });
    }

</script>
@endsection
