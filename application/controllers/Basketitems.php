<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Basketitems
 *
 * @author John Papagiannis <intelen>
 */
class Basketitems extends CI_Controller
{

    //put your code here
    public $usrlevel;
    public $userIdSession;
    public $username;
    public $userLastTimeLogin;
    public $dataComponets;
    //put your code here
    function __construct()
    {

        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->model('SelectData2', '', TRUE);
        $this->load->model('SelectData', '', TRUE);
        $this->load->library('session');
        $this->load->model('Generalpurposes', '', TRUE);
        $this->load->model('ViewUsersProcess', '', TRUE);
        $this->load->model('ViewMarketplaceProcess', '', TRUE);
        $this->load->model('SaveData', '', TRUE);


        if ($this->session->userdata('logged_in') !== 1)
        {
            $this->userIdSession = 0;
        }
        else
        {
            $this->usrlevel = $this->session->userdata('user_level');
            $this->userIdSession = $this->session->userdata('userid');
            $this->username = $this->session->userdata('username');
            $this->userLastTimeLogin = $this->SelectData->LastDateUserLogin($this->userIdSession) === 0 ? "" : $this->Generalpurposes->timestampTOdate($this->SelectData->LastDateUserLogin($this->userIdSession));
            $this->dataComponets = $this->SelectData->SelectComponet();
        }
    }

    public function savebasket()
    {

        if (!$this->input->is_AJAX_request())
        {
            exit('none AJAX calls rejected!');
        }
        
        $data = [];
        $arguments = [];
        $totalOrderSoFar = 0;
        $CurrentTimeOfTransaction = 0;

        $data["productName"] = substr($this->input->post('productName'), 0, -1);
        $data["quantity"] = substr($this->input->post('quantity'), 0, -1);
        $data["price"] = substr($this->input->post('price'), 0, -1);
        $data["productID"] = substr($this->input->post('productID'), 0, -1);

        $productName[] = explode("@", $data["productName"]);
        $quantity[] = explode("@", $data["quantity"]);
        $price[] = explode("@", str_replace("€", "", $data["price"])); //str_replace("€","",$data["price"]);
        $productID[] = explode("@", $data["productID"]);

        $result = $this->SelectData2->SelectIfUserHasMoreThan4PendingOrders(array('userID' => $this->userIdSession
        ));

        foreach ($result->result() as $row)
        {

            if (isset($row->status))
            {
            $totalOrderSoFar = $row->status;
            }
        }

        if ($totalOrderSoFar > 4)
        {

            exit(json_encode(
                            array('result' => 202
            )));
        }

        $CurrentTimeOfTransaction = $this->Generalpurposes->createGMTtimestampOffset();

        foreach ($productName[0] as $key => $value)
        {

            $arguments["productName"] = $value;
            $arguments["productID"] = $productID[0][$key];
            $arguments["quantity"] = $quantity[0][$key];
            $arguments["price"] = $price[0][$key];
            $arguments["userID"] = $this->userIdSession;
            $arguments["timestamp"] = $CurrentTimeOfTransaction;
            $arguments["status"] = "0";


            $this->SaveData->SaveUserOrder($arguments);
        }

        $this->Generalpurposes->deleteAllUserCookies($this->userIdSession);

        echo json_encode(
                array('result' => 200
        ));
    }

