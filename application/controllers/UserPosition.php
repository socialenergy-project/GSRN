<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserPosition
 *
 * @author John Papagiannis <intelen>
 */
class UserPosition extends CI_Controller
{

    //put your code here

    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');

        $this->load->model('Trackusers', '', TRUE);
        $this->load->model('Generalpurposes', '', TRUE);
        $this->load->model('Random', '', TRUE);
        $this->load->model('variablesProcess/FilterVariablesQuest', 'FilterVariablesQuest', TRUE);


        $this->newQuestIntoSystem = $this->session->flashdata('newQuestIntoSystem');

        if ($this->session->userdata('logged_in') !== 1) {

            exit;
        } else {
            $this->userIdSession = $this->session->userdata('userid');
        }
       
    }

    function sposition() {

        if (!$this->input->is_AJAX_request()) {
            exit('none AJAX calls rejected!');
        }

        $type_of_action = "";
        $action = "";

        $type_of_action = $this->input->post('type_of_action');
        $action = $this->input->post('action');

        $userWhereaboutData = $this->FilterVariablesQuest->filterVariableRecomm(
                $this->userIdSession, $this->Generalpurposes->createGMTtimestampOffset(), $type_of_action, $action, trim($this->Random->getOS($_SERVER['HTTP_USER_AGENT'])), trim($this->Random->getBrowser($_SERVER['HTTP_USER_AGENT'])), trim($_SERVER['HTTP_USER_AGENT']));


        $this->Trackusers->saveUsersTrack($userWhereaboutData);
    }

}
