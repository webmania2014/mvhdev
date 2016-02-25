<div class="container">
<div class="row">
  <div class="col-md-6">
        <div class="panel panel-sky">
            <div class="panel-heading">
                <h4>Workers</h4>
                <div class="options">   
                    <a href="javascript:;"><i class="fa fa-cog"></i></a>
                    <a href="javascript:;"><i class="fa fa-wrench"></i></a>
                    <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                </div>
            </div>
            <div class="panel-body collapse in">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="example">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Tax number</th>
                            <th>Phone number</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($workers)): ?>
                            <?php foreach($workers as $worker): ?>
                                <tr onclick="viewData(<?php echo $worker->id;  ?>);">
                                    <td><?php echo $worker->first_name . ' ' . $worker->last_name; ?></td>
                                    <td><?php echo $worker->tax_number; ?></td>
                                    <td><?php echo $worker->phone; ?></td>
                                    <td><?php echo $worker->email; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" style="text-align: center;">No found resutls.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- edit panel -->
    <div class="col-md-6">
    <div class="panel panel-sky">
        <div class="panel-heading">
            <h4>Create/Edit worker</h4>
            <div class="options">   
                <a href="javascript:;"><i class="fa fa-cog"></i></a>
                <a href="javascript:;"><i class="fa fa-wrench"></i></a>
                <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
            </div>
        </div>
        <div class="panel-body collapse in" style="display: block;">

            <?php
            echo form_open_multipart( 'workers/process', 
                array(
                        'role'   => 'form',
                        'id'     => 'validate-form',
                        'class'  => 'form-horizontal row-border',
                        'data-validate'=>'parsley'
                    )
                ); 
            ?>
            <div class="form-group">
                <label class="col-md-2 control-label" for="first_name">First Name</label>
                <div class="col-md-8">
                     <input type="text" required="required" class="form-control parsley-validated" id="first_name" name="first_name" value="<?php echo set_value( 'first_name' ); ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label" for="last_name">Last Name</label>
                <div class="col-md-8">
                    <input type="text" required="required" class="form-control parsley-validated" id="last_name" name="last_name" value="<?php echo set_value( 'last_name' ); ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label" for="sub_contractor">Sub-contractors</label>
                <div class="col-md-6">
                    <?php get_subcontractor_drop_down(); ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Type of worker</label>
                <div class="col-md-6">
                    <?php get_worker_types_dropdown(); ?>                           
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label" for="tax_number">Tax number</label>
                <div class="col-md-8">
                    <input type="text" data-type="digits" placeholder="Digits only" required="required" class="form-control parsley-validated" id="tax_number" name="tax_number" value="<?php echo set_value( 'tax_number' ); ?>"/>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label" for="finish_id">Finish ID</label>
                <div class="col-md-8">
                    <input type="text" data-type="digits" placeholder="Digits only" required="required" class="form-control parsley-validated" id="finish_id" name="finish_id" value="<?php echo set_value( 'tax_number' ); ?>"/>
                </div>
            </div>
            <!-- begin card -->
            <div class="form-group">
                <label class="col-md-2 control-label" for="green_card_number">Green card number</label>
                <div class="col-md-8">
                    <input type="text" data-type="digits" placeholder="Digits only" required="required" class="form-control parsley-validated" id="green_card_number" name="green_card_number" value="<?php echo set_value( 'green_card_number' ); ?>"/>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label" for="green_card_number">Green card expired date</label>
                <div class="col-md-6">
                    <div id="green_date_picker">
                        <div class="input-group date" id="datepicker" data-date-format="mm/yyyy">
                            <input type="text"  class="form-control" name="green_date_picker" id="green_card_exp"/>
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="green_card_number">Green card attach picture</label>
                <div class="col-md-6">
                    <div class="fileinput fileinput-new" data-provides="fileinput" id="display_image_exist_att_pic_green">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                        <div>
                          <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span>
                          <span class="fileinput-exists">Change</span>
                          <input type="file" name="green_att_pic" id="green_att_pic"/></span>
                          <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                    </div>
                    <img src="" class="display_image_exist" style="width: 200px; height: 150px;" id="display_image_exist_green_card" />
                    <a class="green_button_delete_pic btn btn-danger" onclick="deletePicture('green_card_picture')" >Delete</a>
                </div>
            </div>
            <!-- end card -->
            
            <!-- begin card -->
            <div class="form-group">
                <label class="col-md-2 control-label" for="blue_card_number">Blue card number</label>
                <div class="col-md-8">
                    <input type="text" data-type="digits" placeholder="Digits only" class="form-control parsley-validated" id="blue_card_number" name="blue_card_number" value="<?php echo set_value( 'blue_card_number' ); ?>"/>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label" for="blue_card_number">Blue card expired date</label>
                <div class="col-md-6">
                    <div id="green_date_picker">
                        <div class="input-group date" id="datepicker" data-date-format="mm/yyyy">
                            <input type="text"  class="form-control " id="blue_card_exp" name="blue_date_picker"/>
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="blue_card_number">Blue card attach picture</label>
                <div class="col-md-6">
                    <div class="fileinput fileinput-new" data-provides="fileinput" id="display_image_exist_att_pic_blue">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                        <div>
                          <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span>
                          <span class="fileinput-exists">Change</span>
                          <input type="file" name="blue_att_pic" id="blue_att_pic"/></span>
                          <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                    </div>
                    <img src="" class="display_image_exist" style="width: 200px; height: 150px;" id="display_image_exist_blue_card" />
                    <a class="blue_button_delete_pic btn btn-danger" onclick="deletePicture('blue_card_picture')" >Delete</a>
                </div>
            </div>
            <!-- end card -->
            
            <div class="form-group">
                <label class="col-md-2 control-label" for="email_address">Email Address</label>
                <div class="col-md-8">
                    <input type="text" data-type="email" placeholder="Email address" required="required" class="form-control parsley-validated" id="email_address" name="email_address" autocomplete="off"/> 
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label" for="password">Password</label>
                <div class="col-md-8">
                    <input type="password"  required="required" class="form-control parsley-validated" id="password" name="password" autocomplete="off"/> 
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label" for="phone_number">Phone number</label>
                <div class="col-md-8">
                    <input type="text" data-type="phone" placeholder="(XXX) XXXX XXX" required="required" class="form-control parsley-validated" id="phone_number" name="phone_number" value="<?php echo set_value( 'phone_number' ); ?>"/>
                </div>
            </div>
            <!-- begin card -->
            <div class="form-group">
                <label class="col-md-2 control-label" for="valtti_kortti">Valtti kortti</label>
                <div class="col-md-8">
                    <input type="text" data-type="digits" placeholder="Digits only" required="required" class="form-control parsley-validated" id="valtti_kortti" name="valtti_kortti" value="<?php echo set_value( 'valtti_kortti' ); ?>"/>         
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="valtti_kortti">Valtti kortti exp</label>
                <div class="col-md-6">
                    <div id="valtti_kortti_date_picker">
                        <div class="input-group date" id="datepicker" data-date-format="mm/yyyy">
                            <input type="text"  class="form-control" id="valtti_kortti_exp" name="valtti_kortti_date_picker"/>
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="valtti_kortti_att_pic">Valtti kortti attach picture</label>
                <div class="col-md-6">
                    <div class="fileinput fileinput-new" data-provides="fileinput" id="valtti_kortti_att_pic_image">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                        <div>
                          <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span>
                          <span class="fileinput-exists">Change</span>
                          <input type="file" name="valtti_kortti_att_pic"/></span>
                          <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                    </div>
                    <img src="" class="display_image_exist" style="width: 200px; height: 150px;" id="display_image_exist_valtti_kortti" />
                    <a class="valtti_kortti_button_delete_pic btn btn-danger" onclick="deletePicture('valtti_picture')" >Delete</a>
                </div>
            </div>
            <!-- end card -->
            <div class="form-group">
                <label class="col-md-2 control-label" for="accidenttti">Contact in case of accidenttti</label>
                <div class="col-md-8">
                    <input type="text" required="required" class="form-control parsley-validated" id="accidenttti" name="accidenttti" value="<?php echo set_value( 'accidenttti' ); ?>"/>
                   
                </div>
             </div> 
             <div class="form-group">
                <label class="col-md-2 control-label" for="accidenttti">Phone of accidenttti</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" id="phone_accidenttti" name="phone_accidenttti" required="required" class="form-control parsley-validated"/>
                    </div>
                </div>
              </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label" for="local_address">Local Address</label>
                <div class="col-md-8">
                    <input type="text" required="required" class="form-control parsley-validated"  id="local_address" name="local_address" value="<?php echo set_value( 'local_address' ); ?>"/>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label" for="home_address">Home Address</label>
                <div class="col-md-8">
                    <input type="text" required="required" class="form-control parsley-validated" id="home_address" name="home_address" value="<?php echo set_value( 'home_address' ); ?>"/>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label" for="picture_worker">Picture</label>
                <div class="col-md-6">
                    <div class="fileinput fileinput-new" data-provides="fileinput" id="att_pic_image">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                        <div>
                          <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span>
                          <span class="fileinput-exists">Change</span>
                          <input type="file" name="picture_worker"/></span>
                          <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                    </div>
                    <img src="" class="display_image_exist" style="width: 200px; height: 150px;" id="display_image_exist" />
                    <a class="att_button_delete_pic btn btn-danger" onclick="deletePicture('picture_worker')" >Delete</a>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label" for="hour_price">Hour price 1</label>
                <div class="col-md-8">
                    <input type="text" data-type="digits" placeholder="Digits only" required="required" class="form-control parsley-validated" id="hour_price1" name="hour_price1" value="<?php echo set_value( 'hour_price' ); ?>"/>
                    
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="hour_price">Hour price 2</label>
                <div class="col-md-8">
                    <input type="text" data-type="digits" placeholder="Digits only" required="required" class="form-control parsley-validated" id="hour_price2" name="hour_price2" value="<?php echo set_value( 'hour_price' ); ?>"/>
                    
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="hour_price">Hour price 3</label>
                <div class="col-md-8">
                    <input type="text" data-type="digits" placeholder="Digits only" required="required" class="form-control parsley-validated" id="hour_price3" name="hour_price3" value="<?php echo set_value( 'hour_price' ); ?>"/>
                    <input type="hidden" id="worker_id" name="worker_id" />
                </div>
            </div>
            <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-6">
                        <input type="checkbox" class="" id="is_active" name="is_active"/><span class="text_work_need">Active</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Comment</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="comment" name="comment" rows="5" ></textarea>
                    </div>
                </div>
            </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-2">
                    <div class="btn-toolbar">
                        <button class="btn-primary btn" onclick="javascript:$('#validate-form').parsley( 'validate' );">Submit</button>
                        <button class="btn-default btn" onclick="window.location='<?php echo site_url( 'workers' ); ?>';return false;">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
            <?php echo form_close(); ?>
        </div>
    </div>
    <!-- end edit panel -->
