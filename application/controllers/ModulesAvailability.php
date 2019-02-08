<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of ModulesAvailability
 *
 * @author John Papagiannis <intelen>
 */
class ModulesAvailability extends CI_Controller {

	//put your code here

	public $userIdSession;
	public $userLastTimeLogin;
	public $userNameSession;
	public $usrlevel;
	public $usremail;
	public $dataComponets;

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->model('SelectData', '', TRUE);
		$this->load->model('Trackusers', '', TRUE);
		$this->load->model('Generalpurposes', '', TRUE);
		$this->load->model('Random', '', TRUE);
        $this->load->model('UpdateData', '', TRUE);
		

		if ($this->session->userdata('logged_in') !== 1) {

			redirect('Login');
			exit;
		} else {
			$this->usremail = $this->session->userdata('email');
			$this->usrlevel = $this->session->userdata('user_level');
			$this->userIdSession = $this->session->userdata('userid');
			$this->userNameSession = $this->session->userdata('username');
			// $this->userLastTimeLogin = date('Y-m-d H:i:s', $this->SelectData->LastDateUserLogin($this->userIdSession));
			$this->userLastTimeLogin = $this->SelectData->LastDateUserLogin($this->userIdSession) === 0 ? "" : $this->Generalpurposes->timestampTOdate($this->SelectData->LastDateUserLogin($this->userIdSession));
			$this->dataComponets = $this->SelectData->SelectComponet();
		}
	}

	public function index($save = "off") {

		$data = [];

		$data["usrlevel"] = $this->usrlevel;
		$data["Componets"] = "on";
		$data["ActiveTips"] = $this->SelectData->SelectTipsFromSerice($this->usremail); //$this->SelectData->SelectDisplayTips();
		$data["lastTimeLogin"] = $this->userLastTimeLogin;

        $this->load->view('modulesavailability', array_merge($data, $this->dataComponets)); //analytics  //adduser
	}

	public function savequest() {

		if ($_SERVER['REQUEST_METHOD'] != 'POST') {

			$this->index();
		}
		$this->load->library('form_validation');
		$data = [];
		$receivedData = [];
		$data["Componets"] = "on";
		$data["usrlevel"] = $this->usrlevel;

		$data["ActiveTips"] = $this->SelectData->SelectTipsFromSerice($this->usremail); //$this->SelectData->SelectDisplayTips();
		$data["lastTimeLogin"] = $this->userLastTimeLogin;


		$this->load->model('variablesProcess/FilterVariablesQuest', 'FilterVariablesQuest', TRUE);
		$this->load->model('variablesProcess/ValidateQuestionnaire', 'ValidateQuestionnaire', TRUE);
		$this->load->model('Insertdata', '', TRUE);
	
		$receivedData = $this->FilterVariablesQuest->filterVariableModules($this->input->post(), $this->userIdSession);
		$receivedData = $this->security->xss_clean($receivedData);
		$this->ValidateQuestionnaire->validateFormComp();


		if ($this->form_validation->run() == FALSE) {
			
		} else {


		   if(isset($this->dataComponets["RowID"]) && $this->dataComponets["RowID"] > 0 ){
			   
			$this->UpdateData->updateStatusCom($receivedData);
			   		   
		   }else{

			$this->Insertdata->InsertdataTable("Componets", $receivedData);
			
		   }
		}


		$this->load->view('modulesavailability',array_merge($data, $receivedData));
		//echo json_encode(array('result' => 200));
	}

	function radioButtons_control($str) {

		$this->form_validation->set_message("radioButtons_control", 'Field value is not valid.');
		$boolean = TRUE;

		if (mb_strlen($str, 'UTF-8') > 1 && $str != "on") {

			$boolean = FALSE;
		}

		return $boolean;
	}

}
