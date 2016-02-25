<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 * @package: CodeIgniter 2.2.0
 *
 * @module: auth_module
 * @view: emails/notify_registration_complete
 */
?>	

		<?php if( isset($user) && '' != $user ): ?>
			
		<table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
			<tbody>
				<tr>
					<td>
						<table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;border-spacing:0;">
							<tbody>
								<tr>
									<td style="border-collapse:collapse;border-top:1px solid #ccc;border-left:1px solid #ccc;border-right:1px solid #ccc;border-top-left-radius:5px;border-top-right-radius:5px;height:10px;padding:0 15px;"></td>
								</tr>
								<tr>
									<td style="border-collapse:collapse;padding:10px 20px;border-left:1px solid #ccc;border-right:1px solid #ccc;">
										<table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
											<tr>
												<td style="border-collapse:collapse;width: 76px;vertical-align:middle">
													<img src="<?php echo site_url(); ?>assets/images/beo-logo73x50.png" alt="beo Gesellschafts für Sprachen und Technologie mbH" />
												</td>
											</tr>
											<tr><td style="border-collapse:collapse;height:10px;"></td></tr>
											<tr>
												<td><span style="font-family:Arial;font-size:20px;">Complete Your Registration</span></td>
											</tr>
											<tr><td style="border-collapse:collapse;height:5px;"></td></tr>
											<tr><td style="border-top:1px solid #ccc;border-collapse:collapse;height:20px;"></td></tr>
											<tr>
												<td>
													<table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
														<tbody>
															<tr>
																<td>Hi <?php _e( $user ); ?></td>
															</tr>
															<tr>
																<td>You've successfully registered with us. To completed your registration, please <a href="<?php echo $activation_url; ?>">activate your account</a>.</td>
															</tr>
														</tbody>
													</table>
												</td>
											</tr>
											
											<tr><td style="border-collapse:collapse;height:20px;"></td></tr>
											<tr>
												<td>Regards.<br />beo Gesellschafts für Sprachen und Technologie mbH</td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td style="border-collapse:collapse;border-bottom:1px solid #ccc;border-left:1px solid #ccc;border-right:1px solid #ccc;border-bottom-left-radius:5px;border-bottom-right-radius:5px;height:10px;padding:0 15px;"></td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>

		<?php endif; ?>
<?php 
/* End */
/* Location: `application/modules/auth/views/emails/notify_registration_complete.php` */
?>