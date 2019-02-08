<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ViewAdminProcess extends CI_Model
{

    function processUserName($dbResult)
    {

        $data = [];
        $User_ID = [];
        $UserName = [];

        $index = 0;

        foreach ($dbResult->result() as $row)
        {

            $UserName[$index] = $row->UserName;
            $User_ID[$index] = $row->User_ID;

            $index++;
        }


        $data["UsrID"] = $User_ID;
        $data["UserName"] = $UserName;

        return $data;
    }

      function processFriendsRequestTimeC($dbResult){
        
      $continue = FALSE;


        $index = 0;

        foreach ($dbResult->result() as $row)
        {

            $continue = isset($row->timstInvitationApproval) && mb_strlen($row->timstInvitationApproval, 'UTF-8') >= 2 ? TRUE : FALSE;

            $index++;
        }

        return $continue;
        
        
    }
    
    function processFriendsRequest($dbResult){
        
      $continue = FALSE;


        $index = 0;

        foreach ($dbResult->result() as $row)
        {

            $continue = isset($row->rowID) && mb_strlen($row->rowID, 'UTF-8') >= 1 ? TRUE : FALSE;

            $index++;
        }

        return $continue;
        
    }
    
    
    //GrouPName
    function processIfICanSearchDB($dbResult)
    {

        $continue = FALSE;
        $data = [];

        $index = 0;

        foreach ($dbResult->result() as $row)
        {

            $continue = isset($row->GrouPName) && mb_strlen($row->GrouPName, 'UTF-8') > 1 ? TRUE : FALSE;

            $index++;
        }

        return $continue;
    }

    function processViewUsersRequestRecords($dbResult, $exclude = null)
    {


        $data = [];

        $rowID = [];
        $usrReqAdmRleID = [];
        $timstAdminApproval = [];
        $timstAdminRequest = [];
        $usrFlagLevel = [];
        $GrouPName = [];
        $UserName = [];

        $index = 0;

        foreach ($dbResult->result() as $row)
        {

            $rowID[$index] = $row->rowID;
            $usrReqAdmRleID[$index] = $row->usrReqAdmRleID;
            $timstAdminApproval[$index] = $row->timstAdminApproval;
            $timstAdminRequest[$index] = $row->timstAdminRequest;
            $usrFlagLevel[$index] = $row->usrFlagLevel;
            $GrouPName[$index] = $row->GrouPName;
            if ($exclude != 1)
            {
                $UserName[$index] = $row->UserName;
            }



            $index++;
        }

        $data["rowID"] = $rowID;
        $data["usrReqAdmRleID"] = $usrReqAdmRleID;
        $data["timstAdminApproval"] = $timstAdminApproval;
        $data["timstAdminRequest"] = $timstAdminRequest;
        $data["usrFlagLevel"] = $usrFlagLevel;
        $data["GrouPName"] = $GrouPName;
        $data["UserName"] = $UserName;

        return $data;
    }

}
