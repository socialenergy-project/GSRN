<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UpdateData
 *
 * @author John Papagiannis <intelen>
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ValidateQuestionnaire extends CI_Model
{

    //put your code here



    function transferDataReadyToSave($receivedData)
    {

        $data = [];

        $data["user_id"] = $receivedData["user_id"];
        $data["timestampCommit"] = $receivedData["timestampCommit"];
        $data["Residentin_h_1"] = $receivedData["Residentin_h_1"];
        $data["resid_0_12_2"] = $receivedData["resid_0_12_2"];
        $data["resid_13_22_3"] = $receivedData["resid_13_22_3"];
        $data["resid_23_45_4"] = $receivedData["resid_23_45_4"];
        $data["resid_46_65_5"] = $receivedData["resid_46_65_5"];
        $data["doyouownorre1_6"] = $receivedData["doyouownorre1_6"];
        $data["group1_7"] = $receivedData["group1_7"];
        $data["HowManyresiden_work_8"] = $receivedData["HowManyresiden_work_8"];
        $data["timepeopleathome_9"] = $receivedData["timepeopleathome_9"];
        $data["hiedulevwithhome_10"] = $receivedData["hiedulevwithhome_10"];
        $data["pseyuhoty_11"] = $receivedData["pseyuhoty_11"];
        
        $data["dyhreriah1_12"] = $receivedData["enclasspeapp"];
        $data["ipinttrtuh_13"] = $receivedData["ifhowmanclasainh_1"];
        $data["ifhecfhov_14"] = $receivedData["ifdoymswas1"];
        $data["primaryEfficIndex_15"] = $receivedData["ifdyunlinsd"];
        $data["enecerpeddindont_16"] = $receivedData["ifdoyletloiunr_1"];
        $data["typeaircond_17"] = $receivedData["ifyisanencerfyh"];
        $data["energyclassacu_2_18"] = $receivedData["iftmekwmrw_1"];
        $data["doyhwasmach_19"] = $receivedData["ifwitdeokwkhh_1"];
        $data["doyhdrma_20"] = $receivedData["ifhayetapiadre"];
        $data["doyhdish_21"] = $receivedData["ifwhisthappthconthemaen_1"];
        $data["doyhelov_22"] = $receivedData["ifyretoparderespeveanloweryouhoenreons"];
        $data["dyhewh_23"] = $receivedData["ifwhisapro_1"];
        $data["dyumuswas_24"] = $receivedData["ifdoyouharesinyhpv"];
        $data["dyunlisd_25"] = $receivedData["ifiddoyknwhap1_1"];
        $data["dulloiur_26"] = $receivedData["ifhyetpdypp1"];
        $data["durecycling_27"] = $receivedData["ifdykwatourtp1"];
        $data["energyeffibulbs_28"] = $receivedData["ifaypybemolf2_1"];
           
        return $data;
    }

	
	function validateFormComp()
    {
		
				$this->form_validation->set_rules('analyrics1', 'ANALYTICS componet', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_control');
		        $this->form_validation->set_rules('lcmscom1', 'LCMS componet', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_control');
		        $this->form_validation->set_rules('gamecom1', 'GAME componet', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_control');
		        $this->form_validation->set_rules('eneProcom1', 'Energy profile componet', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_control');
		        $this->form_validation->set_rules('marketPlacecom1', 'Market place componet', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_control');
		
	}
	
	
    function validateFormQuesti()
    {

        /*
          //rules from questionaire 1.0
          $this->form_validation->set_rules('dyhreriah1', 'Revewable energy', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_control');
          $this->form_validation->set_rules('ipinttrtuh', 'Type of Res', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_control');
          $this->form_validation->set_rules('ifhecfhov', 'Energy certificate', 'min_length[1]|max_length[50]|trim|strip_tags|callback_select_energycertificate');
          $this->form_validation->set_rules('primaryEfficIndex', 'Energy certificate for your home', 'required|min_length[1]|max_length[50]|trim|strip_tags');
          $this->form_validation->set_rules('enecerpeddindont', 'Dont know', 'min_length[1]|max_length[50]|trim|strip_tags|callback_checkbox_dontknow');
          $this->form_validation->set_rules('typeaircond', 'Type of air conditioning', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_typeofairconditio');
          $this->form_validation->set_rules('energyclassacu_2', 'Class of your ac unit', 'min_length[1]|max_length[50]|trim|strip_tags|callback_select_classofyuoracunit');
          $this->form_validation->set_rules('doyhwasmach', 'Washing machine', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_control');
          $this->form_validation->set_rules('doyhdrma', 'Drying machine', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_control');

          $this->form_validation->set_rules('doyhdish', 'Dishwsher', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_control');
          $this->form_validation->set_rules('doyhelov', 'Electric oven', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_control');
          $this->form_validation->set_rules('dyhewh', 'Electric water heater', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_control');
          $this->form_validation->set_rules('dyumuswas', 'Multiple sockets', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_control');
          $this->form_validation->set_rules('dyunlisd', 'Natural lighting', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_control');
          $this->form_validation->set_rules('dulloiur', 'Light on in unoccupied room', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_control');
          $this->form_validation->set_rules('durecycling', 'Do you do recycling', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_control');
          $this->form_validation->set_rules('energyeffibulbs', 'Energy efficiency bulbs', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_control');

         */


        //New Rules

        $this->form_validation->set_rules('Residentin_h', 'Number of Resident', 'required|min_length[1]|max_length[50]|trim|strip_tags|callback_include_number');
        $this->form_validation->set_rules('resid_0_12', 'How many residents', 'required|min_length[1]|max_length[50]|trim|strip_tags|callback_include_number');
        $this->form_validation->set_rules('resid_13_22', 'How many residents Bet 13 and 22', 'required|min_length[1]|max_length[50]|trim|strip_tags|callback_include_number');
        $this->form_validation->set_rules('resid_23_45', 'How many residents Bet 23 and 45', 'required|min_length[1]|max_length[50]|trim|strip_tags|callback_include_number');
        $this->form_validation->set_rules('resid_46_65', 'How many residents Bet 46 and 65', 'required|min_length[1]|max_length[50]|trim|strip_tags|callback_include_number');
        $this->form_validation->set_rules('doyouownorre1', 'Do you own rent', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_control');
        $this->form_validation->set_rules('group1', 'Time spent at home per resident', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_perresident');
        $this->form_validation->set_rules('HowManyresiden_work', 'How many residents work', 'required|min_length[1]|max_length[50]|trim|strip_tags|callback_include_number');
        $this->form_validation->set_rules('timepeopleathome', 'Time more people at home', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_morepeopleathome');
        $this->form_validation->set_rules('hiedulevwithhome', 'Highest education level', 'min_length[1]|max_length[50]|trim|strip_tags|callback_select_highesteducationlevel');
        $this->form_validation->set_rules('pseyuhoty', 'Home type', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_control');
        $this->form_validation->set_rules('enclasspeapp', 'Energy Class is', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_control');
        $this->form_validation->set_rules('ifhowmanclasainh_1', 'Energy Class A', 'min_length[1]|max_length[50]|trim|strip_tags|callback_select_energyclassaapp');
        $this->form_validation->set_rules('ifdoymswas1', 'Multiple Sockets', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_control');
        $this->form_validation->set_rules('ifdyunlinsd', 'Natural lighting', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_control');
        $this->form_validation->set_rules('ifdoyletloiunr_1', 'Light on', 'min_length[1]|max_length[50]|trim|strip_tags|callback_select_lightsOn');
        $this->form_validation->set_rules('ifyisanencerfyh', 'Energy Certificate', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_control');
        $this->form_validation->set_rules('iftmekwmrw_1', 'The metric kwh m2', 'min_length[1]|max_length[50]|trim|strip_tags|callback_select_themetrickWh');
        $this->form_validation->set_rules('ifwitdeokwkhh_1', 'Difference of kw kwh', 'min_length[1]|max_length[50]|trim|strip_tags|callback_select_differeofkwkwh');
        $this->form_validation->set_rules('ifhayetapiadre', 'Demand Responce event', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_control');
        $this->form_validation->set_rules('ifwhisthappthconthemaen_1', 'Appliance consumers', 'min_length[1]|max_length[50]|trim|strip_tags|callback_select_applconsume');
        $this->form_validation->set_rules('ifyretoparderespeveanloweryouhoenreons', 'Demand Responce eventho', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_control');
        $this->form_validation->set_rules('ifwhisapro_1', 'Prosumer', 'min_length[1]|max_length[50]|trim|strip_tags|callback_select_prosumere');
        $this->form_validation->set_rules('ifdoyouharesinyhpv', 'Res in your house', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_control');
        $this->form_validation->set_rules('ifiddoyknwhap1_1', 'Deregulated Market', 'min_length[1]|max_length[50]|trim|strip_tags|callback_deregulated_market');
        $this->form_validation->set_rules('ifhyetpdypp1', 'Dynamic pricing progrma', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_control');
        $this->form_validation->set_rules('ifdykwatourtp1', 'Time of use and RTP is', 'min_length[1]|max_length[50]|trim|strip_tags|callback_radioButtons_control');
        $this->form_validation->set_rules('ifaypybemolf2_1', 'Bill every month', 'min_length[1]|max_length[50]|trim|strip_tags|callback_billEveryMonth');


        //New Rules
    }

}
