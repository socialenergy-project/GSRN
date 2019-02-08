<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Viewusers
 *
 * @author John Papagiannis <intelen>
 */
class Viewusers extends CI_Controller
{

    //put your code here
    public $newUserIntoSystem;
    public $userIdSession;
    public $userLastTimeLogin;
    public $username;
    public $usrlevel;
    public $usremail;

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->model('SelectData', '', TRUE);
        $this->load->model('Trackusers', '', TRUE);
        $this->load->model('Generalpurposes', '', TRUE);
        $this->load->model('Random', '', TRUE);
        $this->load->model('SelectData2', '', TRUE);
        $this->load->model('ViewUsersProcess', '', TRUE);

        $this->newUserIntoSystem = $this->session->flashdata('newUserIntoSystem');
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
        }
    }

    public function index()
    {

        $data_2 = array();
        $data = array();

        $data_2["ViewUser"] = "on";
        $data_2["newUserIntoSystem"] = $this->newUserIntoSystem;

        $data = array_merge($this->loadUsers(), $data_2);
        $data["ActiveTips"] = $this->SelectData->SelectTipsFromSerice($this->usremail);//$this->SelectData->SelectDisplayTips();
        $data["lastTimeLogin"] = $this->userLastTimeLogin;
        $data["username"] = $this->username;
        $data["usrlevel"] = $this->usrlevel;
        
        $data = array_merge($this->returnAllUsrOfGroups($this->userIdSession), $data);

        $this->load->view('viewusers', $data);
    }

    public function loadUsers()
    {
        $this->load->model('ViewUsersProcess', '', TRUE);
        return $this->ViewUsersProcess->processViewUsersRecors($this->SelectData->SelectUsersRecord());
    }
     public function returnAllUsrOfGroups($usrID)
    {
        return $this->ViewUsersProcess->processViewFriendsRecorsMembers($this->SelectData2->returnMemberofAllGroups($usrID));
    }

}
