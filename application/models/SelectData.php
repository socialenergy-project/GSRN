<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SelectData
 *
 * @author John Papagiannis <intelen>
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class SelectData extends CI_Model {

	//put your code here


	function SelectTotalNumOfClicks($productID, $userID) {

		$sql = "";
		$result;
		$sql = "select productID,"
				. "userID,"
				. "totalClicks "
				. "from "
				. "socialEnergy.marketPlaceProductTraffic "
				. "where productID=" . $this->db->escape($productID) . " "
				. "and "
				. "userID=" . $this->db->escape($userID) . "";

		$result = $this->db->query($sql);
		return $result;
	}

	function CheckIfGroupExists($GroupName, $usrID) {

		$sql = "";
		$result;
		$sql = "select "
				. "rowID,"
				. "usrReqAdmRleID,"
				. "timstAdminApproval,"
				. "timstAdminRequest,"
				. "usrFlagLevel,"
				. "GrouPName "
				. "from "
				. "socialEnergy.AdminUserGroups "
				. "where "
				. "GrouPName=" . $this->db->escape($GroupName) . " "
				. "and "
				. "usrReqAdmRleID=" . $this->db->escape($usrID) . "";

		$result = $this->db->query($sql);
		return $result;
	}

	function GetUserFirstLastName($email, $username) {

		$sql = "";
		$result;

		$sql = "select "
				. "first_name,"
				. "last_name "
				. "from "
				. "my_oauth2_db.oauth_users "
				. "where "
				. "email=" . $this->db->escape($email) . " "
				. "and "
				. "username=" . $this->db->escape($username) . "";
	
		$result = $this->db->query($sql);
		return $result;
	}

	function GetUserUsernameIfExist($userName) {

		$sql = "";
		$result;

		$sql = "select "
				. "UserName,"
				. "EmailAddress "
				. "from "
				. "socialEnergy.UsersCredentials "
				. "where "
				. "UserName=" . $this->db->escape($userName) . "";

		$result = $this->db->query($sql);
		return $result;
	}

	
	function GetUserUsernameOrEmailIfExist($userName,$email) {

		$sql = "";
		$result;

		$sql = "select "
				. "UserName,"
				. "EmailAddress "
				. "from "
				. "socialEnergy.UsersCredentials "
				. "where "
				. "UserName=" . $this->db->escape($userName) . " or EmailAddress=" . $this->db->escape($email) . "";

		$result = $this->db->query($sql);
		return $result;
	}
	
	function GetUserEmailIfExistsCred($email) {

		$sql = "";
		$result;

		$sql = "select "
				. "UserName,"
				. "EmailAddress "
				. "from "
				. "socialEnergy.UsersCredentials "
				. "where "
				. "EmailAddress=" . $this->db->escape($email) . "";
	
		$result = $this->db->query($sql);
		return $result;
	}
	
	function GetUserEmailIfExists($email) {

		$sql = "";
		$result;

		$sql = "select "
				. "first_name,"
				. "last_name "
				. "from "
				. "my_oauth2_db.oauth_users "
				. "where "
				. "email=" . $this->db->escape($email) . "";
		
		$result = $this->db->query($sql);
		return $result;
	}
	
	
	function GetUserIDfExists($usrID) {

		$sql = "";
		$result;

	$sql = "select "
				. "UserName,"
				. "EmailAddress "
				. "from "
				. "socialEnergy.UsersCredentials "
				. "where "
				. "User_ID=" . $this->db->escape($usrID) . "";
	
		$result = $this->db->query($sql);
		return $result;
	}
	
	

	function CanIsearchUsersForAsAdminForGroups($user_id, $groupName) {

		$sql = "";
		$result;

		$sql = "select "
				. "GrouPName "
				. "from "
				. "socialEnergy.AdminUserGroups  "
				. "where "
				. "timstAdminApproval!=0 "
				. "and "
				. "usrReqAdmRleID=" . $this->db->escape($user_id) . " "
				. "and "
				. "GrouPName=" . $this->db->escape($groupName) . "";

		$result = $this->db->query($sql);
		return $result;
	}

	function RetrieveGroupNames($user_id = 0) {

		$sql = "";
		$result;

		$sql = "select "
				. "rowID,"
				. "usrReqAdmRleID,"
				. "timstAdminApproval,"
				. "timstAdminRequest,"
				. "usrFlagLevel,"
				. "GrouPName "
				. "from "
				. "socialEnergy.AdminUserGroups  "
				. "where "
				. "timstAdminApproval!=0 "
				. "and "
				. "usrReqAdmRleID=" . $this->db->escape($user_id) . "";
		
		$result = $this->db->query($sql);
		return $result;
	}

	function SelectUsersRecord($user_id = 0) {

		$sql = "";
		$result;

		//$sql = "select User_ID,UserName,EmailAddress,DateRegister from socialEnergy.UsersCredentials";
		//$sql = "select User_ID,UserName,EmailAddress,DateRegister,from_unixtime(Actions.timestamp) as LastTimeLogin from socialEnergy.UsersCredentials left join Actions on UsersCredentials.User_ID = Actions.userID and action='Login' group by User_ID order by Actions.timestamp desc;";
		$sql = "select * from "
				. "(select  "
				. "User_ID,"
				. "UserName,"
				. "EmailAddress,"
				. "DateRegister,"
				. "from_unixtime(Actions.timestamp) "
				. "as LastTimeLogin,"
				. "Actions.timestamp as TTimestamp  "
				. "from socialEnergy.UsersCredentials "
				. "left join Actions "
				. "on UsersCredentials.User_ID = Actions.userID "
				. "and action='Login'  "
				. "order by Actions.timestamp desc) "
				. "as temp_table "
				. "group by User_ID "
				. "order by TTimestamp desc;";

		$result = $this->db->query($sql);
		return $result;
	}

	function SelectMarketProduct($user_id = 0, $status = null, $proID = null) {

		$sql = "";
		$result;
		$where = "";
		$user_idPath = "";

		
		if($user_id>0){
			
			$user_idPath = " and UserID='$user_id'";
			
		}
		
		
		if (isset($status) && $proID == null) {
			
			$status = $status == "Pending" ? " where StatusPro='Pending'" : " where StatusPro='On AIR'";
		} elseif (isset($status) && $proID) {
			$status = $status == "Pending" ? " where StatusPro='Pending' and ProductID=" . $this->db->escape($proID) . "" : " where StatusPro='On AIR' and ProductID=" . $this->db->escape($proID) . "";
		}elseif($user_id>0){
					
			$user_idPath = " where UserID='$user_id'";
			
		}


		
		//$sql = "select User_ID,UserName,EmailAddress,DateRegister from socialEnergy.UsersCredentials";
		//$sql = "select User_ID,UserName,EmailAddress,DateRegister,from_unixtime(Actions.timestamp) as LastTimeLogin from socialEnergy.UsersCredentials left join Actions on UsersCredentials.User_ID = Actions.userID and action='Login' group by User_ID order by Actions.timestamp desc;";
		$sql = "select "
				. "ProductID,"
				. "Product_Title,"
				. "Product_Short_Desc,"
				. "Product_Main_Description,"
				. "Price,"
				. "Main_Category,"
				. "Sub_Category,"
				. "Sub_Category_Level_3,"
				. "Upload_Pic,"
				. "Upload_Pic_2,"
				. "Upload_Pic_3,"
				. "Timestamp_Created,"
				. "StatusPro "
				. "from "
				. "ProductNum "
				. "$status $user_idPath limit 0,20";

			
		$result = $this->db->query($sql);
		return $result;
	}

	function SelectUserRequestForAdminRole($user_id = null) {

		$sql = "";

		$result;

		$SessionId = isset($user_id) && mb_strlen($user_id, 'utf8') > 0 ? " and usrReqAdmRleID=" . $this->db->escape($user_id) . " " : " ";

		$sql = "select "
				. "rowID,"
				. "usrReqAdmRleID,"
				. "timstAdminApproval,"
				. "timstAdminRequest,"
				. "usrFlagLevel,"
				. "GrouPName,"
				. "UserName "
				. "from "
				. "socialEnergy.AdminUserGroups "
				. "left join "
				. "UsersCredentials on "
				. "usrReqAdmRleID=User_ID $SessionId"; //"select rowID,usrReqAdmRleID,timstAdminApproval,timstAdminRequest,usrFlagLevel,GrouPName from socialEnergy.AdminUserGroups  limit 0,20";

		$result = $this->db->query($sql);

		return $result;
	}

	function SelectTipsRecord($user_id = 0) {

		$sql = "";
		$result;

		$sql = "select "
				. "UserID,"
				. "descM,"
				. "dateFrom,"
				. "dateTo "
				. "from "
				. "socialEnergy.RecomedationsTips";

		$result = $this->db->query($sql);
		return $result;
	}

	function SelectIfhehasAnswerQuestion($user_id = 0) {

		$sql = "";
		$result;
		$questionaire = FALSE;

		$sql = "select "
				. "user_id "
				. "from "
				. "socialEnergy.Questionnaire "
				. "where "
				. "user_id=" . $this->db->escape($user_id) . "";

		$result = $this->db->query($sql);

		foreach ($result->result() as $row) {

			if ($row->User_ID) {
				
			}

			$questionaire = TRUE;
		}

		return $questionaire;
	}

	function SelectDisplayTips($user_id = 0) {

		$sql = "";
		$result;
		$data = [];
		$index = 0;

		$sql = "select "
				. "UserID,"
				. "descM,"
				. "dateFrom,"
				. "dateTo "
				. "from "
				. "socialEnergy.RecomedationsTips";

		$result = $this->db->query($sql);

		foreach ($result->result() as $row) {

			$data[$index] = $row->descM;

			$index++;
		}

		return $data;
	}

	
	
	
	function SelectComponet() {

		$sql = "";
		$result;
		$data = [];
		$index = 0;

		$sql = "select "
				. "RowID,"
				. "userID,"
				. "LcmsCom,"
				. "GameCom,"
				. "EnergyCom,"
				. "MarketPlaCom,"
				. "Analytics,"
				. "TimestampCha "
				. "from "
				. "socialEnergy.Componets ";

		$result = $this->db->query($sql);

		foreach ($result->result() as $row) {

			$data["RowID"] = isset($row->RowID) ? $row->RowID : "";
			$data["userID"] = isset($row->userID) ? $row->userID : "";
			$data["LcmsCom"] = isset($row->LcmsCom) ? $row->LcmsCom : "";
			$data["GameCom"] = isset($row->GameCom) ? $row->GameCom : "";
			$data["EnergyCom"] = isset($row->EnergyCom) ? $row->EnergyCom : "";
			$data["MarketPlaCom"] = isset($row->MarketPlaCom) ? $row->MarketPlaCom : "";
			$data["Analytics"] = isset($row->Analytics) ? $row->Analytics : "";
			$data["TimestampCha"] = isset($row->TimestampCha) ? $row->TimestampCha : "";

			$index++;
		}

		return $data;
	}

	function SelectTipsFromSericeNoParsing($email = null) {

		$sql = "";
		$result;
		$data = [];
		$index = 0;

		$sql = "select "
				. "rowID,"
				. "email,"
				. "message,"
				. "dateFrom,"
				. "dateTo,"
				. "timeRecordInserted "
				. "from "
				. "socialEnergy.RecomedationsService "
				. "where "
				. "email=" . $this->db->escape($email) . " "
				. "order by timeRecordInserted desc";

		$result = $this->db->query($sql);

		foreach ($result->result() as $row) {

			$data[$index] = $row->message;

			$index++;
		}

		return $result;
	}

	function SelectTipsFromSerice($email = null) {

		$sql = "";
		$result;
		$data = [];
		$index = 0;

		$sql = "select "
				. "rowID,"
				. "email,"
				. "message,"
				. "dateFrom,"
				. "dateTo,"
				. "timeRecordInserted "
				. "from "
				. "socialEnergy.RecomedationsService "
				. "where "
				. "email=" . $this->db->escape($email) . " "
				. "order by timeRecordInserted desc";

		$result = $this->db->query($sql);

		foreach ($result->result() as $row) {

			$data[$index] = $row->message;

			$index++;
		}

		return $data;
	}

	function GetNewServiceNames($usrID = null) {

		$sql = "";
		$result;
		$data = [];
		$data2 = [];
		$index = 0;

		$sql = "select "
				. "MessageType,"
				. "Text,typeID"
				. " from "
				. "socialEnergy.messageStack "
				. "where "
				. "Username=" . $this->db->escape($usrID) . " "
				. " and Status='unread'";

		$result = $this->db->query($sql);

		foreach ($result->result() as $row) {

			$data[$index] = $row->Text;
			$data2[$index] = $row->typeID;
			$index++;
		}
		return array($data, $data2);
		//return $data;
	}

	function LastDateUserLogin($userID) {

		$sql = "";
		$result;
		$Timestamp = 0;

		$sql = "select "
				. "timestamp "
				. "from "
				. "socialEnergy.Actions "
				. "where"
				. " userID=" . $this->db->escape($userID) . " "
				. "and "
				. "action='Login' "
				. "order by "
				. "timestamp desc limit 1,1;";
		//echo $sql;
		$result = $this->db->query($sql);

		foreach ($result->result() as $row) {

			$Timestamp = $row->timestamp;
		}

		return $Timestamp;
	}

	function SelectActions($DateFrom, $DateTo) {

		$sql = "";
		$result;
		$data = [];
		$timestamp = [];
		$type_of_action = [];
		$action = [];
		$os = [];
		$browser = [];

		$index = 0;

		$sql = "SELECT "
				. "userID,"
				. "timestamp,"
				. "from_unixtime(1517828945, '%d-%m-%Y %H:%i:%s') as fulldate,"
				. "type_of_action,"
				. "action,"
				. "os,"
				. "browser,"
				. "agent "
				. "FROM `Actions` "
				. "where "
				. "timestamp>'" . $this->db->escape($DateFrom) . "' "
				. "and "
				. "timestamp<'" . $this->db->escape($DateTo) . "'";

		$result = $this->db->query($sql);

		foreach ($result->result() as $row) {

			$timestamp[$index] = $row->fulldate;
			$type_of_action[$index] = $row->type_of_action;
			$action[$index] = $row->action;
			$os[$index] = $row->os;
			$browser[$index] = $row->browser;

			$index++;
		}

		return array($timestamp, $type_of_action, $action, $os, $browser);
	}

	function SelectQuestionaire($DateFrom, $DateTo, $start, $travel = 120) {

		$sql = "";
		$result;
		$timestamp = [];
		$Residentin_h_1 = [];
		$resid_0_12_2 = [];
		$resid_13_22_3 = [];
		$resid_23_45_4 = [];
		$resid_46_65_5 = [];
		$doyouownorre1_6 = [];
		$group1_7 = [];
		$HowManyresiden_work_8 = [];
		$timepeopleathome_9 = [];
		$hiedulevwithhome_10 = [];
		$pleSelectHomeType_11 = [];
		$whatEnergyClassIsForAspecificAppliance_12 = [];
		$HowManEnerClassAppliHav = [];
		$muilSockWithSwit = [];
		$DoYoUseNatLigSunDay = [];
		$DoYoLeaLigInUnoccRoom = [];
		$HavYouIssuEnerCertForHouse = [];
		$TheMetricKwhRepreWhat = [];
		$TheDiffOfKwAndKwh = [];
		$HavYouTakePartDemRespoEve = [];
		$whatIsTheAppliConsMaxEner = [];
		$areYReadInDemResEveLowHomEneCon = [];
		$whatIsAProsumer = [];
		$doYouHaveResInYourHouse = [];
		$DoYouKnowWhatDeregMarket = [];
		$HavYouTakenInDynamiPriciProgram = [];
		$DoKnowWhtTimeOfUseis = [];
		$AreYPayBillEveMon = [];
		$index = 0;

		$sql = "SELECT "
				. "Questionnaire.user_id,"
				. "Residentin_h_1,"
				. "resid_0_12_2,"
				. "resid_13_22_3,"
				. "resid_23_45_4,"
				. "resid_46_65_5,"
				. "doyouownorre1_6,"
				. "group1_7,"
				. "HowManyresiden_work_8,"
				. "timepeopleathome_9,"
				. "hiedulevwithhome_10,"
				. "pseyuhoty_11,"
				. "dyhreriah1_12,"
				. "ipinttrtuh_13,"
				. "ifhecfhov_14,"
				. "primaryEfficIndex_15,"
				. "enecerpeddindont_16,"
				. "typeaircond_17,"
				. "energyclassacu_2_18,"
				. "doyhwasmach_19,"
				. "doyhdrma_20,"
				. "doyhdish_21,"
				. "doyhelov_22,"
				. "dyhewh_23,"
				. "dyumuswas_24,"
				. "dyunlisd_25,"
				. "dulloiur_26,"
				. "durecycling_27,"
				. "energyeffibulbs_28,"
				. "from_unixtime(timestampCommit, '%d-%m-%Y %H:%i:%s') as fulldate,"
				. " UserName FROM "
				. "Questionnaire "
				. "inner join UsersCredentials "
				. "on UsersCredentials.User_ID = Questionnaire.user_id and timestampCommit>'" . $this->db->escape($DateFrom) . "' and timestampCommit<'" . $this->db->escape($DateTo) . "' limit $start,$travel";

		//echo "$sql";
		log_message('error', '------------SelectQuestionaire ' . $sql);
		$result = $this->db->query($sql);

		foreach ($result->result() as $row) {

			$timestamp[$index] = $row->fulldate;
			$Residentin_h_1[$index] = $row->Residentin_h_1;
			$resid_0_12_2[$index] = $row->resid_0_12_2;
			$resid_13_22_3[$index] = $row->resid_13_22_3;
			$resid_23_45_4[$index] = $row->resid_23_45_4;
			$resid_46_65_5[$index] = $row->resid_46_65_5;
			$doyouownorre1_6[$index] = $row->doyouownorre1_6;
			$group1_7[$index] = $row->group1_7;
			$HowManyresiden_work_8[$index] = $row->HowManyresiden_work_8;
			$timepeopleathome_9[$index] = $row->timepeopleathome_9;
			$hiedulevwithhome_10[$index] = $row->hiedulevwithhome_10;
			$pleSelectHomeType_11[$index] = $row->pseyuhoty_11;
			$whatEnergyClassIsForAspecificAppliance_12[$index] = $row->dyhreriah1_12;
			$HowManEnerClassAppliHav[$index] = $row->ipinttrtuh_13;
			$muilSockWithSwit[$index] = $row->ifhecfhov_14;
			$DoYoUseNatLigSunDay[$index] = $row->primaryEfficIndex_15;
			$DoYoLeaLigInUnoccRoom[$index] = $row->enecerpeddindont_16;
			$HavYouIssuEnerCertForHouse[$index] = $row->typeaircond_17;
			$TheMetricKwhRepreWhat[$index] = $row->energyclassacu_2_18;
			$TheDiffOfKwAndKwh[$index] = $row->doyhwasmach_19;
			$HavYouTakePartDemRespoEve[$index] = $row->doyhdrma_20;
			$whatIsTheAppliConsMaxEner[$index] = $row->doyhdish_21;
			$areYReadInDemResEveLowHomEneCon[$index] = $row->doyhelov_22;
			$whatIsAProsumer[$index] = $row->dyhewh_23;
			$doYouHaveResInYourHouse[$index] = $row->dyumuswas_24;
			$DoYouKnowWhatDeregMarket[$index] = $row->dyunlisd_25;
			$HavYouTakenInDynamiPriciProgram[$index] = $row->dulloiur_26;
			$DoKnowWhtTimeOfUseis[$index] = $row->durecycling_27;
			$AreYPayBillEveMon[$index] = $row->energyeffibulbs_28;
			//
			$index++;
		}


		return array
			(
			$timestamp,
			$Residentin_h_1,
			$resid_0_12_2,
			$resid_13_22_3,
			$resid_23_45_4,
			$resid_46_65_5,
			$doyouownorre1_6,
			$group1_7,
			$HowManyresiden_work_8,
			$timepeopleathome_9,
			$hiedulevwithhome_10,
			$pleSelectHomeType_11,
			$whatEnergyClassIsForAspecificAppliance_12,
			$HowManEnerClassAppliHav,
			$muilSockWithSwit,
			$DoYoUseNatLigSunDay,
			$DoYoLeaLigInUnoccRoom,
			$HavYouIssuEnerCertForHouse,
			$TheMetricKwhRepreWhat,
			$TheDiffOfKwAndKwh,
			$HavYouTakePartDemRespoEve,
			$whatIsTheAppliConsMaxEner,
			$areYReadInDemResEveLowHomEneCon,
			$whatIsAProsumer,
			$doYouHaveResInYourHouse,
			$DoYouKnowWhatDeregMarket,
			$HavYouTakenInDynamiPriciProgram,
			$DoKnowWhtTimeOfUseis,
			$AreYPayBillEveMon
		);
	}

	function SelectActionsB($DateFrom, $DateTo, $start, $travel = 120) {

		$sql = "";
		$result;
		$data = [];
		$timestamp = [];
		$type_of_action = [];
		$action = [];
		$os = [];
		$browser = [];
		$username = [];

		$index = 0;

		//$sql = "SELECT userID,timestamp,from_unixtime(1517828945, '%d-%m-%Y %H:%i:%s') as fulldate,type_of_action,action,os,browser,agent FROM `Actions` where timestamp>'" . $this->db->escape($DateFrom) . "' and timestamp<'" . $this->db->escape($DateTo) . "' limit $start,$travel";

		$sql = "SELECT "
				. "userID,"
				. "timestamp,"
				. "from_unixtime(timestamp, '%d-%m-%Y %H:%i:%s') as fulldate,"
				. "type_of_action,"
				. "action,"
				. "os,"
				. "browser,"
				. "agent,"
				. "UserName "
				. "FROM "
				. "Actions "
				. "inner join "
				. "UsersCredentials "
				. "on "
				. "User_ID = userID "
				. "and "
				. "timestamp>'" . $this->db->escape($DateFrom) . "' "
				. "and "
				. "timestamp<'" . $this->db->escape($DateTo) . "' "
				. "limit $start,$travel";

		log_message('error', '------------Some variable did not contain a value start ' . $sql);
		$result = $this->db->query($sql);

		foreach ($result->result() as $row) {

			$timestamp[$index] = $row->fulldate;
			$type_of_action[$index] = $row->type_of_action;
			$action[$index] = $row->action;
			$os[$index] = $row->os;
			$browser[$index] = $row->browser;
			$username[$index] = $row->UserName;

			$index++;
		}

		return array($timestamp, $type_of_action, $action, $os, $browser, $username);
	}

	function SelectUserAdminIDGroup($userIDrow) {

		$sql = "";
		$result;
		$usrReqAdmRleID = 0;
		$data = [];

		$sql = "select "
				. "usrReqAdmRleID,GrouPName "
				. "from "
				. "socialEnergy.AdminUserGroups "
				. "where"
				. " rowID=" . $this->db->escape($userIDrow) . " ";


		$result = $this->db->query($sql);

		foreach ($result->result() as $row) {

			$data["usernameGrp"] = $row->usrReqAdmRleID;
			$data["GrouPName"] = $row->GrouPName;
		}

		return $data;
	}
	
	function SelectUserGroupidEXISTS($userIDrow) {

		$sql = "";
		$result;
	    $IsAlive = false;

		$sql = "select "
				. "typeID "
				. "from "
				. "socialEnergy.messageStack "
				. "where"
				. " GrpID=" . $this->db->escape($userIDrow) . "";

		
		$result = $this->db->query($sql);

		foreach ($result->result() as $row) {

		$IsAlive = $row->typeID?true:false;
			
		}

		return $IsAlive;
	}
	

}
