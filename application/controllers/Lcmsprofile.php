<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Lcmsprofile
 *
 * @author John Papagiannis <intelen>
 */
class Lcmsprofile extends CI_Controller {

	//put your code here username

	public $userNameSession;
	public $userIdSession;
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
		$this->load->library('session');
		$this->load->model('Trackusers', '', TRUE);
		$this->load->model('SelectData2', '', TRUE);
		$this->load->model('ViewUsersProcess', '', TRUE);
		$this->load->model('Generalpurposes', '', TRUE);
		$this->load->model('Random', '', TRUE);
		$this->load->model('Insertdata', '', TRUE);



		if ($this->session->userdata('logged_in') !== 1) {
			redirect('Login');
			exit;
		} else {
			$this->usrlevel = $this->session->userdata('user_level');
			$this->userNameSession = $this->session->userdata('username');
			$this->userIdSession = $this->session->userdata('userid');
			$this->usremail = $this->session->userdata('email');
			$this->userLastTimeLogin = $this->SelectData->LastDateUserLogin($this->userIdSession) === 0 ? "" : $this->Generalpurposes->timestampTOdate($this->SelectData->LastDateUserLogin($this->userIdSession));


			$this->dataComponets = $this->SelectData->SelectComponet();
			$this->dataComponets["LcmsCom"] === "Disable" ? redirect('Dasboard') : "";
			
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
		$compMax = 0;
		$badMax = 0;
		$courMax = 0;
		$get_array = $this->uri->uri_to_assoc(3);
		$offset = 0;
		$data["ActiveTips"] = $this->SelectData->SelectTipsFromSerice($this->usremail); //$this->SelectData->SelectDisplayTips();

		$data["LcmsProfile"] = "on";
		$data["username"] = $this->userNameSession;
		$data["usrlevel"] = $this->usrlevel;
		list($data["GroupMessage"], $data["GroupMessageID"]) = $this->SelectData->GetNewServiceNames($this->userIdSession);
		$userWhereaboutData["action"] = "LCMS Profile";

		list( $user, $competencies, $badges, $courses, $scores ) = $this->Load_lsmsContent($this->userNameSession);//$this->Load_lsmsContent("pmakris"); //$this->userNameSession
        //list( $user, $competencies, $badges, $courses, $scores ) = $this->Load_lsmsContent("pmakris");//$this->Load_lsmsContent("pmakris"); //$this->userNameSession
		
		$scoreMax = sizeof($scores);

		$scoresId = [];
		$scoresNames = [];
		$scoresDescription = [];
		$scoresValue = [];

		$CurrentTotalScore = 0;
		$LastWeekTotalScore = 0;
		$LastMonthTotalScore = 0;


		for ($i = 0; $i < $scoreMax; $i++) {

			if ($scores[$i]["name"] == "Current total score") {

				$CurrentTotalScore = $scores[$i]["value"];
				} elseif ($scores[$i]["name"] == "Last week's total score") {

				$LastWeekTotalScore = $scores[$i]["value"];
			}//Last month's total score
			elseif ($scores[$i]["name"] == "Last month's total score") {

				$LastMonthTotalScore = $scores[$i]["value"];
			} else {
				$scoresNames[$i] = strip_tags($scores[$i]["name"]);
				$scoresId[$i] = strip_tags($scores[$i]["id"]);
				$scoresDescription[$i] = strip_tags($scores[$i]["description"]);
				$scoresValue[$i] = strip_tags($scores[$i]["value"]);
			}
		}





		$competenciesNames = [];
		$competenciesDesc = [];
		$competenciesGradename = [];
		$competenciesGrade = [];
		$gradename = [];
		$grade = [];

		$compMax = sizeof($competencies);

		for ($i = 0; $i < $compMax; $i++) {

			$competenciesNames[$i] = $competencies[$i]["name"];
			$competenciesDesc[$i] = strip_tags($competencies[$i]["description"]);
			$competenciesGradename[$i] = isset($competencies[$i]["gradename"]) ? $competencies[$i]["gradename"] : "";
			$competenciesGrade[$i] = isset($competencies[$i]["grade"]) ? $competencies[$i]["grade"] : "";
		}


		$this->SaveLcmsComp($competenciesNames, $competenciesDesc, $competenciesGradename, $competenciesGrade);
		$badMax = sizeof($badges);
		$i = 0;

		$badgesNames = [];
		$badgesNamesDesc = [];
		$badgesUrl = [];
		$badgesdateissued = [];

		for ($i = 0; $i < $badMax; $i++) {

			$badgesNames[$i] = $badges[$i]["name"];
			$badgesNamesDesc[$i] = $badges[$i]["description"];
			$badgesUrl[$i] = $badges[$i]["url"];
			$badgesDateissued[$i] = date("d/m/Y", $badges[$i]["dateissued"]);
		}

		$courMax = sizeof($courses);
		$coursesNames = [];
		$coursesNamesDesc = [];
		$coursesUrl = [];
		$coursesDategraded = [];
		$grademin = [];
		$grademax = [];
		$gradepass = [];
		$grade = [];
		$timespent = [];

		$i = 0;

		for ($i = 0; $i < $courMax; $i++) {

			$coursesNames[$i] = isset($courses[$i]["name"]) && !empty($courses[$i]["name"]) ? strip_tags($courses[$i]["name"]) : "";
			$coursesNamesDesc[$i] = isset($courses[$i]["description"]) && !empty($courses[$i]["description"]) ? strip_tags($courses[$i]["description"]) : "";

			$coursesNames[$i] = $courses[$i]["name"];
			$coursesNamesDesc[$i] = $courses[$i]["description"];

			$coursesUrl[$i] = $courses[$i]["url"];
			$coursesDategraded[$i] = isset($courses[$i]["dategraded"]) && !empty($courses[$i]["dategraded"]) ? date("d/m/Y", $courses[$i]["dategraded"]) : " - ";
			$grademin[$i] = isset($courses[$i]["grademin"]) && !empty($courses[$i]["grademin"]) ? $courses[$i]["grademin"] : " - ";
			$grademax[$i] = isset($courses[$i]["grademax"]) && !empty($courses[$i]["grademax"]) ? $courses[$i]["grademax"] : " - ";
			$gradepass[$i] = isset($courses[$i]["gradepass"]) && !empty($courses[$i]["gradepass"]) ? $courses[$i]["gradepass"] : " - ";
			$grade[$i] = isset($courses[$i]["grade"]) && !empty($courses[$i]["grade"]) ? $courses[$i]["grade"] : " - ";
			$timespent[$i] = isset($courses[$i]["timespent"]) && !empty($courses[$i]["timespent"]) && trim(mb_strlen($courses[$i]["timespent"], 'UTF-8')) > 1 ? date("i:s", (int) $courses[$i]["timespent"]) : " - ";
		}

		$data["CurrentTotalScore"] = $CurrentTotalScore;
		$data["LastWeekTotalScore"] = $LastWeekTotalScore;
		$data["LastMonthTotalScore"] = $LastMonthTotalScore;


		$data["scoresId"] = $scoresId;
		$data["scoresNames"] = $scoresNames;
		$data["scoresDescription"] = $scoresDescription;
		$data["scoresValue"] = $scoresValue;

		$data["competenciesNames"] = $competenciesNames;
		$data["competenciesDesc"] = $competenciesDesc;

		$data["competenciesGradename"] = isset($competenciesGradename) ? $competenciesGradename : []; //$competenciesGradename;
		$data["competenciesGrade"] = isset($competenciesGrade) ? $competenciesGrade : []; //$competenciesGrade;

		$badgesDateissued = isset($badgesDateissued) ? $badgesDateissued : [];
		
		$data["badgesNames"] = $badgesNames;
		$data["badgesNamesDesc"] = $badgesNamesDesc;
		$data["badgesUrl"] = $badgesUrl;
		$data["badgesDateissued"] = isset($badgesDateissued) ? $badgesDateissued : []; //$badgesDateissued;

		$data["coursesNames"] = $coursesNames;
		$data["coursesNamesDesc"] = $coursesNamesDesc;
		$data["coursesUrl"] = $coursesUrl;
		$data["coursesDategraded"] = $coursesDategraded;
		$data["coursesTimespent"] = $timespent;

		$data["grademin"] = $grademin;
		$data["grademax"] = $grademax;
		$data["gradepass"] = $gradepass;
		$data["grade"] = $grade;

		$this->SaveLcmsCourses($coursesNames, $coursesNamesDesc, $coursesDategraded, $grade, $timespent,$grademin,$grademax,$gradepass);

		$data["lastTimeLogin"] = $this->userLastTimeLogin;

		$data = array_merge($this->returnAllUsrOfGroups($this->userIdSession), $data);

		$this->SaveLcmsBadges($badgesNames, $badgesNamesDesc, $badgesDateissued);


		$this->SaveLcmsScorePage($scoresNames, $scoresDescription, $scoresValue);

		$this->SaveLcmsScorePageTotal($CurrentTotalScore, $LastWeekTotalScore, $LastMonthTotalScore);



		//  echo "<br>";
		//  var_dump($competencies);
		// exit("<br><strong>------------------------------------<strong><br>");

		/*
		  list( $shortname, $description ) = $this->Load_lsmsContent();

		  $data["shortname"] = $shortname;
		  $data["description"] = $description;
		  $data["lastTimeLogin"] = $this->userLastTimeLogin;
		  //
		 */



		/*gg
		  $userWhereaboutData["userID"] = $this->userIdSession;
		  $userWhereaboutData["timestamp"] = $this->Generalpurposes->createGMTtimestampOffset();
		  $userWhereaboutData["type_of_action"] = "click";
		  $userWhereaboutData["os"] = trim($this->Random->getOS($_SERVER['HTTP_USER_AGENT']));
		  $userWhereaboutData["browser"] = trim($this->Random->getBrowser($_SERVER['HTTP_USER_AGENT']));
		  $userWhereaboutData["agent"] = trim($_SERVER['HTTP_USER_AGENT']);
		  $this->Trackusers->saveUsersTrack($userWhereaboutData);
		 */
		$data["usrPlatfromCredits"] = $this->usrPlatfromCredits;
		
		$data = array_merge($this->dataComponets, $data);
		$this->load->view('loadb_widget_1', $data);
	}

