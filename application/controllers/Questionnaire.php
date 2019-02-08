<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Questionnaire
 *
 * @author John Papagiannis <intelen>
 */
class Questionnaire extends CI_Controller {

	//put your code here
	public $userIdSession;
	public $userLastTimeLogin;
	public $userNameSession;
	public $usrlevel;
	public $usremail;
	public $dataComponets;
	public $usrPlatfromCredits;

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->model('SelectData', '', TRUE);
		$this->load->model('Trackusers', '', TRUE);
		$this->load->model('Generalpurposes', '', TRUE);
		$this->load->model('Random', '', TRUE);

		if ($this->session->userdata('logged_in') !== 1) {

			redirect('Login');
			exit;
		} else {
			$this->usremail = $this->session->userdata('email');
			$this->usrlevel = $this->session->userdata('user_level');
			$this->userIdSession = $this->session->userdata('userid');
			$this->userNameSession = $this->session->userdata('username');
			// $this->userLastTimeLogin = date('Y-m-d H:i:s', $this->SelectData->LastDateUserLogin($this->userIdSession));
			$this->userLastTimeLogin = $this->SelectData->LastDateUserLogin($this->userIdSession) === 0 ? "" : $this->Generalpurposes->timestampTOdate($this->SelectData->LastDateUserLogin($this->userIdSession));
		    $this->dataComponets = $this->SelectData->SelectComponet();
			
			$this->load->model('FilterRec', '', TRUE);
			$this->load->model('SelectData2', '', TRUE);
			$num = $this->FilterRec->filterRecValuesActions($this->SelectData2->countVisitsOfUser($this->userIdSession)) * 0.1;			
	        $num2 = $this->FilterRec->filterRecValuesActionsTLG($this->SelectData2->getTotalScoreOfLcmsGame($this->userIdSession, $this->userNameSession)) ;
	        $this->usrPlatfromCredits = number_format($num + $num2);
			
			
		}
	}

	public function index($save = "off") {

		$data = [];

		$data["usrlevel"] = $this->usrlevel;
		$data["Questionnaire"] = "on";
		$data["ActiveTips"] = $this->SelectData->SelectTipsFromSerice($this->usremail); //$this->SelectData->SelectDisplayTips();
		list($data["GroupMessage"], $data["GroupMessageID"]) = $this->SelectData->GetNewServiceNames($this->userIdSession);
		$data["lastTimeLogin"] = $this->userLastTimeLogin;
		$data["username"] = $this->userNameSession;
		$data["usrPlatfromCredits"] = $this->usrPlatfromCredits;
        $data = array_merge($this->dataComponets, $data);
		
		$this->load->view('questionnaire', $data); //analytics  //adduser
	}

	public function savequest() {

		if ($_SERVER['REQUEST_METHOD'] != 'POST') {

			$this->index();
		}

		$receivedData = [];
		$data = [];
		$this->load->library('form_validation');

		$this->load->model('variablesProcess/FilterVariablesQuest', 'FilterVariablesQuest', TRUE);
		$this->load->model('variablesProcess/ValidateQuestionnaire', 'ValidateQuestionnaire', TRUE);
		$this->load->model('Insertdata', '', TRUE);

		$data["ActiveTips"] = $this->SelectData->SelectDisplayTips();
		$data["lastTimeLogin"] = $this->userLastTimeLogin;
		$data["username"] = $this->userNameSession;
		$data["usrlevel"] = $this->usrlevel;
		// var_dump($this->input->post());

		$receivedData = $this->FilterVariablesQuest->filterVariable($this->input->post(), $this->userIdSession);
		$receivedData = $this->security->xss_clean($receivedData);
		$this->ValidateQuestionnaire->validateFormQuesti();

		if ($this->form_validation->run() == FALSE) {

			$data_temp = [];
			$data_temp = $this->FilterVariablesQuest->assignVariablestodata($receivedData, $data);
			$data = array_merge($data, $data_temp);
		} else {

			if ($this->Insertdata->InsertdataTable("Questionnaire", $this->ValidateQuestionnaire->transferDataReadyToSave($receivedData)) === TRUE) { // if ($this->Insertdata->InsertdataTable("Questionnaire", $receivedData) === TRUE)

				$this->load->model('Auth2calls', '', TRUE);

				$QuestionaireResults = $this->Auth2calls->CreatePlanBasedOnQuestionaire($this->userNameSession);
				$dataInsertLcmsRenspoce = [];

				$dataInsertLcmsRenspoce["RowIdLcms"] = $QuestionaireResults["planid"];
				$dataInsertLcmsRenspoce["LcmsTextResult"] = $QuestionaireResults["name"];
				$dataInsertLcmsRenspoce["Username"] = $this->userNameSession;
				$dataInsertLcmsRenspoce["Timestamp"] = $this->Generalpurposes->createGMTtimestampOffset();

				$this->Insertdata->InsertdataTable('LcmsCreatePlanResuly', $dataInsertLcmsRenspoce);
				//echo "<br> QuestionaireResults <br>";
				//exit(var_dump($QuestionaireResults));              
				//save result to db to make sure post took place
				$this->session->set_flashdata('newQuestIntoSystem', "on");

				redirect('dasboard');
			} else {

				$data["failedQuestIntoSystem"] = "on";
			}
		}

		$this->load->view('questionnaire', $data);
	}

	function include_number($str) {

		$this->form_validation->set_message("include_number", 'Field value is not valid. (only numbers allowed)');
		$boolean = TRUE;
		if (ctype_digit($str) == false && mb_strlen($str, 'UTF-8')) {
			$boolean = FALSE;
		}
		return $boolean;
	}

	function select_classofyuoracunit($str) {

		$this->form_validation->set_message("select_energycertificate", 'Field value is not valid.');
		$boolean = TRUE;

		$array[] = "A+++";
		$array[] = "A++";
		$array[] = "A+";
		$array[] = "A";
		$array[] = "B";
		$array[] = "C";
		$array[] = "D";

		$array[] = "E";
		$array[] = "F";
		$array[] = "G";
		$array[] = "Choose your option";

		if (mb_strlen($str, 'UTF-8') > 1 && in_array($str, $array) === FALSE) {

			$boolean = FALSE;
		}

		return $boolean;
	}

	function select_energycertificate($str) {

		$this->form_validation->set_message("select_energycertificate", 'Field value is not valid.');
		$boolean = TRUE;

		$array[] = "A";
		$array[] = "B";
		$array[] = "C";
		$array[] = "D";
		$array[] = "E";
		$array[] = "F";
		$array[] = "G";
		$array[] = "Choose your option";

		if (mb_strlen($str, 'UTF-8') > 1 && in_array($str, $array) === FALSE) {

			$boolean = FALSE;
		}

		return $boolean;
	}

	function billEveryMonth($str) {

		$this->form_validation->set_message("billEveryMonth", 'Field value is not valid.');
		$boolean = TRUE;

		$array[] = "Choose your option";
		$array[] = "Every month";
		$array[] = "Less frequent payment slots";


		if (mb_strlen($str, 'UTF-8') > 1 && in_array($str, $array) === FALSE) {

			$boolean = FALSE;
		}

		return $boolean;
	}

	function deregulated_market($str) {

		$this->form_validation->set_message("deregulated_market", 'Field value is not valid.');
		$boolean = TRUE;

		$array[] = "Choose your option";
		$array[] = "A market that is full or RES";
		$array[] = "A market with many competitive utilities";
		$array[] = "A closed market where one utility exists";


		if (mb_strlen($str, 'UTF-8') > 1 && in_array($str, $array) === FALSE) {

			$boolean = FALSE;
		}

		return $boolean;
	}

	function select_prosumere($str) {

		$this->form_validation->set_message("select_applconsume", 'Field value is not valid.');
		$boolean = TRUE;

		$array[] = "Choose your option";
		$array[] = "A combination of Producer and Consumer";
		$array[] = "A consumer that does not pay utility bills";
		$array[] = "None of the above";

		if (mb_strlen($str, 'UTF-8') > 1 && in_array($str, $array) === FALSE) {

			$boolean = FALSE;
		}

		return $boolean;
	}

	function select_applconsume($str) {

		$this->form_validation->set_message("select_applconsume", 'Field value is not valid.');
		$boolean = TRUE;

		$array[] = "Choose your option";
		$array[] = "Kitchen";
		$array[] = "TV";
		$array[] = "Laundry";

		if (mb_strlen($str, 'UTF-8') > 1 && in_array($str, $array) === FALSE) {

			$boolean = FALSE;
		}

		return $boolean;
	}

	function select_differeofkwkwh($str) {

		$this->form_validation->set_message("select_differeofkwkwh", 'Field value is not valid.');
		$boolean = TRUE;

		$array[] = "Choose your option";
		$array[] = "It is the same thing";
		$array[] = "Power vs Energy for my consumption";
		$array[] = "It’s a conversion from energy into thermal energy";

		if (mb_strlen($str, 'UTF-8') > 1 && in_array($str, $array) === FALSE) {

			$boolean = FALSE;
		}

		return $boolean;
	}

	function select_themetrickWh($str) {

		$this->form_validation->set_message("select_themetrickWh", 'Field value is not valid.');
		$boolean = TRUE;

		$array[] = "Choose your option";
		$array[] = "Thermal Insulation";
		$array[] = "My House characteristic energy curve";
		$array[] = "None of the above";

		if (mb_strlen($str, 'UTF-8') > 1 && in_array($str, $array) === FALSE) {

			$boolean = FALSE;
		}

		return $boolean;
	}

	function select_lightsOn($str) {

		$this->form_validation->set_message("select_lightsOn", 'Field value is not valid.');
		$boolean = TRUE;

		$array[] = "Choose your option";
		$array[] = "Often";
		$array[] = "Sometimes";
		$array[] = "Never";

		if (mb_strlen($str, 'UTF-8') > 1 && in_array($str, $array) === FALSE) {

			$boolean = FALSE;
		}

		return $boolean;
	}

	function select_energyclassaapp($str) {

		$this->form_validation->set_message("select_energyclassaapp", 'Field value is not valid.');
		$boolean = TRUE;

		$array[] = "Choose your option";
		$array[] = "None";
		$array[] = "1-3";
		$array[] = "More than 4";

		if (mb_strlen($str, 'UTF-8') > 1 && in_array($str, $array) === FALSE) {

			$boolean = FALSE;
		}

		return $boolean;
	}

	function select_highesteducationlevel($str) {

		$this->form_validation->set_message("select_highesteducationlevel", 'Field value is not valid.');
		$boolean = TRUE;

		$array[] = "Choose your option";
		$array[] = "a. No degree";
		$array[] = "b. High school or equivalent";
		$array[] = "c. University degree or equivalent";
		$array[] = "d. Master’s degree, or PhD";

		if (mb_strlen($str, 'UTF-8') > 1 && in_array($str, $array) === FALSE) {

			$boolean = FALSE;
		}

		return $boolean;
	}

	function radioButtons_typeofairconditio($str) {

		$this->form_validation->set_message("radioButtons_typeofairconditio", 'Field value is not valid.');
		$boolean = TRUE;

		if (mb_strlen($str, 'UTF-8') > 1 && (!(trim($str) != "Individual cooling" || trim($str) != "Central cooling" || trim($str) != "No air-conditioning" ))) {

			$boolean = FALSE;
		}

		return $boolean;
	}

	function radioButtons_morepeopleathome($str) {

		$this->form_validation->set_message("radioButtons_morepeopleathome", 'Field value is not valid.');
		$boolean = TRUE;

		if (mb_strlen($str, 'UTF-8') > 1 && (!(trim($str) != "Morning" || trim($str) != "Afternoon" || trim($str) != "Evening" ))) {

			$boolean = FALSE;
		}

		return $boolean;
	}

	function radioButtons_perresident($str) {

		$this->form_validation->set_message("radioButtons_perresident", 'Field value is not valid.');
		$boolean = TRUE;

		if (mb_strlen($str, 'UTF-8') > 1 && (!($str != "All day" || $str != "Home 5-7 hours" || $str != "Home 5 or fewer hours" ))) {

			$boolean = FALSE;
		}

		return $boolean;
	}

	function checkbox_dontknow($str) {

		$this->form_validation->set_message("checkbox_dontknow", 'Field value is not valid.');
		$boolean = TRUE;

		if (mb_strlen($str, 'UTF-8') > 1 && $str != "Don’t know") {

			$boolean = FALSE;
		}

		return $boolean;
	}

	function radioButtons_control($str) {

		$this->form_validation->set_message("radioButtons_control", 'Field value is not valid.');
		$boolean = TRUE;

		if (mb_strlen($str, 'UTF-8') > 1 && $str != "on") {

			$boolean = FALSE;
		}

		return $boolean;
	}

}
