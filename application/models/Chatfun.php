<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Chat
 *
 * @author John Papagiannis <intelen>
 */
class Chatfun extends CI_Model
{

    //put your code here

    function SelectChatRecords($userName)
    {

        $sql = "";
        $result;
        $sql = "select * from chat where (chat.to =" . $this->db->escape($userName) . " AND recd = 0) order by id ASC";
     
        $result = $this->db->query($sql);
        return $result;
    }

    function UpdateChatRecord($userName)
    {
        $sql = "";
        $result;
        $sql = "update chat set recd = 1 where chat.to = " . $this->db->escape($userName) . " and recd = 0";

        $result = $this->db->query($sql);
        return $result;
    }
    
    function insertRecordDB($from,$to,$message){
        
        $sql = "insert into chat (chat.from,chat.to,message,sent) values (".$this->db->escape($from).", ".$this->db->escape($to).",".$this->db->escape($message).",NOW())";

        $query = $this->db->query($sql);
        
        
        
    }
   
}
