<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Recommendations
 *
 * @author John Papagiannis <intelen>
 */
class Recommendations extends CI_Controller {

	//put your code here
	public $userIdSession;
	public $userLastTimeLogin;
	public $usrlevel;

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->model('Insertdata', '', TRUE);
		$this->load->model('SelectData', '', TRUE);
		$this->load->model('Trackusers', '', TRUE);
		$this->load->model('Generalpurposes', '', TRUE);
		$this->load->model('Random', '', TRUE);
		$this->load->model('variablesProcess/FilterVariablesQuest', 'FilterVariablesQuest', TRUE);

		if ($this->session->userdata('logged_in') !== 1) {
			redirect('Login');
			exit;
		} else {
			$this->usrlevel = $this->session->userdata('user_level');
			$this->userIdSession = $this->session->userdata('userid');
			$this->userLastTimeLogin = $this->SelectData->LastDateUserLogin($this->userIdSession) === 0 ? "" : $this->Generalpurposes->timestampTOdate($this->SelectData->LastDateUserLogin($this->userIdSession));
		}
	}

	public function index($save = "off") {

		$dataInput = [];
		$data = [];
		$userWhereaboutData = [];

		$data["Recommendations"] = "on";
		$data["ActiveTips"] = $this->SelectData->SelectDisplayTips();
		$data["lastTimeLogin"] = $this->userLastTimeLogin;
		$data["usrlevel"] = $this->usrlevel;
		$data = array_merge($this->loadUsersRequest(), $data);

		$this->load->view('recommendations', $data); //analytics  //adduser
	}

	public function loadUsersRequest() {

		$this->load->model('ViewAdminProcess', '', TRUE);
		return $this->ViewAdminProcess->processViewUsersRequestRecords($this->SelectData->SelectUserRequestForAdminRole());
	}

	public function savemessag() {


		if ($_SERVER['REQUEST_METHOD'] != 'POST') {

			$this->index();
		}

		$receivedData = [];
		$data = [];
		$data["ActiveTips"] = $this->SelectData->SelectDisplayTips();
        
		$data["Recommendations"] = "on";
		$data["usrlevel"] = $this->usrlevel;
		$data = array_merge($this->loadUsersRequest(), $data);
		
		$receivedData["UserID"] = $this->userIdSession;
		$receivedData["descM"] = strip_tags(trim($this->input->post("MainShortMessa")));
		$receivedData["groupReceiver"] = strip_tags(trim($this->input->post("group_1")));
		$receivedData["dateFrom"] = strip_tags(trim($this->input->post("DateTimeFrom")));
		$receivedData["dateTo"] = strip_tags(trim($this->input->post("DateTimeTo")));
		$receivedData["dateCreated"] = "";

		if (isset($receivedData["dateFrom"]) === TRUE) {
			$receivedData["dateFrom"] = date('m/d/Y') . "," . date('m/d/Y', strtotime('+1 day', strtotime(date('m/d/Y'))));
		} else {
			$receivedData["dateFrom"] = strip_tags(trim($this->input->post("DateTimeFrom_from"))) . "," . strip_tags(trim($this->input->post("DateTimeFrom_to")));
		}

		if (isset($receivedData["dateTo"]) === TRUE) {
			$receivedData["dateTo"] = date('m/d/Y') . "," . date('m/d/Y', strtotime('+1 day', strtotime(date('m/d/Y'))));
		} else {
			$receivedData["dateTo"] = strip_tags(trim($this->input->post("DateTimeTo_from"))) . "," . strip_tags(trim($this->input->post("DateTimeTo_to")));
		}

		$receivedData = $this->security->xss_clean($receivedData);

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('MainShortMessa', 'Main Message', 'required|min_length[2]|max_length[150]|trim|strip_tags');
		$this->form_validation->set_rules('group_1', 'define group', 'required|min_length[2]|max_length[50]|trim|strip_tags');
		$this->form_validation->set_rules('DateTimeFrom', 'Date time from', 'required|min_length[2]|max_length[50]|trim|strip_tags');
		$this->form_validation->set_rules('DateTimeTo', 'Date time to', 'required|min_length[2]|max_length[50]|trim|strip_tags');

		//DateTimeFrom

		if ($this->form_validation->run() == FALSE) {

			$data["Recommendations"] = "on";
			$data["MainShortMessa"] = $receivedData["descM"];
			$data["group_1"] = $receivedData["groupReceiver"];
			$data["DateTimeFrom"] = $receivedData["dateFrom"];
			$data["DateTimeTo"] = $receivedData["dateTo"];

			$this->load->view('recommendations', $data);
		} else {

			$this->Insertdata->InsertdataTable("RecomedationsTips", $receivedData);

			$this->session->set_flashdata('newTipIntoSystem', "on");
			redirect('recommendationslist');
			exit;
		}
	}

}
