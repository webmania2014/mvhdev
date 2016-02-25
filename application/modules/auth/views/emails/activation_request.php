<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 * @package     CodeIgniter 2.2.0
 * @module      auth_module
 * @view        emails/activation_request
 */
?>	

		<?php if( isset($user) && '' != $user ): ?>

		<div style="background: #eee; padding: 20px;">
			<p><img src="<?php echo site_url(); ?>assets/img/mvh_logo.png" alt="Logtrino Team" /></p>
			<h2>Activate Your Account</h2>
			<p>Hi, <?php echo $user; ?></p>
			
			<div style="background: #F8EEE2; border: 1px solid #F1CCA0; padding: 20px;">
				<p>You've requested to activate your account. To activate your account. Please click the following link. This link will be expired in 24 hours.<br /><?php echo anchor( $activation_url, $activation_url ); ?></p>
			</div>
			<p>Regards.<br />Logtrino Team</p>
		</div>

		<?php endif; ?>
<?php 
/* End */
/* Location: `application/modules/auth/views/emails/activation_request.php` */
?>