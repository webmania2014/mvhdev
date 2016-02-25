<?php $this->logtrino_ui->_get_header(); ?>

<?php $this->logtrino_ui->_view(); ?>
<?php 
$url = $_SERVER['REQUEST_URI'];
$data = array(
    'register' => '/beo/auth/register'
);
foreach($data as $val){
if($url == $val){
continue;
}
else {$this->logtrino_ui->_get_sidebar();}
}

?>
	
<?php $this->logtrino_ui->_get_footer(); ?>