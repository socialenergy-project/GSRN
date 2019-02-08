<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Analytics
 *
 * @author John Papagiannis <intelen>
 */
class Analytics extends CI_Controller
{

    //put your code here
    public $userIdSession;
    public $userLastTimeLogin;
    public $usrMail;
    public $usrToken;
    public $usrName;
    public $usrPassword;
    public $username;
    public $usrlevel;
    public $usremail;
	public $dataComponets = [];
	public $usrPlatfromCredits;

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        // $this->load->model('SaveData', '', TRUE);
        // $this->load->model('Random', '', TRUE);
        $this->load->model('Auth2calls', '', TRUE);
        $this->load->model('SelectData', '', TRUE);
        $this->load->library('session');
        $this->load->model('Trackusers', '', TRUE);
        $this->load->model('Generalpurposes', '', TRUE);
        $this->load->model('Random', '', TRUE);
        $this->load->model('SelectData2', '', TRUE);
        $this->load->model('ViewUsersProcess', '', TRUE);
     
        if ($this->session->userdata('logged_in') !== 1)
        {
            redirect('Login');
            exit;
        }
        else
        {
            $this->usrlevel = $this->session->userdata('user_level');
            $this->username = $this->session->userdata('username');
            $this->usrMail = $this->session->userdata('email');
            $this->usrToken = $this->session->userdata('PasswordToken');
            $this->userIdSession = $this->session->userdata('userid');
            $this->usrName = $this->session->userdata('UserName');
            $this->usrPassword = $this->session->userdata('Password');
            $this->userLastTimeLogin = $this->SelectData->LastDateUserLogin($this->userIdSession) === 0 ? "" : $this->Generalpurposes->timestampTOdate($this->SelectData->LastDateUserLogin($this->userIdSession));
            $this->dataComponets = $this->SelectData->SelectComponet(); 
			
			$this->load->model('FilterRec', '', TRUE);
			$this->load->model('SelectData2', '', TRUE);
			
			$num = $this->FilterRec->filterRecValuesActions($this->SelectData2->countVisitsOfUser($this->userIdSession)) * 0.1;	
	        $num2 = $this->FilterRec->filterRecValuesActionsTLG($this->SelectData2->getTotalScoreOfLcmsGame($this->userIdSession, $this->username)) ;
	        $this->usrPlatfromCredits = number_format($num + $num2);
			
            if (isset($this->usrToken))
            {

                $arrayStatusOfToken = [];
                $arrayStatusOfToken = $this->Auth2calls->ConfirmToken($this->usrToken);

                if (isset($arrayStatusOfToken["error"]))
                {

                    $updateUserToken = [];
                    $firtName = "";
                    $lastName = "";
                    $resultQuery = $this->SelectData->GetUserFirstLastName($this->usrMail, $this->usrName);
                    //first_name,last_name
                    foreach ($resultQuery->result() as $row)
                    {

                        $firtName = $row->first_name;
                        $lastName = $row->last_name;
                    }

                    $updateUserToken = $this->Auth2calls->CreateClientUserToken($this->usrName, $this->usrPassword, $firtName, $lastName, "iccs2", "secret2");

                    if (isset($updateUserToken["access_token"]))
                    {

                        $this->usrToken = $updateUserToken["access_token"];
                        // $this->load->library('session');
                        $this->session->set_userdata('PasswordToken', $updateUserToken["access_token"]);
                    }
                }
            }
        }
    }

    public function drawData()
    {

        if ($_SERVER['REQUEST_METHOD'] != 'POST')
        {

            $this->index();
        }

        $this->index();
    }

    public function loadData()
    {

        if (!$this->input->is_AJAX_request())
            exit('none AJAX calls rejected!');

        $postVariable = [];
		
		$prosumersIDg = [];
		
		$prosumersIDgg = [];

        $postVariable['searchDateFrom'] = strip_tags(trim($this->input->post('searchDateFrom')));

        $postVariable['searchDateTo'] = strip_tags(trim($this->input->post('searchDateTo')));

        $postVariable['Interval'] = (int) strip_tags(trim($this->input->post('interval')));

        $postVariable['eccType'] = (int) strip_tags(trim($this->input->post('eccType')));

        $postVariable['energyCosPar'] = strip_tags(trim($this->input->post('energyCosPar')));

        $postVariable['ProfitMarginParameter'] = strip_tags(trim($this->input->post('profitMarginParameter')));
        
        $postVariable['number_of_clusters'] = strip_tags(trim($this->input->post('number_of_clusters')));

        $postVariable['flexibility_factor'] = strip_tags(trim($this->input->post('flexibility_factor')));

        $postVariable['gammaParameter'] = strip_tags(trim($this->input->post('gammaParameter')));

		
		//var_dump($this->input->post('prosID'));
		
		$prosumersIDg = $this->input->post('prosID');
		
		$max = sizeof($prosumersIDg);
		
		for($i=0;$i<$max;$i++){
			
		$prosumersIDgg[] = (int) strip_tags(trim($prosumersIDg[$i]));	
			
		}
		
		//var_dump($prosumersIDgg);
		
		$postVariable['prosID'] = strip_tags(trim(implode(",",$this->input->post('prosID'))));
		//echo "<br>";
		//var_dump($postVariable['prosID']);exit;
		
        $energyProgrmasIds = $this->input->post('energyProgrmasIds');


        if (sizeof($energyProgrmasIds))
        // if ($postVariable['energyProgrmasIds'])
        {
           
            $bugNum = false;
        
            $size = sizeof($energyProgrmasIds);

            for ($i = 0; $i < $size; $i++)
            {

                if ($energyProgrmasIds[$i] < 0 && $energyProgrmasIds[$i] > 6)
                {

                    $bugNum = true;
                }
            }

            if ($bugNum === true)
            {

                $postVariable['energyProgrmasIds'] = "1";
            }
            else
            {

                $postVariable['energyProgrmasIds'] = implode(",", $energyProgrmasIds);
            }
        }
        else
        {

            $postVariable['energyProgrmasIds'] = "1";
        }


        if ($postVariable['Interval'] > 0 && $postVariable['Interval'] < 4)
        {
            $postVariable['IntervalPost'] = $postVariable['Interval'];
        }
        else
        {
            $postVariable['IntervalPost'] = 1;
        }


        if ($postVariable['eccType'] > 0 && $postVariable['eccType'] < 5)
        {
            $postVariable['eccTypePost'] = $postVariable['eccType'];
        }
        else
        {
            $postVariable['eccTypePost'] = 1;
        }


        if ($postVariable['flexibility_factor'] > 0 && $postVariable['flexibility_factor'] < 5)
        {
            $postVariable['flexibility_factorPost'] = $postVariable['flexibility_factor'];
        }
        else
        {
            $postVariable['flexibility_factorPost'] = 1;
        }



        if ($postVariable['gammaParameter'] >= 0.0 && $postVariable['gammaParameter'] <= 2.0)
        {
            $postVariable['gammaParameterPost'] = $postVariable['gammaParameter'];
        }
        else
        {
            $postVariable['gammaParameterPost'] = 0.0;
        }




        if ($postVariable['energyCosPar'] >= 0.01 && $postVariable['energyCosPar'] <= 0.1)
        {
            $postVariable['energyCosParPost'] = $postVariable['energyCosPar'];
        }
        else
        {
            $postVariable['energyCosParPost'] = 0.01;
        }

        //

        if ($postVariable['ProfitMarginParameter'] >= 0 && $postVariable['ProfitMarginParameter'] <= 1.5)
        {
            $postVariable['profitMarginParameterPost'] = $postVariable['ProfitMarginParameter'];
        }
        else
        {
            $postVariable['profitMarginParameterPost'] = 0.1;
        }

        
         if ($postVariable['number_of_clusters'] >= 10 && $postVariable['number_of_clusters'] <= 2)
        {
            $postVariable['number_of_clustersPost'] = $postVariable['number_of_clusters'];
        }
        else
        {
            $postVariable['number_of_clustersPost'] = 2;
        }
        
        $postVariable['searchDateFrom'] = str_replace(' ', 'T', $this->Generalpurposes->addtoDataZoneOffset($postVariable['searchDateFrom']) . "+02:00");

        $postVariable['searchDateTo'] = str_replace(' ', 'T', $this->Generalpurposes->addtoDataZoneOffset($postVariable['searchDateTo']) . "+02:00");

    		
         $array = $this->Auth2calls->connectToRat($this->usrMail, $this->usrToken, $postVariable);
        
	
        
        $mySubconsumer_ids = [];

        $mySubconsumer_ids = $array["consumer_ids"];

        $max = sizeof($mySubconsumer_ids);

        $myEnergy_program_ids = [];

        $myEnergy_program_ids = $array["energy_program_ids"];

        $max2 = sizeof($myEnergy_program_ids);

        $myEnergy_plot_data = [];

        $myEnergy_plot_data = $array["plot_data"]["energy_cost"];

        $max3 = sizeof($myEnergy_plot_data);

        $postDataBack = [];
        $time_Series_data = [];
        $values_Series_data = [];
 
        $time_Series_data_RTPNODR_tw = [];
        $values_Series_data_RTPNODR_tw = [];
        $sizeOFarrays_tw = [];

        if (isset($array["plot_data"]["total_welfare"]["RTP (no DR)"]))
        {
            list( $time_Series_data_RTPNODR_tw, $values_Series_data_RTPNODR_tw ) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["total_welfare"]["RTP (no DR)"]);

            $postDataBack["energy_cost_RTPNODRt_tw"] = $time_Series_data_RTPNODR_tw;
            $postDataBack["energy_cost_RTPNODRv_tw"] = $values_Series_data_RTPNODR_tw;

            $sizeOFarrays_tw[0] = (int) sizeof($time_Series_data_RTPNODR_tw);
        }
      
        $time_Series_data_RTP_tw = [];
        $values_Series_data_RTP_tw = [];

        if (isset($array["plot_data"]["total_welfare"]["Real-time pricing"]))
        {
            list( $time_Series_data_RTP_tw, $values_Series_data_RTP_tw ) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["total_welfare"]["Real-time pricing"]);

            $postDataBack["energy_cost_RTPt_tw"] = $time_Series_data_RTP_tw;
            $postDataBack["energy_cost_RTPv_tw"] = $values_Series_data_RTP_tw;

            $sizeOFarrays_tw[1] = (int) sizeof($time_Series_data_RTP_tw);
        }
        $time_Series_data_PRTP_tw = [];
        $values_Series_data_PRTP_tw = [];


        if (isset($array["plot_data"]["total_welfare"]["Personal Real-time pricing"]))
        {
            list( $time_Series_data_PRTP_tw, $values_Series_data_PRTP_tw ) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["total_welfare"]["Personal Real-time pricing"]);

            $postDataBack["energy_cost_PRTPt_tw"] = $time_Series_data_PRTP_tw;
            $postDataBack["energy_cost_PRTPv_tw"] = $values_Series_data_PRTP_tw;

            $sizeOFarrays_tw[2] = (int) sizeof($time_Series_data_PRTP_tw);
            $sizeOFarrays_tw = array_unique($sizeOFarrays_tw);
            sort($sizeOFarrays_tw);
            $postDataBack["max_tw"] = (int) $sizeOFarrays_tw[sizeof($sizeOFarrays_tw) - 1];
        }
        
        $time_Series_data_PRTP_RTIPR_tw = [];
        $values_Series_data_PRTP_RTIPR_tw = [];

        if (isset($array["plot_data"]["total_welfare"]["Community Real-time pricing"]))
        {
            list( $time_Series_data_PRTP_RTIPR_tw, $values_Series_data_PRTP_RTIPR_tw ) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["total_welfare"]["Community Real-time pricing"]);

            $postDataBack["energy_cost_PRTPt_RTIPR_tw"] = $time_Series_data_PRTP_RTIPR_tw;
            $postDataBack["energy_cost_PRTPv_RTIPR_tw"] = $values_Series_data_PRTP_RTIPR_tw;

            $sizeOFarrays_RTIPR_tw[2] = (int) sizeof($time_Series_data_PRTP_RTIPR_tw);
            $sizeOFarrays_RTIPR_tw = array_unique($sizeOFarrays_RTIPR_tw);
            sort($sizeOFarrays_RTIPR_tw);
            $postDataBack["max_RTIPR_tw"] = (int) $sizeOFarrays_RTIPR_tw[sizeof($sizeOFarrays_RTIPR_tw) - 1];
        }

        /////
        $time_Series_data_PRTP_TiOfU_tw = [];
        $values_Series_data_PRTP_TiOfU_tw = [];

        if (isset($array["plot_data"]["total_welfare"]["Time of Usage"]))
        {
            list( $time_Series_data_PRTP_TiOfU_tw, $values_Series_data_PRTP_TiOfU_tw ) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["total_welfare"]["Time of Usage"]);

            $postDataBack["energy_cost_PRTPt_TiOfU_tw"] = $time_Series_data_PRTP_TiOfU_tw;
            $postDataBack["energy_cost_PRTPv_TiOfU_tw"] = $values_Series_data_PRTP_TiOfU_tw;

            $sizeOFarrays_TiOfU_tw[2] = (int) sizeof($time_Series_data_PRTP_TiOfU_tw);
            $sizeOFarrays_TiOfU_tw = array_unique($sizeOFarrays_TiOfU_tw);
            sort($sizeOFarrays_TiOfU_tw);
            $postDataBack["max_TiOfU_tw"] = (int) $sizeOFarrays_TiOfU_tw[sizeof($sizeOFarrays_TiOfU_tw) - 1];
        }

        ////////////////////////////////////
       ///////////total_bill////////////////
        
        $time_Series_data_RTPNODR_tbill = [];
        $values_Series_data_RTPNODR_tbill = [];
        $sizeOFarrays_tbill = [];

        if (isset($array["plot_data"]["total_bill"]["RTP (no DR)"]))
        {
            list( $time_Series_data_RTPNODR_tbill, $values_Series_data_RTPNODR_tbill ) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["total_bill"]["RTP (no DR)"]);

            $postDataBack["energy_cost_RTPNODRt_tbill"] = $time_Series_data_RTPNODR_tbill;
            $postDataBack["energy_cost_RTPNODRv_tbill"] = $values_Series_data_RTPNODR_tbill;

            $sizeOFarrays_tbill[0] = (int) sizeof($time_Series_data_RTPNODR_tbill);
        }
   
        $time_Series_data_RTP_tbill = [];
        $values_Series_data_RTP_tbill = [];

        if (isset($array["plot_data"]["total_bill"]["Real-time pricing"]))
        {
            list( $time_Series_data_RTP_tbill, $values_Series_data_RTP_tbill ) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["total_bill"]["Real-time pricing"]);

            $postDataBack["energy_cost_RTPt_tbill"] = $time_Series_data_RTP_tbill;
            $postDataBack["energy_cost_RTPv_tbill"] = $values_Series_data_RTP_tbill;

            $sizeOFarrays_tbill[1] = (int) sizeof($time_Series_data_RTP_tbill);
        }
        $time_Series_data_PRTP_tbill = [];
        $values_Series_data_PRTP_tbill = [];


        if (isset($array["plot_data"]["total_bill"]["Personal Real-time pricing"]))
        {
            list( $time_Series_data_PRTP_tbill, $values_Series_data_PRTP_tbill ) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["total_bill"]["Personal Real-time pricing"]);

            $postDataBack["energy_cost_PRTPt_tbill"] = $time_Series_data_PRTP_tbill;
            $postDataBack["energy_cost_PRTPv_tbill"] = $values_Series_data_PRTP_tbill;

            $sizeOFarrays_tbill[2] = (int) sizeof($time_Series_data_PRTP_tbill);
            $sizeOFarrays_tbill = array_unique($sizeOFarrays_tbill);
            sort($sizeOFarrays_tbill);
            $postDataBack["max_tbill"] = (int) $sizeOFarrays_tbill[sizeof($sizeOFarrays_tbill) - 1];
        }
        
        //////
        
        $time_Series_data_PRTP_RTIPR_tbill = [];
        $values_Series_data_PRTP_RTIPR_tbill = [];

        if (isset($array["plot_data"]["total_bill"]["Community Real-time pricing"]))
        {
            list( $time_Series_data_PRTP_RTIPR_tbill, $values_Series_data_PRTP_RTIPR_tbill ) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["total_bill"]["Community Real-time pricing"]);

            $postDataBack["energy_cost_PRTPt_RTIPR_tbill"] = $time_Series_data_PRTP_RTIPR_tbill;
            $postDataBack["energy_cost_PRTPv_RTIPR_tbill"] = $values_Series_data_PRTP_RTIPR_tbill;

            $sizeOFarrays_RTIPR_tbill[2] = (int) sizeof($time_Series_data_PRTP_RTIPR_tbill);
            $sizeOFarrays_RTIPR_tbill = array_unique($sizeOFarrays_RTIPR_tbill);
            sort($sizeOFarrays_RTIPR_tbill);
            $postDataBack["max_RTIPR_tbill"] = (int) $sizeOFarrays_RTIPR_tbill[sizeof($sizeOFarrays_RTIPR_tbill) - 1];
        }

        /////
        $time_Series_data_PRTP_TiOfU_tbill = [];
        $values_Series_data_PRTP_TiOfU_tbill = [];

        if (isset($array["plot_data"]["total_bill"]["Time of Usage"]))
        {
            list( $time_Series_data_PRTP_TiOfU_tbill, $values_Series_data_PRTP_TiOfU_tbill ) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["total_bill"]["Time of Usage"]);

            $postDataBack["energy_cost_PRTPt_TiOfU_tbill"] = $time_Series_data_PRTP_TiOfU_tbill;
            $postDataBack["energy_cost_PRTPv_TiOfU_tbill"] = $values_Series_data_PRTP_TiOfU_tbill;

            $sizeOFarrays_TiOfU_tbill[2] = (int) sizeof($time_Series_data_PRTP_TiOfU_tbill);
            $sizeOFarrays_TiOfU_tbill = array_unique($sizeOFarrays_TiOfU_tbill);
            sort($sizeOFarrays_TiOfU_tbill);
            $postDataBack["max_TiOfU_tbill"] = (int) $sizeOFarrays_TiOfU_tbill[sizeof($sizeOFarrays_TiOfU_tbill) - 1];
        }

           
         $time_Series_data_RTPNODR_tConsm = [];
        $values_Series_data_RTPNODR_tConsm = [];
        $sizeOFarrays_tConsm = [];

        if (isset($array["plot_data"]["total_consumption"]["RTP (no DR)"]))
        {
            list( $time_Series_data_RTPNODR_tConsm, $values_Series_data_RTPNODR_tConsm ) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["total_consumption"]["RTP (no DR)"]);

            $postDataBack["energy_cost_RTPNODRt_tConsm"] = $time_Series_data_RTPNODR_tConsm;
            $postDataBack["energy_cost_RTPNODRv_tConsm"] = $values_Series_data_RTPNODR_tConsm;

            $sizeOFarrays_tConsm[0] = (int) sizeof($time_Series_data_RTPNODR_tConsm);
        }

        $time_Series_data_RTP_tConsm = [];
        $values_Series_data_RTP_tConsm = [];

        if (isset($array["plot_data"]["total_consumption"]["Real-time pricing"]))
        {
            list( $time_Series_data_RTP_tConsm, $values_Series_data_RTP_tConsm ) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["total_consumption"]["Real-time pricing"]);

            $postDataBack["energy_cost_RTPt_tConsm"] = $time_Series_data_RTP_tConsm;
            $postDataBack["energy_cost_RTPv_tConsm"] = $values_Series_data_RTP_tConsm;

            $sizeOFarrays_tConsm[1] = (int) sizeof($time_Series_data_RTP_tConsm);
        }
        $time_Series_data_PRTP_tConsm = [];
        $values_Series_data_PRTP_tConsm = [];


        if (isset($array["plot_data"]["total_consumption"]["Personal Real-time pricing"]))
        {
            list( $time_Series_data_PRTP_tConsm, $values_Series_data_PRTP_tConsm ) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["total_consumption"]["Personal Real-time pricing"]);

            $postDataBack["energy_cost_PRTPt_tConsm"] = $time_Series_data_PRTP_tConsm;
            $postDataBack["energy_cost_PRTPv_tConsm"] = $values_Series_data_PRTP_tConsm;

            $sizeOFarrays_tConsm[2] = (int) sizeof($time_Series_data_PRTP_tConsm);
            $sizeOFarrays_tConsm = array_unique($sizeOFarrays_tConsm);
            sort($sizeOFarrays_tConsm);
            $postDataBack["max_tConsm"] = (int) $sizeOFarrays_tConsm[sizeof($sizeOFarrays_tConsm) - 1];
        }
        
        //////
        
        $time_Series_data_PRTP_RTIPR_tConsm = [];
        $values_Series_data_PRTP_RTIPR_tConsm = [];

        if (isset($array["plot_data"]["total_consumption"]["Community Real-time pricing"]))
        {
            list( $time_Series_data_PRTP_RTIPR_tConsm, $values_Series_data_PRTP_RTIPR_tConsm ) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["total_consumption"]["Community Real-time pricing"]);

            $postDataBack["energy_cost_PRTPt_RTIPR_tConsm"] = $time_Series_data_PRTP_RTIPR_tConsm;
            $postDataBack["energy_cost_PRTPv_RTIPR_tConsm"] = $values_Series_data_PRTP_RTIPR_tConsm;

            $sizeOFarrays_RTIPR_tConsm[2] = (int) sizeof($time_Series_data_PRTP_RTIPR_tConsm);
            $sizeOFarrays_RTIPR_tConsm = array_unique($sizeOFarrays_RTIPR_tConsm);
            sort($sizeOFarrays_RTIPR_tConsm);
            $postDataBack["max_RTIPR_tConsm"] = (int) $sizeOFarrays_RTIPR_tConsm[sizeof($sizeOFarrays_RTIPR_tConsm) - 1];
        }

        /////
        $time_Series_data_PRTP_TiOfU_tConsm = [];
        $values_Series_data_PRTP_TiOfU_tConsm = [];

        if (isset($array["plot_data"]["total_consumption"]["Time of Usage"]))
        {
            list( $time_Series_data_PRTP_TiOfU_tConsm, $values_Series_data_PRTP_TiOfU_tConsm ) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["total_consumption"]["Time of Usage"]);

            $postDataBack["energy_cost_PRTPt_TiOfU_tConsm"] = $time_Series_data_PRTP_TiOfU_tConsm;
            $postDataBack["energy_cost_PRTPv_TiOfU_tConsm"] = $values_Series_data_PRTP_TiOfU_tConsm;

            $sizeOFarrays_TiOfU_tConsm[2] = (int) sizeof($time_Series_data_PRTP_TiOfU_tConsm);
            $sizeOFarrays_TiOfU_tConsm = array_unique($sizeOFarrays_TiOfU_tConsm);
            sort($sizeOFarrays_TiOfU_tConsm);
            $postDataBack["max_TiOfU_tConsm"] = (int) $sizeOFarrays_TiOfU_tConsm[sizeof($sizeOFarrays_TiOfU_tConsm) - 1];
        }
        
        
        
        
        
        
        /////////////////////total_consumption/////////////
        ///////////////////////////////////////////////////
        
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $time_Series_data_RTPNODR_rp = [];
        $values_Series_data_RTPNODR_rp = [];
        $sizeOFarrays_rp = [];

        if (isset($array["plot_data"]["retailer_profit"]["RTP (no DR)"]))
        {
            list( $time_Series_data_RTPNODR_rp, $values_Series_data_RTPNODR_rp ) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["retailer_profit"]["RTP (no DR)"]);

            $postDataBack["energy_cost_RTPNODRt_rp"] = $time_Series_data_RTPNODR_rp;
            $postDataBack["energy_cost_RTPNODRv_rp"] = $values_Series_data_RTPNODR_rp;
            $sizeOFarrays_rp[0] = (int) sizeof($time_Series_data_RTPNODR_rp);
        }

        $time_Series_data_RTP_rp = [];
        $values_Series_data_RTP_rp = [];


        if (isset($array["plot_data"]["retailer_profit"]["Real-time pricing"]))
        {
            list( $time_Series_data_RTP_rp, $values_Series_data_RTP_rp ) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["retailer_profit"]["Real-time pricing"]);

            $postDataBack["energy_cost_RTPt_rp"] = $time_Series_data_RTP_rp;
            $postDataBack["energy_cost_RTPv_rp"] = $values_Series_data_RTP_rp;
            $sizeOFarrays_rp[1] = (int) sizeof($time_Series_data_RTP_rp);
        }


        $time_Series_data_PRTP_rp = [];
        $values_Series_data_PRTP_rp = [];

        if (isset($array["plot_data"]["retailer_profit"]["Personal Real-time pricing"]))
        {
            list( $time_Series_data_PRTP_rp, $values_Series_data_PRTP_rp ) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["retailer_profit"]["Personal Real-time pricing"]);

            $postDataBack["energy_cost_PRTPt_rp"] = $time_Series_data_PRTP_rp;
            $postDataBack["energy_cost_PRTPv_rp"] = $values_Series_data_PRTP_rp;

            $sizeOFarrays_rp[2] = (int) sizeof($time_Series_data_PRTP_rp);
            $sizeOFarrays_rp = array_unique($sizeOFarrays_rp);
            sort($sizeOFarrays_rp);

            $postDataBack["max_rp"] = (int) $sizeOFarrays_rp[sizeof($sizeOFarrays_rp) - 1];
        }
        
        //////
        
        $time_Series_data_PRTP_TiOfU_rp = [];
        $values_Series_data_PRTP_TiOfU_rp = [];

        if (isset($array["plot_data"]["retailer_profit"]["Time of Usage"]))
        {
            list( $time_Series_data_PRTP_TiOfU_rp, $values_Series_data_PRTP_TiOfU_rp ) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["retailer_profit"]["Time of Usage"]);

            $postDataBack["energy_cost_PRTPt_TiOfU_rp"] = $time_Series_data_PRTP_TiOfU_rp;
            $postDataBack["energy_cost_PRTPv_TiOfU_rp"] = $values_Series_data_PRTP_TiOfU_rp;

            $sizeOFarrays_TiOfU_rp[2] = (int) sizeof($time_Series_data_PRTP_TiOfU_rp);
            $sizeOFarrays_TiOfU_rp = array_unique($sizeOFarrays_TiOfU_rp);
            
            sort($sizeOFarrays_TiOfU_rp);

            $postDataBack["max_TiOfU_rp"] = (int) $sizeOFarrays_TiOfU_rp[sizeof($sizeOFarrays_TiOfU_rp) - 1];
        }
 
        
        
        
        $time_Series_data_PRTP_RTIPR_rp = [];
        $values_Series_data_PRTP_RTIPR_rp = [];

        if (isset($array["plot_data"]["retailer_profit"]["Community Real-time pricing"]))
        {
            list( $time_Series_data_PRTP_RTIPR_rp, $values_Series_data_PRTP_RTIPR_rp ) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["retailer_profit"]["Community Real-time pricing"]);

            $postDataBack["energy_cost_PRTPt_RTIPR_rp"] = $time_Series_data_PRTP_RTIPR_rp;
            $postDataBack["energy_cost_PRTPv_RTIPR_rp"] = $values_Series_data_PRTP_RTIPR_rp;

            $sizeOFarrays_RTIPR_rp[2] = (int) sizeof($time_Series_data_PRTP_RTIPR_rp);
            $sizeOFarrays_RTIPR_rp = array_unique($sizeOFarrays_RTIPR_rp);
            sort($sizeOFarrays_RTIPR_rp);

            $postDataBack["max_RTIPR_rp"] = (int) $sizeOFarrays_RTIPR_rp[sizeof($sizeOFarrays_RTIPR_rp) - 1];
        }

        
        $time_Series_data_RTPNODR_wr = [];
        $values_Series_data_RTPNODR_wr = [];
        $sizeOFarrays_wr = [];

        if (isset($array["plot_data"]["user_welfare"]["RTP (no DR)"]))
        {
            list( $time_Series_data_RTPNODR_wr, $values_Series_data_RTPNODR_wr ) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["user_welfare"]["RTP (no DR)"]);

            $postDataBack["energy_cost_RTPNODRt_wr"] = $time_Series_data_RTPNODR_wr;
            $postDataBack["energy_cost_RTPNODRv_wr"] = $values_Series_data_RTPNODR_wr;
            $sizeOFarrays_wr[0] = (int) sizeof($time_Series_data_RTPNODR_wr);
        }


        $time_Series_data_RTP_wr = [];
        $values_Series_data_RTP_wr = [];


        if (isset($array["plot_data"]["user_welfare"]["Real-time pricing"]))
        {
            list( $time_Series_data_RTP_wr, $values_Series_data_RTP_wr ) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["user_welfare"]["Real-time pricing"]);

            $postDataBack["energy_cost_RTPt_wr"] = $time_Series_data_RTP_wr;
            $postDataBack["energy_cost_RTPv_wr"] = $values_Series_data_RTP_wr;

            $sizeOFarrays_wr[1] = (int) sizeof($time_Series_data_RTP_wr);
        }
        
        $time_Series_data_PRTP_wr = [];
        $values_Series_data_PRTP_wr = [];

        if (isset($array["plot_data"]["user_welfare"]["Personal Real-time pricing"]))
        {
            list( $time_Series_data_PRTP_wr, $values_Series_data_PRTP_wr ) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["user_welfare"]["Personal Real-time pricing"]);

            $postDataBack["energy_cost_PRTPt_wr"] = $time_Series_data_PRTP_wr;
            $postDataBack["energy_cost_PRTPv_wr"] = $values_Series_data_PRTP_wr;

            $sizeOFarrays_wr[2] = (int) sizeof($time_Series_data_PRTP_wr);

            $sizeOFarrays_wr = array_unique($sizeOFarrays_wr);

            sort($sizeOFarrays_wr);

            $postDataBack["max_wr"] = (int) $sizeOFarrays_wr[sizeof($sizeOFarrays_wr) - 1];
        }
        
        ///////
        
        $time_Series_data_PRTP_TiOfU_wr = [];
        $values_Series_data_PRTP_TiOfU_wr = [];

        if (isset($array["plot_data"]["user_welfare"]["Time of Usage"]))
        {
            list( $time_Series_data_PRTP_TiOfU_wr, $values_Series_data_PRTP_TiOfU_wr ) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["user_welfare"]["Time of Usage"]);

            $postDataBack["energy_cost_PRTPt_TiOfU_wr"] = $time_Series_data_PRTP_TiOfU_wr;
            $postDataBack["energy_cost_PRTPv_TiOfU_wr"] = $values_Series_data_PRTP_TiOfU_wr;

            $sizeOFarrays_TiOfU_wr[2] = (int) sizeof($time_Series_data_PRTP_TiOfU_wr);

            $sizeOFarrays_TiOfU_wr = array_unique($sizeOFarrays_TiOfU_wr);

            sort($sizeOFarrays_TiOfU_wr);

            $postDataBack["max_TiOfU_wr"] = (int) $sizeOFarrays_TiOfU_wr[sizeof($sizeOFarrays_TiOfU_wr) - 1];
        }

        /////////////////////////////////////
        
        $time_Series_data_PRTP_RTIPR_wr = [];
        $values_Series_data_PRTP_RTIPR_wr = [];

        if (isset($array["plot_data"]["user_welfare"]["Community Real-time pricing"]))
        {
            list( $time_Series_data_PRTP_RTIPR_wr, $values_Series_data_PRTP_RTIPR_wr ) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["user_welfare"]["Community Real-time pricing"]);

            $postDataBack["energy_cost_PRTPt_RTIPR_wr"] = $time_Series_data_PRTP_RTIPR_wr;
            $postDataBack["energy_cost_PRTPv_RTIPR_wr"] = $values_Series_data_PRTP_RTIPR_wr;

            $sizeOFarrays_RTIPR_wr[2] = (int) sizeof($time_Series_data_PRTP_RTIPR_wr);

            $sizeOFarrays_RTIPR_wr = array_unique($sizeOFarrays_RTIPR_wr);

            sort($sizeOFarrays_RTIPR_wr);

            $postDataBack["max_RTIPR_wr"] = (int) $sizeOFarrays_RTIPR_wr[sizeof($sizeOFarrays_RTIPR_wr) - 1];
        }
        
        
        
        
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $time_Series_data_RTPNODR = [];
        $values_Series_data_RTPNODR = [];

        $sizeOFarrays = [];

        if (isset($array["plot_data"]["energy_cost"]["RTP (no DR)"]))
        {
            list( $time_Series_data_RTPNODR, $values_Series_data_RTPNODR ) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["energy_cost"]["RTP (no DR)"]);

            $postDataBack["energy_cost_RTPNODRt"] = $time_Series_data_RTPNODR; //date
            $postDataBack["energy_cost_RTPNODRv"] = $values_Series_data_RTPNODR;
            $sizeOFarrays[0] = (int) sizeof($time_Series_data_RTPNODR);
        }


        //echo "--RTPNODR--".sizeof($time_Series_data_RTPNODR);
        $time_Series_data_RTP_TiOfU = [];
        $values_Series_data_RTP_TiOfU = [];

        if (isset($array["plot_data"]["energy_cost"]["Time of Usage"]))
        {
            list( $time_Series_data_RTP_TiOfU, $values_Series_data_RTP_TiOfU ) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["energy_cost"]["Time of Usage"]);

            $postDataBack["energy_cost_RTPt_TiOfU"] = $time_Series_data_RTP_TiOfU;
            $postDataBack["energy_cost_RTPv_TiOfU"] = $values_Series_data_RTP_TiOfU;

            $sizeOFarrays[1] = (int) sizeof($time_Series_data_RTP_TiOfU);
        }
        
        //////////////////////////////////
        
         $time_Series_data_RTP_RTIPR = [];
        $values_Series_data_RTP_RTIPR = [];

        if (isset($array["plot_data"]["energy_cost"]["Community Real-time pricing"]))
        {
            list( $time_Series_data_RTP_RTIPR, $values_Series_data_RTP_RTIPR) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["energy_cost"]["Community Real-time pricing"]);

            $postDataBack["energy_cost_RTPt_RTIPR"] = $time_Series_data_RTP_RTIPR;
            $postDataBack["energy_cost_RTPv_RTIPR"] = $values_Series_data_RTP_RTIPR;

            $sizeOFarrays[1] = (int) sizeof($time_Series_data_RTP_RTIPR);
        }
 
        
        
        //////////////////////////////////
        
        $time_Series_data_RTP = [];
        $values_Series_data_RTP = [];

        if (isset($array["plot_data"]["energy_cost"]["Real-time pricing"]))
        {
            list( $time_Series_data_RTP, $values_Series_data_RTP ) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["energy_cost"]["Real-time pricing"]);

            $postDataBack["energy_cost_RTPt"] = $time_Series_data_RTP;
            $postDataBack["energy_cost_RTPv"] = $values_Series_data_RTP;

            $sizeOFarrays[1] = (int) sizeof($time_Series_data_RTP);
        }

         
        //////////////////////////////////
 

        $time_Series_data_PRTP = [];
        $values_Series_data_PRTP = [];

        if (isset($array["plot_data"]["energy_cost"]["Personal Real-time pricing"]))
        {
            list( $time_Series_data_PRTP, $values_Series_data_PRTP ) = $this->Auth2calls->exploitDataRowsTest($array["plot_data"]["energy_cost"]["Personal Real-time pricing"]);

            $postDataBack["energy_cost_PRTPt"] = $time_Series_data_PRTP;
            $postDataBack["energy_cost_PRTPv"] = $values_Series_data_PRTP;

            $sizeOFarrays[2] = (int) sizeof($time_Series_data_PRTP);
        }


        $sizeOFarrays = array_unique($sizeOFarrays);
        sort($sizeOFarrays);

        $postDataBack["max"] = (int) $sizeOFarrays[sizeof($sizeOFarrays) - 1];

        $postDataBack["usrMail"] = $this->usrMail;
        $postDataBack["usrToken"] = $this->usrToken;

        echo json_encode($postDataBack);

        exit;
    }

    public function index($save = "off")
    {

        $data = [];
        $userWhereaboutData = [];
		$prosumersDataID = [];
		$prosumersDataTitle = [];
		

        $data["Analyticsp"] = "on";
        $data["ActiveTips"] = $this->SelectData->SelectTipsFromSerice($this->usrMail);// $this->SelectData->SelectDisplayTips();
        $data["lastTimeLogin"] = $this->userLastTimeLogin;
        $data["username"] = $this->username;
        $data["usrlevel"] = $this->usrlevel;
		list($data["GroupMessage"], $data["GroupMessageID"]) = $this->SelectData->GetNewServiceNames($this->userIdSession);

        $data = array_merge($this->returnAllUsrOfGroups($this->userIdSession), $data);
		
		// $array = $this->Auth2calls->getProsumersfromRat("intelen25@intelen.com", "02a74fa3a447f0eb4f30bfa5312c8b209ca17fb7");
		   $array = $this->Auth2calls->getProsumersfromRat($this->usrMail, $this->usrToken);
		   
		 $max = sizeof($array);
	 
		 if(isset($array["error"]) === FALSE){
		 for($i=0;$i<$max;$i++){
			 
		
			  $prosumersDataID[] = $array[$i]["id"];
			  $prosumersDataTitle[] = $array[$i]["name"];
			 
		 }
		 
		 $data["prosumersDataID"] = $prosumersDataID;
		 
		 $data["prosumersDataTitle"] = $prosumersDataTitle;
		 }else{
			 
			 $data["prosumersDataID"] = [];
		 
		 $data["prosumersDataTitle"] = [];
			 
			 
		 }
		 
        $data["usrPlatfromCredits"] = $this->usrPlatfromCredits;
        $data = array_merge($this->dataComponets, $data);

        $this->load->view('analytics', $data); //analytics  //adduser
    }
    
     public function returnAllUsrOfGroups($usrID)
    {
        return $this->ViewUsersProcess->processViewFriendsRecorsMembers($this->SelectData2->returnMemberofAllGroups($usrID));
    }

}