</div>

</div> <!-- container -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
function viewData(id){
var url = "<?php echo base_url(); ?>workers/get_worker_by_id?id=" + id;
    $.ajax({
    type: "GET",
    url: url, 
    dataType: "text",  
    cache:false,
    success: 
        function(data){
            var worker = jQuery.parseJSON(data);
            $('#source').val(worker['type_of_work_id'])
            $('#first_name').val(worker['first_name']);
            $('#worker_id').val(worker['id']);
            $('#last_name').val(worker['last_name']);
            $('#sub_contractor').val(worker['sub_contractor_id']);
            $('#password').val(worker['password']);
            $('#tax_number').val(worker['tax_number']);
            $('#finish_id').val(worker['finish_id']);
            $('#green_card_number').val(worker['green_card_number']);
            var green_card_exp = formatDate(worker['green_card_exp_date']);
            $('#green_card_exp').val(green_card_exp);
            if(worker['green_card_picture'] != ''){
                $('#display_image_exist_att_pic_green').hide();
                $( "#display_image_exist_green_card").attr("src", worker["green_card_picture"]) ;
                $( "#display_image_exist_green_card" ).show();
                $('.green_button_delete_pic').show();
            }else{
                $('#display_image_exist_att_pic_green').show();
                $('#display_image_exist_green_card').hide();
                $('.green_button_delete_pic').hide();
            }
            $('#blue_card_number').val(worker['blue_card_number']);
            var blue_card_exp = formatDate(worker['blue_card_exp_date']);
            $('#blue_card_exp').val(blue_card_exp);
            if(worker['blue_card_picture'] != ''){
                $('#display_image_exist_att_pic_blue').hide();
                $( "#display_image_exist_blue_card").attr("src", worker["blue_card_picture"]) ;
                $( "#display_image_exist_blue_card" ).show();
                $('.blue_button_delete_pic').show();
            }else{
                $('#display_image_exist_att_pic_blue').show();
                $('#display_image_exist_blue_card').hide();
                $('.blue_button_delete_pic').hide();
            }
            
            $('#email_address').val(worker['email']);
            $('#phone_number').val(worker['phone']);
            $('#valtti_kortti').val(worker['valtti_kortti']);
            if(worker['valtti_picture'] != ''){
                $( "#valtti_kortti_att_pic_image" ).hide();
                $( "#display_image_exist_valtti_kortti").attr("src", worker["valtti_picture"]) ;
                $( "#display_image_exist_valtti_kortti" ).show();
                $('.valtti_kortti_button_delete_pic').show();
            }else{
                $( "#display_image_exist_valtti_kortti" ).hide();
                $( "#valtti_kortti_att_pic_image" ).show();
                $('.valtti_kortti_button_delete_pic').hide();
            }
            var valtti_kortti_exp = formatDate(worker['valtti_exp_date']);
            $('#valtti_kortti_exp').val(valtti_kortti_exp);
            $('#valtti_kortti_att_pic').val(worker['valtti_picture']);
            $('#accidenttti').val(worker['contact_in_case_of_accidenttti']);
            $('#phone_accidenttti').val(worker['contact_phone']);
            if(worker['accidenttti_picture'] != ''){
                $( "#accidenttti_att_pic_image" ).hide();
                $( "#display_image_exist_accidenttti").attr("src", worker["accidenttti_picture"]) ;
                $( "#display_image_exist_accidenttti" ).show();
                $('.accidenttti_button_delete_pic').show();
            }else{
                $( "#display_image_exist_accidenttti" ).hide();
                $( "#accidenttti_att_pic_image" ).show();
                $('.accidenttti_button_delete_pic').hide();
            }
            $('#local_address').val(worker['local_address']);
            $('#home_address').val(worker['home_address']);
            
            if(worker['picture_worker'] != ''){
                $( '#att_pic_image').hide();
                $( "#display_image_exist").attr("src", worker["picture_worker"]) ;
                $( "#display_image_exist" ).show();
                $( '.att_button_delete_pic').show();
            }else{
                $('#att_pic_image').show();
                $('#display_image_exist').hide();
                $('.att_button_delete_pic').hide();
            }
            if(worker['active'] == 0){
                $('#is_active').prop('checked', false);
            }else{
                $('#is_active').prop('checked', true);
            }
            $('#comment').val(worker['comment']);
            $('#hour_price1').val(worker['hour_price1']);
            $('#hour_price2').val(worker['hour_price2']);
            $('#hour_price3').val(worker['hour_price3']);
        }
    });
}

