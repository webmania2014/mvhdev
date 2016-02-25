<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 * @package     CodeIgniter 2.2.0

 *
 * @module      users_module
 * @view        admin/create
 */
?>      
    
<div class="container">
    <div class="panel panel-midnightblue">
        <div class="panel-heading">
            <h4>Create worker</h4>
            <div class="options">   
                <a href="javascript:;"><i class="fa fa-cog"></i></a>
                <a href="javascript:;"><i class="fa fa-wrench"></i></a>
                <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
            </div>
        </div>
        <div class="panel-body collapse in" style="display: block;">
            
            <?php $this->logtrino_ui->_message(); ?>

            <?php
            echo form_open_multipart( 'workers/create', 
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
                <div class="col-md-8">
                    <input type="text" required="required" class="form-control parsley-validated" id="sub_contractor" name="sub_contractor" value="<?php echo set_value( 'sub_contractor' ); ?>"/>
                
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">Type of worker</label>
                <div class="col-md-3">
                    <?php get_worker_types_dropdown(); ?>                           
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label" for="tax_number">Tax number</label>
                <div class="col-md-8">
                    <input type="text" data-type="digits" placeholder="Digits only" required="required" class="form-control parsley-validated" id="tax_number" name="tax_number" value="<?php echo set_value( 'tax_number' ); ?>"/>
                    
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
                <div class="col-md-3">
                    <div id="green_date_picker">
                        <div class="input-group date" id="datepicker">
                            <input type="text" required="required" class="form-control parsley-validated" name="green_date_picker" id="green_card_exp"/>
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="green_card_number">Green card attach picture</label>
                <div class="col-md-3">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                        <div>
                          <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span>
                          <span class="fileinput-exists">Change</span>
                          <input type="file" name="green_att_pic" id="green_att_pic" /></span>
                          <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card -->
            
            <!-- begin card -->
            <div class="form-group">
                <label class="col-md-2 control-label" for="blue_card_number">Blue card number</label>
                <div class="col-md-8">
                    <input type="text" data-type="digits" placeholder="Digits only" required="required" class="form-control parsley-validated" id="blue_card_number" name="blue_card_number" value="<?php echo set_value( 'blue_card_number' ); ?>"/>
                   
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label" for="blue_card_number">Blue card expired date</label>
                <div class="col-md-3">
                    <div id="green_date_picker">
                        <div class="input-group date" id="datepicker">
                            <input type="text" required="required" class="form-control parsley-validated" name="blue_date_picker"/>
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="blue_card_number">Blue card attach picture</label>
                <div class="col-md-3">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                        <div>
                          <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span>
                          <span class="fileinput-exists">Change</span>
                          <input type="file" name="blue_att_pic"/></span>
                          <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card -->
            
            <div class="form-group">
                <label class="col-md-2 control-label" for="email_address">Email Address</label>
                <div class="col-md-8">
                    <input type="text" data-type="email" placeholder="Email address" required="required" class="form-control parsley-validated" id="email_address" name="email_address" value="<?php echo set_value( 'email_address' ); ?>"/>
                    
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
                <div class="col-md-3">
                    <div id="valtti_kortti_date_picker">
                        <div class="input-group date" id="datepicker">
                            <input type="text" required="required" class="form-control parsley-validated" name="valtti_kortti_date_picker"/>
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="valtti_kortti_att_pic">Valtti kortti attach picture</label>
                <div class="col-md-3">
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                        <div>
                          <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span>
                          <span class="fileinput-exists">Change</span>
                          <input type="file" name="valtti_kortti_att_pic"/></span>
                          <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                    </div>
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
                        <input type="text" name="phone_accidenttti" data-type="phone" placeholder="(XXX) XXXX XXX" required="required" class="form-control parsley-validated"/>
                    </div>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-md-2 control-label" for="accidenttti_att_pic">Accidenttti attach picture</label>
                <div class="col-md-6">
                    <div class="fileinput fileinput-new" data-provides="fileinput" id="accidenttti_att_pic_image">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                        <div>
                          <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span>
                          <span class="fileinput-exists">Change</span>
                          <input type="file" name="accidenttti_att_pic"/></span>
                          <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                    </div>
                    <img src="" class="display_image_exist" style="width: 200px; height: 150px;" id="display_image_exist_accidenttti" />
                    <a class="accidenttti_button_delete_pic btn btn-danger" onclick="deletePicture('accidenttti_picture')" >Delete</a>
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
                <label class="col-md-2 control-label" for="att_pic">Picture</label>
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
                    <img src="" class="display_image_exist" style="width: 200px; height: 150px;" id="display_image_exist_accidenttti" />
                    <a class="att_button_delete_pic btn btn-danger" onclick="deletePicture('picture_worker')" >Delete</a>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label" for="hour_price">Comment</label>
                <div class="col-md-8">
                    <textarea required="required" class="form-control parsley-validated" id="comment" name="comment" ></textarea>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-2 control-label" for="hour_price">Hour price</label>
                <div class="col-md-8">
                    <input type="text" data-type="digits" placeholder="Digits only" required="required" class="form-control parsley-validated" id="hour_price" name="hour_price" value="<?php echo set_value( 'hour_price' ); ?>"/>
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
</div>	
<?php 
/* End */
/* Location: `application/modules/users/views/admin/create_admin.php` */
?>