<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 * @package     CodeIgniter 2.2.0
 *
 * @module      auth
 * @view        username_sent
 */
?>
        <?php $this->logtrino_ui->_message(); ?>

        <?php if( $this->input->get( 'status', true ) && $this->input->get( 'status', true ) == 'failed' ): ?>

        <h4><?php _e( _i18n( 'Email wasn\'t sent.', 'mod_auth' ) ); ?></h4>
        <p><?php _e( _i18n( 'We\'re sorry. Email wasn\'t sent to your email due to our email service is down or busy.', 'mod_auth' ) ); ?></p>
        <p><?php _e( _i18n( 'Sorry for any incovenience causes.', 'mod_auth' ) ); ?></p>

        <?php else: ?>

        <h4><?php _e( _i18n( 'Please check your email', 'mod_auth' ) ); ?></h4>
        <p><?php _e( _i18n( 'We\'ve sent you email attached your username in it.', 'mod_auth' ) ); ?></p>
        <?php
        if( $this->input->get( 'email' ) ) {
                $email = urldecode( $this->input->get( 'email' ) );
                $email_link = get_email_link( $email );
                if( '' != $email_link ) {
        ?>
        <p><a href="<?php echo $email_link; ?>" class="btn btn-primary"><?php _e( _i18n( 'Check your email now', 'mod_auth' ) ); ?></a></p>
        <?php
                }
        ?>
        <?php
        }
        ?>

        <?php endif; ?>

       
<?php 
/* End */
/* Location: `application/modules/auth/views/username_sent.php` */
?>