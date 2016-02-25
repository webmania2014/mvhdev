<div class="container">
    <div class="row">
       
            
            <!-- Works Queue -->
            
            
            
            <!-- End Works Queue -->
            
       
        <div class="col-md-12 col-xs-12 col-form col-st">                        
            <div class="panel panel-sky">
                <div class="panel-heading">
                    <h4>End Work</h4>
                    <div class="options">   
                        <a href="javascript:;"><i class="fa fa-cog"></i></a>
                        <a href="javascript:;"><i class="fa fa-wrench"></i></a>
                        <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                    </div>
                </div>
                <div class="panel-body collapse in">
            
                    <form action="<?php echo base_url();?>works/end_work" class="form-horizontal row-border" method="POST">
                        <div class="form-group">
                        <input type="hidden" id="work_id" name="work_id" value="<?php echo $work['work'][0]->id; ?>"/>
                            <label class="col-sm-2 control-label">Client</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" value="<?php echo $work['work'][0]->client_name; ?>" onclick="drop_down_client();" placeholder="" autocomplete="off" id="auto_client" name="auto_client">
                                <i class="fa fa-angle-down pull-right"  style="margin-top: -25px; margin-right: 10px;"></i>
                                <input type="hidden" name="client_id" id="client_id" value="<?php echo $work['work'][0]->client_id; ?>"/>
                                <ul class="dropdown-menu txtsearch_client" style="width:95%;margin-right: 8px; " role="menu" aria-labelledby="dropdownMenu"  id="Dropdown_client">
                                </ul>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Project</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" onclick="drop_down_project();" placeholder="" autocomplete="off" id="project_id_drop" name="project_id_drop" value="<?php echo $work['work'][0]->project_id; ?>"/>
                                <i class="fa fa-angle-down pull-right" style="margin-top: -25px; margin-right: 10px;"></i>
                                <input type="hidden" name="project_id" id="project_id" value="<?php echo $work['work'][0]->project_id; ?>"/>
                                <ul class="dropdown-menu txtsearch_project" style="width:95%;margin-right: 8px;" role="menu" aria-labelledby="dropdownMenu"  id="Dropdown_project">
                                </ul>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Work</label>
                            <div class="col-sm-3">
                                <?php get_type_work_dropdown($work['work'][0]->work_type_id); ?>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" onclick="drop_down_work();" placeholder="" autocomplete="off" id="auto_work" name="auto_work">
                                <i class="fa fa-angle-down pull-right" style="margin-top: -25px; margin-right: 10px;"></i>
                                <input type="hidden" name="sub_work_id" id="sub_work_id" value="<?php echo $work['work'][0]->sub_work_id; ?>"/>
                                <ul class="dropdown-menu txtsearch_work" style="width:90%; margin-right: 9px; " role="menu" aria-labelledby="dropdownMenu"  id="Dropdown_work">
                                </ul>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Work Number</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control work_number" name="work_number" disabled="true" value="<?php echo $work['work'][0]->work_number; ?>" />
                                <input type="hidden" class="form-control work_number" id="work_number"  name="work_number" value="<?php echo $work['work'][0]->work_number; ?>" />
                            </div>
                        </div>
                        
                        <div class="form-group rental_number">
                            <label class="col-sm-2 control-label">Rental Number</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control rental_number" name="rental_number" disabled="true" value="<?php echo $work['work'][0]->rental_number; ?>" />
                                <input type="hidden" class="form-control" id="rental_number" name="rental_number" value="<?php echo $work['work'][0]->rental_number; ?>" />
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Area</label>
                            <div class="col-sm-3">
                                <?php get_house_dropdown($work['work'][0]->house_id); ?>
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control" name="room" id="room">
                                    <option>Please choose house</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Client work number</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="client_work_number" name="client_work_number" disabled="true" />
                            </div>
                        </div>
                        <div class="form-group" >
                        <label class="col-sm-2 control-label">Workers</label>
                        <div class="col-sm-6">
                            <?php get_workers_dropdown(); ?>
                        </div>
                        <div class="col-sm-2"><a class="btn btn-primary" onclick="add_worker();">Add</a></div>
                        <?php if(isset($workers)): ?>
                            <?php foreach($workers as $worker): ?>
                                    <div class="col-sm-6 col-sm-offset-2 add_input_work">
                                        <?php  get_workers_dropdown($worker->worker_id); ?>
                                    </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <div class="" id="add_worker"></div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Supervisor</label>
                            <div class="col-sm-6">
                                <?php get_suppervisors_dropdown($work['work'][0]->supervisor_id); ?>
                            </div>
                        </div>   
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="date_will_end">Date</label>
                            <div class="col-md-6">
                                <div id="date_will_end_date_picker">
                                    <div class="input-group date" id="datepicker">
                                        <input type="text" required="required" class="form-control parsley-validated" id="date_will_end" name="date_will_end"/>
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Calculation method</label>
                            <div class="col-sm-3">
                                <select class="form-control" name="cal">
                                    <option value="1">m2</option>
                                    <option value="2">m3</option>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Size</label>
                            <div class='col-sm-6'>
                                <div class='col-md-4'><input type='text' name='lenght[]' class='form-control' placeholder='Length' /></div>
                                <div class='col-md-4'><input type='text' name='width[]' class='form-control' placeholder='Width' /></div>
                                <div class='col-md-4'><input type='text' name='height[]' class='form-control' placeholder='Height' /></div>
                            </div>
                            <div class="col-sm-2"><a class="btn btn-primary" onclick="add_size();">Add</a></div>
                            <?php if(isset($sizes)):?>
                             <div class='col-sm-6 col-sm-offset-2 add_input_work'>
                                <?php foreach($sizes as $size): ?>
                                    <div class='col-md-4'><input type='text' name='lenght[]' class='form-control' placeholder='Length' value="<?php echo $size->lenght;?>" /></div>
                                    <div class='col-md-4'><input type='text' name='width[]' class='form-control' placeholder='Width' value="<?php echo $size->width;?>"/></div>
                                    <div class='col-md-4'><input type='text' name='height[]' class='form-control' placeholder='Height' value="<?php echo $size->height;?>"/></div>
                                <?php endforeach; ?>
                             </div>
                            <?php endif; ?>
                            <div id="add_size"></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Materials</label>
                            <div class='col-sm-6'>
                                <div class='col-md-6'>
                                    <select name='material[]' class='form-control'>
                                        <option value='1'>Flame safe foil</option>
                                        <option value='2'>Normal foil</option>
                                        <option value='3'>Safety net</option>
                                    </select>
                                </div>
                                <div class='col-md-6'><input type='text' name='m2[]' class='form-control'/></div>
                    
                            </div>
                            <div class="col-sm-2"><a class="btn btn-primary" onclick="add_material();">Add</a></div>
                            <div id="add_material"></div>
                        </div>
                        
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-2">
                                <div class="btn-toolbar">
                                    <button class="btn-primary btn" name="action" value="Save work" onclick="javascript:$('#validate-form').parsley( 'validate' );">End work</button>
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
    function add_material(){
        $( "#add_material" ).append("<div class='col-sm-6 col-sm-offset-2 add_input_work'><div class='col-md-6'><select name='material[]' class='form-control'><option value='1'>Flame safe foil</option> <option value='2'>Normal foil</option><option value='3'>Safety net</option></select> </div><div class='col-md-6'><input type='text' name='m2[]' class='form-control'/></div></div>");
    }
    function add_worker(){
        $( "#add_worker" ).append( "<div class='col-sm-6 col-sm-offset-2 add_input_work'><?php get_workers_dropdown(); ?></div>" );
    }
    
    function add_size(){
        $( "#add_size" ).append("<div class='col-sm-6 col-sm-offset-2 add_input_work'><div class='col-md-4'><input type='text' name='lenght[]' class='form-control' placeholder='Length' /></div><div class='col-md-4'><input type='text' name='width[]' class='form-control' placeholder='Width' /></div><div class='col-md-4'><input type='text' name='height[]' class='form-control' placeholder='Height' /></div></div>");
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
        var room_id = "<?php echo $work['work'][0]->room_id; ?>";
        console.log(room_id);
        get_room(room_id);
    });
</script>
   