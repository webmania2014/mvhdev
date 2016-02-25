<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 * @package     CodeIgniter 2.2.0
 *
 * @module      users_module
 * @view        admin/search/admins_search_result
 */
$sort = $this->input->get( 'sort', true );
$order = $this->input->get( 'order', true );
$order = ( $order ) ? $order : 'asc';

$sort_first_name        = FALSE;
$sort_surname           = FALSE;
$sort_email             = FALSE;
$sort_status            = FALSE;
$sort_country           = FALSE;
$sort_username          = FALSE;
$sort_registered_date   = FALSE;
$sort_logged_out_time   = FALSE;

if( $sort == 'username' ) { $sort_username = TRUE; }
if( $sort == 'registered_date' ) { $sort_registered_date = TRUE; }
if( $sort == 'logged_out_time' ) { $sort_logged_out_time = TRUE; }
if( $sort == 'firstname' ) { $sort_first_name = TRUE; }
if( $sort == 'surname' ) { $sort_surname = TRUE; }
if( $sort == 'email' ) { $sort_email = TRUE; }
if( $sort == 'status' ) { $sort_status = TRUE; }
if( $sort == 'country' ) { $sort_country = TRUE; }

$sort_url = $search_params['base_url'];

$sort_url = preg_replace( '/(^|&)sort=([^&]*)?/', '', $sort_url );
$sort_url = preg_replace( '/(^|&)order=([^&]*)?/', '', $sort_url );
$sort_url = $sort_url . '&sort=%s&order=%s';

$base_url = $this->uri->uri_string();

