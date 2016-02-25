<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 * @package: CodeIgniter 2.2.0
 *
 * @view: message
 */

/**
 * Load message stored in session flash data
 */
//$flash_messages = $this->session->flashdata( 'message' );
?>
	<?php if( count( $messages ) > 0 && is_array( $messages ) ): ?>
		<?php foreach( $messages as $type => $msgs ): ?>
			<?php if( is_array( $msgs ) && count( $msgs ) > 0 ): ?>
				<?php foreach( $msgs as $msg ): ?>
				<div class="alert alert-<?php echo strtolower( $type ); ?>"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo $msg; ?></div>
				<?php endforeach; ?>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?>

<?php


?>
<?php
/* End */
/* Location: `application/views/templates/message.php` */
?>