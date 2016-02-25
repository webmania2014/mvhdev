<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 * @package     CodeIgniter 2.2.0
 *
 * @module      activity_module
 * @view        overview
 */
?>
	<div class="content">
    	<div class="matter">
    		<div class="container">
    			<div class="row">
    				<div class="col-xs-12 col-form col-st">

                        <?php $this->logtrino_ui->_message(); ?>

                        <div class="activities-overview">
                        	<ul class="ui-list list-overview">

	                        <?php if( isset( $activities ) && count( $activities ) > 0 ): ?>
	                        	<?php $count = 0; ?>
								<?php $loop_date = ''; ?>
							
								<?php foreach( $activities as $activity ): ?>
									
									<?php if( $count > 0 && $loop_date != date( 'm', strtotime( $activity->created_date ) ) ): ?>
										</ul>
									</li><!--/activities-container -->
									<?php endif; ?>

									<?php if( $loop_date != date( 'm', strtotime( $activity->created_date ) ) ): ?>
									<li class="border-bottom list-item ui-heading">
										<span class="month-title"><?php echo date( 'F, Y', strtotime( $activity->created_date ) ); ?></span>
									</li>

									<li class="activities-container">
									<?php $loop_date = date( 'm', strtotime( $activity->created_date ) ); ?>
										<ul>
									<?php endif; ?>

										<li class="ui-content-row border-bottom activity-text">
											<?php $params = explode( ',', $activity->params ); ?>
											<?php echo vsprintf( stripslashes( $activity->activity_html ),  $params ); ?>
										</li>

									<?php if( $count == count( $activities ) - 1 ): ?>
									</li><!--/activities-container -->
									<?php endif; ?>

									<?php $count++; ?>
								<?php endforeach; ?>

							<?php else: ?>
								<li class="ui-content-row border-bottom"><?php _e( _i18n( 'You\'ve no activities.', 'mod_activity' ) ); ?></li>
							<?php endif; ?>

							</ul>
                        </div>

                        <?php if( isset( $activities ) && count( $activities ) > 0 ): ?>
                        <div class="pagination-bar pagination-center">
                        	<?php $this->logtrino_ui->_pagination(); ?>
                        </div>
                        <?php endif; ?>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>

<?php
/* End */
/* Location: `application/modules/activity/views/overview.php` */
?>