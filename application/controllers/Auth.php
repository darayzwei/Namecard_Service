<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

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
	public function index()
	{
       // echo "god";
		//$this->load->view('welcome_message');
	}

	public function login(){

		$content = file_get_contents("php://input");
		
		// echo $content;
		$array_content = json_decode($content,true);

		$return = array();
		$email = $array_content["email"];
		$password = $array_content["password"];

		$this->db->select("*");

		$this->db->from("member");
		$this->db->where('Email', $email);
		$this->db->where('Password', $password);
		$data = $this->db->get()->result_array();
		
		if(count($data) > 0){
			
			$return["status"] = true;
			$return["message"] = "wellcome to my app";
			$return["data"] = $data[0];
		}else{
			$return["status"] = false;
			$return["message"] = "user not found!!!";
			
		}

		echo json_encode($return);

	}

	public function printMy(){
		return "Hi";
	}
}