    public function incr()
    {

        if (!$this->input->is_AJAX_request())
        {
            exit('none AJAX calls rejected!');
        }
        $data = [];
        $searcharray = [];
        $searchNewarray = [];

        $data["rowpid"] = $this->input->post('rowpid');
        $data["rowid"] = $this->input->post('rowid');
        $data["propri"] = $this->input->post('propri');
        $data["textBoxq"] = (int) $this->input->post('textBoxq') + 1;

        parse_str($this->input->post('serialize'), $searcharray);
        setlocale(LC_MONETARY, "el_GR");
        //   print_r($searcharray);
        $size = sizeof($searcharray);
        for ($i = 0; $i < $size; $i++)
        {

            if ($i == $data["rowid"])
            {
               $searchNewarray[$i] = $data["propri"] * $data["textBoxq"];
            }
            else
            {
               $searchNewarray[$i] = substr($searcharray["quantq_" . $i], 0, -1); //$searcharray["quantq_".$i]; //substr($searcharray["quantq_".$i],0,-1);  
            }
        }

        echo json_encode(
                array('result' => 200,
                    'propri' => money_format("%.2n", $data["propri"] * $data["textBoxq"]) . "€",
                    'number' => $data["propri"],
                    'quant' => $data["textBoxq"],
                    'totalSum' => money_format("%.2n", array_sum($searchNewarray)) . "€"
        ));
    }

    
    public function incrdr(){
        
        
          if (!$this->input->is_AJAX_request())
        {
            exit('none AJAX calls rejected!');
        }
        $data = [];
        $searcharray = [];
        $searchNewarray = [];

        $data["rowpid"] = $this->input->post('rowpid');
        $data["rowid"] = $this->input->post('rowid');
        $data["propri"] = $this->input->post('propri');
        $data["textBoxq"] = (int) $this->input->post('textBoxq') > 1 ? $this->input->post('textBoxq') - 1 : 1;
        setlocale(LC_MONETARY, "el_GR");

        parse_str($this->input->post('serialize'), $searcharray);

        $size = sizeof($searcharray);

        for ($i = 0; $i < $size; $i++)
        {

            if ($i == $data["rowid"])
            {

                $searchNewarray[$i] = $data["propri"] * $data["textBoxq"];
            }
            else
            {

                $searchNewarray[$i] = substr($searcharray["quantq_" . $i], 0, -1); //$searcharray["quantq_".$i]; //substr($searcharray["quantq_".$i],0,-1);  
            }
        }

        echo json_encode(
                array('result' => 200,
                    'propri' => money_format("%.2n", $data["propri"] * $data["textBoxq"]) . "€",
                    'number' => $data["propri"],
                    'quant' => $data["textBoxq"],
                    'totalSum' => money_format("%.2n", (array_sum($searchNewarray)) - $data["propri"]) . "€"
        ));
        
        
    }
    
    public function incrd()
    {


        if (!$this->input->is_AJAX_request())
        {
            exit('none AJAX calls rejected!');
        }
        $data = [];
        $searcharray = [];
        $searchNewarray = [];

        $data["rowpid"] = $this->input->post('rowpid');
        $data["rowid"] = $this->input->post('rowid');
        $data["propri"] = $this->input->post('propri');
        $data["textBoxq"] = (int) $this->input->post('textBoxq') > 1 ? $this->input->post('textBoxq') - 1 : 1;
        setlocale(LC_MONETARY, "el_GR");

        parse_str($this->input->post('serialize'), $searcharray);

        $size = sizeof($searcharray);

        for ($i = 0; $i < $size; $i++)
        {

            if ($i == $data["rowid"])
            {

                $searchNewarray[$i] = $data["propri"] * $data["textBoxq"];
            }
            else
            {

                $searchNewarray[$i] = substr($searcharray["quantq_" . $i], 0, -1); //$searcharray["quantq_".$i]; //substr($searcharray["quantq_".$i],0,-1);  
            }
        }

        echo json_encode(
                array('result' => 200,
                    'propri' => money_format("%.2n", $data["propri"] * $data["textBoxq"]) . "€",
                    'number' => $data["propri"],
                    'quant' => $data["textBoxq"],
                    'totalSum' => money_format("%.2n", array_sum($searchNewarray)) . "€"
        ));
    }

    public function remitem()
    {

        if (!$this->input->is_AJAX_request())
        {
            exit('none AJAX calls rejected!');
        }
        $data = [];
        $data["prodid"] = $this->input->post('prodid');

        if ($this->Generalpurposes->removeItemValueFromCookie($this->userIdSession, $data["prodid"]) === TRUE)
        {

            echo json_encode(array('result' => 200
            ));
        }
        else
        {

            echo json_encode(array('result' => 201
            ));
        }
    }

    public function index()
    {

        $data = [];

        $data["ViewBasketItems"] = "on";

        $data["ActiveTips"] = $this->SelectData->SelectDisplayTips();
        $data["lastTimeLogin"] = $this->userLastTimeLogin;
        $data["username"] = $this->username;
        $data["usrlevel"] = $this->usrlevel;
        $data = array_merge($this->returnAllUsrOfGroups($this->userIdSession), $data);

        $BasketItems = $this->Generalpurposes->returnBasketItems($this->userIdSession);

        if ($BasketItems !== FALSE)
        {

            $data = array_merge($this->loadProductBasket($BasketItems), $data);


            $data["totalSumOfBasket"] = sizeof($data["Price"]) > 1 ? array_sum($data["Price"]) . "€" : $data["Price"][0] . "€";
        }
        else
        {
            
        }

		$data = array_merge($this->dataComponets, $data);
        $this->load->view('viewmarketplacebasket', $data); //viewmarketplacestore
    }

    public function returnAllUsrOfGroups($usrID)
    {
        return $this->ViewUsersProcess->processViewFriendsRecorsMembers($this->SelectData2->returnMemberofAllGroups($usrID));
    }

    public function loadProductBasket($BasketUserId)
    {
        return $this->ViewMarketplaceProcess->processViewProductsRecords($this->SelectData2->selectBasketProducts($BasketUserId));
    }

}
