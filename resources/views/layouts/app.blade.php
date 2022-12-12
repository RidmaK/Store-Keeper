<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8" />
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Canmo</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <script src="https://unpkg.com/sweetalert2@7.19.3/dist/sweetalert2.all.js"></script>
  @yield('styles')
  <style>
    .test {
    width: 60%;
    display: inline;
    overflow: auto;
    white-space: nowrap;
    margin: 0px auto;
    }
  </style>
</head>
@yield('content')

<!--   Core JS Files   -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- jquery-validation -->
<script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/js/adminlte.js') }}"></script>
@yield('scripts')
<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/js/demo.js') }}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

function appDataTable(el, option, sortColums = null) {

    if (sortColums == null) {
        sortColums = [];
    }

    var defOpt = {
        // "bLengthChange": false,
        "processing": true,
        // "deferLoading": 57,
        // "destroy": true,
        // "serverSide": true,
        "lengthMenu": [[25, 50, 75, 100], [25, 50, 75, 100]],
        "language": {
            "search": "",
            "searchPlaceholder": "Search",
            "lengthMenu": "Rows per page _MENU_",
            "info": "_START_ - _END_ of _TOTAL_",
            "infoEmpty": "0 - 0 of 0",
            "infoFiltered": "(_MAX_)",
            "paginate": {
                "first": "",
                "last": "",
                "next": "next",
                "previous": "prev"
            },
            "processing": '<div class="table-loader"></div>'
        },
        "responsive": true,
        "stripeClasses": [],
        "scrollX": true,
        "dom": '<"content-wrp" <"top"<"filters"f><"add-btn-wrp"><"leng">><"tb-content"r<"t-wrp"t><"p-content"lip>>>',
        'aoColumnDefs': [{
            'bSortable': false,
            'aTargets': sortColums /* 1st one, start by the right */
        }],
        "initComplete": function (settings, json) {
            // alert('DataTables has finished its initialisation.');
        }

    };

    $(el).find('th').append('<span class="sort">');

    var extOptions = $.extend({}, defOpt, option);

    var dataTable = $(el).DataTable(extOptions);

    if ($(el).hasClass('inner-table')) {
        $(el).parents('.dataTables_wrapper').addClass('inner-dataTable-wrp')
    }

    if ($(el).attr('data-class')) {
        $(el).parents('.dataTables_wrapper').addClass($(el).attr('data-class'));
    }

    if (extOptions.hasOwnProperty('searching') && extOptions['searching'] === false) {
        $(el).parents('.dataTables_wrapper').addClass('no-searching');
    }

    return dataTable;
    }
</script>
<script type="text/javascript">
    function selectElement(id, valueToSelect) {
        let element = document.getElementById(id);
        element.value = valueToSelect;
    }
    function pushmenuHandler(){
        if($('#brand-image-check').val() == 1){
            $('.brand-image').hide();
            $('.brand-image-icon').show();
            $('.brand-text').show();
            $('#brand-image-check').val(0);
        }else{
            $('.brand-image').show();
            $('.brand-image-icon').hide();
            $('.brand-text').hide();
            $('#brand-image-check').val(1);
        }

    }


    setTimeout(function(){
        $('.alert').hide();
    }, 4000);
</script>
</html>
