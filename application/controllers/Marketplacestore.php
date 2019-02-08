<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Marketplacestore
 *
 * @author John Papagiannis <intelen>
 */
class Marketplacestore extends CI_Controller {

	//put your code here
	public $userIdSession;
	public $userLastTimeLogin;
	public $username;
	public $usrlevel;
	public $usremail;
	public $dataComponets = [];

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('SelectData', '', TRUE);
		$this->load->model('Random', '', TRUE);
		$this->load->library('session');
		$this->load->model('Trackusers', '', TRUE);
		$this->load->model('Generalpurposes', '', TRUE);
		$this->load->model('SelectData2', '', TRUE);
		$this->load->model('ViewUsersProcess', '', TRUE);

		if ($this->session->userdata('logged_in') !== 1) {
			redirect('Login');
			exit;
		} else {
			$this->usremail = $this->session->userdata('email');
			$this->usrlevel = $this->session->userdata('user_level');
			$this->username = $this->session->userdata('username');
			$this->userIdSession = $this->session->userdata('userid');
			$this->userLastTimeLogin = $this->SelectData->LastDateUserLogin($this->userIdSession) === 0 ? "" : $this->Generalpurposes->timestampTOdate($this->SelectData->LastDateUserLogin($this->userIdSession));
			$this->dataComponets = $this->SelectData->SelectComponet();
			$this->dataComponets["MarketPlaCom"] === "Disable" ? redirect('Dasboard') : "";
		}
	}

	public function index() {

		$data_2 = [];
		$data = [];

		$data_2["ViewMarketplaceStore"] = "on";

		
		$data = array_merge($this->loadUsers($id = $this->usrlevel == 3?$this->userIdSession:0 ), $data_2);
		$data["ActiveTips"] = $this->SelectData->SelectTipsFromSerice($this->usremail); //$this->SelectData->SelectDisplayTips();
		$data["lastTimeLogin"] = $this->userLastTimeLogin;
		$data["username"] = $this->username;
		
		
		if($this->usrlevel == 3){
		$data["userIdSession"] = $this->userIdSession.$this->Generalpurposes->createXrandomNumber();
		}
		
		
		$data = array_merge($this->returnAllUsrOfGroups($this->userIdSession), $data);
		$data["usrlevel"] = $this->usrlevel;

		$cookie_name = "uredf_" . $this->userIdSession;

		if (isset($_COOKIE[$cookie_name])) {
		}
		
		$data = array_merge($this->dataComponets, $data);
		$this->load->view('viewmarketplacestore', $data);
	}

	public function addToBasket() {

		if (!$this->input->is_AJAX_request()) {
			exit('none AJAX calls rejected!');
		}

		$data = [];

		$data["rowID"] = (int) strip_tags(trim($this->input->post('prodid')));

		if ($data["rowID"] && mb_strlen($data["rowID"], 'UTF-8') < 7) {

			$cookievalue = $this->Generalpurposes->createSaveValueCookie($this->userIdSession, $data["rowID"]);
			echo json_encode(array('result' => 200));
		} else {

			echo json_encode(array('result' => 201));
		}
	}

	public function removeToBasket() {
		if (!$this->input->is_AJAX_request()) {
			exit('none AJAX calls rejected!');
		}

		$data = [];

		$data["rowID"] = (int) strip_tags(trim($this->input->post('prodid')));

		if ($data["rowID"] && mb_strlen($data["rowID"], 'UTF-8') < 7) {

			$this->Generalpurposes->removeValueCookie($this->userIdSession, $data["rowID"]);

			echo json_encode(array('result' => 200));
		} else {

			echo json_encode(array('result' => 201));
		}
	}

	public function viewdetails() {

		$data = [];
		$data_2 = [];
		$proID = 0;

		$proID = (int) $this->uri->segment('3');

		if (mb_strlen($proID, 'UTF-8') > 20) {
			$proID = 0;
		}

		$data_2["proID"] = $proID;
		$data_2["ViewMarketplaceStore"] = "on";
		$data = array_merge($this->loadUsersPro($proID), $data_2);
		$data["ActiveTips"] = $this->SelectData->SelectDisplayTips();
		$data["username"] = $this->username;
		$data["lastTimeLogin"] = $this->userLastTimeLogin;
		$data["usrlevel"] = $this->usrlevel;
		$data = array_merge($this->returnAllUsrOfGroups($this->userIdSession), $data);

		$this->Generalpurposes->createSaveValueCookie($this->userIdSession, $proID);
		$data = array_merge($this->dataComponets, $data);
		$this->load->view('viewmarketplaceproduct', $data);
	}

	public function loadUsersPro($proID) {
		$this->load->model('ViewMarketplaceProcess', '', TRUE);
		return $this->ViewMarketplaceProcess->processViewProductsRecords($this->SelectData->SelectMarketProduct("", "On AIR", $proID));
	}

	public function loadUsers($ownID=null) {
		$this->load->model('ViewMarketplaceProcess', '', TRUE);
		return $this->ViewMarketplaceProcess->processViewProductsRecords($this->SelectData->SelectMarketProduct($ownID, "On AIR"));
	}

	public function returnAllUsrOfGroups($usrID) {
		return $this->ViewUsersProcess->processViewFriendsRecorsMembers($this->SelectData2->returnMemberofAllGroups($usrID));
	}

}
