<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GameModule
 *
 * @author John Papagiannis <intelen>
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class GameModule extends CI_Model
{

    //put your code here

	function getLoadGameActivityMax($userName = "")
    {
		
	
		  $sql = "";
        $result;

        //$sql = "select UserName,EmailAddress from socialEnergy.UsersCredentials where UserName=" . $this->db->escape($userName) . "";
        $sql = "SELECT "
                . "count(Row_id) as rowCount"
              
                . "timestampReceived FROM GameUserActions where user_id=" . $this->db->escape($userName) . " "; //where user_id=" . $this->db->escape($userName) . "";

     

        $result = $this->db->query($sql);
		
        return $result;
		
	}
	
	function getLoadGameActivityPerUser($userName = "")
    {

        $sql = "";
        $result;

        //$sql = "select UserName,EmailAddress from socialEnergy.UsersCredentials where UserName=" . $this->db->escape($userName) . "";
		
		$ext = isset($userName) && mb_strlen($userName, 'UTF-8') > 1 ? " where user_id=" . $this->db->escape($userName) . "  " : "";
/*		
        $sql = "SELECT "
                . "Row_id,"
                . "id_job,"
                . "total_score,"
                . "daily_score,"
                . "user_id,"
                . "game_duration,"
                . "timestamp_user_logged_in,"
                . "timestamp_user_logged_out,"
                . "energy_program,"
                . "level_game,"
                . "devices,"
                . "timestampReceived FROM GameUserActions where user_id=" . $this->db->escape($userName) . " order by timestampReceived desc limit 1"; //where user_id=" . $this->db->escape($userName) . "";
*/
 
		  $sql = "SELECT "
                . "Row_id,"
                . "id_job,"
                . "total_score,"
                . "daily_score,"
                . "user_id,"
                . "game_duration,"
                . "timestamp_user_logged_in,"
                . "timestamp_user_logged_out,"
                . "energy_program,"
                . "level_game,"
                . "devices,"
                . "timestampReceived FROM GameUserActions $ext order by timestampReceived desc limit 1"; //where user_id=" . $this->db->escape($userName) . "";

		
		

        $result = $this->db->query($sql);
		
        return $result;
    }
	
	
    function getLoadGameActivity($userName = "",$offset=0, $rec_limit=10)
    {

        $sql = "";
        $result;

        //$sql = "select UserName,EmailAddress from socialEnergy.UsersCredentials where UserName=" . $this->db->escape($userName) . "";
        $sql = "SELECT "
                . "Row_id,"
                . "id_job,"
                . "total_score,"
                . "daily_score,"
                . "user_id,"
                . "game_duration,"
                . "timestamp_user_logged_in,"
                . "timestamp_user_logged_out,"
                . "energy_program,"
                . "level_game,"
                . "devices,"
                . "timestampReceived FROM GameUserActions where user_id=" . $this->db->escape($userName) . " order by timestampReceived desc limit $offset, $rec_limit"; //where user_id=" . $this->db->escape($userName) . "";

     
        $result = $this->db->query($sql);
		
        return $result;
    }

    function filterGameValues($dbResult)
    {

        $data = [];
        $Row_id = [];
        $energy_program = [];
        $level_game = [];
        $timestamp_user_logged_in = [];
        $timestamp_user_logged_out = [];
        $total_score = [];
        $devices = [];
        $timestampReceived = [];
        $game_duration = [];
        $daily_score = [];

        $index = 0;

        foreach ($dbResult->result() as $row)
        {

            $Row_id[$index] = $row->Row_id;
            $energy_program[$index] = $row->energy_program;
            $level_game[$index] = $row->level_game;
            $timestamp_user_logged_in[$index] = $row->timestamp_user_logged_in;
            $timestamp_user_logged_out[$index] = $row->timestamp_user_logged_out;
            $total_score[$index] = $row->total_score;
            $devices[$index] = $row->devices;
            $timestampReceived[$index] = $row->timestampReceived;
            $game_duration[$index] = $row->game_duration;
            $daily_score[$index] = $row->daily_score;

            $index++;
        }

        $data["Row_id"] = $Row_id;
        $data["energy_program"] = $energy_program;
        $data["level_game"] = $level_game;
        $data["timestamp_user_logged_in"] = $timestamp_user_logged_in;
        $data["timestamp_user_logged_out"] = $timestamp_user_logged_out;
        $data["total_score"] = $total_score;
        $data["devices"] = $devices;
        $data["timestampReceived"] = $timestampReceived;
        $data["game_duration"] = $game_duration;
        $data["daily_score"] = $daily_score;
        

        return $data;
    }
	
	
	function filterGameValuesPerUser($dbResult,$perUser)
    {

        $data = [];
        $Row_id = [];
        $energy_program = [];
        $level_game = [];
        $timestamp_user_logged_in = [];
        $timestamp_user_logged_out = [];
        $total_score = [];
        $devices = [];
        $timestampReceived = [];
        $game_duration = [];
        $daily_score = [];

        $index = 0;

        foreach ($dbResult->result() as $row)
        {

            $Row_id[$index] = $row->Row_id;
            $energy_program[$index] = $row->energy_program;
            $level_game[$index] = $row->level_game;
            $timestamp_user_logged_in[$index] = $row->timestamp_user_logged_in;
            $timestamp_user_logged_out[$index] = $row->timestamp_user_logged_out;
            $total_score[$index] = $row->total_score;
            $devices[$index] = $row->devices;
            $timestampReceived[$index] = $row->timestampReceived;
            $game_duration[$index] = $row->game_duration;
            $daily_score[$index] = $row->daily_score;

            $index++;
        }

		$data["Row_id_".$perUser] = $Row_id;
        $data["energy_program_".$perUser] = $energy_program;
        $data["level_game_".$perUser] = $level_game;
        $data["timestamp_user_logged_in_".$perUser] = $timestamp_user_logged_in;
        $data["timestamp_user_logged_out_".$perUser] = $timestamp_user_logged_out;
        $data["total_score_".$perUser] = $total_score;
        $data["devices_".$perUser] = $devices;
        $data["timestampReceived_".$perUser] = $timestampReceived;
        $data["game_duration_".$perUser] = $game_duration;
        $data["daily_score_".$perUser] = $daily_score;
        

        return $data;
    }
    
    function filterDataGame($data){
        
        
        
        
        
    }
    

}
