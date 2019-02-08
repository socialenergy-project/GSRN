<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author John Papagiannis <intelen>
 */
class Login extends CI_Controller
{

    public $tempUserId;

    //put your code here
    function __construct()
    {

        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation', 'session');
        $this->load->model('Auth2calls', '', TRUE);
        $this->load->model('Auth', '', TRUE);

        if (isset($_SESSION["username"]))
        {
            unset($_SESSION["username"]);
        }

        if (isset($_SESSION["email"]))
        {
            unset($_SESSION["email"]);
        }

        if (isset($_SESSION["userid"]))
        {
            $this->tempUserId = $_SESSION["userid"];
            unset($_SESSION["userid"]);
        }

        if (isset($_SESSION["logged_in"]))
        {
            unset($_SESSION["logged_in"]);
        }
    }

    public function index()
    {


        $this->load->view('login');
    }

    public function logout()
    {

        $this->load->model('Generalpurposes', '', TRUE);
        $this->load->model('Random', '', TRUE);
        $this->load->model('Trackusers', '', TRUE);
        $this->load->library('session');

        if (isset($_SESSION["userid"]))
        {

            $userWhereaboutData = [];
            $userWhereaboutData["userID"] = $_SESSION["userid"];
            $userWhereaboutData["timestamp"] = $this->Generalpurposes->createGMTtimestampOffset();
            $userWhereaboutData["type_of_action"] = "click";
            $userWhereaboutData["action"] = "LogOut";
            $userWhereaboutData["os"] = trim($this->Random->getOS($_SERVER['HTTP_USER_AGENT']));
            $userWhereaboutData["browser"] = trim($this->Random->getBrowser($_SERVER['HTTP_USER_AGENT']));
            $userWhereaboutData["agent"] = trim($_SERVER['HTTP_USER_AGENT']);
            sleep(1);
            $this->Trackusers->saveUsersTrack($userWhereaboutData);
            unset($_SESSION["userid"]);
            $this->session->sess_destroy();
        }
        // $this->load->view('login');
        $this->index();
    }

    function auth()
    {

        if ($_SERVER['REQUEST_METHOD'] != 'POST')
        {

            $this->index();
        }
        else
        {

            $queryResult;
            $Credential = [];
            $isConnected = false;


            $Credential["UserName"] = trim(strip_tags($this->input->post('nameID')));
            $Credential["Password"] = trim(strip_tags($this->input->post('passwordID')));
            $Credential = $this->security->xss_clean($Credential);

            $userID = 0;

            $EmailAddress = "";
            $PasswordToken = "";
            $UserName = "";

            $queryResult = $this->Auth->AuthorizeUser($Credential["UserName"], $Credential["Password"]);

            foreach ($queryResult->result() as $row)
            {

                if ($row->User_ID && password_verify($Credential["Password"], $row->Password))
                {
                    $EmailAddress = $row->EmailAddress;
                    $userID = $row->User_ID;
                    $PasswordToken = $row->PasswordToken;
                    $UserName = $row->UserName;

                    $isConnected = true;
                }
            }


            if ($isConnected === true)
            {

                $newdata = array(
                    'username' => $Credential["UserName"],
                    'email' => $EmailAddress,
                    'userid' => $userID,
                    'PasswordToken' => $PasswordToken,
                    'UserName' => $UserName,
                    'Password' => $Credential["Password"],
                    'logged_in' => 1
                );
                $this->load->library('session');
               
                $this->session->set_userdata($newdata);

                $this->load->model('Generalpurposes', '', TRUE);
                $this->load->model('Random', '', TRUE);
                $this->load->model('Trackusers', '', TRUE);
                $this->load->model('SelectData', '', TRUE);

                $userWhereaboutData = array();
                $userWhereaboutData["userID"] = $userID;
                $userWhereaboutData["timestamp"] = $this->Generalpurposes->createGMTtimestampOffset();
                $userWhereaboutData["type_of_action"] = "click";
                $userWhereaboutData["action"] = "Login";
                $userWhereaboutData["os"] = trim($this->Random->getOS($_SERVER['HTTP_USER_AGENT']));
                $userWhereaboutData["browser"] = trim($this->Random->getBrowser($_SERVER['HTTP_USER_AGENT']));
                $userWhereaboutData["agent"] = trim($_SERVER['HTTP_USER_AGENT']);


                $this->Trackusers->saveUsersTrack($userWhereaboutData);
                sleep(1);

                if ($this->SelectData->SelectIfhehasAnswerQuestion($userID) === FALSE)
                {
                    redirect('questionnaire/index');
                }
                else
                {
                    redirect('dasboard/index');
                }
            }
            elseif (
                    $this->input->post('nameID') == "Admin" &&
                    $this->input->post('passwordID') == "Admin")
            {

                redirect('ladmin/index');
            }
            else
            {

                $this->load->view('login', array('userName' => 'wrong username', 'passWord' => 'wrong password'));
            }
        }
    }

}
