<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 * @package     CodeIgniter 2.2.0
 * @module      users_module
 * @view        reset_password
 */
?>      

            <div class="container">
                <div class="row">
                    <div class="col-xs-8 col-form col-st">
                        
                        <?php $this->logtrino_ui->_message(); ?>

                        <?php
                        echo form_open( 'users/reset_password/' . $user->get_id(), 
                            array(
                                    'role'   => 'form',
                                    'name'   => 'reset_password_form',
                                    'id'     => 'reset_password_form',
                                    'class'  => 'form-horizontal'
                                )
                            ); 
                        ?>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="current_password">Current Password</label>
                            <div class="col-md-5">
                                <input type="password" class="<?php echo field_class( 'current_password', 'form-control' ); ?>" id="current_password" name="current_password">
                                <div class="error-text" id="current_password_field_error"><?php field_error( 'current_password' ); ?></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="password">New Password</label>
                            <div class="col-md-5">
                                <input type="password" class="<?php echo field_class( 'password', 'form-control' ); ?>" id="password" name="password">
                                <div class="error-text" id="password_field_error"><?php field_error( 'password' ); ?></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="re_password">Re-enter Password</label>
                            <div class="col-md-5">
                                <input type="password" class="<?php echo field_class( 're_password', 'form-control' ); ?>" id="re_password" name="re_password">
                                <div class="error-text" id="re_password_field_error"><?php field_error( 're_password' ); ?></div>
                            </div>
                        </div>

                        <div class="form-group clearfix form-actions">
                            <div class="col-md-7">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-danger" onclick="window.location='<?php echo site_url( 'users/profile/' . $user->get_id() . '/' . $user->get_username() ); ?>';return false;">Cancel</button>
                                <input type="hidden" name="user" value="<?php echo $user->get_id(); ?>" />
                            </div>
                        </div>

                        <?php echo form_close(); ?>

                    </div>
                </div>
            </div>
    
		
<?php 
/* End */
/* Location: `application/modules/users/views/reset_password.php` */
?>