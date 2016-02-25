<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 * @package     CodeIgniter 2.2.0
 *
 * @module      auth
 * @view        forgot_username
 */
?>  
        <div class="portal-form portal-login">
            <div class="row">
                <div class="col-xs-12 col-form col-st">
                    <div class="col-md-12">
                        <?php echo form_fieldset(); ?>
                            <legend><?php _e( _i18n( 'Forgot Username?', 'mod_auth' ) ); ?></legend>

                            <?php $this->logtrino_ui->_message(); ?>

                            <p class="description"><?php _e( _i18n( 'Please enter your email address and follow the instructions.', 'mod_auth' ) ); ?></p>

                            <?php echo form_open( 'auth/forgot_username', array(
                                                'role'   => 'form',
                                                'name'   => 'forgot_username_form',
                                                'id'     => 'forgot_username_form',
                                                'class'  => 'form form-recovery'
                                            )
                                        ); 
                            ?>
                                <div class="form-group">
                                    <input type="text" class="<?php echo field_class( 'email', 'form-control' ); ?>" id="email" name="email">
                                    <div class="error-text" id="email_field_error"><?php echo form_error( 'email' ); ?></div>
                                </div>
                                
                                <div class="form-group form-actions"> 
                                    <button type="submit" class="btn btn-primary"><?php _e( _i18n( 'Submit' ) ); ?></button>
                                </div>
                            <?php echo form_close(); ?>

                        <?php echo form_fieldset_close(); ?>
                    </div>
                </div>
            </div>

        </div>
<?php 
/* End */
/* Location: `application/modules/auth/views/forgot_username.php` */
?>