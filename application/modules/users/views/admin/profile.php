<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 *
 * @module      users_module
 * @view        admin/profile
 */

?>
	<div class="matter">
		<div class="container">
            <?php $this->logtrino_ui->_message(); ?>

            <div class="profile-details-wrap">
                <div class="profile-details-header clearfix">
                    <div class="pull-right">
                        <div class="btn-group">
                            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Edit <span class="caret"></span></button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><?php echo anchor( 'users/edit/' . $user->id , 'Edit Profile' ); ?></li>
                                <li><?php echo anchor( 'users/edit_username/' . $user->id , 'Edit Username' ); ?></li>
                                <li><?php echo anchor( 'users/reset_password/' . $user->id, 'Change Password' ); ?></li>
                            </ul>
                        </div>
                    </div>
                    <h4><?php _e( $user->first_name .' '. $user->last_name ); ?></h4>
                </div>

                <div class="profile-details-container clearfix">
                    <div class="profile-details-sidebar">
                        <div class="user-avatar-container">
                            <img src="#" width="100px" height="100px" />
                        </div>
                    </div>
                    <div class="profile-details-content">
                        <table class="profile-details-table admin-profile-details">
                            <thead>
                                <tr>
                                    <th class="ui-heading"><div>Profile Details</div></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="profile-details">
                                            <div class="profile-data-row clearfix">
                                                <div class="profile-label">Username:</div>
                                                <div class="profile-data">
                                                    <?php _e( $user->username ); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
		</div>
	</div>

<?php
/* End */
/* Location: `application/modules/users/views/admin/profile.php` */
?>