	function SaveLcmsScorePageTotal($CurrentTotalScore, $LastWeekTotalScore, $LastMonthTotalScore) {

		$data = [];

		$query = $this->SelectData2->RetrieveLcmsLastRecordScoreTotal($CurrentTotalScore, $LastWeekTotalScore, $LastMonthTotalScore, $this->userIdSession
		);

		$totalScore_1 = 0;
		$lastWeekTotalScore_1 = 0;
		$lastMonthTotalScore_1 = 0;

		$updateValues = false;

		foreach ($query->result() as $row) {

			if ($row->totalScore || $row->lastWeekTotalScore || $row->lastMonthTotalScore) {

				$updateValues = true;
				$totalScore_1 = $row->totalScore;
				$lastWeekTotalScore_1 = $row->lastWeekTotalScore;
				$lastMonthTotalScore_1 = $row->lastMonthTotalScore;
			}
		}
		
		
		if($updateValues === false){
			
			$this->SaveData->SaveLcmsTotalScore($this->security->xss_clean($CurrentTotalScore),
					                            $this->security->xss_clean($LastWeekTotalScore),
					                            $this->security->xss_clean($LastMonthTotalScore),
					                            $this->Generalpurposes->createGMTtimestampOffset(),
					                            $this->userIdSession);
			
		}elseif($updateValues === true && ($CurrentTotalScore    != $totalScore_1 
				                        || $lastWeekTotalScore_1 != $LastWeekTotalScore 
				                        || $lastMonthTotalScore_1!= $LastMonthTotalScore) ){
			
			$this->UpdateData->updateLcmsTotalScore($this->security->xss_clean($totalScore_1),
					                                $this->security->xss_clean($lastWeekTotalScore_1),
					                                $this->security->xss_clean($lastMonthTotalScore_1),
					                                $this->userIdSession);
			
		}
		
		
		
		
		
	}

