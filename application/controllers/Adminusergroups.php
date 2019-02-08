<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Adminusergroups
 *
 * @author John Papagiannis <intelen>
 */
class Adminusergroups extends CI_Controller
{

    //put your code here


    public $userIdSession;
    public $userLastTimeLogin;
    public $usrlevel;
    public $usremail;

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


        if ($this->session->userdata('logged_in') !== 1)
        {
            redirect('Login');
            exit;
        }
        else
        {
            $this->usremail = $this->session->userdata('email');
            $this->usrlevel = $this->session->userdata('user_level');
            $this->userIdSession = $this->session->userdata('userid');
            $this->userLastTimeLogin = $this->SelectData->LastDateUserLogin($this->userIdSession) === 0 ? "" : $this->Generalpurposes->timestampTOdate($this->SelectData->LastDateUserLogin($this->userIdSession));
        }
    }

    public function index()
    {

        $userWhereaboutData = [];

        $data = [];
        $data_2 = [];

        $data_2["AdminGroups"] = "on";
        $data_2["ActiveTips"] = $this->SelectData->SelectTipsFromSerice($this->usremail);//$this->SelectData->SelectDisplayTips();
        $data_2["lastTimeLogin"] = $this->userLastTimeLogin;

        $data = array_merge($this->loadUsersRequest(), $data_2);
        $data["usrlevel"] = $this->usrlevel;
        $this->load->view('grantrightadmin', $data);
    }

    public function loadUsersRequest()
    {

        $this->load->model('ViewAdminProcess', '', TRUE);
        return $this->ViewAdminProcess->processViewUsersRequestRecords($this->SelectData->SelectUserRequestForAdminRole());
    }

}
