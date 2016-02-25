<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 * @package     CodeIgniter 2.2.0
 * @subpackage  Logtrino Business Solution 1.0
 *
 * @module      auth
 * @view        activation
 */
?>

        <div class="content">
        	<div class="matter">
        		<div class="container">
        			<div class="row">
        				<div class="col-xs-12 col-form col-st">
                            <h2><?php _e( _i18n( 'Activate Your Account', 'mod_auth' ) ); ?></h2>

                            <p><?php echo sprintf( 'User with email &lt;%s&gt; doesn\'t exist in system.', $email ); ?></p>
                            <p><?php echo sprintf( 'If you\'ve not an account. Please <a href="%s">sign up</a>.', site_url( 'auth/register' ) ); ?></p>

                            <?php $this->logtrino_ui->_message(); ?>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>

<?php
/* End */
/* Location: `application/modules/auth/views/activation.php` */
?>