	function SaveLcmsScorePage($scoresNames, $scoresDescription, $scoresValue) {

		$data = [];
		$newScoreNames = [];
		$newScoreDescription = [];
		$newScoreValue = [];
		$newScoreDatesRegister = [];

		$query = $this->SelectData2->RetrieveLcmsLastRecordScore($this->userIdSession);
		$array1 = $query->result_array();
		$flag = false;
		$updateValues = false;

		$arr = array_map(function($value) {
			return $value['Name'];
		}, $array1);


		foreach ($scoresNames as $key => $row) {

			$flag = true;
			if (isset($scoresNames[$key]) && in_array($scoresNames[$key], $arr) === false) {

				$updateValues = true;

				$newScoreNames[] = $scoresNames[$key];
				$newScoreDescription[] = $scoresDescription[$key];
				$newScoreValue[] = $scoresValue[$key];
				// $newScoreDatesRegister[] = $this->Generalpurposes->createGMTtimestampOffset();
			}
		}



		if (sizeof($scoresNames) > 0 and sizeof($scoresDescription) > 0 && $query->num_rows() < 1 && $flag === true) {

			$max = sizeof($scoresNames);
			$scoreDatesRegister = [];

			for ($i = 0; $i < $max; $i++) {

				//$scoreDatesRegister[$i] = $this->Generalpurposes->createGMTtimestampOffset();
			}



			$this->SaveData->SaveBuildMultipleRecordsScore(
					$this->security->xss_clean($scoresNames), $this->security->xss_clean($scoresDescription), $this->security->xss_clean($scoresValue), $this->userIdSession);
		} elseif ($updateValues === true && $query->num_rows() > 0 && sizeof($scoresNames) > 0) {



			$this->SaveData->SaveBuildMultipleRecordsScore(
					$this->security->xss_clean($newScoreNames), $this->security->xss_clean($newScoreDescription), $this->security->xss_clean($newScoreValue), $this->userIdSession);
		}
	}

