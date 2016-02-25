<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 * @package     CodeIgniter 2.2.0
 *
 * @module      auth
 * @view        activation_failed
 */
?>
    <div class="portal-form portal-login">
		<div class="row">
            <div class="col-xs-6 col-form col-st no-padd-left">
                <h3><?php _e( _i18n( 'Account activation was not completed.', 'mod_auth' ) ); ?></h3>
                
                <?php $this->logtrino_ui->_message(); ?>

                <div class="border-box resend-activation-form">
                    <p><?php _e( _i18n( 'Activation code is not valid or expired.', 'mod_auth' ) ); ?></p>
                    <p><strong><?php _e( _i18n( 'Please enter your email to resend activation request.', 'mod_auth' ) ); ?></strong></p>

                    <?php echo form_open( 'auth/activation/resubmit', array(
                                        'role'   => 'form',
                                        'name'   => 'resend_activation',
                                        'id'     => 'resend_activation',
                                        'class'  => 'form'
                                    ) 
                                );
                    ?>
                        <div class="form-group">
                            <input type="text" name="email" class="<?php echo field_class( 'email', 'form-control' ); ?>" id="email" />
                            <div class="error-text" id="email_field_error"><?php echo form_error( 'email' ); ?></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-success"><?php _e( _i18n( 'Resend', 'mod_auth' ) ); ?></button>
                        </div>
                    <?php echo form_close(); ?>
                   
                    <h3>Don't have an account? <?php echo anchor( 'auth/register', _i18n( 'Sign up' ) ); ?></h3>
                </div>
            </div>

			<div class="col-xs-6 col-form col-st no-padd-right">
                <h3><?php _e( _i18n( 'Already have an account ?', 'mod_auth' ) ); ?></h3>
                <div class="border-box">
                    
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
/* Location: `application/modules/auth/views/activation_failed.php` */
?>