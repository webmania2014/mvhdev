<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 * @package     CodeIgniter 2.2.0
 * @module      users_module
 * @view        edit_profile_picture
 */
?>

        <div class="container">

            <?php $this->logtrino_ui->_message(); ?>

            <?php if( isset( $error ) ): ?>
            <?php var_dump( $error ); ?>
            <?php endif; ?>

            <?php if( isset( $upload_data ) ): ?>
            <?php var_dump( $upload_data ); ?>
            <?php endif; ?>

            <div class="edit-profile-picture">
                <?php
                echo form_open_multipart( 'users/edit_profile_picture/', 
                    array(
                            'role'   => 'form',
                            'name'   => 'edit-profile-picture',
                            'id'     => 'edit-profile-picture',
                            'class'  => 'form'
                        )
                    ); 
                ?>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="user-avatar">
                                <?php $profile_pic_url = ( $this->logtrino_user->get_profile_picture() ) ? $this->logtrino_user->get_profile_picture() : 'assets/images/profile-picture-default.png'; ?>
                                <img src="<?php _e( site_url( $profile_pic_url ) ); ?>" class="user-profile-picture" width="<?php echo get_image_size( $profile_pic_url, 'width' ); ?>" height="<?php echo get_image_size( $profile_pic_url, 'height' ); ?>" />
                            </div>
                        </div>                    
                        <div class="col-md-9">
                            <h4>Upload Profile Picture</h4>
                            <div class="form-group row">
                                <div class="col-md-8">
                                    <input type="file" class="<?php echo field_class( 'profile-picture', 'file-upload' ); ?>" id="profile_picture" name="profile_picture">
                                    <div class="error-text" id="profile_picture_field_error"><?php field_error( 'profile_picture' ); ?></div>
                                    <div class="desc">Picture must not larger than 400px in dimension and must not larger than 2 MB in size.<br />File extension must be JPG or PNG or GIF.</div>
                                </div>
                            </div>
                            <div class="form-group form-actions">
                                <div class="buttons">
                                    <span class="ajax-spinner hidden" aria-hidden="true"><img src="<?php echo site_url( 'assets/css/images/loader-16x16.gif' ); ?>" width="16" height="16" class="spinner-ico" alt="Loading..." /></span>
                                    <button class="submit btn btn-small btn-primary" type="submit">Upload</button>
                                    <button class="reset btn btn-small btn-danger cancel-action" type="reset" onclick="window.location='<?php echo site_url( 'users/profile' ); ?>'">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                
                <?php echo form_close(); ?>
            </div>

    
    </div>
<?php 
/* End */
/* Location: `application/modules/users/views/edit_profile_picture.php` */
?>