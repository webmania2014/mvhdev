<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 * @package     CodeIgniter 2.2.0

 *
 * @module      users_module
 * @view        admin/create
 */
?>      
    
            <div class="container">
                <div class="row">
                    <div class="col-xs-8 col-form col-st">
                        
                        <?php $this->logtrino_ui->_message(); ?>

                        <?php
                        echo form_open( 'users/create_new_admin', 
                            array(
                                    'role'   => 'form',
                                    'name'   => 'new_admin_form',
                                    'id'     => 'new_admin_form',
                                    'class'  => 'form-horizontal'
                                )
                            ); 
                        ?>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="first_name">First Name</label>
                            <div class="col-md-8">
                                 <input type="text" class="<?php echo field_class( 'first_name', 'form-control' ); ?>" id="first_name" name="first_name" value="<?php echo set_value( 'first_name' ); ?>">
                                <div class="error-text" id="first_name_field_error"><?php field_error( 'first_name' ); ?></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="last_name">Last Name</label>
                            <div class="col-md-8">
                                <input type="text" class="<?php echo field_class( 'last_name', 'form-control' ); ?>" id="last_name" name="last_name" value="<?php echo set_value( 'last_name' ); ?>">
                                <div class="error-text" id="last_name_field_error"><?php field_error( 'last_name' ); ?></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="username">Username</label>
                            <div class="col-md-8">
                                <input type="text" class="<?php echo field_class( 'username', 'form-control' ); ?>" id="username" name="username" value="<?php echo set_value( 'username' ); ?>">
                                <div class="error-text" id="last_name_field_error"><?php field_error( 'username' ); ?></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="email_address">Email Address</label>
                            <div class="col-md-8">
                                <input type="text" class="<?php echo field_class( 'email_address', 'form-control' ); ?>" id="email_address" name="email_address" value="<?php echo set_value( 'email_address' ); ?>">
                                <div class="error-text" id="email_address_field_error"><?php field_error( 'email_address' ); ?></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label">Status</label>
                            <div class="col-md-2">
                                <select class="form-control" name="active">
                                    <option value="1"<?php echo set_select( 'active', '1', TRUE ); ?>>Active</option>
                                    <option value="0"<?php echo field_selected( 'active', '0' ); ?>>In-active</option>
                                </select>                             
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="password">Password</label>
                            <div class="col-md-8">
                                <input type="password" class="<?php echo field_class( 'password', 'form-control' ); ?>" id="password" name="password">
                                <div class="error-text" id="password_field_error"><?php field_error( 'password' ); ?></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="re_password">Re-enter Password</label>
                            <div class="col-md-8">
                                <input type="password" class="<?php echo field_class( 're_password', 'form-control' ); ?>" id="re_password" name="re_password">
                                <div class="error-text" id="re_password_field_error"><?php field_error( 're_password' ); ?></div>
                            </div>
                        </div>

                        <div class="form-group clearfix form-actions">
                            <div class="col-md-10">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-danger" onclick="window.location='<?php echo site_url( 'users/profile' ); ?>';return false;">Cancel</button>
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