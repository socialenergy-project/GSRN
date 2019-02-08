<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Cocialnetwork
 *
 * @author John Papagiannis <intelen>
 */
class Cocialnetwork extends CI_Controller {

	public $userIdSession;

	//put your code here
	function __construct() {

		parent::__construct();
		$this->load->model('Insertdata', '', TRUE);
		$this->load->library('session');
		$this->load->model('Generalpurposes', '', TRUE);

		if ($this->session->userdata('logged_in') !== 1) {
			$this->userIdSession = 0;
		} else {
			$this->userIdSession = $this->session->userdata('userid');
		}
	}

	public function pullRec() {

		if (!$this->input->is_AJAX_request()) {
			exit('none AJAX calls rejected!');
		}

		$this->load->model('SelectData', '', TRUE);

		$dataTitle = [];
$dataDate = [];
	//	$data["ActiveTips"] = $this->SelectData->SelectTipsFromSerice($this->session->userdata('email'));
    
		$query = $this->SelectData->SelectTipsFromSericeNoParsing($this->session->userdata('email'));
$index = 0;
		 foreach ($query->result() as $row)
        {

            $dataTitle[$index] = $row->message;
			
			$dataDate[$index] = date("d-m-Y h:i:s", $row->timeRecordInserted);

            $index++;
        }

      
		
		
		echo json_encode(array('result' => 200,'tips' => $dataTitle,'tipDate' => $dataDate));
	}

	public function upprodu() {

		if (!$this->input->is_AJAX_request()) {
			exit('none AJAX calls rejected!');
		}

		$data = [];

		$data["rowID"] = (int) strip_tags(trim($this->input->post('proID')));
		$data["proSTA"] = (int) strip_tags(trim($this->input->post('proSTA')));

		if ($data["proSTA"] == 2) {
			$data["timstAdminApproval"] = $this->Generalpurposes->createGMTtimestampOffset();
		} else {
			$data["timstAdminApproval"] = "";
		}

		if (mb_strlen($data["rowID"], 'UTF-8') > 7) {
			$data["rowID"] = 0;
		}

		if ($data["rowID"] > 0) {
			$this->load->model('UpdateData', '', TRUE);
			$data["sessionID"] = $this->userIdSession;


			$this->UpdateData->updateStatusGroup($data);
		}

		echo json_encode(array('result' => 200));
	}

		public function messageQue() {

		if (!$this->input->is_AJAX_request()) {
			exit('none AJAX calls rejected!');
		}
		
		$groupID = (int) strip_tags(trim($this->input->post('GrGrID')));
	
		if($groupID>0){
			$this->load->model('UpdateData', '', TRUE);
				$this->UpdateData->updateStatusGroupMessageSendID($groupID);
		}
		
		echo json_encode(array('result' => 200));
		}
	
	
	public function upprod() {

		if (!$this->input->is_AJAX_request()) {
			exit('none AJAX calls rejected!');
		}

		$data = [];

		$data["rowID"] = (int) strip_tags(trim($this->input->post('proID')));
		$data["proSTA"] = (int) strip_tags(trim($this->input->post('proSTA')));

		if ($data["proSTA"] == 2) {
			$data["timstAdminApproval"] = $this->Generalpurposes->createGMTtimestampOffset();
		} else {
			$data["timstAdminApproval"] = "";
		}

		if (mb_strlen($data["rowID"], 'UTF-8') > 7) {
			$data["rowID"] = 0;
		}

		if ($data["rowID"] > 0) {
			$this->load->model('UpdateData', '', TRUE);

			$this->UpdateData->updateStatusGroup($data);
			$this->load->model('SelectData', '', TRUE);
			
			if($this->SelectData->SelectUserGroupidEXISTS($data["rowID"]."G")=== false){
			$data3 = $this->SelectData->SelectUserAdminIDGroup($data["rowID"]);
			
			$this->Insertdata->InsertdataTablError("messageStack",
			    $messageStack=array(
				"MessageType"=>"NewGroup",
				"Text"=>"Your Group {$data3["GrouPName"]} has being authorized!",
				"Status"=>"unread",
				"Username"=>$data3["usernameGrp"],
				"Timestamp"=>$this->Generalpurposes->createGMTtimestampOffset(),
				"GrpID"=>$data["rowID"]."G"	
						)
						);
			}
			
		}

		echo json_encode(array('result' => 200));
	}

