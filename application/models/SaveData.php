<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SaveData
 *
 * @author John Papagiannis <intelen>
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SaveData extends CI_Model
{

    //put your code here
 function SaveUserOrder($arguments)
    {


        $sql = "INSERT INTO socialEnergy.productOrders ("
                . "productName, productID, quantity,price,userID,timestamp) "
                . "VALUES ("
                . "" . $this->db->escape($arguments["productName"]) . ", "
                . "" . $this->db->escape($arguments["productID"]) . ","
                . "" . $this->db->escape($arguments["quantity"]) . ","
                . "" . $this->db->escape($arguments["price"]) . ","
                . "" . $this->db->escape($arguments["userID"]) . ","
                . "'" . $this->db->escape($arguments["timestamp"]) . "'"
                . ")";


        $result = $this->db->query($sql);
        return $result;
    }


    function CreateClientUsersToken($arguments)
    {

        // $new_password = password_hash($arguments["password"], PASSWORD_DEFAULT);

        $sql = "INSERT INTO my_oauth2_db.oauth_users ("
                . "username,"
                . "password, "
                . "first_name,"
                . "last_name,"
                . "email,"
                . "email_verified,"
                . "scope,"
                . "middle_name,"
                . "family_name,"
                . "given_name) "
                . "VALUES ("
                . "" . $this->db->escape($arguments["username"]) . ", "
                . "" . $this->db->escape(password_hash($arguments["password"], PASSWORD_DEFAULT)) . ","
                . "" . $this->db->escape($arguments["first_name"]) . ","
                . "" . $this->db->escape($arguments["last_name"]) . ","
                . "" . $this->db->escape($arguments["email"]) . ","
                . "" . $this->db->escape($arguments["email_verified"]) . ","
                . "" . $this->db->escape($arguments["scope"]) . ","
                . "" . $this->db->escape($arguments["middle_name"]) . ","
                . "" . $this->db->escape($arguments["family_name"]) . ","
                . "" . $this->db->escape($arguments["given_name"]) . ""
                . ")";


        $result = $this->db->query($sql);
        return $result;
    }

    function SaveLcmsCreateAccount($arguments)
    {


        $sql = "INSERT INTO socialEnergy.LcmsCreateAccount ("
                . "UserName, EmailAddress, RowIdLcms,Timestamp_GMT_00) "
                . "VALUES ("
                . "" . $this->db->escape($arguments["username"]) . ", "
                . "" . $this->db->escape($arguments["email"]) . ","
                . "" . $this->db->escape($arguments["RowIdLcms"]) . ","
                . "" . $this->db->escape($arguments["Timestamp_GMT_00"]) . ""
                . ")";


        $result = $this->db->query($sql);
        return $result;
    }

    function SaveUserToken($arguments)
    {

        $sql = "INSERT INTO my_oauth2_db.oauth_clients ("
                . "client_id, client_secret, redirect_uri) "
                . "VALUES ("
                . "" . $this->db->escape($arguments["client_id"]) . ", "
                . "" . $this->db->escape($arguments["client_secret"]) . ","
                . "" . $this->db->escape($arguments["redirect_uri"]) . ""
                . ")";


        $result = $this->db->query($sql);
        return $result;
    }

	
	 function SaveLcmsTotalScore($CurrentTotalScore,
					             $LastWeekTotalScore,
					             $LastMonthTotalScore,
			                     $dateInserted,
			                     $UserID
			                    )
    {

        $sql = "INSERT INTO LcmsStoreDataFromServiceScoreTotal ("
                . "totalScore, lastWeekTotalScore, lastMonthTotalScore,timeRecordInserted,UserID) "
                . "VALUES ("
                . "" . $this->db->escape($CurrentTotalScore) . ", "
                . "" . $this->db->escape($LastWeekTotalScore) . ","
                . "" . $this->db->escape($LastMonthTotalScore) . ","
				. "" . $this->db->escape($dateInserted) . ","
				. "" . $this->db->escape($UserID) . ""
                . ")";

        //echo "<br>Sql--insert--".$sql;
        $result = $this->db->query($sql);
        return $result;
    }

	
	
	 function SaveBuildMultipleRecordsScore($scoresNames, $scoresDescription, $scoresValue, $userID)
    {
		 
		 $scoresNames1 = [];
		 $scoresDescription1 = [];
		 $scoresValue1 = [];
		 $userID1 = [];
		 $dateRegister1 = [];
		 
		 $buildQuery = "";
        $buildQueryPart2 = "";
		 
		  $buildQuery = "INSERT INTO LcmsStoreDataFromServiceScore
                            (Name,Description,valuesServi,userID,tmsIntoSystem)
                            VALUES ";
		 
		  $max = sizeof($scoresNames);
		  
		  
		    foreach ($scoresNames as $key => $row)
        {
			   
			     $scoresNames1[] = $scoresNames[$key];
			     $scoresDescription1[] = $scoresDescription[$key];
			     $scoresValue1[] = $scoresValue[$key];
			     $dateRegister1[] =  $this->Generalpurposes->createGMTtimestampOffset();//$dateRegister[$key];
			   
		   }
		    for ($i = 0; $i < $max; $i++)
       
		    {

            $buildQueryPart2 .="(" . $this->db->escape($scoresNames1[$i]) . ""
					. "," . $this->db->escape($scoresDescription1[$i]) . ""
					. "," . $this->db->escape($scoresValue1[$i]) . ""
					. "," . $this->db->escape($userID) . ""
                    . "," . $this->db->escape($dateRegister1[$i]) . "),";
        }

       
        if ($max)
        {
		
            $result = $this->db->query($buildQuery . "" . substr_replace($buildQueryPart2, "", -1));
            return $result;
        }
		  
		 
		 
	 }
	
	
	 function SaveBuildMultipleRecordsBadges($badgesNames, $badgesNamesDesc, $badgesDateissued, $userID, $dateRegister)
    {
		 $badgesNames1 = [];
		 $badgesNamesDesc1 = [];
		 $badgesDateissued1 = [];
		 $dateRegisterc1 = [];
		 
		 
		 
		$buildQuery = "";
        $buildQueryPart2 = "";
		 
		  $buildQuery = "INSERT INTO LcmsStoreDataFromServiceBadge
                            (BadgeName,BadgeDesc,DateGiven,RecordSavedAt,UserID)
                            VALUES ";
		 
		  $max = sizeof($badgesNames);
		  
		   foreach ($badgesNames as $key => $row)
        {
			   
			     $badgesNames1[] = $badgesNames[$key];
			     $badgesNamesDesc1[] = $badgesNamesDesc[$key];
			     $badgesDateissued1[] = isset($badgesDateissued[$key]) &&!empty($badgesDateissued[$key])?$badgesDateissued[$key]:"" ;
			     $dateRegisterc1[] = $dateRegister[$key];
			   
		   }
		   
		      for ($i = 0; $i < $max; $i++)
        {

            $buildQueryPart2 .="(" . $this->db->escape($badgesNames1[$i]) . ""
					. "," . $this->db->escape($badgesNamesDesc1[$i]) . ""
					. "," . $this->db->escape($badgesDateissued1[$i]) . ""
					. "," . $this->db->escape($dateRegisterc1[$i]) . ""
                    . "," . $this->db->escape($userID) . "),";
        }

       
        if ($max)
        {
		
            $result = $this->db->query($buildQuery . "" . substr_replace($buildQueryPart2, "", -1));
            return $result;
        }
		  
	 }
	
	
	 function SaveBuildMultipleRecordsCourses(
			 $coursesNames, 
			 $coursesNamesDesc, 
			 $coursesDategraded, 
			 $grade, 
			 $timespent, 
			 $userID, 
			 $dateRegister,
			 $grademin,
			 $grademax,
			 $gradepass
			 )
    {

        $buildQuery = "";
        $buildQueryPart2 = "";

        $coursesNames1 = [];
        $dateRegister1 = [];
		$coursesNamesDesc1 = [];
		$coursesDategraded1 = [];
		$coursesGrade1 = [];
		$coursesTimespent1 = [];
		$coursesDateRegister1 = [];
		
		$coursesGrademin1 = [];
		$coursesGrademax1 = [];
		$coursesGradepass1 = [];

        $buildQuery = "INSERT INTO LcmsStoreDataFromServiceCoursers
                            (ObjectName,
							ObjectNameDesc,
							DateGraded,
							CurrentGrade,
							TimeSpent,
							RecordSavedAt,
							UserID,
                            grademin,
							grademax,
							gradepass
)
                            VALUES ";

        $max = sizeof($coursesNames);

        foreach ($coursesNames as $key => $row)
        {
            $coursesNames1[] = $coursesNames[$key];
          //  $dateRegister1[] = $dateRegister[$key];
			$coursesNamesDesc1[] = $coursesNamesDesc[$key];
			$coursesDategraded1[] = $coursesDategraded[$key];
			$coursesGrade1[] = isset($grade[$key])?$grade[$key]:"";
			$coursesTimespent1[] = isset($timespent[$key])?$timespent[$key]:"";
			$coursesDateRegister1[] = isset($dateRegister[$key])?$dateRegister[$key]:"";
			
			$coursesGrademin1[] = isset($grademin[$key])?$grademin[$key]:"";
			$coursesGrademax1[] = isset($grademax[$key])?$grademax[$key]:"";
			$coursesGradepass1[] = isset($gradepass[$key])?$gradepass[$key]:"";
        }


        for ($i = 0; $i < $max; $i++)
        {

            $buildQueryPart2 .="(" . $this->db->escape($coursesNames1[$i]) . ""
					. "," . $this->db->escape($coursesNamesDesc1[$i]) . ""
					. "," . $this->db->escape($coursesDategraded1[$i]) . ""
					. "," . $this->db->escape($coursesGrade1[$i]) . ""
					. "," . $this->db->escape($coursesTimespent1[$i]) . ""
					. "," . $this->db->escape($coursesDateRegister1[$i]) . ""
					. "," . $this->db->escape($userID) . ""
					. "," . $this->db->escape($coursesGrademin1[$i]) . ""
					. "," . $this->db->escape($coursesGrademax1[$i]) . ","
					
					. "" . $this->db->escape($coursesGradepass1[$i]) . "),";
        }

      
        if ($max)
        {
		
            $result = $this->db->query($buildQuery . "" . substr_replace($buildQueryPart2, "", -1));
            return $result;
        }
    }
	
	
	
    function SaveBuildMultipleRecords($competenciesNames, $competenciesDesc, $competenciesGradename, $competenciesGrade, $userID, $dateRegister)
    {

        $buildQuery = "";
        $buildQueryPart2 = "";

        $competenciesNames1 = [];
        $dateRegister1 = [];

        $buildQuery = "INSERT INTO LcmsStoreDataFromService
                            (CompTitle,CompMainDesc,RecordSavedAt,userID)
                            VALUES ";

        $max = sizeof($competenciesNames);

        foreach ($competenciesNames as $key => $row)
        {
            $competenciesNames1[] = $competenciesNames[$key];
            $dateRegister1[] = $dateRegister[$key];
        }


        for ($i = 0; $i < $max; $i++)
        {

            $buildQueryPart2 .="(" . $this->db->escape($competenciesNames1[$i]) . ",''," . $this->db->escape($dateRegister1[$i]) . "," . $this->db->escape($userID) . "),";
        }

      
        if ($max)
        {
		
            $result = $this->db->query($buildQuery . "" . substr_replace($buildQueryPart2, "", -1));
            return $result;
        }
    }

    function SaveUser($arguments)
    {

        $sql = "INSERT INTO socialEnergy.UsersCredentials ("
                . "UserName,EmailAddress,PasswordToken,Password,DateRegister,timestamp_GMT_00,Status,UserLevel) "
                . "VALUES ("
                . "" . $this->db->escape($arguments["UserName"]) . ", "
                . "" . $this->db->escape($arguments["EmailAddress"]) . ","
                . "" . $this->db->escape($arguments["PasswordToken"]) . ","
                . "" . $this->db->escape(password_hash($arguments["Password"], PASSWORD_DEFAULT)) . ","
                . "" . $this->db->escape($arguments["DateRegister"]) . ","
                . "" . $this->db->escape($arguments["timestamp_GMT_00"]) . ","
                . "" . $this->db->escape($arguments["Status"]) . ","
				. "" . $this->db->escape($arguments["UserLevel"]) . ""
                . ")";

        $result = $this->db->query($sql);
        return $result;
    }

    function StoreFormationMainDashboard($arguments)
    {


        $sql = "INSERT INTO socialEnergy.DashboardFormat ("
                . "timestamDash,droppableDash,baseidDash,userIDDash) "
                . "VALUES ("
                . "" . $this->db->escape($arguments["timestamp"]) . ", "
                . "" . $this->db->escape($arguments["droppableID"]) . ","
                . "" . $this->db->escape($arguments["baseID"]) . ","
                . "" . $this->db->escape($arguments["userID"]) . ""
                . ")  ";


        var_dump($sql);
     
    }

    function StoreFormationPDashboard($arguments)
    {

        $sql = "INSERT INTO socialEnergy.DashboardFormatPlaces ("
                . "{$arguments["FieldName"]},Timestamp,UserID) "
                . "VALUES ("
                . "" . $this->db->escape($arguments["droppableID"]) . ", "
                // . "" . $this->db->escape($arguments["Position_2"]) . ","
                // . "" . $this->db->escape($arguments["Position_3"]) . ","
                // . "" . $this->db->escape($arguments["Position_4"]) . ","
                . "" . $this->db->escape($arguments["Timestamp"]) . ","
                . "" . $this->db->escape($arguments["UserID"]) . ""
                . ")";

        //echo $sql;
        $result = $this->db->query($sql);
        return $result;
    }

    function StoreFormationDashboard($arguments)
    {


        $sql = "INSERT INTO socialEnergy.DashboardFormation ("
                . "user_id,timestamp,json,grid) "
                . "VALUES ("
                . "" . $this->db->escape($arguments["user_id"]) . ", "
                . "" . $this->db->escape($arguments["timestamp"]) . ","
                . "" . $this->db->escape($arguments["json"]) . ","
                . "" . $this->db->escape($arguments["grid"]) . ""
                . ")  ";


        /*

          $sql = "replace into socialEnergy.DashboardFormation set user_id="
          . "" . $this->db->escape($arguments["user_id"]) . ",timestamp= "
          . "" . $this->db->escape($arguments["timestamp"]) . ",json="
          . "" . $this->db->escape($arguments["json"]) . ""
          . "";
         */



        //echo "$sql";
        $result = $this->db->query($sql);
        return $result;
    }

}
