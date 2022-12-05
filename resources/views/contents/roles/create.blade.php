@extends('dashboard.index')

@section('mainContent')
<div class="container-fluid py-4">
    <div class="row"><div class="card">
        <div class="card-header p-3 pt-2">
          <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
            <i class="material-icons opacity-10">weekend</i>
          </div>
          <div class="text-end pt-1">
            <p class="text-sm mb-0 text-capitalize">User Group</p>
            <h4 class="mb-0">ADD</h4>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-3">
            <form  class="text-start" method="POST" action="{{ route('user-group.store') }}">
                @csrf
                <div>
                    {{-- Start Form grop  --}}
                    <div class="input-group input-group-outline my-3 is-filled">
                        <label class="form-label">Name</label>
                        <input type="text" name="display_name" class="form-control">
                    </div>
                    {{-- End Form grop  --}}


                    {{-- Start Form grop  --}}
                    <?php $permission = $errors->has('permission') ? 'has-error' : ''; ?>
                    <div class="col-12 {{$permission}}" req>
                        @slot('label')
                            Permissions
                        @endslot
                        @if ($errors->has('permission'))
                            <input type="hidden" id="permission_errors" value="1">
                            @slot('error')
                            {{ $errors->first('permission') }}
                            @endslot

                        @endif


                        <div class="permission-wrapper show">
                            <div class="permission-header">
                                <div class="column">
                                    <span class="text">Title</span>
                                </div>
                                <div class="column">
                                    <span class="text">View</span>
                                </div>
                                <div class="column">
                                    <span class="text">Create</span>
                                </div>
                                <div class="column">
                                    <span class="text">Edit</span>
                                </div>
                                <div class="column">
                                    <span class="text">Delete</span>
                                </div>
                            </div>
                            <div class="permission-body">


                                @foreach($formattedPermission as $subPermission)
                                <div class="column-group">

                                    <div class="title">
                                        {{$subPermission['main_group']}}
                                    </div>

                                    <div class="group-rows">
                                        {{--sub elements--}}
                                        @foreach($subPermission['sub_elements'] as $subEle)
                                        <div class="sub-group @if($subEle['title']) hasSub @endif">
                                            @if($subEle['title'])
                                            <div class="title">
                                                {{$subEle['title']}}
                                            </div>
                                            @endif
                                        @foreach($subEle['subGroups'] as $subGroup)
                                        <div class="p-row">
                                            @if($subGroup['HasParent'])
                                            @php
                                            $paddingClass = 'leftAlign';

                                            @endphp

                                            @else
                                            @php
                                            $paddingClass = '';
                                            @endphp
                                            @endif
                                            <div class="column {{$paddingClass}}">
                                                {{$subGroup['subGroupName']}}
                                            </div>


                                            @if(checkPermission($subGroup['subGroupPermissions'],'list'))
                                            @php
                                            $permissionKey = array_search('list', array_column($subGroup['subGroupPermissions'], 'key'));


                                            $id = $subGroup['subGroupPermissions'][$permissionKey]['id'];

                                            $disabled = '';
                                            @endphp
                                            @else
                                            @php

                                            $disabled = 'disabled';
                                            $id = '';
                                            @endphp
                                            @endif
                                            <div class="column list col-checkbox {{$disabled}}">
                                                <span class="check"></span>
                                                <div class="custom-control custom-checkbox permission-child">
                                                    <input class="custom-control-input" name="permission[]" type="checkbox" value="{{$id}}"
                                                        {{$disabled}}>
                                                </div>
                                            </div>

                                            @if(checkPermission($subGroup['subGroupPermissions'],'create'))

                                            @php

                                            $permissionKey = array_search('create', array_column($subGroup['subGroupPermissions'], 'key'));

                                            $id = $subGroup['subGroupPermissions'][$permissionKey]['id'];

                                            $disabled = '';
                                            @endphp
                                            @else
                                            @php

                                            $disabled = 'disabled';
                                            $id = '';
                                            @endphp
                                            @endif
                                            <div class="column list col-checkbox {{$disabled}}">
                                                <span class="check active"></span>
                                                <div class="custom-control custom-checkbox permission-child">
                                                    <input class="custom-control-input" name="permission[]" type="checkbox" value="{{$id}}"
                                                        {{$disabled}}>
                                                </div>
                                            </div>

                                            @if(checkPermission($subGroup['subGroupPermissions'],'edit'))
                                            @php
                                            $permissionKey = array_search('edit', array_column($subGroup['subGroupPermissions'], 'key'));


                                            $id = $subGroup['subGroupPermissions'][$permissionKey]['id'];

                                            $disabled = '';
                                            @endphp
                                            @else
                                            @php

                                            $disabled = 'disabled';
                                            $id = '';
                                            @endphp
                                            @endif
                                            <div class="column list col-checkbox {{$disabled}}">
                                                <span class="check active"></span>
                                                <div class="custom-control custom-checkbox permission-child">
                                                    <input class="custom-control-input" name="permission[]" type="checkbox" value="{{$id}}"
                                                        {{$disabled}}>
                                                </div>
                                            </div>


                                            @if(checkPermission($subGroup['subGroupPermissions'],'delete'))
                                            @php
                                            $permissionKey = array_search('delete', array_column($subGroup['subGroupPermissions'], 'key'));


                                            $id = $subGroup['subGroupPermissions'][$permissionKey]['id'];

                                            $disabled = '';
                                            @endphp
                                            @else
                                            @php

                                            $disabled = 'disabled';
                                            $id = '';
                                            @endphp
                                            @endif
                                            <div class="column list col-checkbox {{$disabled}}">
                                                <span class="check active"></span>
                                                <div class="custom-control custom-checkbox permission-child">
                                                    <input class="custom-control-input" name="permission[]" type="checkbox" value="{{$id}}"
                                                        {{$disabled}}>
                                                </div>
                                            </div>

                                        </div>
                                        @endforeach
                                        </div>
                                        @endforeach
                                        {{--end sub elements--}}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                    {{-- End Form grop  --}}

                    <div class="text-center">
                        <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Submit</button>
                    </div>

                </div>
            </form>
        </div>
      </div>
    </div>
    </div>
  </div>
