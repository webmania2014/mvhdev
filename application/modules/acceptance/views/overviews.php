<div class="container">
    <style>
        td {
            padding: 5px;
            text-align: center;
        }
        td input {width:40px;}
        thead {background: #76c4ed;}
    </style>
    <table>
        <tr>
            <td>Workers</td>
            <td id="nthWeek"></td>
        </tr>
        <tr>
            <td>
                <select id="worker_select">
                <?php
                    foreach ($workers as $id => $name) {
                        echo '<option value="' . $id . '">' . $name . '</option>';
                    }
                ?>
                </select>
            </td>
            <td>
                <a href="javascript:goPrevWeek();"><span class="fa fa-chevron-left"></span></a>
                <input type="text" id="work_history_date" style="width:70px">
                <a href="javascript:goNextWeek();"><span class="fa fa-chevron-right"></span></a>
            </td>
        </tr>
    </table><br>
    <div id="table-wrapper"></div>
    <form id="update-workhour-form" method="POST" action="<?php echo base_url();?>acceptance/save_work_hour">
        <input type="hidden" id="request-json" name="request-json">
        <input type="hidden" id="work-accepted" name="work-accepted">
    </form>
</div> 

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

        $('#worker_select').change(function() {
            var curDate = $('#work_history_date').val();
            var startOfWeek = moment(curDate).startOf('week').format('YYYY-MM-DD');
            var endOfWeek   = moment(curDate).endOf('week').format('YYYY-MM-DD');
            var nthWeek = moment(curDate).week();
            $('#nthWeek').html('Week ' + nthWeek);
            getTimesheet(startOfWeek, endOfWeek);
        });

        $('body').on('click', '.accept-check', function() {
            var save_data = [];
            var tbody = $(this).parent().parent().parent();
            var bAccepted = 0;
            if ($(this).is(':checked'))
                bAccepted = 1;
            else 
                bAccepted = 0;

            $(tbody).find('tr').each(function() {
                if ($(this).attr('work-id')) {
                    var work_id = $(this).attr('work-id');
                    var unit_arr = {
                        "id": work_id,
                        "work_activity"     : $('#work-activity-' + work_id).val(),
                        "work_norm"         : $('#work-norm-' + work_id).val(),
                        "work_50"           : $('#work-50-' + work_id).val(),
                        "work_100"          : $('#work-100-' + work_id).val(),
                        "work_150"          : $('#work-150-' + work_id).val(),
                        "work_300"          : $('#work-300-' + work_id).val(),
                        "work_norm_client"  : $('#work-norm-client-' + work_id).val(),
                        "work_50_client"    : $('#work-50-client-' + work_id).val(),
                        "work_100_client"   : $('#work-100-client-' + work_id).val(),
                        "work_150_client"   : $('#work-150-client-' + work_id).val(),
                        "work_300_client"   : $('#work-300-client-' + work_id).val(),
                    };
                    save_data.push(unit_arr);
                }
            });

            var request_json = JSON.stringify(save_data);
            $('#update-workhour-form #request-json').val(request_json);
            $('#update-workhour-form #work-accepted').val(bAccepted);
            $('#update-workhour-form').submit();
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
        var url = "<?php echo base_url(); ?>acceptance/get_time_sheet";
        $.ajax({
            method: "POST",
            url: url,
            data: { workerId: $('#worker_select').val(), startDate: startDate, endDate: endDate }
        })
        .success(function(data) {
            var work_list = jQuery.parseJSON(data);
            var table_html = [];
            for (var work_date in work_list) {
                var unit_table = [
                    '<table width="100%">',
                    '<thead>',
                        '<tr>',
                            '<td rowspan=2>' + moment(work_date).format('ddd MMM DD') + '</td>',
                            '<td rowspan=2></td>',
                            '<td rowspan=2></td>',
                            '<td rowspan=2></td>',
                            '<td rowspan=2>Activity</td>',
                            '<td colspan=5>Worker entry</td>',
                            '<td colspan=5>For client</td>',
                        '</tr>',
                        '<tr>',
                            '<td>Basic</td>',
                            '<td>50%</td>',
                            '<td>100%</td>',
                            '<td>150%</td>',
                            '<td>300%</td>',
                            '<td>Basic</td>',
                            '<td>50%</td>',
                            '<td>100%</td>',
                            '<td>150%</td>',
                            '<td>300%</td>',
                        '</tr>',
                    '</thead>',
                    '<tbody>',
                ];
                var bAccepted = 1;
                for (var i = 0; i < work_list[work_date].length; i ++) {
                    var table_body = [
                        '<tr work-id="' + work_list[work_date][i]['id'] + '">',
                        '<td>' + work_list[work_date][i]['client_name'] + '</td>',
                        '<td>' + work_list[work_date][i]['area'] + '</td>',
                        '<td>' + work_list[work_date][i]['work_number'] + '</td>',
                        '<td>' + work_list[work_date][i]['work_type'] + '</td>',
                        '<td><select id="work-activity-' + work_list[work_date][i]['id'] + '">' + work_list[work_date][i]['work_type_options'] + '</select></td>',
                        '<td><input type="text" id="work-norm-' + work_list[work_date][i]['id'] + '" value="' + work_list[work_date][i]['work_norm'] + '"></td>',
                        '<td><input type="text" id="work-50-' + work_list[work_date][i]['id'] + '" value="' + work_list[work_date][i]['work_50'] + '"></td>',
                        '<td><input type="text" id="work-100-' + work_list[work_date][i]['id'] + '" value="' + work_list[work_date][i]['work_100'] + '"></td>',
                        '<td><input type="text" id="work-150-' + work_list[work_date][i]['id'] + '" value="' + work_list[work_date][i]['work_150'] + '"></td>',
                        '<td><input type="text" id="work-300-' + work_list[work_date][i]['id'] + '" value="' + work_list[work_date][i]['work_300'] + '"></td>',
                        '<td><input type="text" id="work-norm-client-' + work_list[work_date][i]['id'] + '" value="' + work_list[work_date][i]['work_norm_client'] + '"></td>',
                        '<td><input type="text" id="work-50-client-' + work_list[work_date][i]['id'] + '" value="' + work_list[work_date][i]['work_50_client'] + '"></td>',
                        '<td><input type="text" id="work-100-client-' + work_list[work_date][i]['id'] + '" value="' + work_list[work_date][i]['work_100_client'] + '"></td>',
                        '<td><input type="text" id="work-150-client-' + work_list[work_date][i]['id'] + '" value="' + work_list[work_date][i]['work_150_client'] + '"></td>',
                        '<td><input type="text" id="work-300-client-' + work_list[work_date][i]['id'] + '" value="' + work_list[work_date][i]['work_300_client'] + '"></td>',
                        '</tr>'
                    ];
                    unit_table = unit_table.concat(table_body);

                    if (work_list[work_date][i]['status'] != 1)
                        bAccepted = 0;
                }

                var accept_checked = (bAccepted) ? 'checked="checked"' : '';

                var table_footer = [
                        '<tr>',
                        '<td colspan=15 style="text-align: right;"><input type="checkbox" class="accept-check" ' + accept_checked + '>Accepted</td>',
                        '</tr>',
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
   