<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of consumption
 *
 * @author John Papagiannis <intelen>
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Conprocess extends CI_Model
{

    function selectUserIDGridID($arguments)
    {

        $sql = "select user_id from socialEnergy.DashboardFormation where user_id=" . $this->db->escape($arguments["user_id"]) . " and grid=" . $this->db->escape($arguments["grid"]) . "  ";
        $result = $this->db->query($sql);
        return $result;
    }

    function loadGridUserID($arguments)
    {

        $sql = "select grid,json from socialEnergy.DashboardFormation where user_id=" . $this->db->escape($arguments["user_id"]) . " ";
        $result = $this->db->query($sql);
        return $result;
    }

    function loadPositionWidgets($arguments)
    {

        $sql = "select Position_1,Position_2,Position_3,Position_4,Timestamp,UserID from socialEnergy.DashboardFormatPlaces where UserID =" . $this->db->escape($arguments["UserID"]) . " ";
        //echo $sql;
        $result = $this->db->query($sql);
        return $result;
    }

    function ReturnCons($arguments)
    {

        $sql = "select mac as mac,from_unixtime(timestamp) as dateInsertRecord,FROM_UNIXTIME(timestamp),kwh,DATE_FORMAT(CONVERT_TZ(from_unixtime(timestamp), 'Europe/Athens', 'Europe/Athens'), '%Y-%m-%dT%H:%i:%s') AS interval_value from active.cc3_data where " . $arguments["mac_where"] . " timestamp>" . $this->db->escape($arguments["searchDateFrom"]) . " and timestamp<" . $this->db->escape($arguments["searchDateTo"]) . "  GROUP BY DATE_FORMAT(CONVERT_TZ(from_unixtime(timestamp), 'Europe/Athens', 'Europe/Athens'), '" . $arguments["timeD"] . "' ) 
                       ORDER BY interval_value ASC limit 20"; //limit 20
        // exit($sql);
        $result = $this->db->query($sql);
        return $result;
    }

    //put your code here
}
