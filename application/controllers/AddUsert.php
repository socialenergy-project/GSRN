<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AddUsert
 *
 * @author John Papagiannis <intelen>
 */
class AddUsert extends CI_Controller {

	//put your code here

	public $tempUserId;

	//put your code here
	function __construct() {

		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation', 'session');
		$this->load->model('Auth2calls', '', TRUE);
		$this->load->model('Auth', '', TRUE);
		$this->load->model('SelectData', '', TRUE);
		$this->load->model('SaveData', '', TRUE);
		$this->load->model('Generalpurposes', '', TRUE);

		if (isset($_SESSION["username"])) {
			unset($_SESSION["username"]);
		}

		if (isset($_SESSION["email"])) {
			unset($_SESSION["email"]);
		}

		if (isset($_SESSION["userid"])) {
			$this->tempUserId = $_SESSION["userid"];
			unset($_SESSION["userid"]);
		}

		if (isset($_SESSION["logged_in"])) {
			unset($_SESSION["logged_in"]);
		}
	}

	public function index() {

		$this->load->view('login');
	}

	public function create() {

		$Credential = [];
		$receivedData = [];

		$Credential["username1"] = trim(strip_tags($this->input->post('username1')));
		$Credential["useremail1"] = trim(strip_tags($this->input->post('useremail1')));
		$Credential["firtName1"] = trim(strip_tags($this->input->post('firtName1')));
		$Credential["lastName1"] = trim(strip_tags($this->input->post('lastName1')));
		$Credential["password1"] = trim(strip_tags($this->input->post('password1')));

		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('username1', 'Username', 'required|min_length[2]|max_length[50]|trim|strip_tags');
		$this->form_validation->set_rules('useremail1', 'Email', 'required|min_length[2]|max_length[50]|trim|strip_tags|valid_email|callback_unique_email');

		$this->form_validation->set_rules('firtName1', 'First name', 'required|min_length[2]|max_length[50]|trim|strip_tags');
		$this->form_validation->set_rules('lastName1', 'Last name', 'required|min_length[2]|max_length[50]|trim|strip_tags');
		$this->form_validation->set_rules('password1', 'Password', 'required|min_length[2]|max_length[50]|trim|strip_tags');

		$query = $this->SelectData->GetUserUsernameIfExist($Credential["username1"]);
		$boolean = FALSE;
		foreach ($query->result() as $row) {

			if ($row->UserName) {
				$boolean = TRUE;
			}
		}

		$Credential = $this->security->xss_clean($Credential);

		if ($this->form_validation->run() == FALSE || $boolean == TRUE
		) {

			if ($boolean === TRUE) {
				
				$Credential["userNameBugUsername"] = "please choose different username!";
			}

			$Credential["formOn"] = "on";

			$this->load->view('login', $Credential); //
			
		} else {

	
			$receivedData["UserName"] = $Credential["username1"];
			$receivedData["EmailAddress"] = $Credential["useremail1"];
			$receivedData["Password"] = $Credential["password1"];
			$receivedData["timestamp_GMT_00"] = $this->Generalpurposes->createGMTtimestampOffset();
			$receivedData["DateRegister"] = $this->Generalpurposes->createGMTdateOffset(); //date("Y-m-d H:i:s");
			$receivedData["Status"] = "Pending";
			$receivedData["UserLevel"] = 4;
			$receivedData["PasswordToken"] = "MarketPlace";

			$this->SaveData->SaveUser($receivedData); //	 
			$receivedData["successOn"] = "On";


			$this->load->library('session');
			$this->session->set_flashdata('successOn', "on");
			redirect('login/index');

			//$this->load->view('login', $receivedData);
		}
	}

	function unique_email($str) {

		$query = $this->SelectData->GetUserEmailIfExistsCred(strip_tags(trim($str)));

		$this->form_validation->set_message("unique_email", 'please choose different email.');
		$boolean = TRUE;
		foreach ($query->result() as $row) {

			if ($row->EmailAddress) {
				$boolean = FALSE;
			}
		}
		return $boolean;
	}

}