function deletePicture(field_upload){
    var worker_id = $('#worker_id').val();
    var url = "<?php echo base_url(); ?>workers/delete_attach_picture?worker_id=" + worker_id + "&field_attach=" + field_upload;
    if(field_upload = 'green_card_picture'){
        $('#display_image_exist_green_card').hide();
        $('#display_image_exist_att_pic_green').show();
        $('.green_button_delete_pic').hide();
    }
    else if(field_upload = 'blue_card_picture'){
        $('#display_image_exist_blue_card').hide();
        $('#display_image_exist_att_pic_blue').show();
        $('.blue_button_delete_pic').hide();
    }
    else if(field_upload = 'valtti_picture'){
        $('#display_image_exist_valtti_kortti').hide();
        $('#valtti_kortti_att_pic_image').show();
        $('.valtti_kortti_button_delete_pic').hide();
    }
    else if(field_upload = 'accidenttti_picture'){
        $('#display_image_exist_accidenttti').hide();
        $('#display_image_exist_att_pic_accidenttti').show();
        $('.accidenttti_button_delete_pic').hide();
    }
    $.ajax({
    type: "GET",
    url: url, 
    dataType: "text",  
    cache:false,
    success: 
        function(data){
            viewData(worker_id);
        }
    });
}
function formatDate(date){
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    return [month,year].join('/');
}

$(document).ready(function(){   
    $( "#display_image_exist_valtti_kortti" ).hide();
    $('#display_image_exist_green_card').hide();
    $('#display_image_exist_blue_card').hide();
    $( "#display_image_exist_accidenttti" ).hide();
    $( "#display_image_exist" ).hide();
    $('.green_button_delete_pic').hide();
    $('.blue_button_delete_pic').hide();
    $('.valtti_kortti_button_delete_pic').hide();
    $('.accidenttti_button_delete_pic').hide();
    $('.att_button_delete_pic').hide();
});
</script>