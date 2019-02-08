<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Adduser
 *
 * @author John Papagiannis <intelen>
 */
class Adduser extends CI_Controller
{

    //put your code here
    public $userIdSession;
    public $userLastTimeLogin;
    public $ActiveTips;
    public $username;
    public $usrlevel;
    public $usremail;

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('SaveData', '', TRUE);
        $this->load->model('Random', '', TRUE);
        $this->load->model('SelectData', '', TRUE);
        $this->load->model('Auth2calls', '', TRUE);
        $this->load->model('Trackusers', '', TRUE);
        $this->load->model('Generalpurposes', '', TRUE);
        $this->load->model('SelectData2', '', TRUE);
        $this->load->model('ViewUsersProcess', '', TRUE);
        $this->load->library('session');

        if ($this->session->userdata('logged_in') !== 1)
        {
            redirect('Login');
            exit;
        }
        else
        {
            $this->usremail = $this->session->userdata('email');
            $this->usrlevel = $this->session->userdata('user_level');
            $this->username = $this->session->userdata('username');
            $this->userIdSession = $this->session->userdata('userid');
            $this->userLastTimeLogin = $this->SelectData->LastDateUserLogin($this->userIdSession) === 0 ? "" : $this->Generalpurposes->timestampTOdate($this->SelectData->LastDateUserLogin($this->userIdSession));
            $this->ActiveTips = $this->SelectData->SelectTipsFromSerice($this->usremail);//$this->SelectData->SelectDisplayTips();


            //$data["ActiveTips"]
        }
    }

    public function saveuser()
    {


        if ($_SERVER['REQUEST_METHOD'] != 'POST')
        {

            $this->index();
        }

        $newUser = "off";
        $receivedData = [];
        $data = [];
        $tokenCreateData = [];
        $flagBuggy = [];

        $receivedData = $this->input->post();

        $data["AddUser"] = "on";
        $data["ActiveTips"] = $this->ActiveTips; //$this->SelectData->SelectDisplayTips();

        $receivedData["UserName"] = strip_tags(trim($this->input->post("Username_1")));
        $receivedData["EmailAddress"] = strip_tags(trim($this->input->post("email_1")));
        $receivedData["firtName_1"] = strip_tags(trim($this->input->post("firtName_1")));
        $receivedData["lastName_1"] = strip_tags(trim($this->input->post("lastName_1")));
        //$receivedData["escoUser"] = strip_tags(trim($this->input->post("escoUser")));

		$receivedData["escoUser"] = (strip_tags(trim($this->input->post("escoUser"))) == "On" ? 3 : "");
			
        $receivedData["Timestamp"] = "";
        $tokenCreateData["client_id"] = $receivedData["UserName"]; //$this->Random->generateRandomString(); //$this->input->post("Username_1");//
        $tokenCreateData["client_secret"] = strip_tags(trim($this->input->post("password_1")));
        $tokenCreateData["redirect_uri"] = "http://fake/";

 
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('firtName_1', 'First name', 'required|min_length[2]|max_length[50]|trim|strip_tags');
        $this->form_validation->set_rules('lastName_1', 'Last name', 'required|min_length[2]|max_length[50]|trim|strip_tags');
        $this->form_validation->set_rules('Username_1', 'Username', 'required|min_length[2]|max_length[50]|trim|strip_tags|callback_unique_username');
        $this->form_validation->set_rules('email_1', 'Email', 'required|min_length[2]|max_length[50]|trim|strip_tags|valid_email|callback_unique_email');
        $this->form_validation->set_rules('password_1', 'Password', 'required|min_length[2]|max_length[50]|trim|strip_tags');

        $tokenCreateData = $this->security->xss_clean($tokenCreateData);
        $receivedData = $this->security->xss_clean($receivedData);

        if ($this->form_validation->run() == FALSE
        )
        {
            $data["Username_1"] = $receivedData["UserName"];
            $data["email_1"] = $receivedData["EmailAddress"];
            $data["password_1"] = $tokenCreateData["client_secret"];
			$data["usrlevel"] = $this->usrlevel;
			$data["escoUser"] = $receivedData["escoUser"];
			
            $this->load->view('adduser', $data);
        }
        else
        {

            $this->load->model('Generalpurposes', '', TRUE);

            $argumentsUserSave = [];
            $argumentsUserSave["username"] = $receivedData["UserName"];
            $argumentsUserSave["password"] = $tokenCreateData["client_secret"];
            $argumentsUserSave["first_name"] = $receivedData["firtName_1"];
            $argumentsUserSave["last_name"] = $receivedData["lastName_1"];
            $argumentsUserSave["email"] = $receivedData["EmailAddress"];
            $argumentsUserSave["email_verified"] = $receivedData["EmailAddress"];
            $argumentsUserSave["scope"] = "openid profile email";
            $argumentsUserSave["middle_name"] = $receivedData["lastName_1"];
            $argumentsUserSave["family_name"] = $receivedData["lastName_1"];
            $argumentsUserSave["given_name"] = $receivedData["lastName_1"];

            $this->SaveData->CreateClientUsersToken($argumentsUserSave);
            $array = $this->Auth2calls->CreateClientUserToken($receivedData["UserName"], $tokenCreateData["client_secret"], $receivedData["firtName_1"], $receivedData["lastName_1"], "iccs2", "secret2");

            if (mb_strlen($array["access_token"], 'UTF-8') > 2 && mb_strlen($array["access_token"], 'UTF-8') < 150)//mb_strlen($array["access_token"], 'UTF-8')
            {
                $receivedData["PasswordToken"] = $array["access_token"];
                $receivedData["Password"] = $tokenCreateData["client_secret"];
                $receivedData["timestamp_GMT_00"] = $this->Generalpurposes->createGMTtimestampOffset();
                $receivedData["DateRegister"] = $this->Generalpurposes->createGMTdateOffset(); //date("Y-m-d H:i:s");
                $receivedData["Status"] = "Pending";
				$receivedData["UserLevel"] = $receivedData["escoUser"] == 3?3:0;
            }

           $this->SaveData->SaveUser($receivedData);//
           $array = $this->Auth2calls->CreateAccountToLcms($argumentsUserSave["username"], $argumentsUserSave["first_name"], $argumentsUserSave["last_name"], $argumentsUserSave["email"]);
   
            if (isset($array["id"]))
            {
                $argumentsUserSave["RowIdLcms"] = $array["id"];
                $argumentsUserSave["Timestamp_GMT_00"] = $receivedData["timestamp_GMT_00"];
                $this->SaveData->SaveLcmsCreateAccount($argumentsUserSave);
            }
   
            $newUser = "on";
            $this->session->set_flashdata('newUserIntoSystem', "on");
            redirect('viewusers');
        }

        // $this->load->view('adduser', $data);
    }

    public function index($save = "off")
    {

        $data = [];
        $userWhereaboutData = [];

        $data["AddUser"] = "on";
        $data["ActiveTips"] = $this->ActiveTips; //$this->SelectData->SelectDisplayTips();
        $data["lastTimeLogin"] = $this->userLastTimeLogin;
        $data["username"] = $this->username;
        $data["usrlevel"] = $this->usrlevel;
        $data = array_merge($this->returnAllUsrOfGroups($this->userIdSession), $data);      
        $this->load->view('adduser', $data);
    }

    function unique_email($str)
    {

        $query = $this->SelectData->GetUserEmailIfExists(strip_tags(trim($str)));

        $this->form_validation->set_message("unique_email", 'please choose different email.');
        $boolean = TRUE;
        foreach ($query->result() as $row)
        {

            if ($row->first_name)
            {
                $boolean = FALSE;
            }
        }
        return $boolean;
    }

    function unique_username($str)
    {

        $query = $this->SelectData->GetUserUsernameIfExist(strip_tags(trim($str)));

        $this->form_validation->set_message("unique_username", 'please choose different username.');
        $boolean = TRUE;
        foreach ($query->result() as $row)
        {

            if ($row->UserName)
            {
                $boolean = FALSE;
            }
        }
        return $boolean;
    }
    
     public function returnAllUsrOfGroups($usrID)
    {
        return $this->ViewUsersProcess->processViewFriendsRecorsMembers($this->SelectData2->returnMemberofAllGroups($usrID));
    }

}
