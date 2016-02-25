<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 * @package     CodeIgniter 2.2.0
 *
 * @module      auth_module
 * @view        activation_success
 */
?>

    <div class="portal-form portal-login">
		<div class="row">
			<div class="col-xs-12 col-form col-st">
                <h3><?php _e( _i18n( 'Account activated', 'mod_auth' ) ); ?></h3>
                <hr />
               
                <div class="col-md-6 no-padd-left">
                    <!-- Login form -->
                    <?php echo form_open( 'auth/login', array(
                                'role'   => 'form',
                                'name'   => 'login_form',
                                'id'     => 'login_form',
                                'class'  => 'form login_form'
                            ),
                            array( 'continue' => urlencode( $this->input->get( 'continue' ) ) )
                        ); 
                    ?>
                        <div class="form-group">
                            <label class="control-label" for="username"><?php _e( _i18n( 'Username', 'mod_auth' ) ); ?></label>
                            <input type="text" class="<?php echo field_class( 'username', 'form-control' ); ?>" id="username" name="username">
                            <div class="error-text" id="username_field_error"><?php echo form_error( 'username' ); ?></div>        
                        </div>                      
                        <div class="form-group">
                            <label class="control-label" for="password"><?php _e( _i18n( 'Password', 'mod_auth' ) ); ?></label>
                            <input type="password" name="password" id="password" class="<?php echo field_class( 'password', 'form-control' ); ?>" />
                            <div class="error-text" id="password_field_error"><?php echo form_error( 'password' ); ?></div>
                        </div>
                        <div class="form-group actions">
                            <div class="col-xs-5 pull-left">
                                <div class="checkbox">
                                    <label><input type="checkbox" name="remember"> <?php _e( _i18n( 'Remember me', 'mod_auth' ) ); ?></label>
                                </div>
                            </div>
                            <div class="col-xs-7 pull-right">
                                <p><?php echo sprintf( 'Forgot <a href="%s">Username</a> or <a href="%s">Password</a>?', site_url( 'auth/forgot_username' ), site_url( 'auth/forgot_password' ) ); ?></p>
                                <button type="submit" class="btn btn-success btn-signin btn-lg"><?php _e( _i18n( 'Sign in' ) ); ?></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    <?php echo form_close(); ?>
                </div>
			</div>
		</div>
    </div>

<?php
/* End */
/* Location: `application/modules/auth/views/activation_success.php` */
?>