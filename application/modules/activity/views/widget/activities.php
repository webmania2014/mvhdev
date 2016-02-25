<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 * @package     CodeIgniter 2.2.0
 * @module      activity_module
 * @view        widget/recent_activities
 */
 
 
$data_view = ( isset( $view ) || $view ) ? $view : 'default';
?>
	<?php if( $data_view == 'items' ): ?>
		<div class="activities-widget">
			<ul class="widget-list">
				<?php if( isset( $activities ) && count( $activities ) ): ?>

				<?php foreach( $activities as $activity ): ?>
				<li class="activity-text activity-widget-content">
					<?php $params = explode( ',', $activity->params ); ?>
					<?php echo vsprintf( stripslashes( $activity->activity_html ), $params ); ?>
				</li>
				<?php endforeach; ?>
				
				<?php else: ?>
				<li class="activity-text activity-widget-content no-activities">You've no recent activities.</li>
				<?php endif; ?>
			</ul>
		</div><!--/ activities-widget -->
	<?php else: ?>
		<div class="widget wdefault" role="widget" id="activities-widget-wrapper">
	        <div class="widget-head">
	            <div class="pull-left">Activity log</div>
	            <div class="widget-icons pull-right">
	                <a href="#" class="wminimize"><i class="fa fa-chevron-up"></i></a>
	            </div>
	            <div class="clearfix"></div>               
                
	        </div>
            
	        <div class="widget-content">
	        	<div class="activities-widget">
                 <div class="row">
                        			<div class="col-xs-12 col-form col-st">
                                        <table class="table table-bordered overview-table" id="translators-overview">
                                            <thead>
                                                <tr>
                                                    <th class="col-xs-6 sort-column">
                                                         <div class="sort-heading">
                                                         <span class="thead">Date - Time</span>
                                                         <span class="sort-options">
                                    
                                                         <a href="#"><i class="sort-icon sort-asc sort-asc-disabled"></i></a>
                                                         <a href=""><i class="sort-icon sort-desc"></i></a>                                                   
                                                                         
                                                        </span>
                                                        </div>
                                                        </th>
                                                        <th class="col-xs-6 sort-column">
                                                         <div class="sort-heading">
                                                         <span class="thead">Action </span>
                                                         <span class="sort-options">
                                    
                                                         <a href="#"><i class="sort-icon sort-asc sort-asc-disabled"></i></a>
                                                         <a href=""><i class="sort-icon sort-desc"></i></a>
                                                    
                                        
                                  
                                                        </span>
                                                        </div>
                                                        </th>
                                                      
                                                </tr>
                                            </thead>
                                            
                                        </table>
                                        </div>                
                                        </div>
	            	<ul class="widget-list">
	                <?php if( isset( $activities ) && count( $activities ) ): ?>
						<?php foreach( $activities as $activity ): ?>
						<li class="activity-text activity-widget-content">
							<?php $params = explode( ',', $activity->params ); ?>
							<?php echo vsprintf( stripslashes( $activity->activity_html ), $params ); ?>
						</li>
						<?php endforeach; ?>
					<?php else: ?>
						<li class="activity-text activity-widget-content no-activities">You've no activities.</li>
					<?php endif; ?>
					</ul>
				</div><!--/ activities-widget -->

				<div class="ajax-overlay overlay widget-overlay">
	            	<div class="progress-wrap">
		            	<div class="progress progress-striped active">
			        		<div class="progress-bar progress-bar-warning"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
								<span class="sr-only"></span>
							</div>
						</div>
					</div>
	            </div>
	        </div>
	       
	    </div>
	<?php endif; ?>
	
<?php
/* End */
/* Location: `application/modules/activity/views/widget/activities.php` */
?>