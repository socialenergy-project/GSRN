<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Groups extends CI_Controller
{
    public $username;
    public $userIdSession;
    public $userLastTimeLogin;
    public $usrlevel;
	public $usremail;
	public $dataComponets = [];

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('Conprocess', '', TRUE);
        $this->load->model('SaveData', '', TRUE);
        $this->load->model('UpdateData', '', TRUE);
        $this->load->model('SelectData', '', TRUE);
        $this->load->library('session');
        $this->load->model('Trackusers', '', TRUE);
        $this->load->model('Generalpurposes', '', TRUE);
        $this->load->model('Random', '', TRUE);
        $this->load->model('SelectData2', '', TRUE);
        $this->load->model('ViewUsersProcess', '', TRUE);


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
			$this->dataComponets = $this->SelectData->SelectComponet();
            $this->userLastTimeLogin = $this->SelectData->LastDateUserLogin($this->userIdSession) === 0 ? "" : $this->Generalpurposes->timestampTOdate($this->SelectData->LastDateUserLogin($this->userIdSession));
        }
    }

    public function index()
    {

        $userWhereaboutData = [];

        $data = [];
        $data_2 = [];
        $data_2["ActiveTips"] = $this->SelectData->SelectTipsFromSerice($this->usremail);//$this->SelectData->SelectDisplayTips();
        $data_2["lastTimeLogin"] = $this->userLastTimeLogin;

        $data = array_merge($this->loadUsersRequest($this->userIdSession), $data_2);
        $data = array_merge($this->returnAllUsrOfGroups($this->userIdSession), $data);
        $data["username"] = $this->username;
        $data["usrlevel"] = $this->usrlevel;
        $data = array_merge($this->dataComponets, $data);
        $this->load->view('groupsnews', $data);
    }

    public function loadUsersRequest($usrID=null)
    {

        $this->load->model('ViewAdminProcess', '', TRUE);
        return $this->ViewAdminProcess->processViewUsersRequestRecords($this->SelectData->SelectUserRequestForAdminRole($usrID));
    }
    
    public function returnAllUsrOfGroups($usrID)
    {
        return $this->ViewUsersProcess->processViewFriendsRecorsMembers($this->SelectData2->returnMemberofAllGroups($usrID));
    }


}
