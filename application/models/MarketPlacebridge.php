<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MarketPlacebridge
 *
 * @author John Papagiannis <intelen>
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MarketPlacebridge extends CI_Model
{

    //put your code here


    function filterMarketValues($dbResult)
    {

        $data = [];
        $allclicks = [];
        $allproductID = [];
        $userIDPerUser = [];
        $peruserclick = [];
        $productIDPerUSER = [];
        $allclicksu = [];
        $Product_TitleALLCLICKS = [];

        $Product_TitlePERCURRENTUSER = [];
        
        $Product_PerClicks = [];

        $index = 0;

        foreach ($dbResult->result() as $row)
        {

            $Product_TitleALLCLICKS[$index] = $row->allclicks && $row->allclicks > 0 ? $row->Product_Title : "";

            $Product_TitlePERCURRENTUSER[$index] = $row->peruserclick && $row->peruserclick > 0 ? $row->Product_Title . "(:" . $row->peruserclick . ")" : "";

                        $Product_PerClicks[$index] = $row->peruserclick && $row->peruserclick > 0 ?  $row->peruserclick  : "";

            
            
            $allclicks[$index] = $row->allclicks;
            $allproductID[$index] = $row->allproductID;
            $userIDPerUser[$index] = $row->userIDPerUser;
            $peruserclick[$index] = $row->peruserclick;
            $productIDPerUSER[$index] = $row->productIDPerUSER;
            $allclicksu[$index] = $row->allclicksu;
            $Product_Title[$index] = $row->Product_Title;

            $index++;
        }

        $ProductNameAllClicks = [];

        foreach ($Product_TitleALLCLICKS as $row)
        {

            if (isset($row) && mb_strlen($row, 'UTF-8') > 0)
            {
                $ProductNameAllClicks[] = $row;
            }
        }


        $ProductNameTitlePerCurrentUser = [];

        foreach ($Product_TitlePERCURRENTUSER as $row)
        {

            if (isset($row) && mb_strlen($row, 'UTF-8'))
            {
                $ProductNameTitlePerCurrentUser[] = $row;
            }
        }

        $Product_PerClicksPost = [];
        
          foreach ($Product_PerClicks as $row)
        {

            if (isset($row) && mb_strlen($row, 'UTF-8'))
            {
                $Product_PerClicksPost[] = $row;
            }
        }
        
        

        $data["allclicks"] = $allclicks;
        $data["allproductID"] = $allproductID;
        $data["userIDPerUser"] = $userIDPerUser;
        $data["peruserclick"] = $peruserclick;
        $data["productIDPerUSER"] = $productIDPerUSER;
        $data["allclicksu"] = $allclicksu;
        $data["Product_Title"] = $Product_Title;


        $data["Product_TitleAllClicks"] = $ProductNameAllClicks;
        $data["Product_TitlePerCurrentUser"] = $ProductNameTitlePerCurrentUser;

        $data["Product_PerClicksPost"] = $Product_PerClicksPost;

        return $data;
    }

}