$params = array(
    'sort'                 => $sort,
    'order'                => $order,
    'sort_username'        => $sort_username,
    'sort_registered_date' => $sort_registered_date,
    'sort_logged_out_time' => $sort_logged_out_time,
    'sort_first_name'      => $sort_first_name,
    'sort_surname'         => $sort_surname,
    'sort_email'           => $sort_email,
    'sort_status'          => $sort_status,
    'base_url'             => $base_url
);
?>
	<div class="matter">
        <div class="container">
            <?php $this->logtrino_ui->_message(); ?>

	        <div class="filter-bar">
	            <div class="row">
	                <form name="admins-search" id="admins-search" class="search-form" action="<?php echo site_url( 'users/search/admins' ); ?>" method="get">
	                    <div class="filter-options-wrap clearfix">
	                        <div class="filter-search-box admins-search-box">
	                            <div class="input-group">
	                                <div class="input-group-btn">
	                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Filter <span class="caret"></span></button>
	                                    <ul class="dropdown-menu filters-select" role="menu">
	                                        <li class="dropdown-header">Search for:</li>
	                                        <li class="divider"></li>
	                                        <li><a href="#" data-filter-value="firstname">First Name</a></li>
	                                        <li><a href="#" data-filter-value="lastname">Last Name</a></li>
	                                        <li><a href="#" data-filter-value="email">Email</a></li>
	                                    </ul>
	                              	</div>
	                                <input type="hidden" name="ref" value="1">
	                                <input type="text" name="q" id="q" class="form-control" placeholder="search" value="<?php _e( $this->input->get( 'q', true ) ); ?>">
	                                <input type="hidden" name="filter" id="filter" class="hidden filter-value" aria-hidden="true" value="">
	                                <span class="input-group-btn">
	                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
	                                </span>
	                            </div>
	                        </div>
	                    </div>    
	                </form>
	            </div>
	        </div>

            <table class="table table-bordered overview-table" id="admin-users-table">
			    <thead>
			        <tr>
			            <th class="text-center">#</th>
			            <th class="sort-column">
			                <span class="thead">Name</span>
			                <span class="sort-options">
			                	<?php if( $sort_first_name ): ?>
	                        	<?php if( $order == 'asc' ): ?>
	                            <a href="#"><i class="sort-icon sort-asc sort-asc-disabled"></i></a>
	                        	<a href="<?php echo sprintf( $sort_url, 'firstname', 'desc' ); ?>"><i class="sort-icon sort-desc"></i></a>
	                        	<?php else: ?>
	                        	<a href="<?php echo sprintf( $sort_url, 'firstname', 'asc' ); ?>"><i class="sort-icon sort-asc"></i></a>
	                        	<a href="#"><i class="sort-icon sort-desc sort-desc-disabled"></i></a>
	                        	<?php endif; ?>
		                        
		                        <?php else: ?>
		                        <a href="<?php echo sprintf( $sort_url, 'firstname', 'asc' ); ?>"><i class="sort-icon sort-asc"></i></a>
		                        <a href="<?php echo sprintf( $sort_url, 'firstname', 'desc' ); ?>"><i class="sort-icon sort-desc"></i></a>
		                        <?php endif; ?>
			                </span>
			            </th>
			            <th class="sort-column">
			                <span class="thead">Surname</span>
			                <span class="sort-options">
			                	<?php if( $sort_surname ): ?>
	                        	<?php if( $order == 'asc' ): ?>
	                            <a href="#"><i class="sort-icon sort-asc sort-asc-disabled"></i></a>
	                        	<a href="<?php echo sprintf( $sort_url, 'surname', 'desc' ); ?>"><i class="sort-icon sort-desc"></i></a>
	                        	<?php else: ?>
	                        	<a href="<?php echo sprintf( $sort_url, 'surname', 'asc' ); ?>"><i class="sort-icon sort-asc"></i></a>
	                        	<a href="#"><i class="sort-icon sort-desc sort-desc-disabled"></i></a>
	                        	<?php endif; ?>
		                        
		                        <?php else: ?>
		                        <a href="<?php echo sprintf( $sort_url, 'surname', 'asc' ); ?>"><i class="sort-icon sort-asc"></i></a>
		                        <a href="<?php echo sprintf( $sort_url, 'surname', 'desc' ); ?>"><i class="sort-icon sort-desc"></i></a>
		                        <?php endif; ?>
			                </span>
			            </th>
			            <th class="sort-column">
			                <span class="thead">Username</span>
			                <span class="sort-options">
			                	<?php if( $sort_username ): ?>
	                        	<?php if( $order == 'asc' ): ?>
	                            <a href="#"><i class="sort-icon sort-asc sort-asc-disabled"></i></a>
	                        	<a href="<?php echo sprintf( $sort_url, 'username', 'desc' ); ?>"><i class="sort-icon sort-desc"></i></a>
	                        	<?php else: ?>
	                        	<a href="<?php echo sprintf( $sort_url, 'usernam', 'asc' ); ?>"><i class="sort-icon sort-asc"></i></a>
	                        	<a href="#"><i class="sort-icon sort-desc sort-desc-disabled"></i></a>
	                        	<?php endif; ?>
		                        
		                        <?php else: ?>
		                        <a href="<?php echo sprintf( $sort_url, 'username', 'asc' ); ?>"><i class="sort-icon sort-asc"></i></a>
		                        <a href="<?php echo sprintf( $sort_url, 'username', 'desc' ); ?>"><i class="sort-icon sort-desc"></i></a>
		                        <?php endif; ?>
			                </span>
			            </th>
			            <th class="sort-column">
			                <span class="thead">Email</span>
			                <span class="sort-options">
			                	<?php if( $sort_email ): ?>
	                        	<?php if( $order == 'asc' ): ?>
	                            <a href="#"><i class="sort-icon sort-asc sort-asc-disabled"></i></a>
	                        	<a href="<?php echo sprintf( $sort_url, 'email', 'desc' ); ?>"><i class="sort-icon sort-desc"></i></a>
	                        	<?php else: ?>
	                        	<a href="<?php echo sprintf( $sort_url, 'email', 'asc' ); ?>"><i class="sort-icon sort-asc"></i></a>
	                        	<a href="#"><i class="sort-icon sort-desc sort-desc-disabled"></i></a>
	                        	<?php endif; ?>
		                        
		                        <?php else: ?>
		                        <a href="<?php echo sprintf( $sort_url, 'email', 'asc' ); ?>"><i class="sort-icon sort-asc"></i></a>
		                        <a href="<?php echo sprintf( $sort_url, 'email', 'desc' ); ?>"><i class="sort-icon sort-desc"></i></a>
		                        <?php endif; ?>
			                </span>
			            </th>
			            <th class="sort-column">
			                <span class="thead">Status</span>
			            </th>
			            <th class="sort-column">
			                <span class="thead">Registered Date</span>
			                <span class="sort-options">
			                	<?php if( $sort_registered_date ): ?>
	                        	<?php if( $order == 'asc' ): ?>
	                            <a href="#"><i class="sort-icon sort-asc sort-asc-disabled"></i></a>
	                        	<a href="<?php echo sprintf( $sort_url, 'registered_date', 'desc' ); ?>"><i class="sort-icon sort-desc"></i></a>
	                        	<?php else: ?>
	                        	<a href="<?php echo sprintf( $sort_url, 'registered_date', 'asc' ); ?>"><i class="sort-icon sort-asc"></i></a>
	                        	<a href="#"><i class="sort-icon sort-desc sort-desc-disabled"></i></a>
	                        	<?php endif; ?>
		                        
		                        <?php else: ?>
		                        <a href="<?php echo sprintf( $sort_url, 'registered_date', 'asc' ); ?>"><i class="sort-icon sort-asc"></i></a>
		                        <a href="<?php echo sprintf( $sort_url, 'registered_date', 'desc' ); ?>"><i class="sort-icon sort-desc"></i></a>
		                        <?php endif; ?>
			                </span>
			            </th>
			            <th class="sort-column">
			                <span class="thead">Last Logged in</span>
			                <span class="sort-options">
			                	<?php if( $sort_logged_out_time ): ?>
	                        	<?php if( $order == 'asc' ): ?>
	                            <a href="#"><i class="sort-icon sort-asc sort-asc-disabled"></i></a>
	                        	<a href="<?php echo sprintf( $sort_url, 'logged_out_time', 'desc' ); ?>"><i class="sort-icon sort-desc"></i></a>
	                        	<?php else: ?>
	                        	<a href="<?php echo sprintf( $sort_url, 'logged_out_time', 'asc' ); ?>"><i class="sort-icon sort-asc"></i></a>
	                        	<a href="#"><i class="sort-icon sort-desc sort-desc-disabled"></i></a>
	                        	<?php endif; ?>
		                        
		                        <?php else: ?>
		                        <a href="<?php echo sprintf( $sort_url, 'logged_out_time', 'asc' ); ?>"><i class="sort-icon sort-asc"></i></a>
		                        <a href="<?php echo sprintf( $sort_url, 'logged_out_time', 'desc' ); ?>"><i class="sort-icon sort-desc"></i></a>
		                        <?php endif; ?>
			                </span>
			            </th>
			            <th></th>
			        </tr>
			    </thead>
			    <tbody>
		        <?php if( isset( $users ) && count( $users ) > 0 ): ?>
		            <?php $row_count = 1; ?>
		            <?php if( isset( $row_start ) && $row_start != 0 ) {
		                $row_count = $row_start + 1;
		            }
		            ?>

		            <?php foreach( $users as $admin ): ?>
		                <?php $user = new logtrino_user( $admin ); ?>
		                <tr>
		                    <td class="row-number"><?php echo $row_count; ?></td>
		                    <td class="first-name"><a href="<?php echo site_url( 'users/profile/' . $user->get_id() . '/' . $user->get_username() ); ?>"><?php _e( $user->get_first_name() ); ?></a></td>
		                    <td class="last-name"><a href="<?php echo site_url( 'users/profile/' . $user->get_id() . '/' . $user->get_username() ); ?>"><?php _e( $user->get_last_name() ); ?></a></td>
		                    <td class="username"><?php _e( $user->get_username() ); ?></td>
		                    <td class="email-address"><?php _e( $user->get_primary_email() ); ?></td>
		                    <td class="status">
		                        <?php if( $user->is_active() ): ?>
		                            <i class="fa fa-check-circle blue">&nbsp;</i><a href="<?php echo site_url( 'users/activate_user/' . $user->get_id() . '/?active=no&redirect=' . urlencode( current_url() . '?' . $_SERVER['QUERY_STRING'] ) ); ?>" data-content="Click to deactive" data-trigger="popover" data-opt='{"placement":"top","trigger":"hover"}'>Active</a>
		                        <?php else: ?>
		                            <i class="fa fa-minus-circle red">&nbsp;</i><a href="<?php echo site_url( 'users/activate_user/' . $user->get_id() . '/?active=yes&redirect=' . urlencode( current_url() . '?' . $_SERVER['QUERY_STRING'] ) ); ?>" data-content="Click to activate" data-trigger="popover" data-opt='{"placement":"top","trigger":"hover"}'>In-active</a>
		                        <?php endif; ?>
		                    </td>
		                    <td class="registered-date"><?php echo $user->get_registered_date( 'd/m/Y' ); ?></td>
		                    <td class="loggedin-date">
		                        <?php if( $user->get_last_logged_in_time() ): ?>
		                        <?php echo $user->get_last_logged_in_time( 'd/m/Y' ); ?>
		                        <?php else: ?>
		                        Never logged in.
		                        <?php endif; ?>
		                    </td>
		                    <td class="admin-actions">
		                    	<?php
                                $activate_params = ( $user->is_active() ) ? 'active=no&redirect=' . urlencode( current_url() ) : 'redirect=' . urlencode( current_url() );
                                $activate_title = ( $user->is_active() ) ? 'Deactivate User' : 'Activate User';
                                ?>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-gear"></i><span class="caret"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo site_url( 'users/profile/' . $user->get_id() . '/' . _e( $user->get_username(), false ) ); ?>">View Profile</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo site_url( 'users/edit/' . $user->get_id() ); ?>">Edit User</a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo site_url( 'users/activate_user/' . $user->get_id() . '/?' . $activate_params ); ?>"><?php echo $activate_title; ?></a></li>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo site_url( 'users/delete/' . $user->get_id() . '?redirect=' . urlencode( current_url() ) ); ?>">Delete User</a></li>
                                    </ul>
                                </div>
		                    </td>
		                </tr>
		                <?php $row_count++; ?>
		            <?php endforeach; ?>
			        <?php else: ?>
			        <tr>
			        	<td colspan="10">
			        		<div style="padding: 10px; text-align: center;"><strong>No results found.</strong></div>
			        	</td>
			        </tr>
			        <?php endif; ?>
			    </tbody>
			</table>

			<?php if( isset( $total ) && $total > 0 ): ?>
			<div class="pagination-bar pagination-center">
                <?php $this->logtrino_ui->_pagination(); ?>
                <span class="results-counter">
                    <?php echo $result_count; ?>
                </span>
            </div>
            <?php endif; ?>
        </div>
    </div>
	
<?php
/* End */
/* Location: `application/modules/users/views/admin/search/admins_search_result.php` */
?>