	function SaveLcmsBadges($badgesNames, $badgesNamesDesc, $badgesDateissued) {

		$data = [];
		$newBadgesNames = [];
		$newBadgesNamesDesc = [];
		$newBadgesDateissued = [];
		$newbadgesDatesRegister = [];

		$query = $this->SelectData2->RetrieveLcmsLastRecordBadges($this->userIdSession);
		$array1 = $query->result_array();
		$flag = false;
		$updateValues = false;

		$arr = array_map(function($value) {
			return $value['BadgeName'];
		}, $array1);


		foreach ($badgesNames as $key => $row) {

			$flag = true;
			if (isset($badgesNames[$key]) && in_array($badgesNames[$key], $arr) === false) {

				$updateValues = true;

				$newBadgesNames[] = $badgesNames[$key];
				$newBadgesNamesDesc[] = $badgesNamesDesc[$key];
				$newBadgesDateissued[] = $badgesDateissued[$key];

				$newbadgesDatesRegister[] = $this->Generalpurposes->createGMTtimestampOffset();
			}
		}


		if (sizeof($badgesNames) > 0 and sizeof($badgesNamesDesc) > 0 && $query->num_rows() < 1 && $flag === true) {

			$max = sizeof($badgesNames);
			$badgesDatesRegister = [];

			for ($i = 0; $i < $max; $i++) {

				$badgesDatesRegister[$i] = $this->Generalpurposes->createGMTtimestampOffset();
			}



			$this->SaveData->SaveBuildMultipleRecordsBadges(
					$this->security->xss_clean($badgesNames), $this->security->xss_clean($badgesNamesDesc), $this->security->xss_clean($badgesDateissued), $this->userIdSession, $badgesDatesRegister);
		} elseif ($updateValues === true && $query->num_rows() > 0 && sizeof($badgesNames) > 0) {

	

			$this->SaveData->SaveBuildMultipleRecordsCourses(
					$this->security->xss_clean($newBadgesNames), 
					$this->security->xss_clean($newBadgesNamesDesc), 
					$this->security->xss_clean($newbadgesDatesRegister),
					"",
					"",
					$this->security->xss_clean($this->userIdSession),
					"",
					"",
					"",
					""
					);
		}
	}

