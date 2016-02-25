<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 * @package     CodeIgniter 2.2.0
 * @subpackage  Logtrino Business Solution 1.0
 *
 * @module      users_module
 * @view        admin/search/translators_search_result
 */
$sort = $this->input->get( 'sort', true );
$order = $this->input->get( 'order', true );
$order = ( $order ) ? $order : 'asc';

$sort_company           = FALSE;
$sort_first_name        = FALSE;
$sort_surname           = FALSE;
$sort_email             = FALSE;
$sort_telephone         = FALSE;
$sort_status            = FALSE;
$sort_country           = FALSE;
$sort_applicant_type    = FALSE;

if( $sort == 'company' ) { $sort_company = TRUE; }
if( $sort == 'firstname' ) { $sort_first_name = TRUE; }
if( $sort == 'surname' ) { $sort_surname = TRUE; }
if( $sort == 'email' ) { $sort_email = TRUE; }
if( $sort == 'telephone' ) { $sort_telephone = TRUE; }
if( $sort == 'status' ) { $sort_status = TRUE; }
if( $sort == 'country' ) { $sort_country = TRUE; }
if( $sort == 'applicant_type' ) { $sort_applicant_type = TRUE; }

$sort_url = $search_params['base_url'];

$sort_url = preg_replace( '/(^|&)sort=([^&]*)?/', '', $sort_url );
$sort_url = preg_replace( '/(^|&)order=([^&]*)?/', '', $sort_url );
$sort_url = $sort_url . '&sort=%s&order=%s';

$base_url = $this->uri->uri_string();

