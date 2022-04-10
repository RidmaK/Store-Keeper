$('#region_table').DataTable({
    processing: true,
    serverSide: true,
    paging: false,
    destroy: true,
    aaSorting: false,
    searching: false,
    ajax: {
        url: APP_URL + '/region-transfer-search',
        data: function (d) {
            d.old_zone_name = $old_zone_name;
            d.region_name = $region_name;
        }
    },
    columns: [
        {
            data: "active",
            render: function (data, type, row) {
                if (type === 'display') {
                    return '     <fieldset>  ' +
                        '                                                   <div class="vs-checkbox-con vs-checkbox-primary">  ' +
                        '                                                       <input type="checkbox" name="regions[]" onchange="unDisableTransferBtn(event)" class="myCheckbox" value="' + row.region_id + '" >  ' +
                        '                                                       <span class="vs-checkbox">  ' +
                        '                                                           <span class="vs-checkbox--check">  ' +
                        '                                                               <i class="vs-icon feather icon-check"></i>  ' +
                        '                                                           </span>  ' +
                        '                                                       </span>  ' +
                        '                                                   </div>  ' +
                        '                                              </fieldset>  ';
                }
                return data;
            },
            className: "dt-body-center"
        },
        { data: 'region_code', name: 'region_code', className: 'text-center' },
        { data: 'region_name', name: 'region_name', className: 'text-center' },
        { data: 'date_at', name: 'date_at', className: 'text-center' },
    ],
    columnDefs: [{
        orderable: false,
        className: 'select-checkbox',
        targets: 0

    }],
});