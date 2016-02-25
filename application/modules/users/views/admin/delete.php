<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 * @package     CodeIgniter 2.2.0
 * @module      users_module
 * @view        admin/delete
 */
?>

		
            <div class="container">

                <?php $this->logtrino_ui->_message(); ?>

                <div class="delete-confirmation ui-operation-box">
    				<div class="ui-operation-box-header">
        				<h3>Are you sure ?</h3>
        			</div>
        			<hr />
        			<br />
        			<p>You're about to delete a user <strong><?php echo $user->username; ?></strong>. All of user's data will be permenantly deleted.</p>
        			<p>Please continue to delete user or cancel this operation.</p>

        			
        			<?php
                    echo form_open( 'users/delete/' . $user->id, 
                        array(
                                'role'   => 'form',
                                'name'   => 'delete_user_form',
                                'id'     => 'delete_user_form',
                                'class'  => 'form'
                            )
                        ); 
                    ?>
                	<div class="btn-group-lg">
                   		<button type="submit" class="btn btn-danger">Continue</button>
                    	<button type="reset" class="btn btn-primary" onclick="window.location='<?php echo site_url( 'users/profile/' . $user->id . '/' . $user->username ); ?>';return false;">Cancel</button>
                    	<input type="hidden" name="user" value="<?php echo $user->id; ?>" />
                        <input type="hidden" name="redirect" value="<?php echo urlencode( $this->input->get( 'redirect', true ) ); ?>" />
                    </div>
                    <?php echo form_close(); ?>
                </div>

            </div>
      

<?php
/* End */
/* Location: `application/modules/users/views/admin/delete.php` */
?>