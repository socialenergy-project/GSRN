<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of marketPlaceTraffic
 *
 * @author John Papagiannis <intelen>
 */
class MarketPlaceTraffic extends CI_Controller
{

    //put your code here

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('UpdateData', '', TRUE);
        $this->load->model('SelectData', '', TRUE);
        //  $this->load->model('Trackusers', '', TRUE);
        $this->load->model('Generalpurposes', '', TRUE);
        $this->load->model('Random', '', TRUE);
    }

    function proinc()
    {


        if (!$this->input->is_AJAX_request())
        {
            exit('none AJAX calls rejected!');
        }

        $data = [];
        $data2 = [];
        $data3 = [];
        $data4 = [];
        $totalCLick = 0;

        $data["prodID"] = (int) strip_tags(trim($this->input->post('prodID')));

        if (mb_strlen($data["prodID"], 'UTF-8') > 15)
        {

            exit('none AJAX calls rejected!');
        }
        $this->load->library('session');
        $this->load->model('ViewProcessRequestTraffic', '', TRUE);

        $data2 = $this->ViewProcessRequestTraffic->ViewProcessRequestTraffiData($this->SelectData->SelectTotalNumOfClicks($data["prodID"], $this->session->userdata('userid')));

        if (isset($data2["totalClicks"]) && $data2["totalClicks"][0] > 0)
        {

            $totalCLick = (int) $data2["totalClicks"][0];
            $data3["productID"] = $data["prodID"];
            $data3["totalClicks"] = $totalCLick + 1;
            $data3["userID"] = (int) $this->session->userdata('userid');

            $this->UpdateData->updateStatusMarketProViews($data3);
        }
        else
        {

            $this->load->model('Insertdata', '', TRUE);

            $data4["totalClicks"] = 1;
            $data4["productID"] = $data["prodID"];
            $data4["userID"] = $this->session->userdata('userid');

            $this->Insertdata->InsertdataTable("marketPlaceProductTraffic", $data4);
        }

        exit(json_encode(array('result' => 200, 'post' => 4)));

        /* //
         * INSERT INTO marketPlaceProductTraffic (productID, userID, totalClicks) VALUES ('Steve', 'Smith', 1)
          ON DUPLICATE KEY UPDATE logins = logins + 1;
         * 
         * 
         * 
         * 
         */
    }

}
