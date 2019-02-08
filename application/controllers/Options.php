<?php

error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Options
 *
 * @author John Papagiannis <intelen>
 */
//error_reporting(0);
//error_reporting(E_ERROR | E_PARSE);
class Options extends CI_Controller {

	//put your code here

	public $userIdSession;
	public $userNameSession;
	public $userLastTimeLogin;
	public $usrlevel;
	public $usremail;
	public $dataComponets = [];
	public $usrPlatfromCredits;

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('Conprocess', '', TRUE);
		$this->load->model('SaveData', '', TRUE);
		$this->load->model('UpdateData', '', TRUE);
		$this->load->model('SelectData', '', TRUE);
		$this->load->model('SelectData2', '', TRUE);
		$this->load->library('session');
		$this->load->model('Trackusers', '', TRUE);
		$this->load->model('Generalpurposes', '', TRUE);
		$this->load->model('Random', '', TRUE);
		$this->load->model('SelectData2', '', TRUE);
		$this->load->model('ViewUsersProcess', '', TRUE);

		if ($this->session->userdata('logged_in') !== 1) {
			redirect('Login');
			exit;
		} else {
			$this->usrlevel = $this->session->userdata('user_level');
			$this->userNameSession = $this->session->userdata('username');
			$this->userIdSession = $this->session->userdata('userid');
			$this->usremail = $this->session->userdata('email');
			$this->userLastTimeLogin = $this->SelectData->LastDateUserLogin($this->userIdSession) === 0 ? "" : $this->Generalpurposes->timestampTOdate($this->SelectData->LastDateUserLogin($this->userIdSession));
		
			$this->load->model('FilterRec', '', TRUE);
			
			$num = $this->FilterRec->filterRecValuesActions($this->SelectData2->countVisitsOfUser($this->userIdSession)) * 0.1;		
	        $num2 = $this->FilterRec->filterRecValuesActionsTLG($this->SelectData2->getTotalScoreOfLcmsGame($this->userIdSession, $this->userNameSession)) ;
	        $this->usrPlatfromCredits = number_format($num + $num2);
			
		}
	}

	public function index() {
		$userWhereaboutData = [];
		$data = [];

		$id = 0;
		$get_array = $this->uri->uri_to_assoc(3);
		$offset = 0;
		$this->dataComponets = $this->SelectData->SelectComponet();
		$data["ActiveTips"] = $this->SelectData->SelectTipsFromSerice($this->usremail);
		$data["lastTimeLogin"] = $this->userLastTimeLogin;
		$data["username"] = $this->userNameSession;
		$data = array_merge($this->returnAllUsrOfGroups($this->userIdSession), $data);
		$data["usrlevel"] = $this->usrlevel;
		list($data["GroupMessage"], $data["GroupMessageID"]) = $this->SelectData->GetNewServiceNames($this->userIdSession);
		$id = (int) $get_array['id'];

		if ($id == 0) {

			$this->dataComponets["EnergyCom"] === "Disable" ? redirect('Dasboard') : "";
			$data["EnergyProfile"] = "on";
			//$userWhereaboutData["action"] = "My Energy Profile";
			$data["usrPlatfromCredits"] = $this->usrPlatfromCredits;
			$data = array_merge($this->dataComponets, $data);
			$this->load->view('loadsearchmeter', $data);
		} elseif ($id == 1) {

			$data["LcmsProfile"] = "on";
			list( $shortname, $description ) = $this->Load_lsmsContent();
			//$userWhereaboutData["action"] = "LCMS Profile";
			$data["shortname"] = $shortname;
			$data["description"] = $description;
            $data["usrPlatfromCredits"] = $this->usrPlatfromCredits;
			$this->load->view('loadb_widget_1', $data);
		} elseif ($id == 2) {

			$this->dataComponets["GameCom"] === "Disable" ? redirect('Dasboard') : "";

			$get_arrayA = $this->uri->uri_to_assoc(4);
			$this->load->library('pagination');


			$config = array();
			$config["base_url"] = base_url() . "index.php/options/index/id/2/print/";
			$config["total_rows"] = $this->Load_GameContentMax($this->userNameSession);
			$config["per_page"] = 20;
			// $config["uri_segment"] = 4;

			$choice = $config["total_rows"] / $config["per_page"];
			$config["num_links"] = round($choice);



			$this->pagination->initialize($config);
			$page = 0;
			if (isset($get_arrayA[2]) && $get_arrayA[2] == "print") {


				$data["GameProfileActivitys"] = "on";
				$get_arrayA2 = $this->uri->uri_to_assoc(5);
				$page = (int) $get_arrayA2["print"];
			} else {
				$page = 0;
			}


			$data_temp = [];
			$data["GameProfile"] = "on";
			//$userWhereaboutData["action"] = "GAME Profile";
			$data = array_merge($data_temp = $this->Load_GameContent($this->userNameSession, $page, 20), $data);
			$data = array_merge($this->dataComponets, $data);
			$data["totalScore"] = $this->GameCurrentTotalScoreM($this->userNameSession);
			$data["totalScoreW"] = $this->GameLastWeekTotalScoreM($this->userNameSession);
			$data["totalScoreM"] = $this->GameLastMonthTotalScoreM($this->userNameSession);
			$data = array_merge($this->getScoreValuesProgramsPricing($this->userNameSession), $data);
			$data = array_merge($this->getRewardPoints($this->userNameSession), $data);
			$data["dataBadges"] = $this->getAllBadges($this->userNameSession);
			
			$data["previousGameLevel"] = $this->GameLevelOneMonthBck($this->userNameSession);


			$data["usrPlatfromCredits"] = $this->usrPlatfromCredits;
			$data["links"] = $this->pagination->create_links();
			$this->load->view('loadb_widget_2', $data);
		} else {

			$data["EnergyProfile"] = "on";
			$data["usrPlatfromCredits"] = $this->usrPlatfromCredits;
			// $userWhereaboutData["action"] = "MY Energy Profile";
			$this->load->view('loadsearchmeter', $data);
		}
	}

	function Load_GameContentMax($userName) {

		$this->load->model('GameModule', '', TRUE);

		$resultR = $this->GameModule->getLoadGameActivityMax($userName);

		$totalRows = 0;

		foreach ($resultR->result() as $row) {


			$totalRows = $row->rowCounttimestampReceived;
		}

		return $totalRows;
	}

	function GameLevelOneMonthBck($userNameSession) {

		$resultR = $this->SelectData2->SelectUsersGameLevelOneMonthBack($userNameSession);

		$data = [];

		$value1OneMonthBack = 0;

		foreach ($resultR->result() as $row) {

			if (isset($row->GameLevel1monthback) && mb_strlen(trim($row->GameLevel1monthback), 'UTF-8') > 0) {

				$value1OneMonthBack = $row->GameLevel1monthback;
			}
		}

		return $value1OneMonthBack;
	}

	function getAllBadges($userNameSession) {

		$resultR = $this->SelectData2->getAllBadges($userNameSession);

		$data = [];

		$badges = [];

		foreach ($resultR->result() as $row) {

			if (isset($row->all_badges) && mb_strlen(trim($row->all_badges), 'UTF-8') > 0) {

				if (strpos($row->all_badges, ",") !== false) {

					$pieces = explode(",", $row->all_badges);

					$max = sizeof($pieces);

					for ($i = 0; $i < $max; $i++) {

						if (in_array($pieces[$i], $badges) === false) {

							$badges[] = $pieces[$i];
						}
					}
				} else {

					$badges[] = $row->all_badges;
				}
			}
		}

		return $badges;
	}

	function getRewardPoints($userNameSession) {

		$resultR = $this->SelectData2->getTotalRewardsProgram($userNameSession);

		$data = [];

		foreach ($resultR->result() as $row) {

			if (isset($row->totalCredits)) {

				$data["totalCredits"] = $row->totalCredits;
			}

			if (isset($row->totalCash)) {

				$data["totalCash"] = $row->totalCash;
			}

			if (isset($row->toExPoints)) {

				$data["toExPoints"] = $row->toExPoints;
			}
		}

		return $data;
	}

	function getScoreValuesProgramsPricing($userNameSession) {

		$resultS = $this->SelectData2->getTotalForEachProgram($userNameSession);

		$data = [];

		foreach ($resultS->result() as $row) {

			if (isset($row->energy_program)) {

				$data[$row->energy_program] = $row->CommunityPricing;
			}
		}

		return $data;
	}

	function GameLastMonthTotalScoreM($userNameSession) {

		$totalScore = 0;
		$resultM = $this->SelectData2->GameLastMonthTotalScore($userNameSession);

		foreach ($resultM->result() as $row) {

			if (isset($row->totalScore)) {

				$totalScore = $row->totalScore;
			}
		}

		return $totalScore;
	}

	function GameLastWeekTotalScoreM($userNameSession) {

		$totalScore = 0;
		$resultW = $this->SelectData2->GameLastWeekTotalScore($userNameSession);

		foreach ($resultW->result() as $row) {

			if (isset($row->totalScore)) {

				$totalScore = $row->totalScore;
			}
		}

		return $totalScore;
	}

	function GameCurrentTotalScoreM($userNameSession) {

		$resultT = $this->SelectData2->GameCurrentTotalScore($userNameSession);
		$totalScore = 0;
		foreach ($resultT->result() as $row) {

			if (isset($row->totalScore)) {

				$totalScore = $row->totalScore;
			}
		}

		return $totalScore;
	}

	function Load_lsmsContent() {

		$this->load->model('Lcmsbridge', '', TRUE);

		$result = $this->Lcmsbridge->getCodeRefreshToken();
		$data = [];
		$shortname = [];
		$description = [];
		$max = 0;

		$data = json_decode($result, true);
		$max = sizeof($data);

		for ($i = 0; $i < $max; $i++) {

			$shortname[$i] = $data[$i]["shortname"];
			$description[$i] = $data[$i]["description"];
		}

		return array($shortname, $description);
	}

	function Load_GameContent($userName, $offset, $rec_limit) {

		$this->load->model('GameModule', '', TRUE);
		return $this->GameModule->filterGameValues($this->GameModule->getLoadGameActivity($userName, $offset, $rec_limit));
	}

	public function returnAllUsrOfGroups($usrID) {
		return $this->ViewUsersProcess->processViewFriendsRecorsMembers($this->SelectData2->returnMemberofAllGroups($usrID));
	}

}
