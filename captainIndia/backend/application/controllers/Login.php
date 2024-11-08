<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() {

	    header('Access-Control-Allow-Origin: *');
	    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
	    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	    header('Access-Control-Allow-Credentials: true');
		header('Access-Control-Max-Age: 86400');  // cache for 1 day
		
	    $method = $_SERVER['REQUEST_METHOD'];
	    if($method == "OPTIONS") {
	        die();
	    }
	    parent::__construct();

	    $this->load->model('Login_model','login'); // Loading model 
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function verifyLogin()
	{
		$datas = json_decode(file_get_contents("php://input"));
		$result = $this->login->verifyLogin($datas);
			
		echo json_encode($result);
	}
}
