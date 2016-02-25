<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 * @package     CodeIgniter 2.2.0
 *
 * @module      auth
 * @view        reset_password
 */
?>  
        <div class="portal-form portal-login">
            <h3><?php _e( _i18n( 'Reset Your Password', 'mod_auth' ) ); ?></h3>
            <p><?php _e( _i18N( 'To verify your password, please enter it once in each field below.', 'mod_auth' ) ); ?></p>
            <p><?php _e( _i18n( 'Passwords are case-sensitive and must be at least 8 characters long. A good password should contain a mix of capital and lower-case letters, numbers and symbols.', 'mod_auth' ) ); ?></p>

            <?php $this->logtrino_ui->_message(); ?>

            <?php
            $form_params = 'reset_tok=' . $reset_tok . '&uid=' . $user_id . '&email=' . urlencode( $email );
            ?>

            <?php echo form_open( 'auth/reset_password?' . $form_params, array(
                                'role'   => 'form',
                                'name'   => 'reset_password_form',
                                'id'     => 'reset_passowrd_form',
                                'class'  => 'form form-recovery'
                            )
                        );
            ?>
                <div class="form-group">
                    <label for="password"><?php _e( _i18n( 'Enter new password', 'mod_auth' ) ); ?>:</label>
                    <input type="password" class="form-control" id="password" name="password" style="width: 300px;">
                </div>

                <div class="form-group">
                    <label for="re_password"><?php _e( _i18n( 'Re-enter new password', 'mod_auth' ) ); ?>:</label>
                    <input type="password" class="form-control" id="re_password" name="re_password" style="width: 300px;">
                </div>

                <div class="form-group"> 
                    <button type="submit" class="btn btn-primary"><?php _e( _i18n( 'Reset Password', 'mod_auth' ) ); ?></button>
                </div>
            <?php echo form_close(); ?>
        </div>
<?php 
/* End */
/* Location: `application/modules/auth/views/reset_password.php` */
?>