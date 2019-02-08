<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Description of chat
 *
 * @author John Papagiannis <intelen>
 */
class chat extends CI_Controller
{
    //put your code here
    
    
     public function sendchat()
    {

        if (!$this->input->is_AJAX_request())
        {
            exit('none AJAX calls rejected!');
        }
        
        
        
    }
    
    
}
