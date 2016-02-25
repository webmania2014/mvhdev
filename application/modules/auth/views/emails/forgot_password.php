<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 * @package: CodeIgniter 2.2.0
 *
 * @module: auth_module
 * @view: emails/forgot_password
 */
?>  

        <?php if( isset($user) && '' != $user ): ?>
        <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
            <tbody>
                <tr>
                    <td style="border-collapse:collapse;padding:20px;">
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
                                                <td><span style="font-family:Arial;font-size:20px;">Reset new password</span></td>
                                            </tr>
                                            <tr><td style="border-collapse:collapse;height:5px;"></td></tr>
                                            <tr><td style="border-top:1px solid #ccc;border-collapse:collapse;height:20px;"></td></tr>
                                            <tr>
                                                <td>
                                                    <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                                                        <tbody>
                                                            <tr>
                                                                <td>Hi <?php printf( '%s %s', $user->first_name, $user->last_name ); ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border-collapse:collapse;height:10px;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                To reset your password, please click the link <a href="<?php echo urlencode( $reset_link ); ?>"><?php echo urlencode( $reset_link ); ?></a>.<br />If the link doesn't work, please copy and paste the entire URL into your browser's address bar and press Enter.
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                            <td style="border-collapse:collapse;height:10px;"></td>
                                                            </tr>
                                                            <tr>
                                                            <td style="border-collapse:collapse;"><span>The link will be expired after 24 hours from now.</span></td>
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
/* Location: `application/modules/auth/views/emails/forgot_password.php` */
?>