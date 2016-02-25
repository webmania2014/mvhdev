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
                                    <tr onclick="viewData(<?php echo $work->id;  ?>);">
                                        <td><?php echo $work->client_name; ?></td>
                                        <td><?php echo $work->name; ?></td>
                                        <td><?php echo $work->work_type; ?></td>
                                        <td><?php echo $work->date_start; ?></td>
                                        <td><?php echo $work->date_start; ?><a href="works/endwork/<?php echo $work->id;?>" class="btn btn-primary">End</a></td>
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
                                    <tr onclick="viewData(<?php echo $work_queue->id;  ?>);">
                                        <td><?php echo $work_queue->client_name; ?></td>
                                        <td><?php echo $work_queue->name; ?></td>
                                        <td><?php echo $work_queue->work_type; ?></td>
                                        <td><?php echo $work_queue->date_will_start; ?></td>
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
            
                    <form action="<?php echo base_url();?>works/create_contract" class="form-horizontal row-border" method="POST">
                        <div class="form-group">
                        <input type="hidden" id="work_id" name="work_id" />
                            <label class="col-sm-2 control-label">Client</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" onclick="drop_down_client();" placeholder="" autocomplete="off" id="auto_client" name="auto_client">
                                <i class="fa fa-angle-down pull-right"  style="margin-top: -25px; margin-right: 10px;"></i>
                                <input type="hidden" name="client_id" id="client_id"/>
                                <ul class="dropdown-menu txtsearch_client" style="width:95%;margin-right: 8px; " role="menu" aria-labelledby="dropdownMenu"  id="Dropdown_client">
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Project</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" onclick="drop_down_project();" placeholder="" autocomplete="off" id="project_id_drop" name="project_id_drop">
                                <i class="fa fa-angle-down pull-right" style="margin-top: -25px; margin-right: 10px;"></i>
                                <input type="hidden" name="project_id" id="project_id"/>
                                <ul class="dropdown-menu txtsearch_project" style="width:95%;margin-right: 8px;" role="menu" aria-labelledby="dropdownMenu"  id="Dropdown_project">
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Offer Number</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" onclick="drop_down_offer();" placeholder="" autocomplete="off" id="auto_offer" name="auto_offer">
                                <i class="fa fa-angle-down pull-right" style="margin-top: -25px; margin-right: 10px;"></i>
                                <input type="hidden" name="offer_id" id="offer_id"/>
                                <ul class="dropdown-menu txtsearch_offer" style="width:95%;margin-right: 8px;" role="menu" aria-labelledby="dropdownMenu"  id="Dropdown_offer">
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <div id="work_multiple_of_offer" name="work_multiple_of_offer" multiple="" style="width: 100%;"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Work</label>
                            <div class="col-sm-3">
                                <?php get_type_work_dropdown(); ?>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" onclick="drop_down_work();" placeholder="" autocomplete="off" id="auto_work" name="auto_work">
                                <i class="fa fa-angle-down pull-right" style="margin-top: -25px; margin-right: 10px;"></i>
                                <input type="hidden" name="sub_work_id" id="sub_work_id"/>
                                <ul class="dropdown-menu txtsearch_work" style="width:90%; margin-right: 9px; " role="menu" aria-labelledby="dropdownMenu"  id="Dropdown_work">
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Work Number</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control work_number" name="work_number" disabled="true" value="<?php echo generate_work_number(); ?>" />
                                <input type="hidden" class="form-control work_number" id="work_number"  name="work_number" value="<?php echo generate_work_number(); ?>" />
                            </div>
                        </div>
                        <div class="form-group scaffold_number">
                            <label class="col-sm-2 control-label">Scaffold Number</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="scaffold_number" name="scaffold_number"/>
                            </div>
                        </div>
                        <div class="form-group rental_number">
                            <label class="col-sm-2 control-label">Rental Number</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control rental_number" name="rental_number" disabled="true" value="<?php echo generate_rental_number(); ?>" />
                                <input type="hidden" class="form-control" id="rental_number" name="rental_number" value="<?php echo generate_rental_number(); ?>" />
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">House</label>
                            <div class="col-sm-3">
                                <?php get_house_dropdown(); ?>
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control" name="room" id="room">
                                    <option>Please choose house</option>
                                </select>
                            </div>
                        </div>

                        <!--div class="form-group">
                            <label class="col-sm-2 control-label">Area</label>
                            <div class="col-sm-3">
                                <?php get_area_dropdown(); ?>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" onclick="drop_down_area();" placeholder="" autocomplete="off" id="auto_area" name="auto_area">
                                <input type="hidden" name="area_id" id="area_id"/>
                                <i class="fa fa-angle-down pull-right" style="margin-top: -25px; margin-right: 10px;"></i>
                                <ul class="dropdown-menu txtsearch_area" style="width:90%; margin-right: 9px; " role="menu" aria-labelledby="dropdownMenu"  id="Dropdown_area">
                                </ul>
                            </div>
                        </div-->
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Client work number</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="client_work_number" name="client_work_number" disabled="true" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <input type="checkbox" class="" id="work_needed" name="work_needed"/><span class="text_work_need">No work needed</span>
                            </div>
                        </div>
                        <div class="form-group" id="">
                            <label class="col-sm-2 control-label">Workers</label>
                            <div class="col-sm-6">
                                <?php get_workers_dropdown(); ?>
                            </div>
                            <div class="col-sm-2"><a class="btn btn-primary" onclick="add_worker();">Add</a></div>
                            
                            <div class="" id="add_worker"></div> 
                        </div> 
                          
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Supervisor</label>
                            <div class="col-sm-6">
                                <?php get_suppervisors_dropdown(); ?>
                            </div>
                        </div>   
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <div class="btn-toolbar">
                                    <button class="btn-primary btn" name="action" value="Save work" onclick="javascript:$('#validate-form').parsley( 'validate' );">Save work</button>
                                    <button class="btn-primary btn" name="action" value="Work queue" onclick="javascript:$('#validate-form').parsley( 'validate' );">Work queue</button>
                                    <!-- <input type="submit" class="btn-danger  btn" name="action" value="Delete" /> -->
                                    <button class="btn-default btn" onclick="window.location='<?php echo site_url( 'workers' ); ?>';return false;">Cancel</button>
                                   
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
    function add_worker(){
        $( "#add_worker" ).append( "<div class='col-sm-6 col-sm-offset-2 add_input_work'><?php get_workers_dropdown(); ?></div>" );
    }
    function display_work_number_client(){
        var text = $('#auto_client').val();
            text = encodeURIComponent(text);
            var url = "<?php echo base_url(); ?>works/get_client?client="+text;
            $.ajax({
                type: "GET",
                url: url, 
                dataType: "text",  
                cache:false,
                success: 
                  function(data){
                      var client = jQuery.parseJSON(data);             
                      $('#client_work_number').val(client['client_number']);
                  }
    
            });
    }
    
    $('#auto_work').keyup(function(){
        var work_type = $('#work_type').val();
        var text = $('#auto_work').val();
        var url = "<?php echo base_url(); ?>works/get_autosearch_work?work_type=" + work_type + '&text=' +text;
            $.ajax({
                 type: "GET",
                 url: url, 
                 dataType: "json",
                 cache:false,
                 success: 
                    function(data){
                        if (data.length > 0) {
                            $('#Dropdown_work').empty();
                            $('#auto_work').attr("data-toggle", "dropdown");
                            $('#Dropdown_work').dropdown('toggle');
                        }
                        else if (data.length == 0) {
                            $('#auto_work').attr("data-toggle", "");
                        }
                        $.each(data, function (key,value) {
                            if (data.length > 0)
                                $('#Dropdown_work').append('<a href="#" class ="drop-down-hover"><li id='+value['id']+' class="li-dropdown" role="presentation" class="li-dropdown" >' + value['title'] + '</li></a>');
                        });
                        $('ul.txtsearch_work').on('click', 'li', function () {
                            $('#sub_work_id').val(this.id);
                            $('#auto_work').val($(this).text());
                        });
                    }
                });
    });
    $('#work_type').change(function(){
        var work_type = $('#work_type').val();
        if(work_type == '1'){
            $('.scaffold_number').hide();
            $('#scaffold_number').val('');
            $('.rental_number').show();
        }else{
            $('.scaffold_number').show();
            $('.rental_number').hide();
            $('#rental_number').val('');
        }
        $('#Dropdown_work').empty();
    });
    $('#area_name').change(function(){
        $('#Dropdown_area').empty();
    });
    function drop_down_area(){
        var area = $('#area_name').val();
        var text = $('#auto_area').val();
        var url = "<?php echo base_url(); ?>works/get_autosearch_area?area="+area+"&area_text="+text;
        $.ajax({
            type: "GET",
            url: url, 
            dataType: "json",
            cache:false,
            success: 
                function(data){
                    if (data.length > 0) {
                        $('#Dropdown_area').parent().closest('div').removeClass('open');
                        $('#Dropdown_area').empty();
                        $('#auto_area').attr("data-toggle", "dropdown");
                        $('#Dropdown_area').dropdown('toggle');
                    }
                    else if (data.length == 0) {
                        $('#auto_area').attr("data-toggle", "");
                    }
                    $.each(data, function (key,value) {
                        if (data.length >= 0)
                            $('#Dropdown_area').append('<a href="#"  class="drop-down-hover"><li id='+value['id']+' class="li-dropdown" role="presentation" >' + value['area'] + '</li></a>');
                    });
                    $('ul.txtsearch_area').on('click', 'li', function () {
                        $('#area_id').val(this.id);
                        $('#auto_area').val($(this).text());
                    });
                }
        });
    }
    function drop_down_offer(){
        var project_id = $('#project_id').val();
        var text = $('#auto_offer').val();
        var client_id = $('#client_id').val();
        var url = "<?php echo base_url(); ?>works/get_autosearch_offer?project_id="+project_id+"&offer="+text+"&client_id="+client_id;
        $.ajax({
            type: "GET",
            url: url, 
            dataType: "json",
            cache:false,
            success: 
            function(data){
                if (data.length > 0) {
                    $('#Dropdown_offer').parent().closest('div').removeClass('open');
                    $('#Dropdown_offer').empty();
                    $('#auto_offer').attr("data-toggle", "dropdown");
                    $('#Dropdown_offer').dropdown('toggle');
                }
                else if (data.length == 0) {
                    $('#auto_offer').attr("data-toggle", "");
                }
                $.each(data, function (key,value) {
                    if (data.length >= 0)
                        $('#Dropdown_offer').append('<a href="#" class ="drop-down-hover"><li id='+value['id']+' class="li-dropdown" role="presentation" >' + value['offer_number'] + '</li></a>');
                        
                });
                $('ul.txtsearch_offer').on('click', 'li', function () {
                    $('#offer_id').val(this.id);
                    $('#auto_offer').val($(this).text());
                    get_works_by_offer(this.id);
                });
            }
        });
    }
    function get_works_by_offer(offer_id) {
        var url = "<?php echo base_url(); ?>works/get_works_by_offer?offer_id=" + offer_id;
        $.ajax({
            type: "GET",
            url: url, 
            dataType: "json",
            cache:false,
            success: 
            function(data){
                var html = [
                '<table width="100%" class="table table-striped table-bordered">',
                    '<tr>',
                        '<td></td>',
                        '<td>Type</td>',
                        '<td>m2</td>',
                        '<td>Cost Total</td>',
                        '<td>Offer Total</td>',
                    '</tr>'
                ];

                for (var i = 0; i < data.length; i ++) {
                    html = html.concat([
                        '<tr>',
                            '<td><input type="radio" name="offer_work_id" value="' + data[i].id + '"></td>',
                            '<td>' + data[i].work_type + '</td>',
                            '<td>' + data[i].m2 + '</td>',
                            '<td>' + data[i].m2 * data[i].price_m2 + '</td>',
                            '<td>' + data[i].m2 * data[i].price_m2 + '</td>',
                        '</tr>'
                    ]);
                }

                html = html.concat(['</table>']);

                $('#work_multiple_of_offer').html(html.join(""));
            }
        });
    }
    function drop_down_work(){
        var work_type = $('#work_type').val();
        var text = $('#auto_work').val();
        var url = "<?php echo base_url(); ?>works/get_autosearch_work?work_type=" + work_type + '&text=' +text;
            $.ajax({
                 type: "GET",
                 url: url, 
                 dataType: "json",
                 cache:false,
                 success: 
                    function(data){
                        if (data.length > 0) {
                            $('#Dropdown_work').parent().closest('div').removeClass('open');
                            $('#Dropdown_work').empty();
                            $('#auto_work').attr("data-toggle", "dropdown");
                            $('#Dropdown_work').dropdown('toggle');
                        }
                        else if (data.length == 0) {
                            $('#auto_work').attr("data-toggle", "");
                        }
                        $.each(data, function (key,value) {
                            if (data.length >= 0)
                                $('#Dropdown_work').append('<a href="#" class ="drop-down-hover"><li id='+value['id']+' class="li-dropdown" role="presentation" class="li-dropdown" >' + value['title'] + '</li></a>');
                                
                        });
                        $('ul.txtsearch_work').on('click', 'li', function () {
                            $('#sub_work_id').val(this.id);
                            $('#auto_work').val($(this).text());
                        });
                    }
                });
    }
    function drop_down_client(){
        var text = $('#auto_client').val();
        var url = "<?php echo base_url(); ?>works/get_autosearch_client?client="+text;
        $.ajax({
             type: "GET",
             url: url, 
             dataType: "json",
             cache:false,
             success: 
                function(data){
                    if (data.length > 0) {
                        $('#Dropdown_client').parent().closest('div').removeClass('open');
                        $('#Dropdown_client').empty();
                        $('#auto_client').attr("data-toggle", "dropdown");
                        $('#Dropdown_client').dropdown('toggle');
                    }
                    else if (data.length == 0) {
                        $('#auto_client').attr("data-toggle", "");
                    }
                    $.each(data, function (key,value) {
                        if (data.length >= 0)
                            $('#Dropdown_client').append('<a href="#" class ="drop-down-hover"><li id='+value['id']+' class="li-dropdown" role="presentation">' + value['client_name'] + '</li></a>');
                            
                    });
                    $('ul.txtsearch_client').on('click', 'li', function () {
                        $('#client_id').val(this.id);
                        $('#auto_client').val($(this).text());
                        display_work_number_client();
                    });
                }
            });
    }
    $('#auto_client').keyup(function(){
    var text = $('#auto_client').val();
    var url = "<?php echo base_url(); ?>works/get_autosearch_client?client="+text;
        $.ajax({
             type: "GET",
             url: url, 
             dataType: "json",
             cache:false,
             success: 
                function(data){
                    if (data.length > 0) {
                        $('#Dropdown_client').empty();
                        $('#auto_client').attr("data-toggle", "dropdown");
                        $('#Dropdown_client').dropdown('toggle');
                    }
                    else if (data.length == 0) {
                        $('#auto_client').attr("data-toggle", "");
                    }
                    $.each(data, function (key,value) {
                        if (data.length >= 0)
                            $('#Dropdown_client').append('<a href="#" class ="drop-down-hover"><li id='+value['id']+' class="li-dropdown" role="presentation" >' + value['client_name'] + '</li></a>');
                    });
                    $('ul.txtsearch_client').on('click', 'li', function () {
                        $('#client_id').val(this.id);
                        $('#auto_client').val($(this).text());
                    });
                }
            });
    });
    
    $('#auto_offer').keyup(function(){
        var project_id = $('#project_id').val();
        var text = $('#auto_offer').val();
        var url = "<?php echo base_url(); ?>works/get_autosearch_offer?project_id="+project_id+"&offer="+text;
        $.ajax({
             type: "GET",
             url: url, 
             dataType: "json",
             cache:false,
             success: 
                function(data){
                    if (data.length > 0) {
                        $('#Dropdown_offer').empty();
                        $('#auto_offer').attr("data-toggle", "dropdown");
                        $('#Dropdown_offer').dropdown('toggle');
                    }
                    else if (data.length == 0) {
                        $('#auto_offer').attr("data-toggle", "");
                    }
                    $.each(data, function (key,value) {
                        if (data.length >= 0)
                            $('#Dropdown_offer').append('<a href="#" class ="drop-down-hover"><li id='+value['id']+' class="li-dropdown" role="presentation" >' + value['offer_number'] + '</li></a>');
                    });
                    $('ul.txtsearch_offer').on('click', 'li', function () {
                        $('#offer_id').val(this.id);
                        $('#auto_offer').val($(this).text());
                    });
                }
            });
    });
    
    
    
    $('#auto_project').keyup(function(){
    var text = $('#auto_project').val();
    var client = $('#client_id').val();
    var url = "<?php echo base_url(); ?>works/get_autosearch_project?project="+text;
        $.ajax({
             type: "GET",
             url: url, 
             dataType: "json",
             cache:false,
             success: 
                function(data){
                    if (data.length > 0) {
                        $('#Dropdown_project').empty();
                        $('#project_id_drop').attr("data-toggle", "dropdown");
                        $('#Dropdown_project').dropdown('toggle');
                    }
                    else if (data.length == 0) {
                        $('#project_id_drop').attr("data-toggle", "");
                    }
                    $.each(data, function (key,value) {
                        if (data.length >= 0)
                            $('#Dropdown_project').append('<a href="#" class ="drop-down-hover"><li id='+value['id']+' class="li-dropdown" role="presentation" >' + value['project_number'] + '</li></a>');
                    });
                    $('ul.txtsearch_project').on('click', 'li', function () {
                        $('#project_id').val(this.id);
                        $('#project_id_drop').val($(this).text());
                    });
                }
            });
    });
    
    function drop_down_project(){
        var client = $('#client_id').val();
        var text = $('#project_id_drop').val();
        var url = "<?php echo base_url(); ?>works/get_autosearch_project?client="+client+"&project="+text;
        $.ajax({
            type: "GET",
            url: url, 
            dataType: "json",
            cache:false,
            success: 
            function(data){
                console.log(data);
                if (data.length > 0) {
                    $('#Dropdown_project').parent().closest('div').removeClass('open');
                    $('#Dropdown_project').empty();
                    $('#project_id_drop').attr("data-toggle", "dropdown");
                    $('#Dropdown_project').dropdown('toggle');
                }
                else if (data.length == 0) {
                    $('#project_id_drop').attr("data-toggle", "");
                }
                $.each(data, function (key,value) {
                    if (data.length >= 0)
                        $('#Dropdown_project').append('<a href="#" class ="drop-down-hover"><li id='+value['id']+' class="li-dropdown" role="presentation" >' + value['project_number'] + '</li></a>');
                        
                });
                $('ul.txtsearch_project').on('click', 'li', function () {
                    $('#project_id').val(this.id);
                    $('#project_id_drop').val($(this).text());
                });
            }
        });
    }
    
    function viewData(id){
        var url = "<?php echo base_url(); ?>works/get_work_id?id=" + id;
            $.ajax({
            type: "GET",
            url: url, 
            dataType: "text",  
            cache:false,
            success: 
                function(data){
                    $( "#add_worker" ).empty();
                    var work = jQuery.parseJSON(data);
                    $('#work_id').val(work['work'][0]['id']);
                    $('#project_id_drop').val(work['work'][0]['project_number']);
                    $('#house').val(work['work'][0]['house_id']);
                    get_room(work['work'][0]['room_id']);
                    $('#room').val(work['work'][0]['room_id']);
                    $('#client_id').val(work['work'][0]['client_id']);
                    $('#offer_id').val(work['work'][0]['offer_id']);
                    $('#auto_client').val(work['work'][0]['client_name']);
                    $('#auto_offer').val(work['work'][0]['offer_number']);
                    $('#work_type').val(work['work'][0]['work_type_id']);
                    $('#auto_work').val(work['work'][0]['sub_title']);
                    $('#sub_work_id').val(work['work'][0]['sub_work_id']);
                    $('.work_number').val(work['work'][0]['work_number']);
                    $('#work_number').val(work['work'][0]['work_number']);
                    $('#scaffold_number').val(work['work'][0]['rental_number']);
                    $('#suppervisor_drop').val(work['work'][0]['supervisor_id']);
                    $('#client_work_number').val(work['work'][0]['client_number']);
                    for(i=0; i<work['workers'].length; i++){
                        var id = work['workers'][i]['worker_id'];
                        $( "#add_worker" ).append( "<div class='col-sm-6 col-sm-offset-2 add_input_work' id='select_box"+i+"' ><?php get_workers_dropdown(); ?></div>" );
                        $('#select_box'+i).find('select').val(id);
                    }

                    var html = [
                    '<table width="100%" class="table table-striped table-bordered">',
                        '<tr>',
                            '<td></td>',
                            '<td>Type</td>',
                            '<td>m2</td>',
                            '<td>Cost Total</td>',
                            '<td>Offer Total</td>',
                        '</tr>'
                    ];

                    for (var i = 0; i < work['works_in_offer'].length; i ++) {
                        var checked = (work['works_in_offer'][i].id == work['work'][0]['parent_work_id']) ? 'checked="checked"' : '';
                        html = html.concat([
                            '<tr>',
                                '<td><input type="radio" name="offer_work_id" value="' + work['works_in_offer'][i].id + '" '+checked+'></td>',
                                '<td>' + work['works_in_offer'][i].work_type + '</td>',
                                '<td>' + work['works_in_offer'][i].m2 + '</td>',
                                '<td>' + work['works_in_offer'][i].m2 * work['works_in_offer'][i].price_m2 + '</td>',
                                '<td>' + work['works_in_offer'][i].m2 * work['works_in_offer'][i].price_m2 + '</td>',
                            '</tr>'
                        ]);
                    }

                    html = html.concat(['</table>']);

                    $('#work_multiple_of_offer').html(html.join(""));
                }
            });
    }
    function get_room(room_id){
        var parent_id = $('#house').val();
        var url = "<?php echo base_url() ?>offers/get_room_of_house?house_id="+parent_id;
        $.ajax({
            type: "GET",
            url: url, 
            dataType: "text",  
            cache:true,
            success: 
                function(data){
                    $('#room').empty();
                    var data_room = jQuery.parseJSON(data);                        
                    $.each(data_room, function (key,value) {
                        if(value['id'] == room_id){
                            $('#room').append("<option value="+value['id']+" selected>"+value['name']+"</option>");
                        }else{
                            $('#room').append("<option value="+value['id']+">"+value['name']+"</option>");
                        }
                        
                    });
                }
            });
    }
    $('#house').change(function(){
    var parent_id = $('#house').val();
    var url = "<?php echo base_url() ?>offers/get_room_of_house?house_id="+parent_id;
    $.ajax({
        type: "GET",
        url: url, 
        dataType: "text",  
        cache:true,
        success: 
            function(data){
                $('#room').empty();
                var data_room = jQuery.parseJSON(data);                        
                $.each(data_room, function (key,value) {
                    $('#room').append("<option value="+value['id']+">"+value['name']+"</option>");
                });
            }
        });
    });

    $( document ).ready(function() {
        $('.scaffold_number').hide();
        $('.rental_number').show();
    });

</script>
   