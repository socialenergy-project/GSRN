<?php

defined('BASEPATH') OR exit('No direct script access allowed');


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Auth
 *
 * @author John Papagiannis <intelen>
 */
class Auth extends CI_Model
{
    //put your code here
    
    function AuthorizeUser($username="",$userpassword=""){
        
        $sql = "";
        $result;
        
       // $sql = "select User_ID,UserName,EmailAddress,DateRegister,PasswordToken from socialEnergy.UsersCredentials where UserName='$username' and Password='$userpassword'";
        $sql = "select User_ID,UserName,EmailAddress,DateRegister,PasswordToken,Password,Status,UserLevel from socialEnergy.UsersCredentials where UserName='$username'";
        $result = $this->db->query($sql);
        //echo "<br>Sql--".$sql;
        return $result; 
        
    }
    
    
    
    
}
