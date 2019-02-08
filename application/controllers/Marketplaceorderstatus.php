<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Marketplaceorderstatus
 *
 * @author John Papagiannis <intelen>
 */
class Marketplaceorderstatus extends CI_Controller
{

    //put your code here


    public $userIdSession;
    public $userNameSession;
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
            $this->usremail = $this->session->userdata('email');
            $this->usrlevel = $this->session->userdata('user_level');
            $this->userNameSession = $this->session->userdata('username');
            $this->userIdSession = $this->session->userdata('userid');
			$this->dataComponets = $this->SelectData->SelectComponet();
            $this->userLastTimeLogin = $this->SelectData->LastDateUserLogin($this->userIdSession) === 0 ? "" : $this->Generalpurposes->timestampTOdate($this->SelectData->LastDateUserLogin($this->userIdSession));
        }
    }

    public function index()
    {
        $userWhereaboutData = [];
        $data = [];

        $id = 0;

        $data["ActiveTips"] = $this->SelectData->SelectTipsFromSerice($this->usremail);//$this->SelectData->SelectDisplayTips();
        $data["lastTimeLogin"] = $this->userLastTimeLogin;
        $data["username"] = $this->userNameSession;
        $data = array_merge($this->returnAllUsrOfGroups($this->userIdSession), $data);
        $data["usrlevel"] = $this->usrlevel;
		list($data["GroupMessage"], $data["GroupMessageID"]) = $this->SelectData->GetNewServiceNames($this->userIdSession);

        $data_temp = [];
        $data["OrderStatusStore"] = "on";
        //$userWhereaboutData["action"] = "GAME Profile";

        $data = array_merge($data_temp = $this->Load_SalesContent(array('userID' => $this->userIdSession)), $data);
        $data = array_merge($this->dataComponets, $data);
			if($this->usrlevel == 3){
		$data["userIdSession"] = $this->userIdSession.$this->Generalpurposes->createXrandomNumber();
		}
        $this->load->view('orderStatusStore', $data);
    }

    public function loadCont()
    {

        if (!$this->input->is_AJAX_request())
        {
            exit('none AJAX calls rejected!');
        }

        $data = [];

        $data["rowID"] = (int) strip_tags(trim($this->input->post('dataId')));

        if ($data["rowID"] && mb_strlen($data["rowID"], 'UTF-8') < 15)
        {

            $dbResult = $this->SelectData2->SelectAllPendingListOrders(array('userID' => $this->userIdSession, 'timestamp' => $data["rowID"]));

            $productName = "";
            $quantity = "";
            $price = "";

            foreach ($dbResult->result() as $row)
            {

                $productName .= $row->productName . "@";
                $quantity .= $row->quantity . "@";
                $price .= $row->price . "@";
            }

            echo json_encode(array(
                'result' => 200,
                'productName' => substr($productName, 0, -1),
                'quantity' => substr($quantity, 0, -1),
                'price' => substr($price, 0, -1)
            ));
        }
        else
        {

            echo json_encode(array('result' => 201));
        }
    }

    function Load_SalesContent($userId)
    {

        $this->load->model('ViewProcessRequestTraffic', '', TRUE);

        return $this->ViewProcessRequestTraffic->filterSalesValues($this->SelectData2->SelectAllPendingOrders($userId));
    }

    public function returnAllUsrOfGroups($usrID)
    {
        return $this->ViewUsersProcess->processViewFriendsRecorsMembers($this->SelectData2->returnMemberofAllGroups($usrID));
    }

}
