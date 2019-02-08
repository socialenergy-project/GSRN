<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Recommendationslist
 *
 * @author John Papagiannis <intelen>
 */
class Recommendationslist extends CI_Controller
{

    public $newTipIntoSystem;
    public $userIdSession;
    public $userLastTimeLogin;
    public $usrlevel;
    //put your code here

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('SelectData', '', TRUE);
        $this->load->library('session');
        $this->load->model('SelectData', '', TRUE);
        $this->newTipIntoSystem = $this->session->flashdata('newTipIntoSystem');
        $this->load->model('Trackusers', '', TRUE);
        $this->load->model('Generalpurposes', '', TRUE);
        $this->load->model('Random', '', TRUE);
        
         if ($this->session->userdata('logged_in') !== 1) {
            redirect('Login');
            exit;
        } else {
            $this->usrlevel = $this->session->userdata('user_level');
            $this->userIdSession = $this->session->userdata('userid');
           $this->userLastTimeLogin = $this->SelectData->LastDateUserLogin($this->userIdSession) === 0 ? "" : $this->Generalpurposes->timestampTOdate($this->SelectData->LastDateUserLogin($this->userIdSession));
        }
        
    }

    public function index() {

        $data_3 = [];
        $data_2 = [];
        $data = [];
        $userWhereaboutData = [];

        $data_2["RecommendationsList"] = "on";
        $data_2["newTipIntoSystem"] = $this->newTipIntoSystem;

        $data = array_merge($this->loadTips(), $data_2);

        $data["ActiveTips"] = $this->SelectData->SelectDisplayTips();
        $data["lastTimeLogin"] = $this->userLastTimeLogin;
        $data["usrlevel"] = $this->usrlevel;

        $this->load->view('viewtips', $data);
    }

    public function loadTips() {

        $query = "";
        $data = [];

        $UserID = [];
        $descM = [];
        $dateFrom = [];
        $dateTo = [];

        $index = 0;

        $query = $this->SelectData->SelectTipsRecord();

        foreach ($query->result() as $row) {

            $UserID[$index] = $row->UserID;
            $descM[$index] = $row->descM;
            $dateFrom[$index] = $row->dateFrom;
            $dateTo[$index] = $row->dateTo;

            $index++;
        }

        $data["UserID"] = $UserID;
        $data["descM"] = $descM;
        $data["dateFrom"] = $dateFrom;
        $data["dateTo"] = $dateTo;

        return $data;
    }

}
