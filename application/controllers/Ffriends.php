<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of ffriends
 *
 * @author John Papagiannis <intelen>
 */
class Ffriends extends CI_Controller
{

    //put your code here
    public $username;
    public $userIdSession;
    public $userLastTimeLogin;
    public $usrlevel;
	public $usremail;
	public $usrPlatfromCredits;

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('Conprocess', '', TRUE);
        $this->load->model('SaveData', '', TRUE);
        $this->load->model('UpdateData', '', TRUE);
        $this->load->model('SelectData', '', TRUE);
        $this->load->model('SelectData2', '', TRUE);
        $this->load->model('ViewUsersProcess', '', TRUE);
        $this->load->library('session');
        $this->load->model('Trackusers', '', TRUE);
        $this->load->model('Generalpurposes', '', TRUE);
        $this->load->model('Random', '', TRUE);
        $this->load->model('ViewAdminProcess', '', TRUE);

        if ($this->session->userdata('logged_in') !== 1)
        {
            redirect('Login');
            exit;
        }
        else
        {
            $this->usrlevel = $this->session->userdata('user_level');
            $this->username = $this->session->userdata('username');
            $this->userIdSession = $this->session->userdata('userid');
			$this->usremail = $this->session->userdata('email');
            $this->userLastTimeLogin = $this->SelectData->LastDateUserLogin($this->userIdSession) === 0 ? "" : $this->Generalpurposes->timestampTOdate($this->SelectData->LastDateUserLogin($this->userIdSession));
            
			$this->load->model('FilterRec', '', TRUE);
			$num = $this->FilterRec->filterRecValuesActions($this->SelectData2->countVisitsOfUser($this->userIdSession)) * 0.1;			
	        $num2 = $this->FilterRec->filterRecValuesActionsTLG($this->SelectData2->getTotalScoreOfLcmsGame($this->userIdSession, $this->username)) ;
	        $this->usrPlatfromCredits = number_format($num + $num2);
			
		}
    }

    public function index()
    {
        $data = [];
        $data_2 = [];

        // $data_2["AdminGroups"] = "on";
        $data_2["ActiveTips"]= $this->SelectData->SelectTipsFromSerice($this->usremail);//$this->SelectData->SelectDisplayTips();
        $data_2["lastTimeLogin"] = $this->userLastTimeLogin;

        $data = array_merge($this->loadUsersRequest($this->userIdSession), $data_2);
        $data = array_merge($this->returnAllUsrOfGroups($this->userIdSession), $data);
        $data["username"] = $this->username;
        $data["usrlevel"] = $this->usrlevel;
        $data["usrPlatfromCredits"] = $this->usrPlatfromCredits;
		
        $this->load->view('find_friend', $data);
    }

    public function reqd()
    {

        if (!$this->input->is_AJAX_request())
            exit('none AJAX calls rejected!');

        $postVariable = [];
        $postVariable_2 = [];
        $data = [];

        // legth messasure

        $postVariable['usr'] = (int) substr(strip_tags(trim($this->input->post('usr'))), 0, -3);
        $postVariable['grouName'] = strip_tags(trim($this->input->post('grouName')));

        $postVariable_2["Group_Name"] = $postVariable['grouName'];
        if (mb_strlen($postVariable['usr'], 'UTF-8') > 15 || trim(mb_strlen($postVariable['grouName'], 'UTF-8')) > 65)
        {

            $postVariable_2["status"] = 201;
            exit(json_encode($postVariable_2));
            
        }elseif($this->ViewAdminProcess->processFriendsRequest($this->SelectData2->PullUserGroups($dataTemp2 = array("AdminID"=>$this->userIdSession,"memberID"=>$postVariable['usr'],"usrGroups"=>$postVariable['grouName']))) === TRUE){
                   
            $postVariable_2["status"] = 202;
            exit(json_encode($postVariable_2));
            
        }elseif($this->userIdSession == $postVariable['usr']){
            
            $postVariable_2["status"] = 203;
            exit(json_encode($postVariable_2));
            
        }
        else
        {
            $postVariable_2["status"] = 200;
        }

        $receivedData["StatusPro"] = "Pending";

        $this->load->model('Insertdata', '', TRUE);

        $data["AdminID"] = $this->userIdSession;
        $data["memberID"] = $postVariable['usr'];
        $data["timstInvitationRequest"] = $this->Generalpurposes->createGMTtimestampOffset();
        $data["usrGroups"] = $postVariable['grouName'];
        $data["usrFlagLevel"] = 1;
        $data["grpOwnID"] = $this->userIdSession;
        
		$recordID = $this->Insertdata->InsertdataTableID('MemberUserGroups', $data);
		

		
	   if($recordID > 0 && $this->SelectData->SelectUserGroupidEXISTS($recordID."f") === false ){
		   
		   
		   
			  $result = $this->SelectData->GetUserIDfExists($postVariable['usr']); 
			  
			  $usernameToStack = "";
			  
		  foreach ($result->result() as $row){
			  
				if (isset($row->UserName)){
					
				$usernameToStack = $row->UserName;	
						
				}
			  
		  }

				   
		   $this->Insertdata->InsertdataTablError("messageStack",
			    $messageStack=array(
				"MessageType"=>"FriendRequestPost",
				"Text"=>"Friend request from user {$this->username} to join group {$data["usrGroups"]} has being send to you!",
				"Status"=>"unread",
				"Username"=>$postVariable['usr'],
				"Timestamp"=>$this->Generalpurposes->createGMTtimestampOffset(),
				"GrpID"=>$recordID."f"		
						)
						);
			
	   }

	   
	   
        echo json_encode($postVariable_2);
    }
	

    public function finfriend()
    {

        if (!$this->input->is_AJAX_request())
            exit('none AJAX calls rejected!');

        $postVariable = [];
        $data = [];
        $dataTmp = [];
        $digitsToAdd = 0;
        $digits = 3;


        $postVariable['GroupName'] = strip_tags(trim($this->input->post('GroupName')));
        $postVariable['UserName'] = strip_tags(trim($this->input->post('UserName')));
        $digitsToAdd = rand(pow(10, $digits - 1), pow(10, $digits) - 1);


        if ($this->ViewAdminProcess->processIfICanSearchDB($this->SelectData->CanIsearchUsersForAsAdminForGroups($this->userIdSession, $postVariable['GroupName'])))
        {

            // $data = array_merge($this->searchUsrName($postVariable['UserName']), $postVariable);
            $dataTmp = $this->searchUsrName($postVariable['UserName']);


            //substr($string, 0, -3);
            //echo $dataTmp["UsrID"][0];
            $data["UsrID"] = $dataTmp["UsrID"][0] . $digitsToAdd;
            $data["GroupName"] = $postVariable['GroupName'];
            $data["UserName"] = $postVariable['UserName'];
        }
        else
        {
            $data['GroupName'] = $postVariable['GroupName'];
            $data['UserName'] = $postVariable['UserName'];
            $data['Usrd'] = 1643567;
        }


        echo json_encode($data);
    }

    public function searchUsrName($usrName)
    {

     
        return $this->ViewAdminProcess->processUserName($this->SelectData2->SearchUserByUserName($usrName));
    }

    public function loadUsersRequest($usrID = null)
    {


        return $this->ViewAdminProcess->processViewUsersRequestRecords($this->SelectData->RetrieveGroupNames($usrID), 1);
    }
    
     public function returnAllUsrOfGroups($usrID)
    {
        return $this->ViewUsersProcess->processViewFriendsRecorsMembers($this->SelectData2->returnMemberofAllGroups($usrID));
    }

}