	function SaveLcmsCourses($coursesNames, $coursesNamesDesc, $coursesDategraded, $grade, $timespent, $grademin, $grademax, $gradepass) {

		$data = [];
		$newRecordsCourseTitle = [];
		$newRecordsCourseMainDesc = [];
		$newRecordsRecordSavedAt = [];
		$newRecordsCourseDategraded = [];
		$newRecordsCourseGrade = [];
		$newRecordsCourseTimespent = [];
		
		$newRecordsGrademin = [];
		$newRecordsGrademax = [];
        $newRecordsGradepass = [];
		

		$query = $this->SelectData2->RetrieveLcmsLastRecordCourses($this->userIdSession);
		$array1 = $query->result_array();
		$flag = false;
		$updateValues = false;

		$arr = array_map(function($value) {
			return $value['ObjectName'];
		}, $array1);


		foreach ($coursesNames as $key => $row) {

			$flag = true;

			if (isset($coursesNames[$key]) && in_array($coursesNames[$key], $arr) === false) {

				$updateValues = true;
				$newRecordsCourseTitle[] = $coursesNames[$key];
				$newRecordsCourseMainDesc[] = isset($coursesNamesDesc[$key]) ? $coursesNamesDesc[$key] : "";
				$newRecordsRecordSavedAt[] = $this->Generalpurposes->createGMTtimestampOffset();
				$newRecordsCourseDategraded[] = isset($coursesDategraded[$key]) ? $coursesDategraded[$key] : "";
				$newRecordsCourseGrade[] = isset($grade[$key]) ? $grade[$key] : "";
				$newRecordsCourseTimespent[] = isset($timespent[$key]) ? $timespent[$key] : "";
				
				
				$newRecordsGrademin[] = isset($grademin[$key]) ? $grademin[$key] : "";		
				$newRecordsGrademax[] = isset($grademax[$key]) ? $grademax[$key] : "";				
				$newRecordsGradepass[] = isset($gradepass[$key]) ? $gradepass[$key] : "";
				
				//$newRecordsCourseTimespent = isset($timespent[$key]) && trim(mb_strlen($timespent[$key], 'UTF-8')) > 1?date("i:s", (int)$timespent[$key]): "-";
///insert new records
			} else {


				//$newRecordsCourseTimespent = isset($timespent[$key]) && trim(mb_strlen($timespent[$key], 'UTF-8')) > 1?date("i:s", (int)$timespent[$key]): "-";
			}
		}

		if (sizeof($coursesNames) > 0 and sizeof($coursesNamesDesc) > 0 && $query->num_rows() < 1 && $flag === true) {


			$max = sizeof($coursesNames);
			$competenciesDatesRegister = [];
			for ($i = 0; $i < $max; $i++) {

				$competenciesDatesRegister[$i] = $this->Generalpurposes->createGMTtimestampOffset();
			}
//
			$this->SaveData->SaveBuildMultipleRecordsCourses(
					$this->security->xss_clean($coursesNames), 
					$this->security->xss_clean($coursesNamesDesc), 
					$this->security->xss_clean($coursesDategraded), 
					$this->security->xss_clean($grade), 
					$this->security->xss_clean($timespent), 
					$this->userIdSession, 
					$competenciesDatesRegister,
					$this->security->xss_clean($newRecordsGrademin), 
					$this->security->xss_clean($newRecordsGrademax), 
					$this->security->xss_clean($newRecordsGradepass)
					);


			//SaveBuildMultipleRecordsCourses($coursesNames, $coursesNamesDesc, $coursesDategraded, $grade, $timespent, $userID, $dateRegister)
		} elseif ($updateValues === true && $query->num_rows() > 0 && sizeof($coursesNames) > 0) {



			$this->SaveData->SaveBuildMultipleRecordsCourses(
					$this->security->xss_clean($newRecordsCourseTitle), 
					$this->security->xss_clean($newRecordsCourseMainDesc), 
					$this->security->xss_clean($newRecordsCourseDategraded), 
					$this->security->xss_clean($newRecordsCourseGrade), 
					$this->security->xss_clean($newRecordsCourseTimespent), 
					$this->userIdSession, 
					$newRecordsRecordSavedAt,
					$this->security->xss_clean($newRecordsCourseTimespent), 
					$this->security->xss_clean($grademin), 
					$this->security->xss_clean($grademax), 
					$this->security->xss_clean($gradepass)
					);
		}
	}

