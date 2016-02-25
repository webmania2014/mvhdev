<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Global Logtrino system configurations
 *
 * @package     CodeIgniter 2.2.0
 * @subpackage  Logtrino Business Solution 1.0
 *
 * @author      Ko Ko Zin
 * @email       kozin@mvhnetworks.com
 * @url         http://mvhnetworks.com
 *
 * This config file contains associative array of system configurations can be accessed globally.
 *
 * @System Global Configurations ( Application name, vendor name, application status etc. )
 * @System Email Configurations
 * @System Email Templates Configurations
 * @System I/O Messages ( System errors message, system validation output messages etc. )
 * @System File Configurations ( Set up Upload path, assets path and permissions etc. )
 */

/**
 * System Global Configurations
 * Define the global configurtaions of system.
 */
$config['logtrino']['global_config'] = array(
	'app_name'          => 'Logtrino Business Solution',
	'app_version'       => '1.0',
	'app_provider'      => 'MVH Networks',
	'license'           => '',
	'vendor'            => 'Beo Translation',
	'site_name'         => 'Beo Translation Portal',
	'site_description'  => 'Beo is an online translation portal.',
);


/**
 * System Email Configurations
 * Configure email settings for incoming / outgoing email from system
 */
$config['logtrino']['email_config'] = array(
	'from_email'  => 'info@mvhnetworks.com',
	'from_name'   => 'Logtrino Business Solution Team, MVH Networks',
	'signature'   => 'Best regards.' . "\r\n" . 'Logtrino Business Solution Team, MVH Networks',
	'settings'    => array(
		'mailtype'   => 'html',
		'charset'    => 'utf8',
		'validate'   => TRUE,
		'crlf'       => "\r\n",
		'newline'    => "\n\r",
	),
);

/**
 * System Email Templates Configurations
 * Configure email templates for email notification and email responding processes.
 */
$config['logtrino']['email_templates'] = array(
	'admin_user_created'     => array(
		'subject'    => 'You became new administrator of ' . $config['logtrino']['global_config']['vendor'],
		'message'    => 'You had added as administrator user of ' . $config['logtrino']['global_config']['vendor'] . '.'
						. "\r\n"
						. '<a href="%s">Log in</a>',
	),
	'complete_registration'  => array(
		'subject'    => 'You\'ve been successfully registered',
		'message'    => 'Hi %s' . "\r\n"
						. 'You\'ve been successfully registered on ' . $config['logtrino']['global_config']['vendor'] . '.'
						. "\r\n"
						. 'Please verify your account with the following link.' . "\r\n"
						. '<a href="%s">%s</a>' . "\r\n"
						. 'This link will be expired in 24 hours from now on.',
	),
	'account_activated' => array(
		'subject'    => 'Account activated successfully',
		'message'    => 'Hi %s' . "\r\n"
						. 'Your account is now activated.' . "\r\n"
						. '<a href="%s">Log in</a>',
	),
	'new_password_request' => array(
		'subject'    => 'New Password Request',
		'message'    => 'You\'ve requested new password from password recovery option with this email.' . "\r\n"
						. 'Please follow the link to reset your new password. <a href="%s">%s</a>' . "\r\n"
						. 'This link will be expired in 24 hours from now on.' . "\r\n"
						. 'If you didn\'t do it. Please ignore this email.',
	),
	'username_request'     => array(
		'subject'   => 'Username Request',
		'message'   => 'Hi %s' . "\r\n"
						. 'You\'ve requested your username. Your username is described below:' . "\r\n"
						. 'Username = %s',
	),
);

/**
 * System I/O Messages Configurations
 * Configure input / output message of system for various events occurrences
 */
$config['logtrino']['io_messages'] = array();

/**
 * UI Configuration
 * Pagination, form validation wrapper etc.
 */
$config['logtrino']['ui_config'] = array(
	'pagination' => array(
		'base_url'           => '',
		'per_page'           => 10,
		'use_page_numbers'   => TRUE,
		'first_url'          => '',
		'full_tag_open'      => '<ul class="pagination">',
		'full_tag_close'     => '</ul>',
		'last_tag_open'      => '<li>',
		'last_tag_close'     => '</li>',
		'next_link'          => 'Next',
		'next_tag_open'      => '<li>',
		'next_tag_close'     => '</li>',
		'prev_link'          => 'Prev',
		'prev_tag_open'      => '<li>',
		'prev_tag_close'     => '</li>',
		'cur_tag_open'       => '<li><a href="javascript:;" class="active disabled">',
		'cur_tag_close'      => '</a></li>',
		'num_tag_open'       => '<li>',
		'num_tag_close'      => '</li>',
		'first_link'         => 'First',
		'first_tag_open'     => '<li>',
		'first_tag_close'    => '</li>',
		'last_lik'           => 'Last',
		'last_tag_open'      => '<li>',
		'last_tag_close'     => '</li>',
		'num_links'          => 4
	)
);

/**
 * System File Configurations
 * Configure system files. Set up upload paths and assets folders and permissions
 */
$config['logtrino']['file_config'] = array(
	'upload_path'   => 'uploads/',
	'assets_path'   => 'assets/',
	'permissions'   => array(
		'file'      => array(
			'read'   	  => '0400',
			'read-write'  => '0644',
			'all'         => '0777' 
		),
		'dir'       => array(
			'read'        => '0755',
			'read-write'  => '0775',
			'all'         => '0777'
		),
	),
);


/* End */
/* Location: `application/config/logtrino.php` */