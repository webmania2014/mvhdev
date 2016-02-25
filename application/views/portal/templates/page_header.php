<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 * @package: CodeIgniter 2.2.0
 *
 * @view: templates/page_header
 */
?>
		<div class="page-head">
			<!-- Page heading -->
			<h2 class="pull-left"><?php echo $this->logtrino_ui->_get_title(); ?></h2>
			<!-- Breadcrumb -->
			<div class="bread-crumb pull-right">
			  <a href="<?php echo site_url( 'dashboard' ); ?>"><i class="fa fa-home"></i> Dashboard</a> 
			  <!-- Divider -->
			  <span class="divider">/</span> 
			  <?php
			  $module = $this->router->fetch_module();
			  $class  = $this->router->class;
			  $method = $this->router->method;
			  $paths = array( $module, $class, $method );

			  $segments = $this->uri->segment_array();
			  
			  $count = 0;
			  foreach( $segments as $segment ) {
			  	if( in_array( $segment, $paths ) ) {
			  		if( $count == count( $segments ) - 1 ) {
			  			$links[] = '<span>' . $segment . '</span>';
			  		} else {
			  			$links[] = '<a href="#">' . $segment . '</a>';
			  		}
			  	}
			  	$count++;
			  }

			  ?>
			  <?php $this->logtrino_ui->_breadcrumb(); ?>
			</div>
			<div class="clearfix"></div>
		</div>

<?php
/* End */
/* Location: `application/views/templates/page_header.php` */
?>