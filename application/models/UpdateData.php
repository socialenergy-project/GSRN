<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UpdateData
 *
 * @author John Papagiannis <intelen>
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class UpdateData extends CI_Model {

	//put your code here

		function updateLcmsTotalScore($totalScore,$lastWeekTotalScore,$lastMonthTotalScore,$UserID) {

		$sql = "update socialEnergy.LcmsStoreDataFromServiceScoreTotal set "
				. "totalScore=" . $this->db->escape($totalScore) . ","
				. "lastWeekTotalScore=" . $this->db->escape($lastWeekTotalScore) . ","
				. "lastMonthTotalScore=" . $this->db->escape($lastMonthTotalScore) . " where"
				. " UserID=" . $this->db->escape($UserID) . "";
	
		$result = $this->db->query($sql);
		return $result;
	}
	
	function recomedationRead($username,$rowID,$status) {

		$sql = "update socialEnergy.RecomedationsTips,UsersCredentials set "
				. "statusR=" . $this->db->escape($status) . ""				
				. "where "
				. "UserID=(select User_ID from UsersCredentials "
				. "where UserName=" . $this->db->escape($username) . ") and row_id=" . $this->db->escape($rowID) . "";

		$result = $this->db->query($sql);
		return $result;
	}
	
	
	function updateStatusCom($arguments) {

		$sql = "update socialEnergy.Componets set "
				. "userID=" . $this->db->escape($arguments["userID"]) . ","
				. "LcmsCom=" . $this->db->escape($arguments["LcmsCom"]) . ","
				. "GameCom=" . $this->db->escape($arguments["GameCom"]) . ","
				. "EnergyCom=" . $this->db->escape($arguments["EnergyCom"]) . ","
				. "Analytics=" . $this->db->escape($arguments["Analytics"]) . ","
				. "MarketPlaCom=" . $this->db->escape($arguments["MarketPlaCom"]) . ","
				. "TimestampCha=" . $this->db->escape($arguments["TimestampCha"]) . "";


		$result = $this->db->query($sql);
		return $result;
	}

	function updateStatusGroupMessageSendID($RowID) {

		$sql = "update socialEnergy.messageStack set "
				. "Status='read' "
				. " where "
				. "typeID=" . $this->db->escape($RowID) . " ";
				

		$result = $this->db->query($sql);
		return $result;
	}
	
	
	function updateStatusOrder($arguments) {

		$sql = "update socialEnergy.productOrders set "
				. "status=" . $this->db->escape($arguments["status"]) . ""
				. " where "
				. "timestamp=" . $this->db->escape($arguments["rowID"]) . " "
				. "and "
				. "userID=" . $this->db->escape($arguments["rowUserId"]) . "";

		$result = $this->db->query($sql);
		return $result;
	}

	function updateStatusReceiveInvitation($arguments) {

		$sql = "update socialEnergy.MemberUserGroups set "
				. "timstInvitationApproval=" . $this->db->escape($arguments["timstInvitationApproval"]) . ""
				. " where "
				. "rowID=" . $this->db->escape($arguments["rowID"]) . " "
				. "and "
				. "memberID=" . $this->db->escape($arguments["memberID"]) . "";

		$result = $this->db->query($sql);
		return $result;
	}

	function updateStatusMarketProViews($arguments) {

		$sql = "update socialEnergy.marketPlaceProductTraffic set "
				. "totalClicks=" . $this->db->escape($arguments["totalClicks"]) . ""
				. " where "
				. "productID=" . $this->db->escape($arguments["productID"]) . " "
				. "and "
				. "userID=" . $this->db->escape($arguments["userID"]) . "";

		$result = $this->db->query($sql);
		return $result;
	}

	function updateStatusGroup($arguments) {


		$SessionId = isset($data["sessionID"]) && mb_strlen($data["sessionID"], 'utf8') > 0 ? " and usrReqAdmRleID=" . $this->db->escape($arguments["sessionID"]) . " " : " ";

		$sql = "update socialEnergy.AdminUserGroups set "
				. "timstAdminApproval=" . $this->db->escape($arguments["timstAdminApproval"]) . ""
				. " where rowID='" . $this->db->escape($arguments["rowID"]) . "'  $SessionId";

		$result = $this->db->query($sql);
		return $result;
	}

	function updateStatusProduct($arguments) {

		$sql = "update socialEnergy.ProductNum set "
				. "StatusPro=" . $this->db->escape($arguments["proSTA"]) . ""
				. " where ProductID='" . $this->db->escape($arguments["proID"]) . "'";

		$result = $this->db->query($sql);
		return $result;
	}

	function updateStatusProPicture($arguments) {

		$sql = "update socialEnergy.ProductNum set "
				. "{$arguments["fieldName"]}=''"
				. " where ProductID=" . $this->db->escape($arguments["ProductID"]) . "";

		$result = $this->db->query($sql);
		return $result;
	}

	function updateDetailsProduct($arguments) {

		$sqlExtraPart = "";

		if (isset($arguments["Upload_Pic"]) && mb_strlen($arguments["Upload_Pic"], 'UTF-8') > 1) {

			$sqlExtraPart .= ",Upload_Pic=" . $this->db->escape($arguments["Upload_Pic"]) . "";
		}

		if (isset($arguments["Upload_Pic_2"]) && mb_strlen($arguments["Upload_Pic_2"], 'UTF-8') > 1) {

			$sqlExtraPart .= ",Upload_Pic_2=" . $this->db->escape($arguments["Upload_Pic_2"]) . "";
		}

		if (isset($arguments["Upload_Pic_3"]) && mb_strlen($arguments["Upload_Pic_3"], 'UTF-8') > 1) {

			$sqlExtraPart .= ",Upload_Pic_3=" . $this->db->escape($arguments["Upload_Pic_3"]) . "";
		}

		$sql = "update socialEnergy.ProductNum set "
				. "Product_Title=" . $this->db->escape($arguments["Product_Title"]) . ","
				. "Product_Short_Desc=" . $this->db->escape($arguments["Product_Short_Desc"]) . ","
				. "Product_Main_Description=" . $this->db->escape($arguments["Product_Main_Desc"]) . ","
				. "Price=" . $this->db->escape($arguments["Product_Price"]) . ","
				. "Main_Category=" . $this->db->escape($arguments["Main_Category"]) . ","
				. "Sub_Category=" . $this->db->escape($arguments["Sub_Category"]) . ","
				. "Sub_Category_Level_3=" . $this->db->escape($arguments["Sub_Category3"]) . " $sqlExtraPart "
				. " where ProductID='" . $this->db->escape($arguments["ProductID"]) . "'";

		$result = $this->db->query($sql);
		return $result;
	}

	function updateTokenUserCredentials($arguments) {

		$sql = "update socialEnergy.UsersCredentials set "
				. "PasswordToken=" . $this->db->escape($arguments["PasswordToken"]) . ""
				. " where UserName=" . $this->db->escape($arguments["userid"]) . " and"
				. " Password=" . $this->db->escape($arguments["password"]) . "   ";

		$result = $this->db->query($sql);
		return $result;
	}

	function updateRecordUserIDgridID($arguments) {

		$sql = "update socialEnergy.DashboardFormation set "
				. "json=" . $this->db->escape($arguments["json"]) . ","
				. "timestamp=" . $this->db->escape($arguments["timestamp"]) . ""
				. " where user_id=" . $this->db->escape($arguments["user_id"]) . " and"
				. " grid=" . $this->db->escape($arguments["grid"]) . "   ";

		$result = $this->db->query($sql);
		return $result;
	}

	function updateRecordDashboardPosition($arguments) {

		$sql = "update socialEnergy.DashboardFormatPlaces set "
				. "{$arguments["FieldName"]}=" . $this->db->escape($arguments["droppableID"]) . ""
				. " where  UserID=" . $this->db->escape($arguments["UserID"]) . "   ";
	
		$result = $this->db->query($sql);
		return $result;
	}

}
