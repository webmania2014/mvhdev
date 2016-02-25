<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 * @package: CodeIgniter 2.2.0
 * @view: templates/page_header
 */
?>
<!--<div class="content">-->
<!--    <div class="matter">-->
<!--        <div class="container-fluid">-->
		    <div class="page-head page-head-block">
			    <!-- Page heading -->
			    <h2 class="pull-left"><?php echo $this->logtrino_ui->_get_title(); ?></h2>
			    <!-- Breadcrumb -->
			    <div class="bread-crumb pull-right bread-crumb-custom">
			    <?php $url_segments = array_values( $this->uri->segment_array() ); ?>
			    <?php if( $url_segments[0] == 'translations' ): ?>
			    <a href="<?php echo site_url( 'dashboard' ); ?>"><i class="fa fa-home"></i> Home</a>
			    <span class="divider">/</span>
			    <?php if( isset( $user_id ) ): ?>
			    <a href="<?php echo site_url( 'translations/user/overview/' . $user_id ); ?>">Translations</a>
				<?php else: ?>
			    <span>Translations</span>
				<?php endif; ?>
			    <?php if( isset( $user ) ): ?>
			    <span class="divider">/</span>
			    <span><?php _e( $user ); ?></span>
			    <?php endif; ?>
			    <?php else: ?>
			    <?php $this->logtrino_ui->_breadcrumb(); ?>
				<?php endif; ?>
			    </div>
		    </div>
            <div class="clearfix"></div>
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<?php
/* End */
/* Location: `application/views/templates/page_header.php` */
?>