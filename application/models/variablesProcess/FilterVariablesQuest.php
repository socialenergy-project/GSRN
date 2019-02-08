<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FilterVariablesQuest
 *
 * @author John Papagiannis <intelen>
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class FilterVariablesQuest extends CI_Model {

	//put your code here

	function filterVariableRecomm(
	$userID, $timestamp, $type_of_action, $action, $os, $browser, $agent) {

		$userWhereaboutData = [];


		$userWhereaboutData["userID"] = $userID;
		$userWhereaboutData["timestamp"] = $timestamp;
		$userWhereaboutData["type_of_action"] = $type_of_action;
		$userWhereaboutData["action"] = $action;

		$userWhereaboutData["os"] = $os;
		$userWhereaboutData["browser"] = $browser;
		$userWhereaboutData["agent"] = $agent;

		return $userWhereaboutData;
	}

	function filterVariableModules($array, $userIdSession) {

		$receivedData = array();

		$this->load->model('Generalpurposes', '', TRUE);
        $receivedData["Analytics"] = (strip_tags(trim($this->input->post("analyrics1"))) == "on" ? "Enable" : "Disable");
		$receivedData["LcmsCom"] = (strip_tags(trim($this->input->post("lcmscom1"))) == "on" ? "Enable" : "Disable");
		$receivedData["GameCom"] = (strip_tags(trim($this->input->post("gamecom1"))) == "on" ? "Enable" : "Disable");
		$receivedData["EnergyCom"] = (strip_tags(trim($this->input->post("eneProcom1"))) == "on" ? "Enable" : "Disable");
		$receivedData["MarketPlaCom"] = (strip_tags(trim($this->input->post("marketPlacecom1"))) == "on" ? "Enable" : "Disable");
		$receivedData["TimestampCha"] = $this->Generalpurposes->createGMTtimestampOffset();
		$receivedData["userID"] = $userIdSession;
		
		return $receivedData;
	}

	function filterVariable($array, $userIdSession) {

		$receivedData = array();

		$this->load->model('Generalpurposes', '', TRUE);

		$receivedData["enclasspeapp"] = (strip_tags(trim($this->input->post("enclasspeapp"))) == "on" ? "No" : "Yes");
		$receivedData["ifhowmanclasainh_1"] = strip_tags(trim($this->input->post("ifhowmanclasainh_1")));
	
		$receivedData["ifdoymswas1"] = (strip_tags(trim($this->input->post("ifdoymswas1"))) == "on" ? "No" : "Yes");
		//  echo "<br>::" . $receivedData["ifdoymswas1"];
		// echo "<br>--2) Do you use natural lighting in sunny days?";
		$receivedData["ifdyunlinsd"] = (strip_tags(trim($this->input->post("ifdyunlinsd"))) == "on" ? "No" : "Yes");
		// echo "<br>::" . $receivedData["ifdyunlinsd"];
		// echo "<br>--12) Do you leave the light on, in unoccupied room?";
		$receivedData["ifdoyletloiunr_1"] = strip_tags(trim($this->input->post("ifdoyletloiunr_1")));
		// echo "<br>::" . $receivedData["ifdoyletloiunr_1"];
		///ifyisanencerfyh
		//  echo "<br>--13) Have you issued an Energy Certificate for your House?";
		$receivedData["ifyisanencerfyh"] = (strip_tags(trim($this->input->post("ifyisanencerfyh"))) == "on" ? "No" : "Yes");
		// echo "<br>::" . $receivedData["ifyisanencerfyh"];
		// echo "<br>--14a) The metric kWh/m2 represents what?";
		$receivedData["iftmekwmrw_1"] = strip_tags(trim($this->input->post("iftmekwmrw_1")));
		// echo "<br>::" . $receivedData["iftmekwmrw_1"];
		//  echo "<br>--15a) The metric kWh/m2 represents what?";
		$receivedData["ifwitdeokwkhh_1"] = strip_tags(trim($this->input->post("ifwitdeokwkhh_1")));
		// echo "<br>::" . $receivedData["ifwitdeokwkhh_1"];
		///ifyisanencerfyh
		// echo "<br>--16)  Have you ever taken part in a Demand Response event?";
		$receivedData["ifhayetapiadre"] = (strip_tags(trim($this->input->post("ifhayetapiadre"))) == "on" ? "No" : "Yes");
		// echo "<br>::" . $receivedData["ifhayetapiadre"];
		// echo "<br>--17a) What is the appliance that consumes the maximum energy";
		$receivedData["ifwhisthappthconthemaen_1"] = strip_tags(trim($this->input->post("ifwhisthappthconthemaen_1")));
		// echo "<br>::" . $receivedData["ifwhisthappthconthemaen_1"];
		//  echo "<br>--18)  Have you ever taken part in a Demand Response event?";
		$receivedData["ifyretoparderespeveanloweryouhoenreons"] = (strip_tags(trim($this->input->post("ifyretoparderespeveanloweryouhoenreons"))) == "on" ? "No" : "Yes");
		//  echo "<br>::" . $receivedData["ifyretoparderespeveanloweryouhoenreons"];
		//  echo "<br>--19) What is a  Prosumer?";
		$receivedData["ifwhisapro_1"] = strip_tags(trim($this->input->post("ifwhisapro_1")));
		//  echo "<br>::" . $receivedData["ifwhisapro_1"];
		//  echo "<br>--20a) Do you have a RES in your house ? (PV)";
		$receivedData["ifdoyouharesinyhpv"] = (strip_tags(trim($this->input->post("ifdoyouharesinyhpv"))) == "on" ? "No" : "Yes");
		// echo "<br>::" . $receivedData["ifdoyouharesinyhpv"];
		/// new form elements
		//  echo "<br>--21) What is a  Prosumer?";
		$receivedData["ifiddoyknwhap1_1"] = strip_tags(trim($this->input->post("ifiddoyknwhap1_1")));
		//  echo "<br>::" . $receivedData["ifiddoyknwhap1_1"];
		//  echo "<br>--22a) Do you have a RES in your house ? (PV)";
		$receivedData["ifhyetpdypp1"] = (strip_tags(trim($this->input->post("ifhyetpdypp1"))) == "on" ? "No" : "Yes");
		// echo "<br>::" . $receivedData["ifhyetpdypp1"];
		// echo "<br>--23a) Do you have a RES in your house ? (PV)";
		$receivedData["ifdykwatourtp1"] = (strip_tags(trim($this->input->post("ifdykwatourtp1"))) == "on" ? "No" : "Yes");
		//  echo "<br>::" . $receivedData["ifdykwatourtp1"];
		//  echo "<br>--24) What is a  Prosumer?";
		$receivedData["ifaypybemolf2_1"] = strip_tags(trim($this->input->post("ifaypybemolf2_1")));
		//  echo "<br>::" . $receivedData["ifaypybemolf2_1"];




		$receivedData["user_id"] = $userIdSession;
		$receivedData["timestampCommit"] = $this->Generalpurposes->createGMTtimestampOffset();
		$receivedData["Residentin_h_1"] = strip_tags(trim($this->input->post("Residentin_h")));
		$receivedData["resid_0_12_2"] = strip_tags(trim($this->input->post("resid_0_12")));
		$receivedData["resid_13_22_3"] = strip_tags(trim($this->input->post("resid_13_22")));
		$receivedData["resid_23_45_4"] = strip_tags(trim($this->input->post("resid_23_45")));
		$receivedData["resid_46_65_5"] = strip_tags(trim($this->input->post("resid_46_65")));
		$receivedData["doyouownorre1_6"] = strip_tags(trim($this->input->post("doyouownorre1")));
		$receivedData["doyouownorre1_6"] = ($receivedData["doyouownorre1_6"] == "on" ? "Rent" : "Own");
		$receivedData["group1_7"] = strip_tags(trim($this->input->post("group1")));
		$receivedData["HowManyresiden_work_8"] = strip_tags(trim($this->input->post("HowManyresiden_work")));
		$receivedData["timepeopleathome_9"] = strip_tags(trim($this->input->post("timepeopleathome")));
		$receivedData["hiedulevwithhome_10"] = strip_tags(trim($this->input->post("hiedulevwithhome")));
		$receivedData["pseyuhoty_11"] = (strip_tags(trim($this->input->post("pseyuhoty"))) == "on" ? "Single family house" : "Block of flats");
		$receivedData["dyhreriah1_12"] = (strip_tags(trim($this->input->post("dyhreriah1"))) == "on" ? "No" : "Yes");
		$receivedData["ipinttrtuh_13"] = (strip_tags(trim($this->input->post("ipinttrtuh"))) == "on" ? "Other (Free text)" : "Photovoltaic in Roof");
		$receivedData["ifhecfhov_14"] = strip_tags(trim($this->input->post("ifhecfhov")));
		$receivedData["primaryEfficIndex_15"] = strip_tags(trim($this->input->post("primaryEfficIndex")));
		$receivedData["enecerpeddindont_16"] = strip_tags(trim($this->input->post("enecerpeddindont")));
		$receivedData["typeaircond_17"] = strip_tags(trim($this->input->post("typeaircond")));
		$receivedData["energyclassacu_2_18"] = strip_tags(trim($this->input->post("energyclassacu_2")));
		$receivedData["doyhwasmach_19"] = (strip_tags(trim($this->input->post("doyhwasmach"))) == "on" ? "No" : "Yes");
		$receivedData["doyhdrma_20"] = (strip_tags(trim($this->input->post("doyhdrma"))) == "on" ? "No" : "Yes");
		$receivedData["doyhdish_21"] = (strip_tags(trim($this->input->post("doyhdish"))) == "on" ? "No" : "Yes");
		$receivedData["doyhelov_22"] = (strip_tags(trim($this->input->post("doyhelov"))) == "on" ? "No" : "Yes");
		$receivedData["dyhewh_23"] = (strip_tags(trim($this->input->post("dyhewh"))) == "on" ? "No" : "Yes");
		$receivedData["dyumuswas_24"] = (strip_tags(trim($this->input->post("dyumuswas"))) == "on" ? "No" : "Yes");
		$receivedData["dyunlisd_25"] = (strip_tags(trim($this->input->post("dyunlisd"))) == "on" ? "No" : "Yes");
		$receivedData["dulloiur_26"] = (strip_tags(trim($this->input->post("dulloiur"))) == "on" ? "No" : "Yes");
		$receivedData["durecycling_27"] = (strip_tags(trim($this->input->post("durecycling"))) == "on" ? "No" : "Yes");
		$receivedData["energyeffibulbs_28"] = (strip_tags(trim($this->input->post("energyeffibulbs"))) == "on" ? "No" : "Yes");


		return $receivedData;
	}

	function assignVariablestodata($receivedData, $data) {

		$data = [];

		/*
		  //questionaire version 1.0


		  $data["dyhreriah1"] = $receivedData["dyhreriah1_12"];
		  $data["ipinttrtuh"] = $receivedData["ipinttrtuh_13"];
		  $data["ifhecfhov"] = $receivedData["ifhecfhov_14"];
		  $data["primaryEfficIndex"] = $receivedData["primaryEfficIndex_15"];
		  $data["enecerpeddindont"] = $receivedData["enecerpeddindont_16"];
		  $data["typeaircond"] = $receivedData["typeaircond_17"];
		  $data["energyclassacu_2"] = $receivedData["energyclassacu_2_18"];
		  $data["doyhwasmach"] = $receivedData["doyhwasmach_19"];
		  $data["doyhdrma"] = $receivedData["doyhdrma_20"];
		  $data["doyhdish"] = $receivedData["doyhdish_21"];
		  $data["doyhelov"] = $receivedData["doyhelov_22"];

		  $data["dyhewh"] = $receivedData["dyhewh_23"];
		  $data["dyumuswas"] = $receivedData["dyumuswas_24"];
		  $data["dyunlisd"] = $receivedData["dyunlisd_25"];
		  $data["dulloiur"] = $receivedData["dulloiur_26"];
		  $data["durecycling"] = $receivedData["durecycling_27"];
		  $data["energyeffibulbs"] = $receivedData["energyeffibulbs_28"];

		 */


		$data["Residentin_h"] = $receivedData["Residentin_h_1"];
		$data["resid_0_12"] = $receivedData["resid_0_12_2"];
		$data["resid_13_22"] = $receivedData["resid_13_22_3"];
		$data["resid_23_45"] = $receivedData["resid_23_45_4"];
		$data["resid_46_65"] = $receivedData["resid_46_65_5"];
		$data["doyouownorre1"] = $receivedData["doyouownorre1_6"];
		$data["group1"] = $receivedData["group1_7"];
		$data["HowManyresiden_work"] = $receivedData["HowManyresiden_work_8"];
		$data["timepeopleathome"] = $receivedData["timepeopleathome_9"];
		$data["hiedulevwithhome"] = $receivedData["hiedulevwithhome_10"];
		$data["pseyuhoty"] = $receivedData["pseyuhoty_11"];


		$data["enclasspeapp"] = $receivedData["enclasspeapp"];
		$data["ifhowmanclasainh_1"] = $receivedData["ifhowmanclasainh_1"];
		$data["ifdoymswas1"] = $receivedData["ifdoymswas1"];
		$data["ifdyunlinsd"] = $receivedData["ifdyunlinsd"];
		$data["ifdoyletloiunr_1"] = $receivedData["ifdoyletloiunr_1"];
		$data["ifyisanencerfyh"] = $receivedData["ifyisanencerfyh"];
		$data["iftmekwmrw_1"] = $receivedData["iftmekwmrw_1"];
		$data["ifwitdeokwkhh_1"] = $receivedData["ifwitdeokwkhh_1"];
		$data["ifhayetapiadre"] = $receivedData["ifhayetapiadre"];
		$data["ifwhisthappthconthemaen_1"] = $receivedData["ifwhisthappthconthemaen_1"];
		$data["ifyretoparderespeveanloweryouhoenreons"] = $receivedData["ifyretoparderespeveanloweryouhoenreons"];
		$data["ifwhisapro_1"] = $receivedData["ifwhisapro_1"];
		$data["ifdoyouharesinyhpv"] = $receivedData["ifdoyouharesinyhpv"];
		$data["ifiddoyknwhap1_1"] = $receivedData["ifiddoyknwhap1_1"];
		$data["ifhyetpdypp1"] = $receivedData["ifhyetpdypp1"];
		$data["ifdykwatourtp1"] = $receivedData["ifdykwatourtp1"];
		$data["ifaypybemolf2_1"] = $receivedData["ifaypybemolf2_1"];



		return $data;
	}

}
