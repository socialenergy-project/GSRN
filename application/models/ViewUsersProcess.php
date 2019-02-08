<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewUsersProcess
 *
 * @author John Papagiannis <intelen>
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class ViewUsersProcess extends CI_Model {

	//put your code here

	function processViewUsersRecors($dbResult) {

		$data = [];
		$UserID = [];
		$UserName = [];
		$UserEmail = [];
		$UserDateRegister = [];
		$LastTimeLogin = [];

		$index = 0;

		foreach ($dbResult->result() as $row) {

			$UserID[$index] = $row->User_ID;
			$UserName[$index] = $row->UserName;
			$UserEmail[$index] = $row->EmailAddress;
			$UserDateRegister[$index] = $row->DateRegister;
			$LastTimeLogin[$index] = $row->LastTimeLogin;

			$index++;
		}
		$data["UserID"] = $UserID;
		$data["UserName"] = $UserName;
		$data["UserEmail"] = $UserEmail;
		$data["UserDateRegister"] = $UserDateRegister;
		$data["LastTimeLogin"] = $LastTimeLogin;

		return $data;
	}

	function processViewFriendsMM($dbResult, $usrName) {

		$data = [];


		$index = 0;
		$usrname = [];
		$timestamp = [];


		foreach ($dbResult->result() as $row) {

			if ($usrName != $row->UserName) {
				$usrname[$index] = $row->UserName;
				$timestamp[$index] = $row->timstInvitationApproval;
			}
			$index++;
		}

		$usrname1 = [];
		$timestamp1 = [];

		foreach ($usrname as $value) {

			$usrname1[] = $value;
		}
		foreach ($timestamp as $value1) {

			$timestamp1[] = $value1;
		}


		$data["usrname"] = $usrname1;
		$data["timestamp"] = $timestamp1;


		return $data;
	}

	function processViewFriendsM($dbResult) {

		$data = [];


		$index = 0;
		$usrname = [];
		$timestamp = [];


		foreach ($dbResult->result() as $row) {

			$usrname[$index] = $row->UserName;
			$timestamp[$index] = $row->timstInvitationApproval;

			$index++;
		}

		$data["usrname"] = $usrname;
		$data["timestamp"] = $timestamp;


		return $data;
	}

	function processViewFriendsRecorsMembers($dbResult) {

		$data = [];
		$rowID = [];
		$AdminID = [];
		$memberID = [];
		$timstInvitationApproval = [];
		$timstInvitationRequest = [];
		$usrFlagLevel = [];
		$usrGroups = [];
		$UserName = [];
		$AdminName = [];
		$grpOwnID = [];


		$index = 0;

		foreach ($dbResult->result() as $row) {


			$rowID[$index] = $row->rowID;
			$AdminID[$index] = $row->AdminID;
			$memberID[$index] = $row->memberID;
			$timstInvitationApproval[$index] = $row->timstInvitationApproval;
			$timstInvitationRequest[$index] = $row->timstInvitationRequest;
			$usrFlagLevel[$index] = $row->usrFlagLevel;
			$usrGroups[$index] = $row->usrGroups;
			$UserName[$index] = $row->UserName;
			$AdminName[$index] = $row->AdminName;
			$grpOwnID[$index] = $row->grpOwnID;

			$index++;
		}


		$data["rowIDX"] = $rowID;
		$data["AdminIDX"] = $AdminID;
		$data["memberIDX"] = $memberID;
		$data["timstInvitationApprovalX"] = $timstInvitationApproval;
		$data["timstInvitationRequestX"] = $timstInvitationRequest;
		$data["usrFlagLevelX"] = $usrFlagLevel;
		$data["usrGroupsX"] = $usrGroups;
		$data["UserNameX"] = $UserName;
		$data["AdminNameX"] = $AdminName;
		$data["grpOwnIDX"] = $grpOwnID;

		return $data;
	}

	function processViewFriendsRecors($dbResult) {

		$data = [];
		$rowID = [];
		$AdminID = [];
		$memberID = [];
		$timstInvitationApproval = [];
		$timstInvitationRequest = [];
		$usrFlagLevel = [];
		$usrGroups = [];
		$UserName = [];
		$AdminName = [];
		$grpOwnID = [];

		$index = 0;

		foreach ($dbResult->result() as $row) {

			$rowID[$index] = $row->rowID;
			$AdminID[$index] = $row->AdminID;
			$memberID[$index] = $row->memberID;
			$timstInvitationApproval[$index] = $row->timstInvitationApproval;
			$timstInvitationRequest[$index] = $row->timstInvitationRequest;
			$usrFlagLevel[$index] = $row->usrFlagLevel;
			$usrGroups[$index] = $row->usrGroups;
			$UserName[$index] = $row->UserName;
			$AdminName[$index] = $row->AdminName;
			$grpOwnID[$index] = $row->grpOwnID;

			$index++;
		}

		$data["rowID"] = $rowID;
		$data["AdminID"] = $AdminID;
		$data["memberID"] = $memberID;
		$data["timstInvitationApproval"] = $timstInvitationApproval;
		$data["timstInvitationRequest"] = $timstInvitationRequest;
		$data["usrFlagLevel"] = $usrFlagLevel;
		$data["usrGroups"] = $usrGroups;
		$data["UserName"] = $UserName;
		$data["AdminName"] = $AdminName;
		$data["grpOwnID"] = $grpOwnID;

		return $data;
	}

	function processViewFriendsRecorsP($dbResult) {

		$data = [];
		$rowID = [];
		$AdminID = [];
		$memberID = [];
		$timstInvitationApproval = [];
		$timstInvitationRequest = [];
		$usrFlagLevel = [];
		$usrGroups = [];
		$UserName = [];
		$AdminName = [];
		$grpOwnID = [];


		$index = 0;

		foreach ($dbResult->result() as $row) {


			$rowID[$index] = $row->rowID;
			$AdminID[$index] = $row->AdminID;
			$memberID[$index] = $row->memberID;
			$timstInvitationApproval[$index] = $row->timstInvitationApproval;
			$timstInvitationRequest[$index] = $row->timstInvitationRequest;
			$usrFlagLevel[$index] = $row->usrFlagLevel;
			$usrGroups[$index] = $row->usrGroups;
			$UserName[$index] = $row->UserName;
			$AdminName[$index] = $row->AdminName;
			$grpOwnID[$index] = $row->grpOwnID;

			$index++;
		}


		$data["rowIDP"] = $rowID;
		$data["AdminIDP"] = $AdminID;
		$data["memberIDP"] = $memberID;
		$data["timstInvitationApprovalP"] = $timstInvitationApproval;
		$data["timstInvitationRequestP"] = $timstInvitationRequest;
		$data["usrFlagLevelP"] = $usrFlagLevel;
		$data["usrGroupsP"] = $usrGroups;
		$data["UserNameP"] = $UserName;
		$data["AdminNameP"] = $AdminName;
		$data["grpOwnIDP"] = $grpOwnID;


		return $data;
	}

	function processViewFriendsRecordsSend($dbResult) {

		$data = [];
		$rowID = [];
		$AdminID = [];
		$memberID = [];
		$timstInvitationApproval = [];
		$timstInvitationRequest = [];
		$usrFlagLevel = [];
		$usrGroups = [];
		$UserName = [];
		$AdminName = [];
		$grpOwnID = [];

		$index = 0;

		foreach ($dbResult->result() as $row) {


			$rowID[$index] = $row->rowID;
			$AdminID[$index] = $row->AdminID;
			$memberID[$index] = $row->memberID;
			$timstInvitationApproval[$index] = $row->timstInvitationApproval;
			$timstInvitationRequest[$index] = $row->timstInvitationRequest;
			$usrFlagLevel[$index] = $row->usrFlagLevel;
			$usrGroups[$index] = $row->usrGroups;
			$UserName[$index] = $row->UserName;
			$AdminName[$index] = $row->AdminName;
			$grpOwnID[$index] = $row->grpOwnID;

			$index++;
		}


		$data["rowID_Send"] = $rowID;
		$data["AdminID_Send"] = $AdminID;
		$data["memberID_Send"] = $memberID;
		$data["timstInvitationApproval_Send"] = $timstInvitationApproval;
		$data["timstInvitationRequest_Send"] = $timstInvitationRequest;
		$data["usrFlagLevel_Send"] = $usrFlagLevel;
		$data["usrGroups_Send"] = $usrGroups;
		$data["UserName_Send"] = $UserName;
		$data["AdminName_Send"] = $AdminName;
		$data["grpOwnID_Send"] = $grpOwnID;

		return $data;
	}

}