@endsection
@section('scripts')

<script type="text/javascript">
    $(function () {
            // Chaeckbox
            $('.col-checkbox .check').each(function(){
                var $parent = $(this).parent();

                if($parent.hasClass('disabled')) {
                    return;
                }

                var isCheck = $parent.find('.custom-checkbox input[type="checkbox"]').is(":checked");
                isCheck === true ? $(this).addClass('active') : $(this).removeClass('active')

                $(this).on('click',function(){
                    var $this = $(this);

                    if($this.parent().hasClass('disabled')) {
                        return;
                    }

                    $this.toggleClass('active');
                    var $checkbox = $this.parent().find('.custom-checkbox input[type="checkbox"]');

                    var isCheck  = $checkbox.is(':checked');
                    $checkbox.prop('checked',!isCheck);
                })
            });
        })
</script>
@endsection


<style>

.permission-wrapper {
  display: flex;
  flex: 0 0 100%;
  flex-direction: column;
}
.permission-wrapper .permission-header {
  display: flex;
  align-items: center;
  border-bottom: 1px solid #ddd;
}
.permission-wrapper .permission-body {
  display: flex;
  flex-direction: column;
}
.permission-wrapper .permission-body .p-row {
  display: flex;
  align-items: center;
  transition: all ease-in-out 0.3s;
}
.permission-wrapper .permission-body .p-row:hover {
  background-color: rgba(237, 238, 239, 0.75);
  border-radius: 4px;
}
.permission-wrapper .permission-body .check {
  min-width: 18px;
  width: 18px;
  height: 18px;
  border-radius: 3px;
  background-color: #ccd9ff;
  overflow: hidden;
}
.permission-wrapper .permission-body .check::after {
  content: "";
  display: inline-block;
  border: 1px solid #C5CEE0;
  display: inline-block;
  width: 20px;
  height: 20px;
  background-color: transparent;
  background-size: contain;
  background-position: center;
  background-repeat: no-repeat;
  width: 100%;
  height: 100%;
  background-size: 8px;
  background-position: center;
}
.permission-wrapper .permission-body .check.active {
  background-color: #3366FF;
}
.permission-wrapper .permission-body .check.active::after {
  content: "";
  display: inline-block;
  background-size: 10px;
  background-image: url(icons/role/checked.svg);
  border-color: #3366FF;
}
.permission-wrapper .permission-body .column.disabled {
  align-items: center;
}
.permission-wrapper .permission-body .column.disabled .check {
  background-color: transparent;
  cursor: auto;
  width: auto;
}
.permission-wrapper .permission-body .column.disabled .check::after {
  content: "";
  display: inline-block;
  background-image: none;
  content: "N/A";
  color: rgba(34, 43, 69, 0.35);
  border-color: transparent;
}
.permission-wrapper .column-group {
  margin-top: 15px;
}
.permission-wrapper .column-group .title {
  font-size: 14px;
  font-weight: 700 !important;
  padding-top: 10px;
  margin-bottom: 5px;
  padding-left: 10px;
}
@media (max-width: 990.98px) {
  .permission-wrapper .column-group .title {
    font-size: 14px;
  }
}
.permission-wrapper .column-group .title + .group-rows .p-row .column {
  padding: 8px 10px;
  font-weight: 400 !important;
}
.permission-wrapper .column-group .title + .group-rows .p-row .column.leftAlign:first-child {
  padding-left: 35px;
  color: rgba(34, 43, 69, 0.48);
}
.permission-wrapper .column-group .title + .group-rows .p-row .column:first-child {
  padding-left: 20px;
}
.permission-wrapper .column-group .title + .group-rows .p-row .column .text {
  font-weight: 400 !important;
}
.permission-wrapper .column-group .sub-group.hasSub .title {
  padding-left: 20px;
}
.permission-wrapper .column-group .sub-group.hasSub .p-row .column.leftAlign:first-child {
  padding-left: 45px;
}
.permission-wrapper .column-group .sub-group.hasSub .p-row .column:first-child {
  padding-left: 35px;
}
.permission-wrapper .column {
  display: flex;
  flex: 15%;
  max-width: 15%;
  padding: 10px;
  font-size: 14px;
  transition: all ease-in-out 0.3s;
}
@media (max-width: 990.98px) {
  .permission-wrapper .column {
    font-size: 14px;
  }
}
.permission-wrapper .column .text,
.permission-wrapper .column .custom-control-label {
  color: #445689;
  text-transform: uppercase;
  font-size: 11px;
}
@media (max-width: 990.98px) {
  .permission-wrapper .column .text,
.permission-wrapper .column .custom-control-label {
    font-size: 11px;
  }
}
.permission-wrapper .column:first-child {
  flex: 55%;
  max-width: 55%;
  padding-left: 10px;
  font-size: 13;
  font-weight: 600;
}
.permission-wrapper .column.col-checkbox .check {
  cursor: pointer;
}
.permission-wrapper .column.col-checkbox .custom-checkbox {
  width: 0;
  height: 0;
  min-width: 0;
  padding: 0;
}
.permission-wrapper .column.col-checkbox .custom-checkbox input[type=checkbox] {
  width: 0;
  height: 0;
}
.permission-wrapper.show .column {
  justify-content: center;
}
.permission-wrapper.show .column:first-child {
  justify-content: flex-start;
}
</style>
