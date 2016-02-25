<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 * @package     CodeIgniter 2.2.0
 * @module      users_module
 * @view        edit_username
 */
?>      
            <div class="container">
                <div class="row">
                    <div class="col-xs-8 col-form col-st">
                        
                        <?php $this->logtrino_ui->_message(); ?>

                        <?php
                        echo form_open( 'users/edit_username/' . $user->get_id(), 
                            array(
                                    'role'   => 'form',
                                    'name'   => 'edit_username_form',
                                    'id'     => 'edit_username_form',
                                    'class'  => 'form-horizontal'
                                )
                            ); 
                        ?>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="current_password">Current Username</label>
                            <div class="col-md-5">
                                <span class="current-username"><?php echo $user->get_username(); ?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="username">New Username</label>
                            <div class="col-md-5">
                                <input type="text" class="<?php echo field_class( 'username', 'form-control' ); ?>" id="username" name="username" value="<?php echo set_value( 'username' ); ?>">
                                <div class="error-text" id="username_field_error"><?php field_error( 'username' ); ?></div>
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
/* Location: `application/modules/users/views/edit_username.php` */
?>