<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 * @package: CodeIgniter 2.2.0
 * @subpackage: Logtrino Business Solution 1.0
 *
 * @view: administration/index
 */
?>

<?php if(isset($this->session->userdata['user_id'])): ?>
<?php $this->logtrino_ui->_get_header(); ?>
<div id="page-content">
    <div id='wrap'>
        <div id="page-heading">
            <div class="breadcrumbs">
                
                    <?php echo $this->logtrino_ui->_breadcrumb(); ?>
                
            </div>
              <h1><?php echo $this->logtrino_ui->_get_title(); ?></h1>
              
        </div>
        
        <div class="container">
        <?php $this->logtrino_ui->_message(); ?>
            <div class="row">
                   
            		  <?php $this->logtrino_ui->_view(); ?>
                   
            </div>
        </div>
        
        
    </div>
</div>        
<div class="clearfix"></div>
<?php $this->logtrino_ui->_get_footer(); ?>
<?php else: ?>
    <?php $this->logtrino_ui->_view(); ?>
<?php endif; ?>
	
