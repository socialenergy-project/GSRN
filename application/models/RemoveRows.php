<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RemoveRows
 *
 * @author John Papagiannis <intelen>
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class RemoveRows extends CI_Model
{

    //put your code here

    function RemoveUserGroup($user_id = null, $rowID = null)
    {


        $SessionId = isset($user_id) && mb_strlen($user_id, 'utf8') > 0 ? " and usrReqAdmRleID=" . $this->db->escape($user_id) . " " : " ";

        $sql = "DELETE FROM socialEnergy.AdminUserGroups WHERE rowID='" . $this->db->escape($rowID) . "' $SessionId ";

        if ($this->db->query($sql) === TRUE)
        {

            return TRUE;
        }
        else
        {

            return FALSE;
        }
    }

    function RmoeveMarketPlacepro($user_id = 0, $rowID = null)
    {

        $sql = "DELETE FROM socialEnergy.ProductNum WHERE ProductID=" . $this->db->escape($rowID) . "";

        if ($this->db->query($sql) === TRUE)
        {

            return TRUE;
        }
        else
        {

            return FALSE;
        }
    }
	
	
	function RemoveUserOfSystem($userName=null,$usrID = null){
		
	
		$sql = "";
		
		$sql = "DELETE FROM socialEnergy.GameUserActions WHERE user_id=" . $this->db->escape($userName) . "";
		
		$result = $this->db->query($sql);
      
		$sql = "";
		
		$sql = "DELETE FROM socialEnergy.UsersCredentials WHERE UserName=" . $this->db->escape($userName) . "";
		
		$result = $this->db->query($sql);
		
		$sql = "";
		
		$sql = "DELETE FROM socialEnergy.LcmsCreateAccount WHERE UserName=" . $this->db->escape($userName) . "";
		
		$result = $this->db->query($sql);
		
		$sql = "";

		$sql = "DELETE FROM socialEnergy.LcmsCreatePlanResuly WHERE Username=" . $this->db->escape($userName) . "";
		
		$result = $this->db->query($sql);
		
		$sql = "";

		$sql = "DELETE FROM socialEnergy.logOutAuth WHERE sessionName=" . $this->db->escape($userName) . "";
		
		$result = $this->db->query($sql);
		
		$sql = "";
		
		$sql = "DELETE FROM my_oauth2_db.oauth_users WHERE username=" . $this->db->escape($userName) . "";
		
		$result = $this->db->query($sql);

        $sql = "";
		
		$sql = "DELETE FROM my_oauth2_db.oauth_refresh_tokens WHERE user_id=" . $this->db->escape($userName) . "";
		
		$result = $this->db->query($sql);
		
		$sql = "";
		
		$sql = "DELETE FROM my_oauth2_db.oauth_access_tokens WHERE user_id=" . $this->db->escape($userName) . "";
		
		$result = $this->db->query($sql);

		
		
	}
	

}