$params = array(
    'sort'                 => $sort,
    'order'                => $order,
    'sort_company'         => $sort_company,
    'sort_first_name'      => $sort_first_name,
    'sort_surname'         => $sort_surname,
    'sort_email'           => $sort_email,
    'sort_telephone'       => $sort_telephone,
    'sort_status'          => $sort_status,
    'sort_country'         => $sort_country,
    'base_url'             => $base_url
);
?>
	<div class="matter">
        <div class="container">
            <?php $this->logtrino_ui->_message(); ?>
            <div class="filter-bar">
	            <div class="row">
	                <form name="translators-search" id="translators-search" class="search-form" action="<?php echo site_url( 'users/search/translators' ); ?>" method="get">
	                    <div class="filter-options-wrap clearfix">
	                        <div class="filter-options">
	                            <div class="filter-option">
	                            	<div class="applicant-type-filter">
	                            		<label><?php _e( _i18n( 'Role' ) ); ?></label>
	                                	<?php get_applicant_types_dropdown( ( $this->input->get( 'applicant-type', true ) !== false ) ? $this->input->get( 'applicant-type', true ) : '', 'applicant-type', 'applicant-type', 'form-control', true, 'Role' ); ?>
	                                </div>
	                            </div>
	                            <div class="filter-option">
	                            	<div class="source-language-filter">
	                            		<label><?php _e( _i18n( 'Source Language' ) ); ?></label>
	                                	<?php get_languages_dropdown( ( $this->input->get( 'source-language', true ) !== false ) ? $this->input->get( 'source-language', true ) : '', 'source-language', 'source-language', 'form-control', true ); ?>
	                                </div>
	                            </div>
	                            <div class="filter-option">
	                            	<div class="target-language-filter">
	                            		<label><?php _e( _i18n( 'Target Language' ) ); ?></label>
	                                	<?php get_languages_dropdown( ( $this->input->get( 'target-language', true ) !== false ) ? $this->input->get( 'target-language', true ) : '', 'target-language', 'target-language', 'form-control', true ); ?>
	                                </div>
	                            </div>
	                            <div class="filter-option">
	                            	<div class="subject-area-filter">
	                            		<label>Subject Area</label>
	                                	<?php get_subject_areas_dropdown( ( $this->input->get( 'subject-area', true ) !== false ) ? $this->input->get( 'subject-area', true ) : '', 'subject-area', 'subject-area', 'form-control' ); ?>
	                                </div>
	                            </div>
	                            <div class="filter-option">
	                            	<div class="software-filter">
	                            		<label><?php _e( _i18n( 'Software' ) ); ?></label>
	                                	<?php get_softwares_dropdown( ( $this->input->get( 'software', true ) !== false ) ? $this->input->get( 'software', true ) : '', 'software', 'software', 'form-control' ); ?>
	                                </div>
	                            </div>
	                        </div>
	                        
	                        <div class="filter-search-box translators-search-box">
	                        	<label>Search Keyword</label>
	                            <div class="input-group">
	                                <div class="input-group-btn">
	                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Filter <span class="caret"></span></button>
	                                    <ul class="dropdown-menu filters-select" role="menu">
	                                        <li class="dropdown-header">Search for:</li>
	                                        <li class="divider"></li>
	                                        <li><a href="#" data-filter-value="firstname">First Name</a></li>
	                                        <li><a href="#" data-filter-value="lastname">Last Name</a></li>
	                                        <li><a href="#" data-filter-value="company">Company</a></li>
	                                        <li><a href="#" data-filter-value="country">Country</a>
	                                        <li><a href="#" data-filter-value="email">Email</a></li>
	                                    </ul>
	                              </div>
	                                <input type="hidden" name="status" value="<?php echo $search_params['status']; ?>">
	                                <input type="hidden" name="type" value="<?php echo $search_params['type']; ?>"
	                                <input type="hidden" name="ref" value="2">
	                                <input type="text" name="q" id="q" class="form-control" value="<?php echo $this->input->get( 'q', true ); ?>" placeholder="search">
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

            <table class="table table-bordered overview-table" id="translators-table">
			    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="sort-column">
                            <div class="sort-heading">
                                <span class="thead">Company</span>
                                <span class="sort-options">
                                    <?php if( $sort_company ): ?>
		                        	<?php if( $order == 'asc' ): ?>
		                            <a href="#"><i class="sort-icon sort-asc sort-asc-disabled"></i></a>
		                        	<a href="<?php echo sprintf( $sort_url, 'company', 'desc' ); ?>"><i class="sort-icon sort-desc"></i></a>
		                        	<?php else: ?>
		                        	<a href="<?php echo sprintf( $sort_url, 'company', 'asc' ); ?>"><i class="sort-icon sort-asc"></i></a>
		                        	<a href="#"><i class="sort-icon sort-desc sort-desc-disabled"></i></a>
		                        	<?php endif; ?>
			                        
			                        <?php else: ?>
			                        <a href="<?php echo sprintf( $sort_url, 'company', 'asc' ); ?>"><i class="sort-icon sort-asc"></i></a>
			                        <a href="<?php echo sprintf( $sort_url, 'company', 'desc' ); ?>"><i class="sort-icon sort-desc"></i></a>
			                        <?php endif; ?>
                                </span>
                            </div>
                        </th>
                        <th class="sort-column">
                            <div class="sort-heading">
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
                            </div>
                        </th>
                        <th class="sort-column">
                            <div class="sort-heading">
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
                            </div>
                        </th>
                        <th class="sort-column">
                            <div class="sort-heading">
                                <span class="thead">Country</span>
                                <span class="sort-options">
                                    <?php if( $sort_country ): ?>
		                        	<?php if( $order == 'asc' ): ?>
		                            <a href="#"><i class="sort-icon sort-asc sort-asc-disabled"></i></a>
		                        	<a href="<?php echo sprintf( $sort_url, 'country', 'desc' ); ?>"><i class="sort-icon sort-desc"></i></a>
		                        	<?php else: ?>
		                        	<a href="<?php echo sprintf( $sort_url, 'country', 'asc' ); ?>"><i class="sort-icon sort-asc"></i></a>
		                        	<a href="#"><i class="sort-icon sort-desc sort-desc-disabled"></i></a>
		                        	<?php endif; ?>
			                        
			                        <?php else: ?>
			                        <a href="<?php echo sprintf( $sort_url, 'country', 'asc' ); ?>"><i class="sort-icon sort-asc"></i></a>
			                        <a href="<?php echo sprintf( $sort_url, 'country', 'desc' ); ?>"><i class="sort-icon sort-desc"></i></a>
			                        <?php endif; ?>
                                </span>
                            </div>
                        </th>
                        <th class="sort-column">
                            <div class="sort-heading">
                                <span class="thead">Telephone</span>
                                <span class="sort-options">
                                    <?php if( $sort_telephone ): ?>
		                        	<?php if( $order == 'asc' ): ?>
		                            <a href="#"><i class="sort-icon sort-asc sort-asc-disabled"></i></a>
		                        	<a href="<?php echo sprintf( $sort_url, 'telephone', 'desc' ); ?>"><i class="sort-icon sort-desc"></i></a>
		                        	<?php else: ?>
		                        	<a href="<?php echo sprintf( $sort_url, 'telephone', 'asc' ); ?>"><i class="sort-icon sort-asc"></i></a>
		                        	<a href="#"><i class="sort-icon sort-desc sort-desc-disabled"></i></a>
		                        	<?php endif; ?>
			                        
			                        <?php else: ?>
			                        <a href="<?php echo sprintf( $sort_url, 'telephone', 'asc' ); ?>"><i class="sort-icon sort-asc"></i></a>
			                        <a href="<?php echo sprintf( $sort_url, 'telephone', 'desc' ); ?>"><i class="sort-icon sort-desc"></i></a>
			                        <?php endif; ?>
                                </span>
                            </div>
                        </th>
                        <th class="sort-column">
                            <div class="sort-heading">
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
                            </div>
                        </th>
                        <th class="sort-column">
                            <div class="sort-heading">
                                <span class="thead">Applicant Type</span>
                                <span class="sort-options">
                                    <?php if( $sort_applicant_type ): ?>
		                        	<?php if( $order == 'asc' ): ?>
		                            <a href="#"><i class="sort-icon sort-asc sort-asc-disabled"></i></a>
		                        	<a href="<?php echo sprintf( $sort_url, 'applicant_type', 'desc' ); ?>"><i class="sort-icon sort-desc"></i></a>
		                        	<?php else: ?>
		                        	<a href="<?php echo sprintf( $sort_url, 'applicant_type', 'asc' ); ?>"><i class="sort-icon sort-asc"></i></a>
		                        	<a href="#"><i class="sort-icon sort-desc sort-desc-disabled"></i></a>
		                        	<?php endif; ?>
			                        
			                        <?php else: ?>
			                        <a href="<?php echo sprintf( $sort_url, 'applicant_type', 'asc' ); ?>"><i class="sort-icon sort-asc"></i></a>
			                        <a href="<?php echo sprintf( $sort_url, 'applicant_type', 'desc' ); ?>"><i class="sort-icon sort-desc"></i></a>
			                        <?php endif; ?>
                                </span>
                            </div>
                        </th>
                        <th>Action</th>
                    </tr>
                </thead>
			    <tbody>
		        <?php if( isset( $translators ) && count( $translators ) > 0 ): ?>
		            <?php $row_count = 1; ?>
		            <?php if( isset( $row_start ) && $row_start != 0 ) {
		                $row_count = $row_start + 1;
		            }
		            ?>
		            <?php foreach( $translators as $translator ): ?>
	                <?php $translator = new logtrino_user( $translator ); ?>
	                <tr>
	                    <td class="row-number"><?php echo $row_count; ?></td>
	                    <td class="company-name"><?php _e( $translator->get_company_name() ); ?></td>
	                    <td class="first-name"><?php _e( $translator->get_first_name() ); ?></td>
	                    <td class="last-name"><?php _e( $translator->get_last_name() ); ?></td>
	                    <td class='country-name'><?php _e( $translator->get_primary_address( 'country_name' ) ); ?></td>
	                    <td class="telephone-number"><?php _e( $translator->get_telephone_number() ); ?></td>
	                    <td class="email-address"><?php _e( $translator->get_primary_email() ); ?></td>
	                    <td class="applicant-type"><?php _e( $translator->get_type( 'title' ) ); ?></td>
	                    <td class="translator-actions">
                            <?php
                            $activate_params = ( $translator->is_active() ) ? 'active=no&redirect=' . urlencode( current_url() ) : 'redirect=' . urlencode( current_url() );
                            $activate_title = ( $translator->is_active() ) ? 'Deactivate User' : 'Activate User';
                            ?>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-gear"></i><span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo site_url( 'users/profile/' . $translator->get_id() . '/' . _e( $translator->get_username(), false ) ); ?>">View Profile</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo site_url( 'users/edit/' . $translator->get_id() ); ?>">Edit User</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo site_url( 'users/activate_user/' . $translator->get_id() . '/?' . $activate_params ); ?>"><?php echo $activate_title; ?></a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo site_url( 'users/delete/' . $translator->get_id() . '?redirect=' . urlencode( current_url() ) ); ?>">Delete User</a></li>
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
/* Location: `application/modules/users/views/admin/search/translators_search_result.php` */
?>