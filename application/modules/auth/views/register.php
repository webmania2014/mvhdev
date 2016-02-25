<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 * @package     CodeIgniter 2.2.0
 *
 * @module      auth
 * @view        register
 */
?>
        <div class="portal-form portal-signup">

			<div class="row">
				<div class="col-xs-12 col-form col-st">

                    <?php echo form_fieldset(); ?>
                        <legend><?php echo 'Đăng Ký'; ?></legend>

                        <?php $this->logtrino_ui->_message(); ?>

                        <p class="description"><strong><?php echo  'Vui lòng điền thông tin vào ô có dấu(<i class="asterisk-required">*</i>).'; ?></strong></p>

                        <?php echo form_open( 'auth/register', array(
                                            'role'   => 'form',
                                            'name'   => 'registration_form',
                                            'id'     => 'registration_form',
                                            'class'  => 'form'
                                        ) 
                                    ); 
                        ?>
                           
                            <div class="clearfix"></div>

                            <div class="form-group col-xs-6 no-left-padd">
                                <label for="first_name"><?php echo 'Họ'; ?> <i class="asterisk-required">*</i></label>
                                <input type="text" class="<?php echo field_class( 'first_name', 'form-control' ); ?>" id="first_name" name="first_name" value="<?php echo set_value( 'first_name' ); ?>">
                                <div class="error-text" id="first_name_field_error"><?php echo form_error( 'first_name' ); ?></div>
                            </div>
                            <div class="form-group col-xs-6 no-right-padd">
                                <label for="last_name"><?php echo 'Tên'; ?> <i class="asterisk-required">*</i></label>
                                <input type="text" class="<?php echo field_class( 'last_name', 'form-control' ); ?>" id="last_name" name="last_name" value="<?php echo set_value( 'last_name' ); ?>">
                                <div class="error-text" id="last_name_field_error"><?php echo form_error( 'last_name' ); ?></div>
                            </div>
                            <div class="clearfix"></div>

                            <div class="form-group col-xs-6 no-left-padd">
                                <label for="address"><?php echo 'Địa Chỉ'; ?> <i class="asterisk-required">*</i></label>
                                <input type="text" name="address" id="address" class="<?php echo field_class( 'address', 'form-control' ); ?>" value="<?php echo set_value( 'address', '' ); ?>" />
                                <div class="error-text" id="address_field_error"><?php echo form_error( 'address' ); ?></div>
                            </div>

                            <div class="clearfix"></div>
                                
                            <div class="form-group col-xs-6 no-left-padd">
                                <label for="telephone"><?php echo 'Số Điện Thoại'; ?> <i class="asterisk-required">*</i></label>
                                <input type="text" class="<?php echo field_class( 'telephone', 'form-control' ); ?>" id="telephone" name="telephone" value="<?php echo set_value( 'telephone' ); ?>">
                                <div class="error-text" id="telephone_field_error"><?php echo form_error( 'telephone' ); ?></div>
                            </div>

                            <div class="form-group col-xs-6 no-right-padd">
                                <label for="email_adress"><?php _e( _i18n( 'Email', 'mod_auth' ) ); ?> <i class="asterisk-required">*</i></label>
                                <input type="text" class="<?php echo field_class( 'email_address', 'form-control' ); ?>" id="email_address" name="email_address" value="<?php echo set_value( 'email_address' ); ?>">
                                <div class="error-text" id="email_address_field_error"><?php echo form_error( 'email_address' ); ?></div>
                            </div>
                            <div class="clearfix"></div>

                            <div class="form-group col-xs-6 no-left-padd">
                                <label for="postal_code"><?php echo 'Tên Đăng Nhập';; ?> <i class="asterisk-required">*</i><span class="inline-label">(<?php _e( _i18n( 'Must be at least 8 characters in length.', 'mod_auth' ) ); ?>)</label>
                                <input type="text" class="<?php echo field_class( 'username', 'form-control' ); ?>" id="username" name="username" value="<?php echo set_value( 'username' ); ?>">
                                <div class="error-text" id="username_field_error"><?php echo form_error( 'username' ); ?></div>
                            </div>
                            <div class="clearfix"></div>
                            
                            <div class="form-group col-xs-6 no-left-padd">
                                <label for="password"><?php echo 'Mật Khẩu'; ?> <i class="asterisk-required">*</i><span class="inline-label">(<?php _e( _i18n( 'Must be at least 8 characters in length.' ) ); ?>)</label>
                                <input type="password" class="<?php echo field_class( 'password', 'form-control' ); ?>" id="password" name="password">
                                <div class="error-text" id="password_field_error"><?php echo form_error( 'password' ); ?></div>
                            </div>

                            <div class="form-group col-xs-6 no-right-padd">
                                <label for="re_password"><?php echo 'Nhập Lại Mật Khẩu';; ?> <i class="asterisk-required">*</i></label>
                                <input type="password" class="<?php echo field_class( 're_password', 'form-control' ); ?>" id="re_password" name="re_password">
                                <div class="error-text" id="re_password_field_error"><?php echo form_error( 're_password' ); ?></div>
                            </div>
                            <div class="clearfix"></div>

                            <div class="form-group">
                                <label for="seq"><?php _e( _i18n( 'Please answer the question', 'mod_auth' ) ); ?> <i class="asterisk-required">*</i><span class="inline-label">(<?php _e( _i18n( 'Prove that you\'re not a bot', 'mod_auth' ) ); ?>)</span></label>
                                <div>
                                    <?php $seq_numbers = get_security_question(); ?>
                                    <span class="seq-context"><?php echo sprintf( '%s + %s', $seq_numbers['first_num'], $seq_numbers['second_num'] ); ?> = </span>
                                    <input type="text" id="seq" value="" autocomplete="off" name="seq" class="<?php echo field_class( 'seq', 'seq form-control' ); ?>" />
                                    <div class="clearfix"></div>
                                </div>
                                <div class="error-text" id="seq_field_error"><?php echo form_error( 'seq' ); ?></div>
                            </div>
                            <div class="clearfix"></div>
                            
                            <div class="form-group">
                                <label for="accept-terms" class="checkbox-inline"><input type="checkbox" id="accept-terms" name="accept-terms" value="1"<?php echo set_checkbox( 'accept-terms', '1' ); ?> /> <?php echo sprintf( _i18n( 'I have read and agree to the <a href="%s">Terms &amp; Conditions</a> and <a href="%s">Privacy Policy</a>.', 'mod_auth' ), site_url( 'terms' ), site_url( 'privacy' ) ); ?></label>
                                <div class="error-text" id="accept-terms_field_error"><?php echo form_error( 'accept-terms' ); ?></div>
                            </div>

                            <div class="form-group">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-lg btn-primary"><?php _e( _i18n( 'Submit' ) ); ?></button>
                                    <button type="reset" class="btn btn-lg btn-danger"><?php _e( _i18n( 'Cancel' ) ); ?></button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        <?php echo form_close(); ?>
                    <?php echo form_fieldset_close(); ?>	
				</div>
			</div>
        </div>

<?php
/* End */
/* Location: `application/modules/auth/views/register.php` */
?>