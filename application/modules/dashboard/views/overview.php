<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 * @package     CodeIgniter 2.2.0
 *
 * @module      dashboard_module
 * @view        overview
 */
  
?>
    <div id="page-heading">
            <ol class="breadcrumb">
                <li><a href="index.php">Dashboard</a></li>
                <!-- <li class="active">Calendar</li> -->
            </ol>
    </div>
    <div class="container">
        <div class="col-xs-12 col-md-12">
            <?php echo modules::run( 'activity/activity_widget/_recent_activities' ); ?>
        </div><!--/ recent-notifications-widget -->
        
    </div>
    
<?php 
/* End */
/* Location: `application/modules/dashboard/views/overview.php` */
?>