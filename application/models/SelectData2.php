<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class SelectData2 extends CI_Model {

	function GetRecomedationAboutUser($usename, $rowID = null) {

		$sql = "";
		$result;

		$extraPart = isset($rowID) ? " and row_id=" . $this->db->escape($rowID) . "" : "";
		$sql = "select row_id,"
				. "UserID,"
				. "descM,"
				. "groupReceiver,"
				. "dateFrom,"
				. "dateTo,dateCreated,statusR "
				. " from "
				. "RecomedationsTips "
				. "where "
				. "UserID=(select User_ID from UsersCredentials where UserName=" . $this->db->escape($usename) . ")"
				. $extraPart;


		$result = $this->db->query($sql);
		return $result;
	}

	function GetLastSavedGameRecord($usename) {

		$sql = "";
		$result;

		$sql = "select row_id,"
				. "UserID,"
				. "descM,"
				. "groupReceiver,"
				. "dateFrom,"
				. "dateTo,dateCreated "
				. " from "
				. "RecomedationsTips "
				. "where "
				. "UserID=(select User_ID from UsersCredentials where UserName=" . $this->db->escape($usename) . ")";


		$result = $this->db->query($sql);
		return $result;
	}

	function SelectAllPendingListOrdersjson($usename) {

		$sql = "";
		$result;

		$sql = "SELECT JsonString FROM saveGameStatus where username=" . $this->db->escape($usename) . " order by timestamprecordInsert desc limit 0,1 ";


		$result = $this->db->query($sql);
		return $result;
	}
	
	
	function SelectAllPendingListOrders($usename) {

		$sql = "";
		$result;

		$sql = "SELECT username,Player,Badges,ActionObjects,JobPlanner,GameTime,Avatar FROM saveGameStatus where username=" . $this->db->escape($usename) . " order by timestamprecordInsert desc limit 0,1 ";


		$result = $this->db->query($sql);
		return $result;
	}

	function SelectAllPendingOrders($data, $admin = null) {

		$sql = "";
		$result;


		if (isset($admin)) {

			$sql = "select status,timestamp,userID from socialEnergy.productOrders  group by timestamp order by timestamp desc";
		} else {

			$sql = "select status,timestamp,userID from socialEnergy.productOrders where userID=" . $this->db->escape($data["userID"]) . " group by timestamp order by timestamp desc";
		}


		$result = $this->db->query($sql);
		return $result;
	}

	function SelectIfUserHasMoreThan4PendingOrders($data) {

		$sql = "";
		$result;

		$sql = "select count(status) as status from "
				. "("
				. "select "
				. "status,timestamp "
				. "from "
				. "socialEnergy.productOrders "
				. "where "
				. "userID=" . $this->db->escape($data["userID"]) . " "
				. "group by "
				. "timestamp) "
				. "as temp";

		// $sql = "select status from socialEnergy.productOrders where "
		// . "userID=" . $this->db->escape($data["userID"]) . " group by timestamp";

		$result = $this->db->query($sql);
		return $result;
	}

	function SelectIfRecomedationExist($data) {

		$sql = "";
		$result;
		$sql = "select email from socialEnergy.RecomedationsService where "
				. "email=" . $this->db->escape($data["email"]) . ""
				. "and message=" . $this->db->escape($data["message"]) . " "
				. "and dateFrom=" . $this->db->escape($data["dateFrom"]) . " "
				. "and dateTo=" . $this->db->escape($data["dateTo"]) . "  limit 20";

		$result = $this->db->query($sql);
		return $result;
	}

	function SelectUsersGameLevelOneMonthBack($usrName) {

		$sql = "";
		$results;

		$ext = isset($usrName) && mb_strlen($usrName, 'UTF-8') > 1 ? "  user_id=" . $this->db->escape($usrName) . " and " : "";
		
		//$sql = "select level_game as GameLevel1monthback,FROM_UNIXTIME(timestamp_user_logged_in),timestamp_user_logged_in from GameUserActions where user_id=" . $this->db->escape($usrName) . " and FROM_UNIXTIME(timestamp_user_logged_in) BETWEEN TIMESTAMP(DATE_SUB(NOW(), INTERVAL 31 day)) and TIMESTAMP(DATE_SUB(NOW(), INTERVAL 30 day)) order by timestamp_user_logged_in desc limit 1";
		
		$sql = "select level_game as GameLevel1monthback,FROM_UNIXTIME(timestamp_user_logged_in),timestamp_user_logged_in,user_id from GameUserActions where $ext FROM_UNIXTIME(timestamp_user_logged_in) BETWEEN TIMESTAMP(DATE_SUB(NOW(), INTERVAL 31 day)) and TIMESTAMP(DATE_SUB(NOW(), INTERVAL 30 day)) order by timestamp_user_logged_in desc limit 1";


		$result = $this->db->query($sql);
		return $result;
	}

	function SelectUserActivityLcms($usrName) {
		//$usrName ="usertestjohnqq";
		$sql = "";
		$results;
		$ext = isset($usrName) && mb_strlen($usrName, 'UTF-8') > 1 ? " and UsersCredentials.UserName = " . $this->db->escape($usrName) . "" : "";
		/*
		  $sql = "select "
		  . "CompTitle,"
		  . "CompMainDesc,"
		  . "RecordSavedAt "
		  . "from "
		  . "LcmsStoreDataFromService "
		  . "where "
		  . "userID=("
		  . "SELECT "
		  . "User_ID "
		  . "FROM "
		  . "UsersCredentials "
		  . "where "
		  . "UserName=" . $this->db->escape($usrName) . ")";
		 */

		$sql = "select CompTitle,"
				. "CompMainDesc,"
				. "UsersCredentials.UserName as username,"
				. "RecordSavedAt "
				. "from "
				. "LcmsStoreDataFromService "
				. "inner join "
				. "UsersCredentials on "
				. "UsersCredentials.User_ID = LcmsStoreDataFromService.userID "
				. " "
				. " $ext";


		
		$result = $this->db->query($sql);
		return $result;
	}

	function SelectUserActivityGame($usrName) {

		$sql = "";
		$results;
		$ext = isset($usrName) && mb_strlen($usrName, 'UTF-8') > 1 ? "where user_id=" . $this->db->escape($usrName) . "" : "";


		$sql = "select id_job,"
				. "user_id,"
				. "total_score,"
				. "daily_score,"
				. "game_duration,"
				. "timestamp_user_logged_in,"
				. "timestamp_user_logged_out,"
				. "energy_program,"
				. "level_game,"
				. "job_name,"
				. "total_credits,"
				. "total_cash,"
				. "total_experience_points,"
				. "all_badges,"
				. "devices from GameUserActions $ext ";
		
		$result = $this->db->query($sql);
		return $result;
	}

	function selectBasketProducts($stringBasketID) {

		$sql = "";
		$result;
		$sql = "select ProductID,"
				. "Product_Title,"
				. "Product_Short_Desc,"
				. "Product_Main_Description,"
				. "Price,"
				. "Main_Category,"
				. "Sub_Category,"
				. "Sub_Category_Level_3,"
				. "Upload_Pic,"
				. "Upload_Pic_2,"
				. "Upload_Pic_3,Timestamp_Created,"
				. "StatusPro "
				. "from ProductNum where ProductID in ($stringBasketID) and StatusPro='On AIR'";
		
		$result = $this->db->query($sql);
		return $result;
	}

	function SearchUserByUserName($usrName) {

		$sql = "";
		$result;
		$sql = "select "
				. "UserName,"
				. "User_ID "
				. "from "
				. "socialEnergy.UsersCredentials "
				. "where "
				. "UserName=" . $this->db->escape($usrName) . " "
				. "limit 20";

		$result = $this->db->query($sql);
		return $result;
	}

	function SearchUserByUseremail($usrEmail) {

		$sql = "";
		$result;
		$sql = "select "
				. "UserName,"
				. "User_ID "
				. "from "
				. "socialEnergy.UsersCredentials "
				. "where "
				. "EmailAddress=" . $this->db->escape($usrEmail) . " "
				. "limit 20";

		$result = $this->db->query($sql);
		return $result;
	}

	function isFriendRequestAccepted($data) {

		$sql = "";
		$result;
		$sql = "select rowID,"
				. "AdminID,"
				. "memberID,"
				. "timstInvitationApproval,"
				. "timstInvitationRequest,"
				. "usrFlagLevel,"
				. "usrGroups from socialEnergy.MemberUserGroups where memberID=" . $this->db->escape($data["memberID"]) . " and "
				. " rowID=" . $this->db->escape($data["rowID"]) . " and "
				. " usrGroups=" . $this->db->escape($data["usrGroups"]) . "";
		
		$result = $this->db->query($sql);
		return $result;
	}

	function PullUserGroups($data) {

		$sql = "";
		$result;
		$sql = "select rowID,"
				. "AdminID,"
				. "memberID,"
				. "timstInvitationApproval,"
				. "timstInvitationRequest,"
				. "usrFlagLevel,"
				. "usrGroups from socialEnergy.MemberUserGroups where AdminID=" . $this->db->escape($data["AdminID"]) . " and "
				. " memberID=" . $this->db->escape($data["memberID"]) . " and "
				. " usrGroups=" . $this->db->escape($data["usrGroups"]) . "";
		
		$result = $this->db->query($sql);
		return $result;
	}

	function RetrieveMostPopularProductPerUserANDALL($user_id = 0) {

		$sql = "";
		$result;

		$sql = "select 
            allclicks,
            allproductID,
            userIDPerUser,
            peruserclick ,
            productIDPerUSER ,
            allclicksu,
            Product_Title
from(
select 
allclicks,
allproductID,
userIDPerUser,
if(peruserclick,'','') as peruserclick ,
if(productIDPerUSER,'','') as productIDPerUSER ,
allclicksu,
Product_Title 
from ( 
select 
allclicks,
allproductID,
userIDPerUser,
if(totalClicks,'','') as peruserclick,
if(productID,'','') as productIDPerUSER,
userID as allclicksu 
from (
select productID as allproductID,
userID as allclicksu,
totalClicks as allclicks,
totalClicks as tPerUserAll,
userID as userIDPerUser 
from marketPlaceProductTraffic) 
as allrecords 
left join marketPlaceProductTraffic 
on marketPlaceProductTraffic.userID=allrecords.userIDPerUser 
and 
allrecords.userIDPerUser=" . $this->db->escape($user_id) . "  
group by userIDPerUser,
allproductID) as dataPeruser 
inner join 
ProductNum on allproductID=ProductID 
order by allclicks desc) 
as dataPeruser2
union
select allclicks,
allproductID,
userIDPerUser, 
peruserclick,
productIDPerUSER,
allclicksu,
Product_Title
from(
select allclicks,
allproductID,
userIDPerUser,
peruserclick,
productIDPerUSER,
allclicksu,
Product_Title 
from ( select 
allclicks,
allproductID,
userIDPerUser,
totalClicks as peruserclick,
productID as productIDPerUSER,
userID as allclicksu 
from (select if(productID,'','') as allproductID,
userID as allclicksu,
if(totalClicks,'','') as allclicks,
totalClicks as tPerUserAll,
if(userID,'','') as userIDPerUser 
from marketPlaceProductTraffic) as allrecords 
left join 
marketPlaceProductTraffic 
on marketPlaceProductTraffic.userID=allrecords.allclicksu 
and allrecords.allclicksu=" . $this->db->escape($user_id) . "  
group by productIDPerUSER) 
as dataPeruser 
inner join ProductNum 
on productIDPerUSER=ProductID 
order by peruserclick desc) as dataPeruser2";

		$result = $this->db->query($sql);
		return $result;
	}

	function RetrieveFriendsNamesPending($user_id = 0) {

		$sql = "";
		$result;

		$sql = "select rowID,"
				. "AdminID,"
				. "memberID,"
				. "timstInvitationApproval,"
				. "timstInvitationRequest,"
				. "usrFlagLevel,"
				. "UsersCredentials.UserName as AdminName,"
				. "tableB.UserName as UserName,grpOwnID,"
				. "usrGroups from "
				. "(select rowID,"
				. "AdminID,"
				. "memberID,"
				. "timstInvitationApproval,"
				. "timstInvitationRequest,"
				. "usrFlagLevel,"
				. "UserName,grpOwnID,"
				. "usrGroups "
				. "from socialEnergy.MemberUserGroups "
				. "join UsersCredentials on (memberID=User_ID or grpOwnID=User_ID)"
				. "and (memberID=" . $this->db->escape($user_id) . " or grpOwnID=" . $this->db->escape($user_id) . ")"
				. "and User_ID=" . $this->db->escape($user_id) . ") as tableB"
				. " join UsersCredentials on AdminID=User_ID";

		
		$result = $this->db->query($sql);
		return $result;
	}

	function countVisitsOfUser($usrID) {

		$sql = "";
		$result;

		$sql = "select COUNT(userID) as NumVisits from Actions where userID=" . $this->db->escape($usrID) . "";

		$result = $this->db->query($sql);

		return $result;
	}

	function getTotalScoreOfLcmsGame($usrID, $userName) {

		$sql = "";
		$result;

		$sql = "select sum(t.totalScore) as totalScoreSum from (
SELECT totalScore FROM LcmsStoreDataFromServiceScoreTotal where UserID=" . $this->db->escape($usrID) . "
 UNION
select sum(total_score) as totalScore from  GameUserActions where user_id=" . $this->db->escape($userName) . ") as t;";

		$result = $this->db->query($sql);

		return $result;
	}

	function GameCurrentTotalScore($usrID,$flag=null) {

		$sql = "";
		$result;
		$ext = "";

		if($flag){
			
			$ext = isset($usrID) && mb_strlen($usrID, 'UTF-8') > 1 ? " where user_id=" . $this->db->escape($usrID) . "" : "";

		}else{
			
			$ext = " where user_id=" . $this->db->escape($usrID) . "";
			
		}
		
		$sql = "select sum(total_score) as totalScore,user_id from  GameUserActions $ext";
		
		//$sql = "select sum(total_score) as totalScore from  GameUserActions where user_id=" . $this->db->escape($usrID) . "";

		$result = $this->db->query($sql);

		return $result;
	}

	function GameLastWeekTotalScore($usrID,$flag=null) {

		$sql = "";

		$result;
        $ext = "";
		
		if($flag){
			
			$ext = isset($usrID) && mb_strlen($usrID, 'UTF-8') > 1 ? "  user_id=" . $this->db->escape($usrID) . " and " : "";

		}else{
			
			$ext = " user_id=" . $this->db->escape($usrID) . " and ";
			
		}
		
		//$sql = "select sum(total_score) as totalScore,user_id from  GameUserActions where user_id=" . $this->db->escape($usrID) . " and DATE_ADD(FROM_UNIXTIME(timestamp_user_logged_in), INTERVAL 7 DAY) >= NOW()";
        $sql = "select sum(total_score) as totalScore,user_id from  GameUserActions where $ext DATE_ADD(FROM_UNIXTIME(timestamp_user_logged_in), INTERVAL 7 DAY) >= NOW()";
		
		
		$result = $this->db->query($sql);

		return $result;
	}

	function getAllBadges($usrID,$flag=null) {

		$sql = "";
        $ext = "";
		$result;

		//		
		if($flag){
			
			$ext = isset($usrID) && mb_strlen($usrID, 'UTF-8') > 1 ? " where user_id=" . $this->db->escape($usrID) . "" : "";

		}else{
			
			$ext = " where user_id=" . $this->db->escape($usrID) . "";
			
		}
		
		$sql = "select all_badges,user_id from GameUserActions $ext group by all_badges";
		
		//$sql = "select all_badges from GameUserActions where user_id=" . $this->db->escape($usrID) . " group by all_badges";

		$result = $this->db->query($sql);

		return $result;
	}

	function getTotalRewardsProgram($usrID,$flag=null) {

		$sql = "";
        $ext = "";
		$result;

		if($flag){
			
			$ext = isset($usrID) && mb_strlen($usrID, 'UTF-8') > 1 ? " where user_id=" . $this->db->escape($usrID) . "" : "";

		}else{
			
			$ext = " where user_id=" . $this->db->escape($usrID) . "";
			
		}
		
		$sql = "select sum(total_credits) as totalCredits,sum(total_cash) as totalCash,sum(total_experience_points) as toExPoints,user_id from GameUserActions $ext";
		//$sql = "select sum(total_credits) as totalCredits,sum(total_cash) as totalCash,sum(total_experience_points) as toExPoints,user_id from GameUserActions where user_id=" . $this->db->escape($usrID) . "";
      
		$result = $this->db->query($sql);

		return $result;
	}

	
		function getTotalForEachProgramPerUser() {

		$sql = "";

		$result;

		$sql = "select energy_program,sum(total_score) as CommunityPricing,user_id from GameUserActions where energy_program='CommunityPricing' group by user_id "
				. "UNION "
				. "select energy_program,sum(total_score) as CommunityPricing,user_id from GameUserActions where energy_program='PersonalRealTimePricing' group by user_id "
				. "UNION "
				. "select energy_program,sum(total_score) as CommunityPricing,user_id from GameUserActions where energy_program='RealTimePricing' group by user_id "
				. "UNION "
				. "select energy_program,sum(total_score) as CommunityPricing,user_id from GameUserActions where energy_program='FixedPricing' group by user_id";

		$result = $this->db->query($sql);

		return $result;
	}
	
	
	
	
	function getTotalForEachProgram($usrID) {

		$sql = "";

		$result;

		$sql = "select energy_program,sum(total_score) as CommunityPricing,user_id from GameUserActions where user_id=" . $this->db->escape($usrID) . " and energy_program='CommunityPricing'
                UNION
                select energy_program,sum(total_score) as CommunityPricing,user_id from GameUserActions where user_id=" . $this->db->escape($usrID) . " and energy_program='PersonalRealTimePricing'
                UNION
                select energy_program,sum(total_score) as CommunityPricing,user_id from GameUserActions where user_id=" . $this->db->escape($usrID) . " and energy_program='RealTimePricing'
                UNION
                select energy_program,sum(total_score) as CommunityPricing,user_id from GameUserActions where user_id=" . $this->db->escape($usrID) . " and energy_program='FixedPricing'";

		$result = $this->db->query($sql);

		return $result;
	}

	function GameLastMonthTotalScore($usrID,$flag=null) {


		$sql = "";

		$result;
		$ext = "";
		
		if($flag){
			
			$ext = isset($usrID) && mb_strlen($usrID, 'UTF-8') > 1 ? "  user_id=" . $this->db->escape($usrID) . " and " : "";

		}else{
			
			$ext = "  user_id=" . $this->db->escape($usrID) . " and ";
			
		}
		

		//$sql = "select sum(total_score) as totalScore,user_id from  GameUserActions where user_id=" . $this->db->escape($usrID) . " and DATE_ADD(FROM_UNIXTIME(timestamp_user_logged_in), INTERVAL 30"
			//	. " DAY) >= NOW()";
		
		$sql = "select sum(total_score) as totalScore,user_id from  GameUserActions where $ext DATE_ADD(FROM_UNIXTIME(timestamp_user_logged_in), INTERVAL 30"
				. " DAY) >= NOW()";

		

		$result = $this->db->query($sql);
		
		return $result;
	}

	function GetUserNames($usrGroupName) {

		$sql = "";
		$result;

		$sql = "select UserName from MemberUserGroupsPassed join UsersCredentials on memberID=User_ID and usrGroups=" . $this->db->escape($usrGroupName) . "";

		$result = $this->db->query($sql);

		return $result;
	}

	function returnMemberofAllGroups($user_id) {

		$sql = "";
		$result;

		$sql = "select 
            tableA.rowID,
            tableA.AdminID,
            tableA.memberID,
            tableA.timstInvitationApproval,
            tableA.timstInvitationRequest,
            tableA.usrFlagLevel,
            tableA.AdminName,
            tableA.UserName,
            tableA.grpOwnID,
            tableA.usrGroups 
            from(
select 
rowID,
AdminID,
memberID,
timstInvitationApproval,
timstInvitationRequest,
usrFlagLevel,
UsersCredentials.UserName as AdminName,
tableB.UserName as UserName,
grpOwnID,
usrGroups 
from (
select 
rowID,
AdminID,
memberID,
timstInvitationApproval,
timstInvitationRequest,
usrFlagLevel,
UserName,
grpOwnID,
usrGroups 
from 
socialEnergy.MemberUserGroupsPassed 
join UsersCredentials 
on 
(memberID=User_ID or grpOwnID=User_ID)) 
as tableB join UsersCredentials 
on memberID=User_ID group by UserName
union
select 
rowID,
AdminID,
memberID,
timstInvitationApproval,
timstInvitationRequest,
usrFlagLevel,
UsersCredentials.UserName as AdminName,
tableB.UserName as UserName,
grpOwnID,
usrGroups 
from (
select 
rowID,
AdminID,
memberID,
timstInvitationApproval,
timstInvitationRequest,
usrFlagLevel,
UserName,
grpOwnID,
usrGroups 
from 
socialEnergy.MemberUserGroupsPassed 
join UsersCredentials 
on 
(memberID=User_ID or grpOwnID=User_ID)) 
as tableB 
join 
UsersCredentials 
on AdminID=User_ID 
group by rowID) 
as tableA inner join 
(select 
rowID,
AdminID,
memberID,
timstInvitationApproval,
timstInvitationRequest,
usrFlagLevel,
UsersCredentials.UserName as AdminName,
tableB.UserName as UserName,
grpOwnID,
usrGroups 
from (
select rowID,
AdminID,
memberID,
timstInvitationApproval,
timstInvitationRequest,
usrFlagLevel,
UserName,
grpOwnID,
usrGroups 
from socialEnergy.MemberUserGroupsPassed 
join UsersCredentials on (
memberID=User_ID 
or grpOwnID=User_ID) and 
(memberID=" . $this->db->escape($user_id) . " or grpOwnID=" . $this->db->escape($user_id) . ") 
and User_ID=" . $this->db->escape($user_id) . ") as tableB join 
UsersCredentials on 
AdminID=User_ID group by usrGroups) 
as tableBB on tableA.usrGroups=tableBB.usrGroups 
group by tableA.UserName";

		
		$result = $this->db->query($sql);

		return $result;
	}

	function retrieveGroupMemebers($groupName) {

		$sql = "";
		$result;

		$sql = "select rowID,"
				. "AdminID,"
				. "memberID,"
				. "timstInvitationApproval,"
				. "timstInvitationRequest,"
				. "usrFlagLevel,"
				. "UsersCredentials.UserName as AdminName,"
				. "tableB.UserName as UserName,"
				. "grpOwnID,"
				. "usrGroups "
				. "from (select "
				. "rowID,"
				. "AdminID,"
				. "memberID,"
				. "timstInvitationApproval,"
				. "timstInvitationRequest,"
				. "usrFlagLevel,"
				. "UserName,"
				. "grpOwnID,"
				. "usrGroups "
				. "from socialEnergy.MemberUserGroupsPassed "
				. "join UsersCredentials on "
				. "memberID=User_ID and  usrGroups=" . $this->db->escape($groupName) . ") "
				. "as tableB join UsersCredentials "
				. "on memberID=User_ID";

		$result = $this->db->query($sql);
		return $result;
	}

	//to retrieve 
	function getMemebersofGroup($groupName) {

		$sql = "";
		$result;

		$sql = "select rowID,
			AdminID,
			memberID,
			timstInvitationApproval,
			timstInvitationRequest,
			usrFlagLevel,
			UsersCredentials
.UserName as AdminName,
tableB.UserName as UserName,
grpOwnID,
usrGroups 
from (
select rowID,
AdminID,
memberID
,timstInvitationApproval,
timstInvitationRequest,
usrFlagLevel,
UserName,
grpOwnID,
usrGroups from socialEnergy
.MemberUserGroupsPassed join UsersCredentials 
on (memberID=User_ID OR AdminID=User_ID) and usrGroups=" . $this->db->escape($groupName) . " group by UserName) as tableB
 join UsersCredentials on memberID=User_ID";


		$result = $this->db->query($sql);
		return $result;
	}

	function RetrieveLcmsLastRecordCourses($user_id = 0) {

		$user_id = (int) $user_id;

		$sql = "select "
				. "RowID,"
				. "ObjectName,"
				. "ObjectNameDesc,"
				. "RecordSavedAt "
				. "from socialEnergy.LcmsStoreDataFromServiceCoursers "
				. "where "
				. "UserID=" . $this->db->escape($user_id) . " "
				. "order by RecordSavedAt desc ";

		// echo "<br>SelectData3::SQL:::--  ".$sql;
		$result = $this->db->query($sql);
		return $result;
	}

	function RetrieveLcmsLastRecordCoursesw($user_id) {

	

		/*
		  $sql = "select "
		  . "RowID,"
		  . "ObjectName,"
		  . "ObjectNameDesc,"
		  . "RecordSavedAt "
		  . "from socialEnergy.LcmsStoreDataFromServiceCoursers "
		  . "where "
		  . "UserID=" . $this->db->escape($user_id) . " "
		  . "order by RecordSavedAt desc ";
		 */
		// echo "<br>SelectData3::SQL:::--  ".$sql;

		$ext = isset($user_id) && mb_strlen($user_id, 'UTF-8') > 1 ? " and UsersCredentials.UserName = " . $this->db->escape($user_id) . "" : "";

		$sql = "select RowID,DateGraded,CurrentGrade,TimeSpent,"
				. "ObjectName,"
				. "ObjectNameDesc,"
				. "UsersCredentials.UserName as username,"
				. "RecordSavedAt,grademin,grademax,gradepass "
				. "from "
				. "socialEnergy.LcmsStoreDataFromServiceCoursers "
				. "inner join "
				. "UsersCredentials "
				. "on UsersCredentials.User_ID= LcmsStoreDataFromServiceCoursers.UserID "
				. " "
				. "$ext "
				. "order by RecordSavedAt desc";


		$result = $this->db->query($sql);
		return $result;
	}

	function RetrieveLcmsLastRecordScoreTotalw(
	$user_id) {

		$ext = isset($user_id) && mb_strlen($user_id, 'UTF-8') > 1 ? " and UsersCredentials.UserName = " . $this->db->escape($user_id) . "" : "";
	
		/*
		  $sql = "select "
		  . "totalScore,"
		  . "lastWeekTotalScore,"
		  . "lastMonthTotalScore "
		  . "from socialEnergy.LcmsStoreDataFromServiceScoreTotal "
		  . "where "
		  . "UserID=" . $this->db->escape($user_id) . " "
		  . "order by timeRecordInserted desc ";
		 */


		$sql = "select totalScore,"
				. "lastWeekTotalScore,"
				. "lastMonthTotalScore,UsersCredentials.UserName as username "
				. "from "
				. "socialEnergy.LcmsStoreDataFromServiceScoreTotal "
				. "inner join "
				. "UsersCredentials on "
				. "UsersCredentials.User_ID= LcmsStoreDataFromServiceScoreTotal.UserID "
				. " "
				. " $ext "
				. "order by timeRecordInserted desc";


		$result = $this->db->query($sql);
		return $result;
	}

	function RetrieveLcmsLastRecordScoreTotal($CurrentTotalScore, $LastWeekTotalScore, $LastMonthTotalScore, $user_id = 0) {


		$user_id = (int) $user_id;

		$sql = "select "
				. "totalScore,"
				. "lastWeekTotalScore,"
				. "lastMonthTotalScore "
				. "from socialEnergy.LcmsStoreDataFromServiceScoreTotal "
				. "where "
				. "UserID=" . $this->db->escape($user_id) . " "
				. "order by timeRecordInserted desc ";

	
		$result = $this->db->query($sql);
		return $result;
	}

	function RetrieveLcmsLastRecordScore($user_id = 0) {


		$user_id = (int) $user_id;

		$sql = "select "
				. "Name,"
				. "Description,"
				. "valuesServi "
				. "from socialEnergy.LcmsStoreDataFromServiceScore "
				. "where "
				. "userID=" . $this->db->escape($user_id) . " "
				. "order by tmsIntoSystem desc ";

	
		$result = $this->db->query($sql);
		return $result;
	}

	function RetrieveLcmsLastRecordScorew($user_id) {

	
		/*
		  $sql = "select "
		  . "Name,"
		  . "Description,"
		  . "valuesServi "
		  . "from socialEnergy.LcmsStoreDataFromServiceScore "
		  . "where "
		  . "userID=" . $this->db->escape($user_id) . " "
		  . "order by tmsIntoSystem desc ";
		 */
		$ext = isset($user_id) && mb_strlen($user_id, 'UTF-8') > 1 ? " and UsersCredentials.UserName = " . $this->db->escape($user_id) . "" : "";
		$sql = "select Name,"
				. "Description,"
				. "valuesServi,UsersCredentials.UserName as username "
				. "from "
				. "socialEnergy.LcmsStoreDataFromServiceScore "
				. "inner join "
				. "UsersCredentials on "
				. "UsersCredentials.User_ID= LcmsStoreDataFromServiceScore.userID "
				. " "
				. " $ext "
				. "order by tmsIntoSystem desc;";


		$result = $this->db->query($sql);
		return $result;
	}

	function RetrieveLcmsLastRecordBadgesW($user_id) {

		
		/* 		
		  $sql = "select "
		  . "RowID,"
		  . "BadgeName,"
		  . "BadgeDesc,"
		  . "DateGiven,RecordSavedAt,UserID "
		  . "from socialEnergy.LcmsStoreDataFromServiceBadge "
		  . "where "
		  . "UserID=" . $this->db->escape($user_id) . " "
		  . "order by RecordSavedAt desc ";
		 */

		$ext = isset($user_id) && mb_strlen($user_id, 'UTF-8') > 1 ? " and UsersCredentials.UserName = " . $this->db->escape($user_id) . "" : "";

		$sql = "select RowID,"
				. "BadgeName,"
				. "BadgeDesc,"
				. "DateGiven,"
				. "UsersCredentials.UserName as username,"
				. "RecordSavedAt,"
				. "UserID "
				. "from socialEnergy.LcmsStoreDataFromServiceBadge "
				. "inner join "
				. "UsersCredentials "
				. "on "
				. "UsersCredentials.User_ID =LcmsStoreDataFromServiceBadge.UserID "
				. " "
				. " $ext "
				. "order by LcmsStoreDataFromServiceBadge.RecordSavedAt desc;";


		$result = $this->db->query($sql);
		return $result;
	}

	function RetrieveLcmsLastRecordBadges($user_id = 0) {

		$user_id = (int) $user_id;

		$sql = "select "
				. "RowID,"
				. "BadgeName,"
				. "BadgeDesc,"
				. "DateGiven,RecordSavedAt,UserID "
				. "from socialEnergy.LcmsStoreDataFromServiceBadge "
				. "where "
				. "UserID=" . $this->db->escape($user_id) . " "
				. "order by RecordSavedAt desc ";


		$result = $this->db->query($sql);
		return $result;
	}

	function RetrieveLcmsLastRecord($user_id = 0) {

		$user_id = (int) $user_id;

		$sql = "select "
				. "IdRow,"
				. "CompTitle,"
				. "CompMainDesc,"
				. "RecordSavedAt "
				. "from socialEnergy.LcmsStoreDataFromService "
				. "where "
				. "userID=" . $this->db->escape($user_id) . " "
				. "order by RecordSavedAt desc ";

	
		$result = $this->db->query($sql);
		return $result;
	}

	function RetrieveFriendsNames($user_id = 0) {

		$sql = "";
		$result;
		/*
		  $sql = "select rowID,"
		  . "AdminID,"
		  . "memberID,"
		  . "timstInvitationApproval,"
		  . "timstInvitationRequest,"
		  . "usrFlagLevel,"
		  . "UserName,"
		  . "usrGroups from socialEnergy.MemberUserGroups join UsersCredentials on memberID=User_ID and  "
		  . " memberID=" . $this->db->escape($user_id) . "  and User_ID=" . $this->db->escape($user_id) . " ";
		 */

		$sql = "select rowID,"
				. "AdminID,"
				. "memberID,"
				. "timstInvitationApproval,"
				. "timstInvitationRequest,"
				. "usrFlagLevel,"
				. "UsersCredentials.UserName as AdminName,"
				. "tableB.UserName as UserName,grpOwnID,"
				. "usrGroups from "
				. "(select rowID,"
				. "AdminID,"
				. "memberID,"
				. "timstInvitationApproval,"
				. "timstInvitationRequest,"
				. "usrFlagLevel,"
				. "UserName,grpOwnID,"
				. "usrGroups "
				. "from socialEnergy.MemberUserGroupsPassed "
				. "join UsersCredentials on (memberID=User_ID or grpOwnID=User_ID)"
				. "and (memberID=" . $this->db->escape($user_id) . " or grpOwnID=" . $this->db->escape($user_id) . ")"
				. "and User_ID=" . $this->db->escape($user_id) . ") as tableB"
				. " join UsersCredentials on AdminID=User_ID group by usrGroups";



		$result = $this->db->query($sql);
		return $result;
	}

	function RetrieveFriendsNamesBasedOnUserName($user_name) {

		$sql = "select "
				. "rowID,"
				. "AdminID,"
				. "memberID,"
				. "timstInvitationApproval,"
				. "timstInvitationRequest,"
				. "usrFlagLevel,"
				. "UsersCredentials.UserName as AdminName,"
				. "tableB.UserName as UserName,"
				. "grpOwnID,"
				. "usrGroups "
				. "from "
				. "(select rowID,"
				. "AdminID,"
				. "memberID,"
				. "timstInvitationApproval,"
				. "timstInvitationRequest,"
				. "usrFlagLevel,"
				. "UserName,"
				. "grpOwnID,"
				. "usrGroups "
				. "from socialEnergy.MemberUserGroupsPassed "
				. "join "
				. "UsersCredentials on "
				. "(memberID=User_ID or grpOwnID=User_ID) "
				. "and "
				. "UserName=" . $this->db->escape($user_name) . ") as tableB "
				. "join UsersCredentials "
				. "on AdminID=User_ID "
				. "group by usrGroups;";


		$result = $this->db->query($sql);
		return $result;
	}

	function toWhomIhaveSendRequest($user_id = 0) {

		$sql = "";
		$result;

		$sql = "select rowID,"
				. "AdminID,"
				. "memberID,"
				. "timstInvitationApproval,"
				. "timstInvitationRequest,"
				. "usrFlagLevel,"
				. "UsersCredentials.UserName as AdminName,"
				. "tableB.UserName as UserName,grpOwnID,"
				. "usrGroups "
				. "from ("
				. "select "
				. "rowID,"
				. "AdminID,"
				. "memberID,"
				. "timstInvitationApproval,"
				. "timstInvitationRequest,"
				. "usrFlagLevel,"
				. "UserName,grpOwnID,"
				. "usrGroups "
				. "from socialEnergy.MemberUserGroups "
				. "join UsersCredentials on "
				. "AdminID=User_ID "
				. "and AdminID=" . $this->db->escape($user_id) . " "
				. "and User_ID=" . $this->db->escape($user_id) . ") "
				. "as tableB join UsersCredentials on memberID=User_ID";

	
		$result = $this->db->query($sql);
		return $result;
	}

	function acceptInvitation($arguments) {
		//$this->db->trans_start();
		$this->db->trans_begin();
		$this->db->trans_strict(FALSE);

		$sql = "";
		$affectedRowsInsert = 0;
		$affectedRowsUpdate = 0;


		$sql = "update socialEnergy.MemberUserGroups set "
				. "timstInvitationApproval=" . $this->db->escape($arguments["timstInvitationApproval"]) . ""
				. " where rowID=" . $this->db->escape($arguments["rowID"]) . " and memberID=" . $this->db->escape($arguments["memberID"]) . "";

		$result = $this->db->query($sql);
		$affectedRowsUpdate = $this->db->affected_rows();


		$sql = "INSERT INTO 
            MemberUserGroupsPassed (
            AdminID, 
            memberID, 
            timstInvitationApproval, 
            timstInvitationRequest, 
            usrFlagLevel, 
            usrGroups, 
            grpOwnID)
            SELECT 
            AdminID, 
            memberID, 
            timstInvitationApproval, 
            timstInvitationRequest, 
            usrFlagLevel, 
            usrGroups, 
            grpOwnID 
            FROM MemberUserGroups  
            where 
            rowID=" . $this->db->escape($arguments["rowID"]) . " "
				. "and memberID=" . $this->db->escape($arguments["memberID"]) . "";

		$result = $this->db->query($sql);
		$affectedRowsInsert = $this->db->affected_rows();


		if ($this->db->trans_status() === FALSE || $affectedRowsUpdate < 1 || $affectedRowsInsert < 1) {

			$this->db->trans_rollback();

			return FALSE;
		} else {

			$this->db->trans_commit();

			return TRUE;
		}

		//  if($this->db->trans_status() === FALSE || !isset($result) || !isset($rst2)){
		// $this->db->trans_rollback();
//}else{
		//  $this->db->trans_commit();
//}
	}

}
