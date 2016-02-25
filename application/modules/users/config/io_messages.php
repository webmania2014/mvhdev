<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * I/O messages configurations
 *
 * @package     CodeIgniter 2.2.0
 *
 * @module      users_module
 * @config      io_messages
 */

$config['io_messages'] = array(
	'create_user_success'     => 'New user %s created successfully.',
	'create_user_failed'      => 'New user %s couldn\'t create.',
	'username_already_exists' => 'Username %s already taken.',
	'email_already_exists'    => 'Email already taken.',
	'delete_user_success'     => 'User %s successfully deleted.',
	'delete_user_failed'      => 'User %s couldn\'t delete.',
	'update_user_success'     => 'User %s successfully updated.',
	'update_user_failed'      => 'User %s couldn\'t update.',
	'activate_user_success'   => 'User %s is activated.',
	'activate_user_failed'    => 'User %s couldn\'t activate.',
);

/**
 * Activity Messages
 * Store messages for activity log in database.
 */

$config['io_messages']['activity_log'] = array(
	'accepted_supplier' => array(
		'text' => '%s changed status of %s as accepted.',
		'html' => '<i class="fa fa-check-circle green"></i><a href="%s"><strong>%s</strong></a> changed status of <a href="%s">%s</a> as accepted.'
	),
	'rejected_supplier' => array(
		'text' => '%s changed status of %s as rejected.',
		'html' => '<i class="fa fa-check-ban red"></i><a href="%s"><strong>%s</strong></a> changed status of <a href="%s">%s</a> as rejected.'
	),
	'potential_supplier' => array(
		'text' => '%s changed status of %s as potential.',
		'html' => '<i class="fa fa-check-circle"></i><a href="%s"><strong>%s</strong></a> changed status of <a href="%s">%s</a> as potential.'
	),
	'sent_application_form' => array(
		'text' => '%s sent application form.',
		'html' => '<i class="fa fa-paper-plane blue"></i><a href="%s"><strong>%s</strong></a> sent application form.'
	),
	'add_new_admin' => array(
		'text' => '%s added new admin %s.',
		'html' => '<i class="fa fa-plus-square red"></i><a href="%s"><strong>%s</strong></a> added new admin <a href="%s"><strong>%s</strong></a>.'
	),
    'add_new_user' => array(
		'text' => '%s added new user %s.',
		'html' => '<i class="fa fa-plus-square red"></i><a href="%s"><strong>%s</strong></a> added new user <a href="%s"><strong>%s</strong></a>.'
	),
	'update_profile' => array(
		'text' => '%s updated his profile %s.',
		'html' => '<i class="fa fa-check-square blue"></i><a href="%s"><strong>%s</strong></a> updated his profile.'
	),
	'update_user_profile' => array(
		'text' => '%s updated profile of %s.',
		'html' => '<i class="fa fa-check-square blue"></i><a href="%s"><strong>%s</strong></a> updated profile of <a href="%s"><strong>%s</strong></a>.'
	),
	'delete_user' => array(
		'text' => '%s deleted user %s.',
		'html' => '<i class="fa fa-minus-square black"></i><a href="%s"><strong>%s</strong></a> deleted user <strong>%s</strong>.'
	),
	'update_password' => array(
		'text' => '%s changed password.',
		'html' => '<i class="fa fa-pencil blue"></i><a href="%s"><strong>%s</strong></a> changed password.'
	),
	'update_username' => array(
		'text' => '%s changed his username.',
		'html' => '<i class="fa fa-pencil blue"></i><a href="%s"><strong>%s</strong></a> changed his username.',
	),
	'update_user_username' => array(
		'text' => '%s changed username of %s.',
		'html' => '<i class="fa fa-pencil blue"></i><a href="%s"><strong>%s</strong></a> changed username of <a href="%s"><strong>%s</strong></a>.'
	),
	'update_profile_picture' => array(
		'text' => '%s updated profile picture',
		'html' => '<i class="fa fa-photo"></i> <a href="%s"><strong>%s</strong></a> updated profile picture.'
	)
);

/* End */
/* Location: `application/modules/users/config/io_messages.php` */