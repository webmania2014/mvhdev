<div class="container">
    <div class="row">
        <div class="col-md-5 col-xs-12">
            <div class="panel panel-sky">
                <div class="panel-heading">
                    <h4>Works Ongoing</h4>
                    <div class="options">   
                        <a href="javascript:;"><i class="fa fa-cog"></i></a>
                        <a href="javascript:;"><i class="fa fa-wrench"></i></a>
                        <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Area</th>
                                <th>Work</th>
                                <th>Started</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php  if(isset($works)):  ?>
                                <?php foreach($works as $work ): ?>
                                    <tr onclick="viewData(<?php echo $work['id'];  ?>);">
                                        <td><?php echo $work['client_name']; ?></td>
                                        <td><?php echo $work['area']; ?></td>
                                        <td><?php echo $work['work_type']; ?></td>
                                        <td><?php echo $work['start_date']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Works Queue -->
            
            <div class="panel panel-sky">
                <div class="panel-heading">
                    <h4>Works in queue</h4>
                    <div class="options">   
                        <a href="javascript:;"><i class="fa fa-cog"></i></a>
                        <a href="javascript:;"><i class="fa fa-wrench"></i></a>
                        <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Area</th>
                                <th>Work</th>
                                <th>Will start</th>
                            </tr>
                        </thead>
                        <tbody>
                             <?php  if(isset($works_queue)):  ?>
                                <?php foreach($works_queue as $work_queue ): ?>
                                    <tr onclick="viewData(<?php echo $work_queue['id'];  ?>);">
                                        <td><?php echo $work_queue['client_name']; ?></td>
                                        <td><?php echo $work_queue['area']; ?></td>
                                        <td><?php echo $work_queue['work_type']; ?></td>
                                        <td><?php echo $work_queue['will_start_date']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif;?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- End Works Queue -->
            
        </div>
        <div class="col-md-7 col-xs-12 col-form col-st">                        
            <div class="panel panel-sky">
                <div class="panel-heading">
                    <h4>Create/Edit Works</h4>
                    <div class="options">   
                        <a href="javascript:;"><i class="fa fa-cog"></i></a>
                        <a href="javascript:;"><i class="fa fa-wrench"></i></a>
                        <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                    </div>
                </div>
                <div class="panel-body collapse in">
            
                    <form action="<?php echo base_url();?>labours/save_work" id="saveWorkHoursForm" class="form-horizontal row-border" method="POST">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Enter Worked Hours:</label>
                            <div class="col-sm-10">
                                <table width="100%" cellpadding="10" id="work_hours_table">
                                    <thead>
                                        <tr>
                                            <td>Date</td>
                                            <td>Start time</td>
                                            <td>End time</td>
                                            <td>Norm</td>
                                            <td>50%</td>
                                            <td>100%</td>
                                            <td>150%</td>
                                            <td>300%</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" id="work_history_date" style="width:70px"></td>
                                            <td><input type="text" id="work_history_start_time" placeholder="10:00" style="width:70px"></td>
                                            <td><input type="text" id="work_history_end_time" placeholder="15:00" style="width:70px"></td>
                                            <td><input type="text" id="work_history_norm" placeholder="4h" style="width:70px"></td>
                                            <td><input type="text" id="work_history_50" placeholder="4h" style="width:70px"></td>
                                            <td><input type="text" id="work_history_100" placeholder="4h" style="width:70px"></td>
                                            <td><input type="text" id="work_history_150" placeholder="4h" style="width:70px"></td>
                                            <td><input type="text" id="work_history_300" placeholder="4h" style="width:70px"></td>
                                            <td><a href="javascript:addWorkHours();" class="btn btn-primary">Add</a></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="form-group">
                        <input type="hidden" id="work_id" name="work_id" />
                        <input type="hidden" id="work_hours_json" name="work_hours_json" />
                            <label class="col-sm-2 control-label">Client:</label>
                            <div class="col-sm-6">
                                <label class="control-label" id="client_name"></label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Project:</label>
                            <div class="col-sm-6">
                                <label class="control-label" id="project"></label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Offer Number:</label>
                            <div class="col-sm-6">
                                <label class="control-label" id="offer_number"></label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Work:</label>
                            <div class="col-sm-6">
                                <label class="control-label" id="work"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Work Number:</label>
                            <div class="col-sm-6">
                                <label class="control-label" id="work_number"></label>
                            </div>
                        </div>
                        <div class="form-group rental_number">
                            <label class="col-sm-2 control-label">Rental Number:</label>
                            <div class="col-sm-6">
                                <label class="control-label" id="rental_number"></label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Area:</label>
                            <div class="col-sm-3">
                                <label class="control-label" id="area"></label>
                            </div>
                            <div class="col-sm-3">
                                <label class="control-label" id="sub_area"></label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Client work number:</label>
                            <div class="col-sm-6">
                                <label class="control-label" id="client_work_number"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <input type="checkbox" class="" id="work_needed" name="work_needed"/><span class="text_work_need">No work needed</span>
                            </div>
                        </div>
                        <div class="form-group" id="">
                            <label class="col-sm-2 control-label">Workers:</label>
                            <div class="col-sm-6" id="add_worker"></div> 
                        </div> 
                          
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Supervisor:</label>
                            <div class="col-sm-6">
                                <label id="supervisor" class="control-label"></label>
                            </div>
                        </div>   
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <input type="checkbox" class="" id="mark_done" name="mark_done"/><span class="text_work_need">Mark as done</span>
                            </div>
                        </div>   
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <div class="btn-toolbar">
                                    <button class="btn-primary btn" id="save_work_btn" onclick="javascript:saveLaborHours();" disabled>Save work</button>
                                    <button class="btn-default btn" onclick="window.location='<?php echo site_url( 'labours' ); ?>';return false;">Cancel</button>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div> 
