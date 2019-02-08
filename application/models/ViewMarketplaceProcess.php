<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewMarketplaceProcess
 *
 * @author John Papagiannis <intelen>
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ViewMarketplaceProcess extends CI_Model
{
    //put your code here
    
    
       function processViewProductsRecords($dbResult) {

        $data = [];
        
        $ProductID = [];
        $Product_Title = [];
        $Product_Short_Desc = [];
        $Product_Main_Description = [];
        $Price = [];
        $Main_Category = [];
        $Sub_Category = [];
        $Sub_Category_Level_3 = [];
        $Upload_Pic = [];
        $Upload_Pic_2 = [];    
        $Upload_Pic_3 = [];
        $Timestamp_Created = [];
        $StatusPro = [];

        $index = 0;

        foreach ($dbResult->result() as $row) {

            $ProductID[$index] = $row->ProductID;
            $Product_Title[$index] = $row->Product_Title;
            $Product_Short_Desc[$index] = $row->Product_Short_Desc;
            $Product_Main_Description[$index] = $row->Product_Main_Description;
            $Price[$index] = $row->Price;  
            
            $Main_Category[$index] = $row->Main_Category;
            $Sub_Category[$index] = $row->Sub_Category;
            $Sub_Category_Level_3[$index] = $row->Sub_Category_Level_3;
            $Upload_Pic[$index] = $row->Upload_Pic;
            $Upload_Pic_2[$index] = $row->Upload_Pic_2;
            $Upload_Pic_3[$index] = $row->Upload_Pic_3;
            $Timestamp_Created[$index] = $row->Timestamp_Created;
            $StatusPro[$index] = $row->StatusPro;
            
            $index++;
        }
        $data["ProductID"] = $ProductID;
        $data["Product_Title"] = $Product_Title;
        $data["Product_Short_Desc"] = $Product_Short_Desc;
        $data["Product_Main_Description"] = $Product_Main_Description;
        $data["Price"] = $Price;     
        $data["Main_Category"] = $Main_Category;
        $data["Sub_Category"] = $Sub_Category;
        $data["Sub_Category_Level_3"] = $Sub_Category_Level_3;
        $data["Upload_Pic"] = $Upload_Pic;
        $data["Upload_Pic_2"] = $Upload_Pic_2;
        $data["Upload_Pic_3"] = $Upload_Pic_3;
        $data["Timestamp_Created"] = $Timestamp_Created;
        $data["StatusPro"] = $StatusPro;
        
        return $data;
        
    }
    
    
}
