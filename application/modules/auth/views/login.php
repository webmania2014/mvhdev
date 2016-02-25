<?php if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 * @package     CodeIgniter 2.2.0
 *
 * @module      auth
 * @view        login
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Avant</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Avant">
    <meta name="author" content="The Red Team">

    <link href="<?php echo base_url(); ?>/assets/less/styles.less" rel="stylesheet/less" media="all">
    <!-- <link rel="stylesheet" href="assets/css/styles.min.css?=120"> -->
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css'>
    
    <script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/less.js"></script>
</head>
<body class="focusedform">
<div class="verticalcenter">
	<a href="index.php"><img src="<?php echo base_url(); ?>/assets/img/logo-big.png" alt="Logo" class="brand" /></a>
	<div class="panel panel-primary">
		<div class="panel-body">
        <?php $this->logtrino_ui->_message(); ?>
			<h4 class="text-center" style="margin-bottom: 25px;">Log in to get started</h4>
				<form action="<?php echo base_url()?>auth/login" method="POST" class="form-horizontal" style="margin-bottom: 0px !important;">
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<input type="text" name="username" class="form-control" id="username" placeholder="Username">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock"></i></span>
									<input type="password" name="password" class="form-control" id="password" placeholder="Password">
								    <input type="hidden" name="continue" value="<?php echo urlencode( $this->input->get( 'continue' ) ); ?>" />
                                </div>
							</div>
						</div>	
		</div>
		<div class="panel-footer">
			<a href="extras-forgotpassword.php" class="pull-left btn btn-link" style="padding-left:0">Forgot password?</a>
			
			<div class="pull-right">
				<a href="#" class="btn btn-default">Reset</a>
				<button type="submit" class="btn btn-primary">Log In</button>
			</div>
		</div>
        </form>
	</div>
 </div>
      
</body>
</html>
        
<?php 
/* End */
/* Location: `application/modules/auth/views/login.php` */
?>