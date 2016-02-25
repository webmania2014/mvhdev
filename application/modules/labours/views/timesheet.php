<div class="container">
    <div id="nthWeek" style="width:95px; text-align: center;"></div>        
    <div>
        <a href="javascript:goPrevWeek();"><span class="fa fa-chevron-left"></span></a>
        <input type="text" id="work_history_date" style="width:70px">
        <a href="javascript:goNextWeek();"><span class="fa fa-chevron-right"></span></a>
    </div><br>
    <style>
        table {margin-bottom: 20px;}
        thead {background: #76c4ed;}
        td {padding: 5px;}
    </style>
    <div id="table-wrapper"></div>
</div> 
<!-- container -->

<script>
    $(document).ready(function() {
        var today = moment().format('YYYY-MM-DD');
        $('#work_history_date').val(today);
        var startOfWeek = moment().startOf('week').format('YYYY-MM-DD');
        var endOfWeek   = moment().endOf('week').format('YYYY-MM-DD');
        var nthWeek = moment().week();
        $('#nthWeek').html('Week ' + nthWeek);
        getTimesheet(startOfWeek, endOfWeek);

        $('#work_history_date').change(function() {
            var curDate = $('#work_history_date').val();
            var startOfWeek = moment(curDate).startOf('week').format('YYYY-MM-DD');
            var endOfWeek   = moment(curDate).endOf('week').format('YYYY-MM-DD');
            var nthWeek = moment(curDate).week();
            $('#nthWeek').html('Week ' + nthWeek);
            getTimesheet(startOfWeek, endOfWeek);
        });
    });

    function goPrevWeek() {
        var curDate = $('#work_history_date').val();
        var newDate = moment(curDate).day(-6).format('YYYY-MM-DD');
        $('#work_history_date').val(newDate);
        var startOfWeek = moment(newDate).startOf('week').format('YYYY-MM-DD');
        var endOfWeek = moment(newDate).endOf('week').format('YYYY-MM-DD');
        var nthWeek = moment(newDate).week();
        $('#nthWeek').html('Week ' + nthWeek);
        getTimesheet(startOfWeek, endOfWeek);
    }

    function goNextWeek() {
        var curDate = $('#work_history_date').val();
        var newDate = moment(curDate).day(8).format('YYYY-MM-DD');
        $('#work_history_date').val(newDate);
        var startOfWeek = moment(newDate).startOf('week').format('YYYY-MM-DD');
        var endOfWeek = moment(newDate).endOf('week').format('YYYY-MM-DD');
        var nthWeek = moment(newDate).week();
        $('#nthWeek').html('Week ' + nthWeek);
        getTimesheet(startOfWeek, endOfWeek);
    }

    function getTimesheet(startDate, endDate) {
        var url = "<?php echo base_url(); ?>labours/get_time_sheet";
        $.ajax({
            method: "POST",
            url: url,
            data: { startDate: startDate, endDate: endDate }
        })
        .success(function(data) {
            var work_list = jQuery.parseJSON(data);
            var table_html = [];
            for (var work_date in work_list) {
                var unit_table = [
                    '<table width="100%">',
                    '<col width="11%"></col>',
                    '<col width="11%"></col>',
                    '<col width="11%"></col>',
                    '<col width="11%"></col>',
                    '<col width="11%"></col>',
                    '<col width="11%"></col>',
                    '<col width="11%"></col>',
                    '<col width="11%"></col>',
                    '<col width="11%"></col>',
                    '<thead>',
                        '<tr>',
                            '<td>' + moment(work_date).format('ddd MMM DD') + '</td>',
                            '<td>Building</td>',
                            '<td>Work Number</td>',
                            '<td>Activity</td>',
                            '<td>Basic</td>',
                            '<td>50%</td>',
                            '<td>100%</td>',
                            '<td>150%</td>',
                            '<td>300%</td>',
                        '</tr>',
                    '</thead>',
                    '<tbody>',
                ];
                for (var i = 0; i < work_list[work_date].length; i ++) {
                    var table_body = [
                        '<tr>',
                        '<td>' + work_list[work_date][i]['client_name'] + '</td>',
                        '<td>' + work_list[work_date][i]['area'] + '</td>',
                        '<td>' + work_list[work_date][i]['work_number'] + '</td>',
                        '<td>' + work_list[work_date][i]['work_type'] + '</td>',
                        '<td>' + work_list[work_date][i]['work_norm'] + '</td>',
                        '<td>' + work_list[work_date][i]['work_50'] + '</td>',
                        '<td>' + work_list[work_date][i]['work_100'] + '</td>',
                        '<td>' + work_list[work_date][i]['work_150'] + '</td>',
                        '<td>' + work_list[work_date][i]['work_300'] + '</td>',
                        '</tr>'
                    ];
                    unit_table = unit_table.concat(table_body);
                }
                var table_footer = [
                    '</tbody>',
                    '</table>'
                ];
                unit_table = unit_table.concat(table_footer);
                table_html = table_html.concat(unit_table);
            }
            $('#table-wrapper').html(table_html.join(""));
        });
    }
</script>
   