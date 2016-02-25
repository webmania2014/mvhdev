<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * File configurations
 *
 * @package     CodeIgniter 2.2.0
 *
 * @module      users_module
 * @config      users_file
 */

/**
 * User Profile Picture Upload Configuration
 */
$config['profile_picture_upload'] = array(
	'allowed_types' => 'gif|jpg|png',
	'max_size'      => '2048',
	'max_width'     => '400',
	'max_height'    => '400',
	'overwrite'     => TRUE,
	'min_width'     => '200'
);

/**
 * User Profile Picture Manipulation
 */
$config['profile_picture_resize'] = array(
	'image_library'  => 'gd2',
	'create_thumb'   => FALSE,
	'maintain_ratio' => TRUE,
	'width'          => 200,
	'height'         => 200,
	'quality'        => '80%',
	'x_axis'         => '10',
	'y_axis'         => '10'
);

/**
 * Supplier certification
 * Upload a document of professional qualification of a supplier. Supplier has to upload 
 * the certification document in application form.
 */
$config['supplier_certification'] = array(
	'allowed_types' => 'pdf|doc|docx',
	'max_size'      => '51200',
	'overwrite'     => TRUE,
	'upload_path'   => 'uploads/'
);

/* End */
/* Location: `application/modules/users/config/users_file.php` */