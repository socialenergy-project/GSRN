<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Trackusers
 *
 * @author John Papagiannis <intelen>
 */
class Trackusers extends CI_Model
{

    //put your code here

    function saveUsersTrack($data)
    {

        if (!isset($data))
        {
            return FALSE;
        }

        if ($this->db->insert('Actions', $data))
        {
            unset($data);
            return TRUE;
        }
        else
        {

            return FALSE;
        }
    }

}
