<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
require_once 'tivoka/include.php';
/**
 * Class Tivoka
 * @author     Thanh Ho
 * @url        http://www.mvhnetworks.com
 *
 * @package    CodeIgniter 2.2.0
 * @subpackage Logtrino Business Solution 1.0
 *
 */
 
class Tivoka {
    
    private $_client;
    
    function __construct() {
  		$this->ci = &get_instance();
        //http://145.253.107.18:20080/beodata/SOAP/beologtrino/
    }
    function initialize(){
        $info    = get_option('api');
        $info    = str_replace('&quot;', '"', $info);
        $api     = json_decode($info);
        //var_dump($info);exit;
        if(!$this->connected('saleadmin@gitpackage.com','demo123','staging.gitpackage.com/authentication_api/v1/authenticate/')){
            return false;
        }else{
            return true;
        }
    }
    function connected($user_name,$password_api,$url_api){
        $connect = @get_headers($url_api, 1);
        $code    = substr($connect[0], 9, 3);
        if($code == '200'){
            return true;
        }else{
            return false;
        }
    }
    function get_token(){
        $token = $this->_client->sendRequest( 'getToken', array( 'username' => get_option('user_name_api'), 'password' => get_option('password_api') ) );
		return $token->result;
    }
    
    function get_jobs(){
        $jobs = $this->_client->sendRequest( 'getJobs', array( 'token' => '', 'vendorGUID' => 5 ) );
        return $jobs->result;
    }
    
    function get_job(){
        $job = $this->_client->sendRequest( 'getJob', array( 'token' => '', 'jobGUID' => 4 ) );
		return $job->result;
    }
    
    function accept_job(){
        $job = $this->_client->sendRequest( 'acceptJob', array( 'token' => '', 'jobGUID' => 4 ) );
		return $job->result;
    }
    
    function reject_job(){
        $job = $client->sendRequest( 'rejectJob', array( 'token' => '', 'jobGUID' => 4 ) );
		return $job->result;
    }
    function upload_job(){
        $job = $this->_client->sendRequest( 'uploadJob', array( 'token' => '', 'jobGUID' => 4, 'uploadStatus' => 0, 'comment' => '' ) );
		return $job->result;
    }
    
    function get_invoices(){
        $invoices = $this->_client->sendRequest( 'getInvoices', array( 'token' => '', 'vendorGUID' => 5 ) );
		return $invoices->result;
    }
    
    function get_invoice(){
        $invoice = $this->_client->sendRequest( 'getInvoice', array( 'token' => '', 'invoiceGUID' => '' ) );
		return $invoice->result;
    }
    
    function accept_invoice($guid, $supplierInvoiceNumber){
        $invoice = $this->_client->sendRequest( 'acceptInvoice', array( 'token' => '', 'invoiceGUID' => '3f30118a-2507-4e6e-8519-a78b7112d153', 'supplierInvoiceNumber' => $supplierInvoiceNumber ) );
		return $invoice->result;
    }
    
    function reject_invoice($guid, $supplierInvoiceNumber){
        $invoice = $this->_client->sendRequest( 'rejectInvoice', array( 'token' => '', 'invoiceGUID' => '3f30118a-2507-4e6e-8519-a78b7112d153', 'supplierInvoiceNumber' => $supplierInvoiceNumber ) );
		return $invoice->result;
    }
    
}