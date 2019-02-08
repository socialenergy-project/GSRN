<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewProcessRequestTraffic
 *
 * @author John Papagiannis <intelen>
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ViewProcessRequestTraffic extends CI_Model
{

    //put your code here


    function filterSalesValues($dbResult, $admin = null)
    {

        $data = [];

        $status = [];
        $timestamp = [];
        $userID = [];

        $index = 0;

        foreach ($dbResult->result() as $row)
        {

            $status[$index] = $row->status;
            $timestamp[$index] = $row->timestamp;
            $userID[$index] = $row->userID;



            $index++;
        }

        $data["status"] = $status;
        $data["timestamp"] = $timestamp;
        $data["userID"] = $userID;

        return $data;
    }

    function ViewProcessRequestTraffiData($dbResult)
    {


        $data = [];
        $productID = [];
        $userID = [];
        $totalClicks = [];

        $index = 0;

        foreach ($dbResult->result() as $row)
        {

            $productID[$index] = $row->productID;
            $userID[$index] = $row->userID;
            $totalClicks[$index] = $row->totalClicks;

            $index++;
        }

        $data["productID"] = $productID;
        $data["userID"] = $userID;
        $data["totalClicks"] = $totalClicks;


        return $data;
    }

}
