<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * File configurations
 *
 * @package     CodeIgniter 2.2.0
 * @subpackage  Logtrino Business Solution 1.0
 * 
 * @author      Thanh Ho
 * @url         http://www.mvhnetworks.com
 *
 * @module      translations
 * @config      translations_file
 */

/**
 * User Profile Picture Upload Configuration
 */
$config['att_picture_file'] = array(
    'allowed_types' => 'jpg|png',
	'max_size'      => '2048',
	'max_width'     => '2000',
	'max_height'    => '2000',
	'overwrite'     => TRUE,
	'min_width'     => '150'
);