	function SaveLcmsComp($competenciesNames, $competenciesDesc, $competenciesGradename, $competenciesGrade) {

		$data = [];
		$newRecordsCompTitle = [];
		$newRecordsCompMainDesc = [];
		$newRecordsRecordSavedAt = [];
		$newRecordsGradename = [];
		$newRecordsGrade = [];

		$query = $this->SelectData2->RetrieveLcmsLastRecord($this->userIdSession);
		$array1 = $query->result_array();
		$flag = false;
		$updateValues = false;

		/*
		  var_dump($competenciesNames);
		  $competenciesNamesz[]="2.1.zz EU energy labelling. Level 1 - Basic";
		  $competenciesNames[]="4.1. Demand Response (DR). Level 1 - Basic";
		  $competenciesNames[]="6.1redd. Types of pricing schemes and energy programs. Level 1 - Basic";
		 */
		$arr = array_map(function($value) {
			return $value['CompTitle'];
		}, $array1);


		foreach ($competenciesNames as $key => $row) {

			$flag = true;

			if (isset($competenciesNames[$key]) && in_array($competenciesNames[$key], $arr) === false) {

				$updateValues = true;
				$newRecordsCompTitle[] = $competenciesNames[$key];
				$newRecordsCompMainDesc[] = isset($competenciesDesc[$key]) ? $competenciesDesc[$key] : "";

				$newRecordsGradename[] = $competenciesGradename[$key];

				$newRecordsGrade[] = $competenciesGrade[$key];


				$newRecordsRecordSavedAt[] = $this->Generalpurposes->createGMTtimestampOffset();

///insert new records
			}
		}

		if (sizeof($competenciesNames) > 0 and sizeof($competenciesDesc) > 0 && $query->num_rows() < 1 && $flag === true) {

			$max = sizeof($competenciesNames);
			$competenciesDatesRegister = [];
			for ($i = 0; $i < $max; $i++) {

				$competenciesDatesRegister[$i] = $this->Generalpurposes->createGMTtimestampOffset();
			}

			$this->SaveData->SaveBuildMultipleRecords(
					$this->security->xss_clean($competenciesNames), $this->security->xss_clean($competenciesDesc), $this->security->xss_clean($competenciesGradename), $this->security->xss_clean($competenciesGrade), $this->userIdSession, $competenciesDatesRegister);
		} elseif ($updateValues === true && $query->num_rows() > 0 && sizeof($competenciesNames) > 0) {

			$this->SaveData->SaveBuildMultipleRecords(
					$this->security->xss_clean($newRecordsCompTitle), $this->security->xss_clean($newRecordsCompMainDesc), $this->security->xss_clean($newRecordsGradename), $this->security->xss_clean($newRecordsGrade), $this->userIdSession, $newRecordsRecordSavedAt);
		}
	}

	function Load_lsmsContent($usrName = null) {

		$this->load->model('Lcmsbridge', '', TRUE);

		$data = [];
		$user = [];
		$competencies = [];
		$badges = [];
		$courses = [];

		//$usrName = "usertestjohnq";

		$result = $this->Lcmsbridge->getUserProfileOnLcms($usrName);

		//var_dump($result);
//exit;
		$data = json_decode($result, true);

		$max = sizeof($data);

		$user = isset($data[0]["user"])?$data[0]["user"]:[];

		$competencies = isset($data[0]["competencies"])?$data[0]["competencies"]:[];

		$badges = isset($data[0]["badges"])?$data[0]["badges"]:[];

		$courses = isset($data[0]["courses"])?$data[0]["courses"]:[];

		$scores = isset($data[0]["scores"])?$data[0]["scores"]:[];

		//var_dump($scores);
		//exit();


		/*

		  echo "<br><strong>--------------------------------------------------------------------------------------------</strong><br>";
		  echo "<br>--max:: $max -- user::<br>";
		  var_dump($user);
		  echo "<br><strong>--------------------------------------------------------------------------------------------</strong><br>";
		  echo "<br>--max:: $max -- competencies::<br>";
		  var_dump($competencies);
		  echo "<br><strong>--------------------------------------------------------------------------------------------</strong><br>";
		  echo "<br>--max:: $max -- badges::<br>";
		  var_dump($badges);
		  echo "<br><strong>--------------------------------------------------------------------------------------------</strong><br>";
		  echo "<br>--max:: $max -- courses::<br>";
		  var_dump($courses);
		  echo "<br><strong>--------------------------------------------------------------------------------------------</strong><br>";
		  var_dump($data);
		  echo "<br>-----------------------<br>";
		  exit("---xeri ka8aro mori arostia---");

		 */

		return array($user, $competencies, $badges, $courses, $scores);

		/*

		  $result = $this->Lcmsbridge->getCodeRefreshToken();
		  $data = [];
		  $shortname = [];
		  $description = [];
		  $max = 0;

		  $data = json_decode($result, true);
		  //echo "<br>sizeof--" . sizeof($data); //var_dump($data[0]["shortname"]);
		  $max = sizeof($data);

		  for ($i = 0; $i < $max; $i++) {

		  $shortname[$i] = $data[$i]["shortname"];
		  $description[$i] = $data[$i]["description"];
		  }

		  return array($shortname, $description);


		 */
	}

	public function returnAllUsrOfGroups($usrID) {
		return $this->ViewUsersProcess->processViewFriendsRecorsMembers($this->SelectData2->returnMemberofAllGroups($usrID));
	}

}