<!-- container -->

<script>
    var work_hours_list = [];
    var work_hours_json = "";

    function viewData(id){
        var url = "<?php echo base_url(); ?>labours/get_work_id?id=" + id;
            $.ajax({
            type: "GET",
            url: url, 
            dataType: "text",  
            cache:false,
            success: 
                function(data){
                    $("#add_worker").empty();
                    var work = jQuery.parseJSON(data);
                    work_hours_list = [];
                    for (var i = 0; i < work['work_hours'].length; i ++) {
                        var work_hours = {
                            'work_history_date': work['work_hours'][i]['work_history_date'],
                            'work_history_start_time': work['work_hours'][i]['work_history_start_time'],
                            'work_history_end_time': work['work_hours'][i]['work_history_end_time'],
                            'work_history_norm': work['work_hours'][i]['work_history_norm'],
                            'work_history_50': work['work_hours'][i]['work_history_50'],
                            'work_history_100': work['work_hours'][i]['work_history_100'],
                            'work_history_150': work['work_hours'][i]['work_history_150'],
                            'work_history_300': work['work_hours'][i]['work_history_300']
                        };
                        work_hours_list.push(work_hours);
                    }
                    var initTableData = [];
                    for (var i = 0; i < work_hours_list.length; i ++) {
                        var unit = [
                            '<tr>',
                            '<td>' + work_hours_list[i]['work_history_date'] + '</td>',
                            '<td>' + work_hours_list[i]['work_history_start_time'] + '</td>',
                            '<td>' + work_hours_list[i]['work_history_end_time'] + '</td>',
                            '<td>' + work_hours_list[i]['work_history_norm'] + '</td>',
                            '<td>' + work_hours_list[i]['work_history_50'] + '</td>',
                            '<td>' + work_hours_list[i]['work_history_100'] + '</td>',
                            '<td>' + work_hours_list[i]['work_history_150'] + '</td>',
                            '<td>' + work_hours_list[i]['work_history_300'] + '</td>',
                            '</tr>'
                        ];
                        initTableData.push(unit);
                    }

                    $('#work_hours_table tbody').html(initTableData.join(""));
                    $('#work_needed').removeAttr('checked');
                    $('#mark_done').removeAttr('checked');

                    $('#client_name').text(work['client_name']);
                    $('#project').text(work['project_number']);
                    $('#offer_number').text(work['offer_number']);
                    $('#work').text(work['work_type']);
                    $('#work_number').text(work['work_number']);
                    $('#rental_number').text(work['rental_number']);
                    $('#area').text(work['area']);
                    /*$('#sub_area').text(work['work'][0]['room_name']);*/
                    $('#client_work_number').text(work['client_number']);
                    $('#supervisor').text(work['supervisor_name']);
                    for(i=0; i<work['workers'].length; i++){
                        $( "#add_worker" ).append( "<label class='control-label' >" + work['workers'][i] + "</label><div class='clearfix'></div>" );
                    }
                    if (work['status'] == 3) {
                        $('#work_needed').attr('checked', 'checked');
                    }
                    $('#work_id').val(work['id']);
                    $('#save_work_btn').removeAttr('disabled');
                }
            });
    }


    function addWorkHours() {
        var work_history_date       = $('#work_history_date').val();
        var work_history_start_time = $('#work_history_start_time').val();
        var work_history_end_time   = $('#work_history_end_time').val();
        var work_history_norm       = $('#work_history_norm').val();
        var work_history_50         = $('#work_history_50').val();
        var work_history_100        = $('#work_history_100').val();
        var work_history_150        = $('#work_history_150').val();
        var work_history_300        = $('#work_history_300').val();

        if (work_history_date == '') {
            alert('Please input work date');
            return;
        }

        var html = [
            '<tr>',
            '<td>' + work_history_date + '</td>',
            '<td>' + work_history_start_time + '</td>',
            '<td>' + work_history_end_time + '</td>',
            '<td>' + work_history_norm + '</td>',
            '<td>' + work_history_50 + '</td>',
            '<td>' + work_history_100 + '</td>',
            '<td>' + work_history_150 + '</td>',
            '<td>' + work_history_300 + '</td>',
            '</tr>'
        ].join("");

        $('#work_hours_table tbody').append(html);

        var work_hours = {
            'work_history_date': work_history_date,
            'work_history_start_time': work_history_start_time,
            'work_history_end_time': work_history_end_time,
            'work_history_norm': work_history_norm,
            'work_history_50': work_history_50,
            'work_history_100': work_history_100,
            'work_history_150': work_history_150,
            'work_history_300': work_history_300
        };        

        work_hours_list.push(work_hours);
        work_hours_json = JSON.stringify(work_hours_list);
        $('#saveWorkHoursForm #work_hours_json').val(work_hours_json);

        $('#work_history_date').val('');
        $('#work_history_start_time').val('');
        $('#work_history_end_time').val('');
        $('#work_history_norm').val('');
        $('#work_history_50').val('');
        $('#work_history_100').val('');
        $('#work_history_150').val('');
        $('#work_history_300').val('');
    }

    function saveLaborHours() {
        $('#saveWorkHoursForm').submit();
    }
</script>
   