	public function notifyIfGroupApprouved() {

		if (!$this->input->is_AJAX_request() || $this->userIdSession < 1) {
			exit('none AJAX calls rejected!');
		}
	}

	public function reqleaces() {

		if (!$this->input->is_AJAX_request() || $this->userIdSession < 1) {
			exit('none AJAX calls rejected!');
		}

		//see if he has allready grant admin rights
		//if he hasnt grant him right/


		$data = [];
		$data_2 = [];

		$data["GrouPName"] = strip_tags(trim($this->input->post('GrName')));


		if (mb_strlen($this->input->post('GrName'), 'UTF-8') > 50) {

			exit(json_encode(array('result' => 200, 'post' => 2))); // error group name more than 50
		} else if (mb_strlen($this->input->post('GrName'), 'UTF-8') < 2) {

			exit(json_encode(array('result' => 200, 'post' => 3))); // error group less than 2 chars
		}

		// if this user has allready another group with this name
		$data_2 = $this->IsUsrGroupAlive($data["GrouPName"], $this->userIdSession);

		if (isset($data_2["rowID"]) && $data_2["rowID"] == 0) {

			exit(json_encode(array('result' => 200, 'post' => 4)));  // error name allready exists
		}

		$data["usrReqAdmRleID"] = $this->userIdSession;
		$data["timstAdminApproval"] = 0;
		$data["timstAdminRequest"] = $this->Generalpurposes->createGMTtimestampOffset();
		$data["usrFlagLevel"] = 2; //pending – member  ( admin )  = 0 - 1 - 2
		//InsertdataTable
		$this->Insertdata->InsertdataTable("AdminUserGroups", $data);

		echo json_encode(array('result' => 200, 'post' => 1));
	}

	public function reprod() {

		if (!$this->input->is_AJAX_request()) {
			exit('none AJAX calls rejected!');
		}

		$flag = FALSE;
		$data = [];

		$data["proID"] = (int) strip_tags(trim($this->input->post('proID')));

		if (mb_strlen($data["proID"], 'UTF-8') > 7) {
			$data["proID"] = 0;
		}

		if ($data["proID"] > 0) {
			$this->load->model('RemoveRows', '', TRUE);
			$flag = $this->RemoveRows->RemoveUserGroup("", $data["proID"]);
		}

		if ($flag === TRUE) {
			echo json_encode(array('result' => 200, 'post' => 1));
		} else {
			echo json_encode(array('result' => 200, 'post' => 0));
		}
	}

	public function reprodm() {

		if (!$this->input->is_AJAX_request()) {
			exit('none AJAX calls rejected!');
		}

		$flag = FALSE;
		$data = [];

		$data["proID"] = (int) strip_tags(trim($this->input->post('proID')));

		if (mb_strlen($data["proID"], 'UTF-8') > 7) {
			$data["proID"] = 0;
		}

		if ($data["proID"] > 0) {
			$this->load->model('RemoveRows', '', TRUE);
			$data["sessionID"] = $this->userIdSession;
			$flag = $this->RemoveRows->RemoveUserGroup($data["sessionID"], $data["proID"]);
		}

		if ($flag === TRUE) {
			echo json_encode(array('result' => 200, 'post' => 1));
		} else {
			echo json_encode(array('result' => 200, 'post' => 0));
		}
	}

	public function IsUsrGroupAlive($GroupName, $usrID) {

		$this->load->model('SelectData', '', TRUE);
		$this->load->model('ViewAdminProcess', '', TRUE);

		// $this->SelectData->CheckIfGroupExists($GroupName, $usrID);
		return $this->ViewAdminProcess->processViewUsersRequestRecords($this->SelectData->CheckIfGroupExists($GroupName, $usrID));
	}

}
