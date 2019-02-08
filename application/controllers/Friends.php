<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Friends
 *
 * @author John Papagiannis <intelen>
 */
class Friends extends CI_Controller {

	//put your code here

	public $userIdSession;
	public $username;
	public $userLastTimeLogin;
	public $usrlevel;
	public $usremail;
	public $dataComponets = [];
	public $usrPlatfromCredits;

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('Conprocess', '', TRUE);
		$this->load->model('SaveData', '', TRUE);
		$this->load->model('UpdateData', '', TRUE);
		$this->load->model('SelectData', '', TRUE);
		$this->load->model('SelectData2', '', TRUE);
		$this->load->library('session');
		$this->load->model('Trackusers', '', TRUE);
		$this->load->model('Generalpurposes', '', TRUE);
		$this->load->model('Random', '', TRUE);
		$this->load->model('ViewUsersProcess', '', TRUE);

		if ($this->session->userdata('logged_in') !== 1) {
			redirect('Login');
			exit;
		} else {
			$this->usrlevel = $this->session->userdata('user_level');
			$this->username = $this->session->userdata('username');
			$this->userIdSession = $this->session->userdata('userid');
			$this->usremail = $this->session->userdata('email');
			$this->userLastTimeLogin = $this->SelectData->LastDateUserLogin($this->userIdSession) === 0 ? "" : $this->Generalpurposes->timestampTOdate($this->SelectData->LastDateUserLogin($this->userIdSession));
			$this->dataComponets = $this->SelectData->SelectComponet();
			
			$this->load->model('FilterRec', '', TRUE);
			
			$num = $this->FilterRec->filterRecValuesActions($this->SelectData2->countVisitsOfUser($this->userIdSession)) * 0.1;			
	        $num2 = $this->FilterRec->filterRecValuesActionsTLG($this->SelectData2->getTotalScoreOfLcmsGame($this->userIdSession, $this->username)) ;
	        $this->usrPlatfromCredits = number_format($num + $num2);
		}
	}

	public function index() {
		$data = [];
		$data_2 = [];
		$data_3 = [];
		$data_4 = [];
		$data_5 = [];

		// $data_2["AdminGroups"] = "on";
		$data_2["ActiveTips"] = $this->SelectData->SelectTipsFromSerice($this->usremail); //$this->SelectData->SelectDisplayTips();

		$data_2["lastTimeLogin"] = $this->userLastTimeLogin;
		//groups authorized--- here
		$data_3 = array_merge($this->loadUsersRequest($this->userIdSession), $data_2);

		$data_4 = array_merge($this->loadSendRequest($this->userIdSession), $data_3);

		$data_5 = array_merge($this->loadUsersRequestP($this->userIdSession), $data_4);

		$data = array_merge($this->returnAllUsrOfGroups($this->userIdSession), $data_5);

		$data["usrlevel"] = $this->usrlevel;

		$data["username"] = $this->username;
        $data["usrPlatfromCredits"] = $this->usrPlatfromCredits;
		$data["currentSessionID"] = $this->userIdSession;
		$data = array_merge($this->dataComponets, $data);
		$this->load->view('friends_list', $data);
	}

	
	public function actrnFriend(){
		
		if (!$this->input->is_AJAX_request())
			exit('none AJAX calls rejected!');
		
		$data = [];
		$data['rID'] = (int) strip_tags(trim($this->input->post('rsrid')));
		$data['grouName'] = strip_tags(trim($this->input->post('grouName')));
		$tempName=[];
		$result = $this->SelectData2->GetUserNames($data['grouName']);
		$this->load->model('GameModule', '', TRUE);
		$i = 0;
		foreach ($result->result() as $row) {
			
			
			if (isset($row->UserName)) {
				$tempName["names_".++$i] = $row->UserName;
				$data = array_merge($this->GameModule->filterGameValuesPerUser($this->GameModule->getLoadGameActivity($row->UserName),$row->UserName), $data);
			//$data[] = 	$this->GameModule->filterGameValuesPerUser($this->GameModule->getLoadGameActivity($userName),$row->UserName);
				
			}
		}
		$data = array_merge($tempName,$data);
		$data["namesSizeof"] = sizeof($tempName);
		
		
		
		echo json_encode($data);
	}
	
	
	public function prnFriend() {

		if (!$this->input->is_AJAX_request())
			exit('none AJAX calls rejected!');

		$data = [];
		$data_3 = [];
		$postVariable_2 = [];

		$data['rsr'] = (int) strip_tags(trim($this->input->post('rsr')));

		$data['grouName'] = strip_tags(trim($this->input->post('grouName')));


		if (mb_strlen($data['grouName'], 'UTF-8') > 65) {

			$postVariable_2["status"] = 202;
			exit(json_encode($postVariable_2));
		}

		$data_2['status'] = 200;

		$data_3 = array_merge($this->loadAllGroupNames($data['grouName'], $this->username), $data_2);

		echo json_encode($data_3);
	}

	public function reqdac() {

		if (!$this->input->is_AJAX_request())
			exit('none AJAX calls rejected!');

		$data = [];

		//check if he has allready accept his invitation -  202

		$data['rowID'] = (int) strip_tags(trim($this->input->post('rsr')));

		$data['usrGroups'] = strip_tags(trim($this->input->post('grouName')));

		$data['memberID'] = $this->userIdSession;

		$this->load->model('ViewAdminProcess', '', TRUE);

		if ($this->ViewAdminProcess->processFriendsRequestTimeC($this->SelectData2->isFriendRequestAccepted($dataTemp2 = array("memberID" => $this->userIdSession, "rowID" => $data['rowID'], "usrGroups" => $data['usrGroups']))) === TRUE) {

			$postVariable_2["status"] = 202;

			exit(json_encode($postVariable_2));
		}

		$data["status"] = 200;

		$data["timstInvitationApproval"] = $this->Generalpurposes->createGMTtimestampOffset();

		// $this->UpdateData->updateStatusReceiveInvitation($data);

		if ($data['rowID'] > 0 && $this->SelectData->SelectUserGroupidEXISTS($data['rowID'] . "a") === false) {

			$result = $this->SelectData2->isFriendRequestAccepted($dataTemp2 = array("memberID" => $this->userIdSession, "rowID" => $data['rowID'], "usrGroups" => $data['usrGroups']));

			$usernameToStack = "";
			$userIDPreview;
			foreach ($result->result() as $row) {

				if (isset($row->AdminID)) {

					$userIDPreview = $row->AdminID;
					$result = $this->SelectData->GetUserIDfExists($row->AdminID);

					foreach ($result->result() as $row) {

						if (isset($row->UserName)) {

							$usernameToStack = $row->UserName;
						}
					}
				}
			}
			
			$this->load->model('Insertdata', '', TRUE);

			$this->Insertdata->InsertdataTablError("messageStack", $messageStack = array(
				"MessageType" => "FriendRequestAccepted",
				"Text" => " Member has accepted request to join group {$data['usrGroups']} !",
				"Status" => "unread",
				"Username" => $userIDPreview,
				"Timestamp" => $this->Generalpurposes->createGMTtimestampOffset(),
				"GrpID" => $data['rowID'] . "a"
					)
			);
		}

		$this->SelectData2->acceptInvitation($data);

		echo json_encode($data);
	}

	public function loadUsersRequestP($usrID = null) {
		return $this->ViewUsersProcess->processViewFriendsRecorsP($this->SelectData2->RetrieveFriendsNamesPending($usrID));
	}

	public function returnAllUsrOfGroups($usrID) {
		return $this->ViewUsersProcess->processViewFriendsRecorsMembers($this->SelectData2->returnMemberofAllGroups($usrID));
	}

	public function loadUsersRequest($usrID = null) {
		return $this->ViewUsersProcess->processViewFriendsRecors($this->SelectData2->RetrieveFriendsNames($usrID));
	}

	public function loadGroupNames($grpName) {
		return $this->ViewUsersProcess->processViewFriendsM($this->SelectData2->retrieveGroupMemebers($grpName));
	}

	public function loadAllGroupNames($grpName, $usrName) {
		return $this->ViewUsersProcess->processViewFriendsMM($this->SelectData2->getMemebersofGroup($grpName), $usrName);
	}

	public function loadSendRequest($usrID = null) {
		return $this->ViewUsersProcess->processViewFriendsRecordsSend($this->SelectData2->toWhomIhaveSendRequest($usrID));
	}

}
