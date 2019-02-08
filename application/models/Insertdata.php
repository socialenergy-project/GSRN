<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Insertdata
 *
 * @author John Papagiannis <intelen>
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Insertdata extends CI_Model
{

    //put your code here

	
	    function InsertdataTableID($tableName = 'RecomedationsTips', $data)
    {

        if ($this->db->insert($tableName, $data))
        {
            return  $this->db->insert_id();
        }
        else
        {

            return false;
        }
    }
	
	
    function InsertdataTable($tableName = 'RecomedationsTips', $data)
    {

        if ($this->db->insert($tableName, $data))
        {
            return true;
        }
        else
        {

            return false;
        }
    }

     function InsertdataRec($tableName = 'RecomedationsTips', $data)
    {

        if ($this->db->insert($tableName, $data))
        {
            return $this->db->affected_rows();
        }
        else
        {

            return false;
        }
    }
  
    
    
    function InsertdataTablError($tableName = 'RecomedationsTips', $data)
    {

        try
        {
            if ($this->db->insert($tableName, $data))
            {

                log_message('error', '------------Print last query:: ' . $this->db->last_query());

                return true;
            }
            else
            {
                $error = $this->db->error();
                log_message('error', '------------::Error Code [' . $error['code'] . '] Error: ' . $error['message']);
                if (!empty($error))
                {
                    throw new Exception('Database error! Error Code [' . $error['code'] . '] Error: ' . $error['message']);
                    return false; // unreachable retrun statement !!!
                }

                return false;
            }
        } catch (Exception $e)
        {
            
        }
    }

    function Insertquestionnare($data)
    {

        if ($this->db->insert('Questionnaire', $data))
        {

            return true;
        }
        else
        {

            return false;
        }
    }

    function Insertreccommendation($data)
    {

        if ($this->db->insert('RecomedationsTips', $data))
        {

            return true;
        }
        else
        {

            return false;
        }
    }

}
