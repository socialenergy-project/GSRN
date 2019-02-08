<?php

header('Access-Control-Allow-Origin: *');
require(APPPATH . '/libraries/REST_Controller.php');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of webservices
 *
 * @author John Papagiannis <intelen>
 */
class Webservices extends REST_Controller {

	//put your code here
	//https://socialenergy.intelen.com/index.php/webservices/logingsrn?tokenid=HP_0001

	function __construct() {

		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method == "OPTIONS") {
			die();
		}

		parent::__construct();

		$this->load->model('Auth2calls', '', TRUE);
		$this->load->model('UpdateData', '', TRUE);
		$this->load->model('SelectData', '', TRUE);
		$this->load->model('Insertdata', '', TRUE);
	}

	function actionsgsrn2_post() {

		$data = [];
		$dataExport = [];
		$timestamp = [];
		$type_of_action = [];
		$action = [];
		$os = [];
		$browser = [];
		$username = [];
		$printActions = [];
		$livePage = 1;
		$travel = 120;

		if (mb_strlen($this->post('dateFrom'), 'UTF-8') > 50) {// 
			exit("dateFrom Lenght too long");
		}

		if (mb_strlen($this->post('dateTo'), 'UTF-8') > 50) {// 
			exit("dateTo Lenght too long");
		}

		if (mb_strlen($this->post('page'), 'UTF-8') > 50) {// 
			exit("page Lenght too long");
		}


		$data["dateFrom"] = strip_tags(trim($this->post('dateFrom')));
		$data["dateTo"] = strip_tags(trim($this->post('dateTo')));

		$livePage = (int) strip_tags(trim($this->post('page')));

		//   $datefrom = strtotime($data["dateFrom"]);
		//   $dateto = strtotime($data["dateTo"]);
		$from = DateTime::createFromFormat('d-m-Y', str_replace('/', '-', $data["dateFrom"]), new DateTimeZone('UTC'));
		$to = DateTime::createFromFormat('d-m-Y', str_replace('/', '-', $data["dateTo"]), new DateTimeZone('UTC'));

		$page = 1;
		$limit = 120; //$limit; 
		$start = 0;
		if (isset($livePage) && $livePage != "" && $livePage > 1) {
			$page = $livePage;
			if (!is_numeric($page)) {
				$page = 1;
			}
			$start = ($page - 1) * $limit;
		}

		list( $timestamp, $type_of_action, $action, $os, $browser, $username ) = $this->SelectData->SelectActionsB((int) $from->getTimestamp(), (int) $to->getTimestamp(), $start, $travel);


		$sizeof = sizeof($timestamp);

		for ($i = 0; $i < $sizeof; $i++) {

			$printActions[$i] = json_encode(["timestamp" => $timestamp[$i],
				"type_of_action" => $type_of_action[$i],
				"action" => $action[$i],
				"os" => $os[$i],
				"browser" => $browser[$i],
				"username" => $username[$i],
			]);
		}


		$dataExport = array("status" => "200",
			"dateFrom" => $from->getTimestamp(),
			"dateTo" => $to->getTimestamp(),
			"dateFromTimest" => $data["dateFrom"],
			"dateToTimest" => $data["dateTo"],
			"actions" => $printActions
				//"timestamp" => $timestamp,
				// "type_of_action" => $type_of_action,
				// "action" => $action,
				// "os" => $os,
				// "browser" => $browser,
		);
//return exit(htmlspecialchars(json_encode($dataExport), ENT_QUOTES, 'UTF-8'));
		// $printActions[$i] =  str_replace("\"{","{",json_encode($dataExport));
		$healthy = ["\"{", "}\"", "\\"];

		$yummy = ["{", "}", ""];

		return exit(str_replace($healthy, $yummy, json_encode($dataExport)));
		// $firstpart = str_replace("\"{","{",json_encode($dataExport));
		//   $firstpart = str_replace("}\"","{",$firstpart); 
		//  return exit($firstpart);
	}

	function getrecommendations_post() {

		$postVariables = [];
		$username = true;

		try {

			if (mb_strlen($this->post('username'), 'UTF-8') > 60) {
				$username = FALSE;
				log_message('error', '------------username Lenght too long:: ');
				throw new Exception("username Lenght too long");
				//exit("username Lenght too long");
			} elseif (mb_strlen($this->post('username'), 'UTF-8') < 1) {
				$username = FALSE;
				log_message('error', '------------username has no value ');
				throw new Exception("username has no value");
				//exit("username has no value");
			}

			$this->load->model('FilterRec', '', TRUE);
			$this->load->model('SelectData2', '', TRUE);

			$data = [];

			$data = $this->FilterRec->filterRecValues($this->SelectData2->GetRecomedationAboutUser($postVariables["username"] = $this->post('username')));

			//$data["code"]= "SUCCESS";
			//var_dump($data);
			$oVal = new stdClass();
			$oVal->code = "SUCCESS";
			$oVal->returnobject = $data;

			echo json_encode($oVal);



			//echo json_encode($data);
			// echo "---------------------";
			//var_dump($postVariables);
		} catch (Exception $e) {
			exit($e->getMessage());
		}
	}

	
		function pullgamestatusjson_post() {
			
			try {
			$username = "";
			$data = "";
			if (mb_strlen($this->post('username'), 'UTF-8') > 60) {

				log_message('error', '------------username Lenght too long:: ');
				throw new Exception("username Lenght too long");
			} elseif (mb_strlen($this->post('username'), 'UTF-8') < 1) {

				log_message('error', '------------username has no value ');
				throw new Exception("username has no value");
			}
			$username = trim(strip_tags($this->post('username')));
			$this->load->model('FilterRec', '', TRUE);
			$this->load->model('SelectData2', '', TRUE);
			$data["username"] = $username;
			$data = $this->FilterRec->filterGameValuesJson($this->SelectData2->SelectAllPendingListOrdersjson($username));



			$healthy = ["\"{", "}\"", "\\"];

			$yummy = ["{", "}", ""];

			return exit(str_replace($healthy, $yummy, json_encode($data)));
			
		} catch (Exception $ex) {


			exit($ex->getMessage());
		}
			
			
		}
	
	function pullgamestatus_post() {


		try {
			$username = "";
			$data = [];
			if (mb_strlen($this->post('username'), 'UTF-8') > 60) {

				log_message('error', '------------username Lenght too long:: ');
				throw new Exception("username Lenght too long");
			} elseif (mb_strlen($this->post('username'), 'UTF-8') < 1) {

				log_message('error', '------------username has no value ');
				throw new Exception("username has no value");
			}
			$username = trim(strip_tags($this->post('username')));
			$this->load->model('FilterRec', '', TRUE);
			$this->load->model('SelectData2', '', TRUE);
			$data["username"] = $username;
			$data = $this->FilterRec->filterGameValues($this->SelectData2->SelectAllPendingListOrders($username));



			$healthy = ["\"{", "}\"", "\\"];

			$yummy = ["{", "}", ""];

			return exit(str_replace($healthy, $yummy, json_encode($data)));
			//return exit(json_encode($data));
		} catch (Exception $ex) {


			exit($ex->getMessage());
		}
	}

	function savegamestatusjson_post() {

		$dataA = [];
		$data = $this->post();
        $Username = "";
	

		try {


			if (mb_strlen($this->post('username'), 'UTF-8') > 60) {

				log_message('error', '------------username Lenght too long:: ');
				throw new Exception("username Lenght too long");
			} elseif (mb_strlen($this->post('username'), 'UTF-8') < 1) {

				log_message('error', '------------username has no value ');
				throw new Exception("username has no value2");
			} elseif (json_encode($data) === false) {
				log_message('error', '------------json format is wrong ');
				throw new Exception("json format is wrong");
			}elseif (mb_strlen(strip_tags(json_encode($data)), 'UTF-8') > 40000) {
				
				log_message('error', '------------json length is too long ');
				throw new Exception("json length is too long");
			}

		
			
			
			$json = $this->security->xss_clean($data);
            $Username = $this->post('username');

			$this->load->model('Generalpurposes', '', TRUE);

			$Data["username"] = $Username;
		
            $Data["JsonString"] = strip_tags(json_encode($json));

			$Data["timestamprecordInsert"] = $this->Generalpurposes->createGMTtimestampOffset();
			
			$this->Insertdata->InsertdataTablError('saveGameStatus', $Data);

			$dataA["code"] = 200;
			return exit(json_encode($dataA));
			
			
			
			
		} catch (Exception $ex) {


			exit($ex->getMessage());
		}
	}

	function savegamestatus_post() {

		try {

			if (mb_strlen($this->post('username'), 'UTF-8') > 60) {

				log_message('error', '------------username Lenght too long:: ');
				throw new Exception("username Lenght too long");
			} elseif (mb_strlen($this->post('username'), 'UTF-8') < 1) {
				$username = false;
				log_message('error', '------------username has no value ');
				throw new Exception("username has no value2");
			}

			$Username = "";
			$Player = [];
			$Badges = [];
			$Data = [];
			$Avatar = [];
			$max = 0;

			//echo "\n ---";
			$Username = $this->security->xss_clean(trim(strip_tags($this->post('username'))));
			//echo "\n -- " . $Username . "\n";

			$Player = $this->security->xss_clean($this->post('Player'));


			//var_dump($Player);
			//exit;

			$max = sizeof($Player);

			//echo "\n ----" . isset($Player["Status"]) ? $Player["Status"] . "\n" : "";
			//echo "\n ----" . isset($Player["Enabled"]) ? $Player["Enabled"] . "\n" : "";


			if (mb_strlen($Player["Status"], 'UTF-8') > 60) {

				log_message('error', '------------Player status Lenght too long:: ');
				throw new Exception("Player status Lenght too long");
			} elseif (mb_strlen($Player["Status"], 'UTF-8') < 1) {

				log_message('error', '------------Player status has no value ');
				throw new Exception("Player status has no value");
			}


			if (mb_strlen($Player["Enabled"], 'UTF-8') > 60) {

				log_message('error', '------------Player Enabled Lenght too long:: ');
				throw new Exception("Player Enabled Lenght too long");
			} elseif (mb_strlen($Player["Enabled"], 'UTF-8') < 1) {

				log_message('error', '------------Player Enabled has no value ');
				throw new Exception("Player Enabled has no value");
			}



			if (mb_strlen($Player["Name"], 'UTF-8') > 60) {

				log_message('error', '------------Name Enabled Lenght too long:: ');
				throw new Exception("Name Enabled Lenght too long");
			} elseif (mb_strlen($Player["Name"], 'UTF-8') < 1) {

				log_message('error', '------------Name Enabled has no value ');
				throw new Exception("Name Enabled has no value");
			}


			if (mb_strlen($Player["PositionX"], 'UTF-8') > 60) {

				log_message('error', '------------PositionX Enabled Lenght too long:: ');
				throw new Exception("PositionX Enabled Lenght too long");
			} elseif (mb_strlen($Player["PositionX"], 'UTF-8') < 1) {

				log_message('error', '------------PositionX Enabled has no value ');
				throw new Exception("PositionX Enabled has no value");
			}

			if (mb_strlen($Player["PositionY"], 'UTF-8') > 60) {

				log_message('error', '------------PositionY Enabled Lenght too long:: ');
				throw new Exception("PositionY Enabled Lenght too long");
			} elseif (mb_strlen($Player["PositionY"], 'UTF-8') < 1) {

				log_message('error', '------------PositionY Enabled has no value ');
				throw new Exception("PositionY Enabled has no value");
			}

			if (mb_strlen($Player["PositionZ"], 'UTF-8') > 60) {

				log_message('error', '------------PositionZ Enabled Lenght too long:: ');
				throw new Exception("PositionZ Enabled Lenght too long");
			} elseif (mb_strlen($Player["PositionZ"], 'UTF-8') < 1) {

				log_message('error', '------------PositionZ Enabled has no value ');
				throw new Exception("PositionZ Enabled has no value");
			}

			if (mb_strlen($Player["RotationX"], 'UTF-8') > 60) {

				log_message('error', '------------RotationX Enabled Lenght too long:: ');
				throw new Exception("RotationX Enabled Lenght too long");
			} elseif (mb_strlen($Player["RotationX"], 'UTF-8') < 1) {

				log_message('error', '------------RotationX Enabled has no value ');
				throw new Exception("RotationX Enabled has no value");
			}

			if (mb_strlen($Player["RotationY"], 'UTF-8') > 60) {

				log_message('error', '------------RotationY Enabled Lenght too long:: ');
				throw new Exception("RotationY Enabled Lenght too long");
			} elseif (mb_strlen($Player["RotationY"], 'UTF-8') < 1) {

				log_message('error', '------------RotationY Enabled has no value ');
				throw new Exception("RotationY Enabled has no value");
			}

			if (mb_strlen($Player["RotationZ"], 'UTF-8') > 60) {

				log_message('error', '------------RotationZ Enabled Lenght too long:: ');
				throw new Exception("RotationZ Enabled Lenght too long");
			} elseif (mb_strlen($Player["RotationZ"], 'UTF-8') < 1) {

				log_message('error', '------------RotationZ Enabled has no value ');
				throw new Exception("RotationZ Enabled has no value");
			}

			if (mb_strlen($Player["RotationW"], 'UTF-8') > 60) {

				log_message('error', '------------RotationW Enabled Lenght too long:: ');
				throw new Exception("RotationW Enabled Lenght too long");
			} elseif (mb_strlen($Player["RotationW"], 'UTF-8') < 1) {

				log_message('error', '------------RotationW Enabled has no value ');
				throw new Exception("RotationW Enabled has no value");
			}


			if (mb_strlen($Player["DisplayName"], 'UTF-8') > 60) {

				log_message('error', '------------DisplayName Enabled Lenght too long:: ');
				throw new Exception("DisplayName Enabled Lenght too long");
			} elseif (mb_strlen($Player["DisplayName"], 'UTF-8') < 1) {

				log_message('error', '------------DisplayName Enabled has no value ');
				throw new Exception("DisplayName Enabled has no value");
			}






			//echo "\n --ExtraData--PositionX--" . $Player["PositionX"];
			//echo "\n --ExtraData--PositionY--" . $Player["PositionY"];
			//echo "\n --ExtraData--PositionZ--" . $Player["PositionZ"];
			//echo "\n --ExtraData--RotationX--" . $Player["RotationX"];
			//echo "\n --ExtraData--RotationY--" . $Player["RotationY"];
			//echo "\n --ExtraData--RotationZ--" . $Player["RotationZ"];
			//echo "\n --ExtraData--RotationW--" . $Player["RotationW"];
			//echo "\n ----" . isset($Player["Name"]) ? $Player["Name"] . "\n" : "";
			//echo "\n --Resources--Name--" . $Player["Resources"][0]["Name"];
			//echo "\n --Resources--Value--" . $Player["Resources"][0]["Value"];
			//echo "\n --Resources--Minimum--" . $Player["Resources"][0]["Minimum"];
			//echo "\n --Resources--Maximum--" . $Player["Resources"][0]["Maximum"];
			//echo "\n --Resources--AutomaticRefillAmount--" . $Player["Resources"][0]["AutomaticRefillAmount"];
			//echo "\n --Resources--AutomaticRefillSeconds--" . $Player["Resources"][0]["AutomaticRefillSeconds"];
			//echo "\n --Values--Name--" . $Player["Values"][0]["Name"];
			//echo "\n --Values--Value--" . $Player["Values"][0]["Value"];
			//echo "\n --Inventory--Name--" . $Player["Inventory"][0]["Name"];
			//echo "\n --Inventory--Id--" . $Player["Inventory"][0]["Id"];
			//echo "\n --Inventory--Status--" . $Player["Inventory"][0]["Status"];
			//echo "\n --ExtraData--DisplayName--" . $Player["DisplayName"];
			for ($i = 0; $i < $max; $i++) {//START OF LOOP
				if (isset($Player["Resources"][$i]["Name"])) {

					if (mb_strlen($Player["Resources"][$i]["Name"], 'UTF-8') > 60) {

						log_message('error', '------------Resources Name Enabled Lenght too long:: ');
						throw new Exception("Resources Name Enabled Lenght too long");
					} elseif (mb_strlen($Player["Resources"][$i]["Name"], 'UTF-8') < 1) {

						log_message('error', '------------Resources Name Enabled has no value ');
						throw new Exception("Resources Name Enabled has no value");
					}
				}

				if (isset($Player["Resources"][$i]["Value"])) {

					if (mb_strlen($Player["Resources"][$i]["Value"], 'UTF-8') > 60) {

						log_message('error', '------------Resources Value Enabled Lenght too long:: ');
						throw new Exception("Resources Value Enabled Lenght too long");
					} elseif (mb_strlen($Player["Resources"][$i]["Value"], 'UTF-8') < 1) {

						log_message('error', '------------Resources Value Enabled has no value ');
						throw new Exception("Resources Value Enabled has no value");
					}
				}

				if (isset($Player["Resources"][$i]["Minimum"])) {

					if (mb_strlen($Player["Resources"][$i]["Minimum"], 'UTF-8') > 60) {

						log_message('error', '------------Resources Minimum Enabled Lenght too long:: ');
						throw new Exception("Resources Minimum Enabled Lenght too long");
					} elseif (mb_strlen($Player["Resources"][$i]["Minimum"], 'UTF-8') < 1) {

						log_message('error', '------------Resources Minimum Enabled has no value ');
						throw new Exception("Resources Minimum Enabled has no value");
					}
				}

				if (isset($Player["Resources"][$i]["Maximum"])) {

					if (mb_strlen($Player["Resources"][$i]["Maximum"], 'UTF-8') > 60) {

						log_message('error', '------------Resources Maximum Enabled Lenght too long:: ');
						throw new Exception("Resources Maximum Enabled Lenght too long");
					} elseif (mb_strlen($Player["Resources"][$i]["Maximum"], 'UTF-8') < 1) {

						log_message('error', '------------Resources Maximum Enabled has no value ');
						throw new Exception("Resources Maximum Enabled has no value");
					}
				}


				if (isset($Player["Resources"][$i]["AutomaticRefillAmount"])) {

					if (mb_strlen($Player["Resources"][$i]["AutomaticRefillAmount"], 'UTF-8') > 60) {

						log_message('error', '------------Resources AutomaticRefillAmount Enabled Lenght too long:: ');
						throw new Exception("Resources AutomaticRefillAmount Enabled Lenght too long");
					} elseif (mb_strlen($Player["Resources"][$i]["AutomaticRefillAmount"], 'UTF-8') < 1) {

						log_message('error', '------------Resources AutomaticRefillAmount Enabled has no value ');
						throw new Exception("Resources AutomaticRefillAmount Enabled has no value");
					}
				}

				if (isset($Player["Resources"][$i]["AutomaticRefillSeconds"])) {

					if (mb_strlen($Player["Resources"][$i]["AutomaticRefillSeconds"], 'UTF-8') > 60) {

						log_message('error', '------------Resources AutomaticRefillSeconds Enabled Lenght too long:: ');
						throw new Exception("Resources AutomaticRefillSeconds Enabled Lenght too long");
					} elseif (mb_strlen($Player["Resources"][$i]["AutomaticRefillSeconds"], 'UTF-8') < 1) {

						log_message('error', '------------Resources AutomaticRefillSeconds Enabled has no value ');
						throw new Exception("Resources AutomaticRefillSeconds Enabled has no value");
					}
				}



				if (isset($Player["Values"][$i]["Name"])) {

					if (mb_strlen($Player["Values"][$i]["Name"], 'UTF-8') > 60) {

						log_message('error', '------------Values Name Enabled Lenght too long:: ');
						throw new Exception("Values Name Enabled Lenght too long");
					} elseif (mb_strlen($Player["Values"][$i]["Name"], 'UTF-8') < 1) {

						log_message('error', '------------Values Name Enabled has no value ');
						throw new Exception("Values Name Enabled has no value");
					}
				}

				if (isset($Player["Values"][$i]["Value"])) {

					if (mb_strlen($Player["Values"][$i]["Value"], 'UTF-8') > 60) {

						log_message('error', '------------Values Value Enabled Lenght too long:: ');
						throw new Exception("Values Value Enabled Lenght too long");
					} elseif (mb_strlen($Player["Values"][$i]["Value"], 'UTF-8') < 1) {

						log_message('error', '------------Values Value Enabled has no value ');
						throw new Exception("Values Value Enabled has no value");
					}
				}



				if (isset($Player["Inventory"][$i]["Name"])) {

					if (mb_strlen($Player["Inventory"][$i]["Name"], 'UTF-8') > 60) {

						log_message('error', '------------Inventory Value Enabled Lenght too long:: ');
						throw new Exception("Inventory Value Enabled Lenght too long");
					} elseif (mb_strlen($Player["Inventory"][$i]["Name"], 'UTF-8') < 1) {

						log_message('error', '------------Inventory Value Enabled has no value ');
						throw new Exception("Inventory Value Enabled has no value");
					}
				}


				if (isset($Player["Inventory"][$i]["Id"])) {

					if (mb_strlen($Player["Inventory"][$i]["Id"], 'UTF-8') > 60) {

						log_message('error', '------------Inventory Id Enabled Lenght too long:: ');
						throw new Exception("Inventory Id Enabled Lenght too long");
					} elseif (mb_strlen($Player["Inventory"][$i]["Id"], 'UTF-8') < 1) {

						log_message('error', '------------Inventory Id Enabled has no value ');
						throw new Exception("Inventory Id Enabled has no value");
					}
				}


				if (isset($Player["Inventory"][$i]["Status"])) {

					if (mb_strlen($Player["Inventory"][$i]["Status"], 'UTF-8') > 60) {

						log_message('error', '------------Inventory Status Enabled Lenght too long:: ');
						throw new Exception("Inventory Id Status Lenght too long");
					} elseif (mb_strlen($Player["Inventory"][$i]["Status"], 'UTF-8') < 1) {

						log_message('error', '------------Inventory Status Enabled has no value ');
						throw new Exception("Inventory Status Enabled has no value");
					}
				}


				if (isset($Player["QuestLog"]["RunningQuests"][$i]["Name"])) {

					if (mb_strlen($Player["QuestLog"]["RunningQuests"][$i]["Name"], 'UTF-8') > 60) {

						log_message('error', '------------QuestLog RunningQuests Name Enabled Lenght too long:: ');
						throw new Exception("QuestLog RunningQuests Name Lenght too long");
					} elseif (mb_strlen($Player["QuestLog"]["RunningQuests"][$i]["Name"], 'UTF-8') < 1) {

						log_message('error', '------------QuestLog RunningQuests Name Enabled has no value ');
						throw new Exception("QuestLog RunningQuests Name Enabled has no value");
					}
				}

				if (isset($Player["QuestLog"]["RunningQuests"][$i]["Status"])) {

					if (mb_strlen($Player["QuestLog"]["RunningQuests"][$i]["Status"], 'UTF-8') > 60) {

						log_message('error', '------------QuestLog RunningQuests Status Enabled Lenght too long:: ');
						throw new Exception("QuestLog RunningQuests Status Lenght too long");
					} elseif (mb_strlen($Player["QuestLog"]["RunningQuests"][$i]["Status"], 'UTF-8') < 1) {

						log_message('error', '------------QuestLog RunningQuests Status Enabled has no value ');
						throw new Exception("QuestLog RunningQuests Status Enabled has no value");
					}
				}


				if (isset($Player["QuestLog"]["RunningQuests"][$i]["Progress"])) {

					if (mb_strlen($Player["QuestLog"]["RunningQuests"][$i]["Progress"], 'UTF-8') > 60) {

						log_message('error', '------------QuestLog RunningQuests Progress Enabled Lenght too long:: ');
						throw new Exception("QuestLog RunningQuests Progress Lenght too long");
					} elseif (mb_strlen($Player["QuestLog"]["RunningQuests"][$i]["Progress"], 'UTF-8') < 1) {

						log_message('error', '------------QuestLog RunningQuests Progress Enabled has no value ');
						throw new Exception("QuestLog RunningQuests Progress Enabled has no value");
					}
				}


				if (isset($Player["QuestLog"]["RunningQuests"][$i]["Owner"])) {

					if (mb_strlen($Player["QuestLog"]["RunningQuests"][$i]["Owner"], 'UTF-8') > 60) {

						log_message('error', '------------QuestLog RunningQuests Owner Enabled Lenght too long:: ');
						throw new Exception("QuestLog RunningQuests Owner Lenght too long");
					} elseif (mb_strlen($Player["QuestLog"]["RunningQuests"][$i]["Owner"], 'UTF-8') < 1) {

						log_message('error', '------------QuestLog RunningQuests Owner Enabled has no value ');
						throw new Exception("QuestLog RunningQuests Owner Enabled has no value");
					}
				}

				if (isset($Player["QuestLog"]["RunningQuests"][$i]["ConvenienceModifier"])) {

					if (mb_strlen($Player["QuestLog"]["RunningQuests"][$i]["ConvenienceModifier"], 'UTF-8') > 60) {

						log_message('error', '------------QuestLog RunningQuests ConvenienceModifier Enabled Lenght too long:: ');
						throw new Exception("QuestLog RunningQuests ConvenienceModifier Lenght too long");
					} elseif (mb_strlen($Player["QuestLog"]["RunningQuests"][$i]["ConvenienceModifier"], 'UTF-8') < 1) {

						log_message('error', '------------QuestLog RunningQuests ConvenienceModifier Enabled has no value ');
						throw new Exception("QuestLog RunningQuests ConvenienceModifier Enabled has no value");
					}
				}

				if (isset($Player["QuestLog"]["RunningQuests"][$i]["TotalConsumption"])) {

					if (mb_strlen($Player["QuestLog"]["RunningQuests"][$i]["TotalConsumption"], 'UTF-8') > 60) {

						log_message('error', '------------QuestLog RunningQuests TotalConsumption Enabled Lenght too long:: ');
						throw new Exception("QuestLog RunningQuests TotalConsumption Lenght too long");
					} elseif (mb_strlen($Player["QuestLog"]["RunningQuests"][$i]["TotalConsumption"], 'UTF-8') < 1) {

						log_message('error', '------------QuestLog RunningQuests TotalConsumption Enabled has no value ');
						throw new Exception("QuestLog RunningQuests TotalConsumption Enabled has no value");
					}
				}

				if (isset($Player["QuestLog"]["RunningQuests"][$i]["TotalCosts"])) {

					if (mb_strlen($Player["QuestLog"]["RunningQuests"][$i]["TotalCosts"], 'UTF-8') > 60) {

						log_message('error', '------------QuestLog RunningQuests TotalCosts Enabled Lenght too long:: ');
						throw new Exception("QuestLog RunningQuests TotalCosts Lenght too long");
					} elseif (mb_strlen($Player["QuestLog"]["RunningQuests"][$i]["TotalCosts"], 'UTF-8') < 1) {

						log_message('error', '------------QuestLog RunningQuests TotalCosts Enabled has no value ');
						throw new Exception("QuestLog RunningQuests TotalCosts Enabled has no value");
					}
				}


				if (isset($Player["QuestLog"]["RunningQuests"][$i]["TotalCostsMinimum"])) {

					if (mb_strlen($Player["QuestLog"]["RunningQuests"][$i]["TotalCostsMinimum"], 'UTF-8') > 60) {

						log_message('error', '------------QuestLog RunningQuests TotalCostsMinimum Enabled Lenght too long:: ');
						throw new Exception("QuestLog RunningQuests TotalCostsMinimum Lenght too long");
					} elseif (mb_strlen($Player["QuestLog"]["RunningQuests"][$i]["TotalCostsMinimum"], 'UTF-8') < 1) {

						log_message('error', '------------QuestLog RunningQuests TotalCostsMinimum Enabled has no value ');
						throw new Exception("QuestLog RunningQuests TotalCostsMinimum Enabled has no value");
					}
				}


				if (isset($Player["QuestLog"]["FinishedQuests"][$i])) {

					if (mb_strlen($Player["QuestLog"]["FinishedQuests"][$i], 'UTF-8') > 60) {

						log_message('error', '------------QuestLog FinishedQuests Enabled Lenght too long:: ');
						throw new Exception("QuestLog FinishedQuests Lenght too long");
					} elseif (mb_strlen($Player["QuestLog"]["FinishedQuests"][$i], 'UTF-8') < 1) {

						log_message('error', '------------QuestLog FinishedQuests Enabled has no value ');
						throw new Exception("QuestLog FinishedQuests Enabled has no value");
					}
				}


				if (isset($Player["ActivityLog"]["RunningActivities"][$i]["Name"])) {

					if (mb_strlen($Player["ActivityLog"]["RunningActivities"][$i]["Name"], 'UTF-8') > 60) {

						log_message('error', '------------ActivityLog RunningActivities Name Enabled Lenght too long:: ');
						throw new Exception("ActivityLog RunningActivities Name Lenght too long");
					} elseif (mb_strlen($Player["ActivityLog"]["RunningActivities"][$i]["Name"], 'UTF-8') < 1) {

						log_message('error', '------------ActivityLog RunningActivities Name Enabled has no value ');
						throw new Exception("ActivityLog RunningActivities Name Enabled has no value");
					}
				}


				if (isset($Player["ActivityLog"]["RunningActivities"][$i]["Owner"])) {

					if (mb_strlen($Player["ActivityLog"]["RunningActivities"][$i]["Owner"], 'UTF-8') > 60) {

						log_message('error', '------------ActivityLog RunningActivities Owner Enabled Lenght too long:: ');
						throw new Exception("ActivityLog RunningActivities Owner Lenght too long");
					} elseif (mb_strlen($Player["ActivityLog"]["RunningActivities"][$i]["Name"], 'UTF-8') < 1) {

						log_message('error', '------------ActivityLog RunningActivities Owner Enabled has no value ');
						throw new Exception("ActivityLog RunningActivities Owner Enabled has no value");
					}
				}


				if (isset($Player["ActivityLog"]["RunningActivities"][$i]["Progress"])) {

					if (mb_strlen($Player["ActivityLog"]["RunningActivities"][$i]["Progress"], 'UTF-8') > 60) {

						log_message('error', '------------ActivityLog RunningActivities Progress Enabled Lenght too long:: ');
						throw new Exception("ActivityLog RunningActivities Progress Lenght too long");
					} elseif (mb_strlen($Player["ActivityLog"]["RunningActivities"][$i]["Progress"], 'UTF-8') < 1) {

						log_message('error', '------------ActivityLog RunningActivities Progress Enabled has no value ');
						throw new Exception("ActivityLog RunningActivities Progress Enabled has no value");
					}
				}

				/////////////////////////////////////////////////////////




				if (isset($Player["ActivityLog"]["FinishedActivities"][$i])) {

					if (mb_strlen($Player["ActivityLog"]["FinishedActivities"][$i], 'UTF-8') > 60) {

						log_message('error', '------------ActivityLog FinishedActivities  Enabled Lenght too long:: ');
						throw new Exception("ActivityLog FinishedActivities  Lenght too long");
					} elseif (mb_strlen($Player["ActivityLog"]["FinishedActivities"][$i], 'UTF-8') < 1) {

						log_message('error', '------------ActivityLog FinishedActivities Enabled has no value ');
						throw new Exception("ActivityLog FinishedActivities Enabled has no value");
					}
				}

				////////////////////////from here
			}//END OF LOOP	


			$Badges = $this->security->xss_clean($this->post('Badges'));
			$max = sizeof($Badges);


			for ($i = 0; $i < $max; $i++) {


				if (isset($Badges["Badges"][$i])) {

					if (mb_strlen($Badges["Badges"][$i], 'UTF-8') > 60) {

						log_message('error', '------------Badges Badges  Enabled Lenght too long:: ');
						throw new Exception("Badges Badges  Lenght too long");
					} elseif (mb_strlen($Badges["Badges"][$i], 'UTF-8') < 1) {

						log_message('error', '------------Badges Badges Enabled has no value ');
						throw new Exception("Badges Badges Enabled has no value");
					}
				}
			}

			$JobPlanner = $this->security->xss_clean($this->post('JobPlanner'));
			$max = sizeof($JobPlanner);
			$ii = 0;
			for ($i = 0; $i < $max; $i++) {
				++$ii;

				$JobPlanner["GameTime"][$ii][0];

				if (isset($JobPlanner["GameTime"][$ii][$i])) {

					if (mb_strlen($JobPlanner["GameTime"][$ii][$i], 'UTF-8') > 60) {

						log_message('error', '------------JobPlanner GameTime  Enabled Lenght too long:: ');
						throw new Exception("JobPlanner GameTime  Lenght too long");
					} elseif (mb_strlen($JobPlanner["GameTime"][$ii][$i], 'UTF-8') < 1) {

						log_message('error', '------------JobPlanner GameTime Enabled has no value ');
						throw new Exception("JobPlanner GameTime Enabled has no value");
					}
				}
			}


			////////////////////////--

			$Avatar = $this->security->xss_clean($this->post('Avatar'));

			if (isset($Avatar["Model"])) {

				if (mb_strlen($Avatar["Model"], 'UTF-8') > 80) {

					log_message('error', '------------Avatar Year  Enabled Lenght too long:: ');
					throw new Exception("Avatar Year  Lenght too long");
				}
			}



			$max = sizeof($Avatar["Categories"]);

			for ($i = 0; $i < $max; $i++) {


				if (isset($Avatar["Categories"][$i]["Category"])) {

					if (mb_strlen($Avatar["Categories"][$i]["Category"], 'UTF-8') > 80) {

						log_message('error', '------------Avatar Categories Category Lenght too long:: ');
						throw new Exception("Avatar Categories Category too long");
					}
				}

				if (isset($Avatar["Categories"][$i]["Mesh"])) {
					if (mb_strlen($Avatar["Categories"][$i]["Mesh"], 'UTF-8') > 80) {

						log_message('error', '------------Avatar Categories Mesh Lenght too long:: ');
						throw new Exception("Avatar Categories Mesh too long");
					}
				}



				if (isset($Avatar["Categories"][$i]["Color"]["Red"])) {
					if (mb_strlen($Avatar["Categories"][$i]["Color"]["Red"], 'UTF-8') > 80) {

						log_message('error', '------------Avatar Categories Color Red Lenght too long:: ');
						throw new Exception("Avatar Categories Color Red too long");
					}
				}


				if (isset($Avatar["Categories"][$i]["Color"]["Green"])) {
					if (mb_strlen($Avatar["Categories"][$i]["Color"]["Green"], 'UTF-8') > 80) {

						log_message('error', '------------Avatar Categories Color Green Lenght too long:: ');
						throw new Exception("Avatar Categories Color Green too long");
					}
				}

				if (isset($Avatar["Categories"][$i]["Color"]["Blue"])) {
					if (mb_strlen($Avatar["Categories"][$i]["Color"]["Blue"], 'UTF-8') > 80) {

						log_message('error', '------------Avatar Categories Color Blue Lenght too long:: ');
						throw new Exception("Avatar Categories Color Blue too long");
					}
				}
			}



			$GameTime = $this->security->xss_clean($this->post('GameTime'));


			if (isset($GameTime["Year"])) {

				if (mb_strlen($GameTime["Year"], 'UTF-8') > 60) {

					log_message('error', '------------GameTime Year  Enabled Lenght too long:: ');
					throw new Exception("GameTime Year  Lenght too long");
				} elseif (mb_strlen($GameTime["Year"], 'UTF-8') < 1) {

					log_message('error', '------------GameTime Year Enabled has no value ');
					throw new Exception("GameTime Year Enabled has no value");
				}
			}

			if (isset($GameTime["Month"])) {

				if (mb_strlen($GameTime["Month"], 'UTF-8') > 60) {

					log_message('error', '------------GameTime Month  Enabled Lenght too long:: ');
					throw new Exception("GameTime Month  Lenght too long");
				} elseif (mb_strlen($GameTime["Month"], 'UTF-8') < 1) {

					log_message('error', '------------GameTime Month Enabled has no value ');
					throw new Exception("GameTime Month Enabled has no value");
				}
			}

			if (isset($GameTime["Day"])) {

				if (mb_strlen($GameTime["Day"], 'UTF-8') > 60) {

					log_message('error', '------------GameTime Day  Enabled Lenght too long:: ');
					throw new Exception("GameTime Day  Lenght too long");
				} elseif (mb_strlen($GameTime["Day"], 'UTF-8') < 1) {

					log_message('error', '------------GameTime Day Enabled has no value ');
					throw new Exception("GameTime Day Enabled has no value");
				}
			}


			if (isset($GameTime["Hour"])) {

				if (mb_strlen($GameTime["Hour"], 'UTF-8') > 60) {

					log_message('error', '------------GameTime Hour  Enabled Lenght too long:: ');
					throw new Exception("GameTime Hour  Lenght too long");
				} elseif (mb_strlen($GameTime["Hour"], 'UTF-8') < 1) {

					log_message('error', '------------GameTime Hour Enabled has no value ');
					throw new Exception("GameTime Hour Enabled has no value");
				}
			}


			if (isset($GameTime["Minute"])) {

				if (mb_strlen($GameTime["Minute"], 'UTF-8') > 60) {

					log_message('error', '------------GameTime Minute  Enabled Lenght too long:: ');
					throw new Exception("GameTime Minute  Lenght too long");
				} elseif (mb_strlen($GameTime["Minute"], 'UTF-8') < 1) {

					log_message('error', '------------GameTime Minute Enabled has no value ');
					throw new Exception("GameTime Minute Enabled has no value");
				}
			}


			if (isset($GameTime["Second"])) {

				if (mb_strlen($GameTime["Second"], 'UTF-8') > 60) {

					log_message('error', '------------GameTime Second  Enabled Lenght too long:: ');
					throw new Exception("GameTime Minute  Lenght too long");
				} elseif (mb_strlen($GameTime["Minute"], 'UTF-8') < 1) {

					log_message('error', '------------GameTime Second Enabled has no value ');
					throw new Exception("GameTime Second Enabled has no value");
				}
			}


			//echo "\n --QuestLog--Name--" . $Player["QuestLog"]["RunningQuests"][0]["Name"];
			//echo "\n --QuestLog--Status--" . $Player["QuestLog"]["RunningQuests"][0]["Status"];
			//echo "\n --QuestLog--Progress--" . $Player["QuestLog"]["RunningQuests"][0]["Progress"];
			//echo "\n --QuestLog--Owner--" . $Player["QuestLog"]["RunningQuests"][0]["Owner"];
			//echo "\n --QuestLog--ConvenienceModifier--" . $Player["QuestLog"]["RunningQuests"][0]["ConvenienceModifier"];
			//echo "\n --QuestLog--TotalConsumption--" . $Player["QuestLog"]["RunningQuests"][0]["TotalConsumption"];
			//echo "\n --QuestLog--TotalCosts--" . $Player["QuestLog"]["RunningQuests"][0]["TotalCosts"];
			//echo "\n --QuestLog--TotalCosts--" . $Player["QuestLog"]["RunningQuests"][0]["TotalCostsMinimum"];
			//QuestLog
			//echo "\n --QuestLog--FinishedQuests--" . $Player["QuestLog"]["FinishedQuests"][0];
			//echo "\n --ActivityLog--FinishedQuests--" . $Player["ActivityLog"]["RunningActivities"][0]["Name"];
			//echo "\n --ActivityLog--FinishedQuests--" . $Player["ActivityLog"]["RunningActivities"][0]["Owner"];
			//echo "\n --ActivityLog--FinishedQuests--" . $Player["ActivityLog"]["RunningActivities"][0]["Progress"];
			//echo "\n --ActivityLog--FinishedQuests--" . $Player["ActivityLog"]["FinishedActivities"][0];
			//echo "\n --Badges--Badges--" . $Badges["Badges"][0];


			$JobPlanner = $this->security->xss_clean($this->post('JobPlanner'));

			//echo "\n --JobPlanner--GameTime--" . $JobPlanner["GameTime"]["1"][0];


			$GameTime = $this->security->xss_clean($this->post('GameTime'));


			//echo "\n --GameTime--GameTime--Year-" . $GameTime["Year"];
			//echo "\n --GameTime--GameTime--Year-" . $GameTime["Month"];
			//echo "\n --GameTime--GameTime--Year-" . $GameTime["Day"];
			//echo "\n --GameTime--GameTime--Year-" . $GameTime["Hour"];
			//echo "\n --GameTime--GameTime--Year-" . $GameTime["Minute"];
			//echo "\n --GameTime--GameTime--Year-" . $GameTime["Second"];
			//echo "\n ---- $max";
			// var_dump($Player["Resources"]);

			$this->load->model('Generalpurposes', '', TRUE);

			$Data["username"] = $Username;
			$Data["Player"] = strip_tags(json_encode($Player));
			$Data["Badges"] = strip_tags(json_encode($Badges));
			$Data["JobPlanner"] = strip_tags(json_encode($JobPlanner));
			$Data["GameTime"] = strip_tags(json_encode($GameTime));
			$Data["Avatar"] = strip_tags(json_encode($Avatar));



			$Data["timestamprecordInsert"] = $this->Generalpurposes->createGMTtimestampOffset();
			$this->Insertdata->InsertdataTablError('saveGameStatus', $Data);

			$dataA["code"] = 200;
			return exit(json_encode($dataA));
		} catch (Exception $ex) {


			exit($ex->getMessage());
		}
	}

	function activitylcmsgame_post() {

		$username = true;

		try {


			if (mb_strlen($this->post('username'), 'UTF-8') > 60) {
				$username = false;
				log_message('error', '------------username Lenght too long:: ');
				throw new Exception("username Lenght too long");
				//exit("username Lenght too long");
			}// elseif (mb_strlen($this->post('username'), 'UTF-8') < 1) {
			//	$username = false;
			//log_message('error', '------------username has no value ');
			//throw new Exception("username has no value");
			//exit("username has no value");
			//} //elseif (filter_var($this->post('email'), FILTER_VALIDATE_EMAIL) === FALSE) {//

			$this->load->model('FilterRec', '', TRUE);
			$this->load->model('SelectData2', '', TRUE);

			$generator = $this->FilterRec->filterGameLcmsValues($this->SelectData2->SelectUserActivityGame($this->post('username')));
			echo "{";
			echo "\"code\":\"success\",\"returnobjectGameActivity\":[";


			foreach ($generator as $value) {

				echo "{\"totalScore\":\"" . $value["totalScore"] . "\",";
				echo "\"username\":\"" . $value["username"] . "\",";
				echo "\"dailyScore\":\"" . $value["dailyScore"] . "\",";
				echo "\"gameDuration\":\"" . $value["gameDuration"] . "\",";
				echo "\"timestampUserLoggediIn\":\"" . $value["timestampUserloggedin"] . "\",";
				echo "\"energyProgram\":\"" . $value["energyProgram"] . "\",";
				echo "\"levelGame\":\"" . $value["levelGame"] . "\",";
				echo "\"jobName\":\"" . $value["jobName"] . "\"},";
				//	echo "{\"allBadges\":\"" . $value["allBadges"] . "\"},";
//echo  json_encode($value["totalScore"]);	allBadges	
			}

			//	$generatorBadges = $this->FilterRec->filterGameLcmsValuesOlnyBages($this->SelectData2->getAllBadges($this->post('username')));
			//$query = $this->SelectData2->getAllBadges($this->post('username'));
			//	echo "\n-------\n";
			//var_dump($this->getAllBadges($this->post('username')));

			
			
			
/*
			foreach ($this->getAllBadges($this->post('username')) as $valueV) {
//username ----
				if (isset($valueV) && mb_strlen(trim($valueV), 'UTF-8') > 0) {
					echo "{\"allBadges\":\"" . $valueV . "\"},";
				}
			}
*/

			//echo "\n-------\n";
			//foreach ($query->result() as $row) {
			//echo "--------- \n".$row->all_badges."----\n-----";
			//   if (isset($row->email)){   echo "\n  emailRow ".$row->email;
			//  $addToDB = FALSE;
			//}  
			//}
			//foreach ($generatorBadges as $valueD) {
			//	echo "\n -----".$value["allBadges"];
			//echo "{\"allBadges\":\"" . $value["allBadges"] . "\"},";
			//	}
			//echo   json_encode($generator);	energyProgram	
			
			
			
			echo "{\"code\":\"success\"}],";
			
			echo "\"returnobjectGameBadges\":[";
			
				foreach ($this->getAllBadges($this->post('username')) as $valueV) {
//username ----
				if (isset($valueV) && mb_strlen(trim($valueV), 'UTF-8') > 0) {
					echo "{\"allBadges\":\"" . $valueV . "\"},";
				
				}
			}

			echo "{\"code\":\"success\"}],";
			
			
		  echo "\"returnobjectGameRewards\":[";
		 $generator = $this->FilterRec->filterGameRewards($this->SelectData2->getTotalRewardsProgram($this->post('username'),1));
			
		 foreach ($generator as $value) {

				echo "{\"totalCredits\":\"" . $value["totalCredits"] . "\",";
				echo "\"totalCash\":\"" . $value["totalCash"] . "\",";
				echo "\"toExPoints\":\"" . $value["toExPoints"] . "\",";		
				echo "\"userName\":\"" . $value["username"] . "\"},";
				//	echo "{\"allBadges\":\"" . $value["allBadges"] . "\"},";
//echo  json_encode($value["totalScore"]);	allBadges	
			}
			
			echo "{\"code\":\"success\"}],";
			
			
			  echo "\"returnobjectGameScore\":[";
			//$data["totalScore"] =                                              GameCurrentTotalScore
		     $generator = $this->FilterRec->filterGameScoreA($this->SelectData2->GameCurrentTotalScore($this->post('username'),1));
			 foreach ($generator as $value) {

				echo "{\"totalScore\":\"" . $value["totalScore"] . "\",";
				
				echo "\"userName\":\"" . $value["user_id"] . "\"},";
				//	echo "{\"allBadges\":\"" . $value["allBadges"] . "\"},";
//echo  json_encode($value["totalScore"]);	allBadges	
			}
			
		//	$data["totalScoreW"] = $this->GameLastWeekTotalScore($this->userNameSession);
			
			 $generator = $this->FilterRec->filterGameScoreA($this->SelectData2->GameLastWeekTotalScore($this->post('username'),1));
			 foreach ($generator as $value) {

				echo "{\"totalScoreLastWeeks\":\"" . $value["totalScore"] . "\",";
				
				echo "\"userName\":\"" . $value["user_id"] . "\"},";
				//	echo "{\"allBadges\":\"" . $value["allBadges"] . "\"},";
//echo  json_encode($value["totalScore"]);	allBadges	
			}
			
			//$data["totalScoreW"] = $this->GameLastWeekTotalScoreM($this->userNameSession);
			//$data["totalScoreM"] = $this->GameLastMonthTotalScoreM($this->userNameSession);
		
						
			//$data["totalScoreM"] = $this->GameLastMonthTotalScoreM($this->userNameSession);
			
			 $generator = $this->FilterRec->filterGameScoreA($this->SelectData2->GameLastMonthTotalScore($this->post('username'),1));
			
			  foreach ($generator as $value) {

				echo "{\"totalScoreLastMonth\":\"" . $value["totalScore"] . "\",";
				
				echo "\"userName\":\"" . $value["user_id"] . "\"},";
				
			}
			  
			
			  
			  $this->load->model('GameModule', '', TRUE);
			  
			   $generator = $this->FilterRec->filterGameScoreB($this->GameModule->getLoadGameActivityPerUser($this->post('username')));
			  
			  
			   foreach ($generator as $value) {

				echo "{\"currentGameLevel\":\"" . $value["level_game"] . "\",";
				
				echo "\"userName\":\"" . $value["user_id"] . "\"},";
				
			}
			   
			   
			
			$generator = $this->FilterRec->filterGameScoreC($this->SelectData2->SelectUsersGameLevelOneMonthBack($this->post('username')));
			  foreach ($generator as $value) {

				echo "{\"GameLevel1monthBack\":\"" . $value["GameLevel1monthback"] . "\",";
				
				echo "\"userName\":\"" . $value["user_id"] . "\"},";
				
			}
			
			if(isset($usrID) && mb_strlen($usrID, 'UTF-8') > 1){
			
		    $generator = $this->FilterRec->filterGameScoreD($this->SelectData2->getTotalForEachProgram());		
				
			}else{
			$generator = $this->FilterRec->filterGameScoreD($this->SelectData2->getTotalForEachProgramPerUser());
			}
			
			
			 foreach ($generator as $value) {

				echo "{\"CommunityPricing\":\"" . $value["CommunityPricing"] . "\",";
				echo "\"energyProgram\":\"" . $value["energy_program"] . "\",";
				echo "\"userName\":\"" . $value["user_id"] . "\"},";
				
			}
			
			
			   
			     echo "{\"code\":\"success\"}],";
			   
			
			// $this->post('username') = "usertestjohnqq";
			$generator_2 = $this->FilterRec->filterLcmsValues($this->SelectData2->SelectUserActivityLcms($this->post('username')));

			//////////////////////////////usertestjohnqq
			$generator_3 = $this->FilterRec->filterLcmsValuesBadges($this->SelectData2->RetrieveLcmsLastRecordBadgesW($this->post('username')));


			echo "\"returnobjectLcmsBadges\":[";

			foreach ($generator_3 as $value3) {

				echo "{\"BadgeName\":\"" . $value3["BadgeName"] . "\",";
				echo "\"username\":\"" . $value3["username"] . "\",";
				echo "\"DateGiven\":\"" . $value3["DateGiven"] . "\"},";
			}

			echo "{\"code\":\"success\"}],";


			/////////////////////////
			//RetrieveLcmsLastRecordCoursesw
			$generator_4 = $this->FilterRec->filterLcmsValuesCourses($this->SelectData2->RetrieveLcmsLastRecordCoursesw($this->post('username')));

			echo "\"returnobjectLcmsCourses\":[";

			foreach ($generator_4 as $value4) {

				echo "{\"CourseName\":\"" . $value4["CourseName"] . "\",";
				echo "\"DateGraded\":\"" . $value4["DateGraded"] . "\",";
				echo "\"CurrentGrade\":\"" . $value4["CurrentGrade"] . "\",";
				echo "\"TimeSpent\":\"" . $value4["TimeSpent"] . "\",";
				echo "\"Grademin\":\"" . $value4["Grademin"] . "\",";
				echo "\"Grademax\":\"" . $value4["Grademax"] . "\",";
				echo "\"Gradepass\":\"" . $value4["Gradepass"] . "\",";

				echo "\"username\":\"" . $value4["username"] . "\"},";
			}

			echo "{\"code\":\"success\"}],";

			///////////////////////
			echo "\"returnobjectLcmsScore\":[";

			$generator_5 = $this->FilterRec->filterGameLcmsValuesScore($this->SelectData2->RetrieveLcmsLastRecordScorew($this->post('username')));


			foreach ($generator_5 as $value4) {

				echo "{\"Name\":\"" . $value4["Name"] . "\",";
				echo "\"username\":\"" . $value4["username"] . "\",";
				echo "\"Value\":\"" . $value4["Value"] . "\"},";
			}

			echo "{\"code\":\"success\"}],";

			////////////////////
			$generator_6 = $this->FilterRec->filterGameLcmsValuesAgregateTotal($this->SelectData2->RetrieveLcmsLastRecordScoreTotalw($this->post('username')));
			echo "\"returnobjectLcmsScoreAggregate\":[";


			foreach ($generator_6 as $value6) {

				echo "{\"totalScore\":\"" . $value6["totalScore"] . "\",";
				echo "\"lastWeekTotalScore\":\"" . $value6["lastWeekTotalScore"] . "\",";
				echo "\"username\":\"" . $value6["username"] . "\",";
				echo "\"lastMonthTotalScore\":\"" . $value6["lastMonthTotalScore"] . "\"},";
			}


			echo "{\"code\":\"success\"}],";
			/////////////////////		

			echo "\"returnobjectLcmsActivityCompetence\":[";
 /// 
			foreach ($generator_2 as $value2) {

				echo "{\"Title\":\"" . $value2["Title"] . "\",";
				echo "\"username\":\"" . $value2["username"] . "\"},";
			}

			echo "{\"code\":\"success\"}";
			echo "  ]}";
			//echo json_encode($this->FilterRec->filterGameLcmsValues($this->SelectData2->SelectUserActivityGame($this->post('username'))));
			//log_message('error', '------------email format is wrong ');
			//throw new Exception("email format is wrong");
			//}
		} catch (Exception $ex) {


			exit($ex->getMessage());
		}
	}

	function getAllBadges($userNameSession = null) {

		$resultR = $this->SelectData2->getAllBadges($userNameSession,1);

		$data = [];

		$badges = [];

		foreach ($resultR->result() as $row) {

			if (isset($row->all_badges) && mb_strlen(trim($row->all_badges), 'UTF-8') > 0) {

				if (strpos($row->all_badges, ",") !== false) {

					$pieces = explode(",", $row->all_badges);

					$max = sizeof($pieces);

					for ($i = 0; $i < $max; $i++) {

						if (in_array($pieces[$i], $badges) === false) {

							$badges[] = $pieces[$i];
						}
					}
				} else {

					$badges[] = $row->all_badges;
				}
			}
		}

		return $badges;
	}

	function gameactions_post() {

		log_message('error', '------------Print last 130:: ');
		$level_game = 0;
		$devices = "";
		$devicesClean = [];
		$variablesReadyToInsert = [];

		$id_job = TRUE;
		$total_score = TRUE;
		$daily_score = TRUE;
		$user_id = TRUE;
		$timestamp_user_logged_in = TRUE;
		$timestamp_user_logged_out = TRUE;
		$energy_program = TRUE;
		$level_game = TRUE;
		$job_name = TRUE;
		$total_credits = TRUE;
		$total_cash = TRUE;
		$total_experience_points = TRUE;
		$all_badges = TRUE;

		$data = array(
			"status" => "200",
		);


		if (mb_strlen($this->post('id_job'), 'UTF-8') > 50) {
			$id_job = FALSE;
			log_message('error', '------------id_job Lenght too long:: ');
			exit("id_job Lenght too long");
		}

		if (mb_strlen($this->post('total_score'), 'UTF-8') > 50) {
			$total_score = FALSE;
			log_message('error', '------------total_score Lenght too long:: ');
			exit("total_score Lenght too long");
		}

		if (mb_strlen($this->post('daily_score'), 'UTF-8') > 50) {
			$daily_score = FALSE;
			log_message('error', '------------daily_score Lenght too long:: ');
			exit("daily_score Lenght too long");
		}

		if (mb_strlen($this->post('user_id'), 'UTF-8') > 50) {
			$user_id = FALSE;
			log_message('error', '------------user_id Lenght too long:: ');
			exit("user_id Lenght too long");
		}

		if (mb_strlen($this->post('timestamp_user_logged_in'), 'UTF-8') > 50) {
			$timestamp_user_logged_in = FALSE;
			log_message('error', '------------timestamp_user_logged_in Lenght too long:: ');
			exit("timestamp_user_logged_in Lenght too long");
		}

		if (mb_strlen($this->post('timestamp_user_logged_out'), 'UTF-8') > 50) {
			$timestamp_user_logged_out = FALSE;
			log_message('error', '------------timestamp_user_logged_out Lenght too long:: ');
			exit("timestamp_user_logged_out Lenght too long");
		}

		if (mb_strlen($this->post('energy_program'), 'UTF-8') > 50) {
			$energy_program = FALSE;
			log_message('error', '------------energy_program Lenght too long:: ');
			exit("energy_program Lenght too long");
		}

		if (mb_strlen($this->post('level_game'), 'UTF-8') > 50) {
			$level_game = FALSE;
			log_message('error', '------------level_game Lenght too long:: ');
			exit("level_game Lenght too long");
		}

		if (mb_strlen($this->post('job_name'), 'UTF-8') > 60) {
			$job_name = FALSE;
			log_message('error', '------------job_name Lenght too long:: ');
			exit("job_name Lenght too long");
		}
		//totalCredits
		if (mb_strlen($this->post('total_credits'), 'UTF-8') > 50) {
			$total_credits = FALSE;
			log_message('error', '------------total_credits Lenght too long:: ');
			exit("total_credits Lenght too long");
		}

		//totalCash
		if (mb_strlen($this->post('total_cash'), 'UTF-8') > 50) {
			$total_cash = FALSE;
			log_message('error', '------------total_cash Lenght too long:: ');
			exit("total_cash Lenght too long");
		}
		//totalExperiencePoints
		if (mb_strlen($this->post('total_experience_points'), 'UTF-8') > 50) {
			$total_experience_points = FALSE;
			log_message('error', '------------total_experience_points Lenght too long:: ');
			exit("total_experience_points Lenght too long");
		}

		//totalExperiencePoints
		if (mb_strlen($this->post('all_badges'), 'UTF-8') > 500) {
			$all_badges = FALSE;
			log_message('error', '------------all_badges Lenght too long:: ');
			exit("all_badges Lenght too long");
		}


		//  if (mb_strlen($this->post('devices'), 'UTF-8') > 50)
		//   {
		//      exit("devices Lenght too long");
		//   }

		log_message('error', '------------215:: ');
		$variablesReadyToInsert["id_job"] = $this->post('id_job');

		$variablesReadyToInsert["total_score"] = $this->post('total_score');

		$variablesReadyToInsert["daily_score"] = $this->post('daily_score');

		$variablesReadyToInsert["user_id"] = $this->post('user_id');

		$variablesReadyToInsert["game_duration"] = $this->post('game_duration');

		$variablesReadyToInsert["timestamp_user_logged_in"] = $this->post('timestamp_user_logged_in');

		$variablesReadyToInsert["timestamp_user_logged_out"] = $this->post('timestamp_user_logged_out');

		$variablesReadyToInsert["energy_program"] = $this->post('energy_program');

		$variablesReadyToInsert["level_game"] = $this->post('level_game');

		$variablesReadyToInsert["job_name"] = $this->post('job_name');

		$variablesReadyToInsert["total_credits"] = $this->post('total_credits');

		$variablesReadyToInsert["total_cash"] = $this->post('total_cash');

		$variablesReadyToInsert["total_experience_points"] = $this->post('total_experience_points');

		$variablesReadyToInsert["all_badges"] = $this->post('all_badges');

		$devices = $this->post('devices');
		//var_dump($devices);
		$this->security->xss_clean($devices);

		$this->security->xss_clean($variablesReadyToInsert);
		log_message('error', '------------240:: ');


		$max = sizeof($devices);
		$v = 0;
		for ($i = 0; $i < $max; $i++) {
			$v = $i + 1;

			if (isset($devices['consumption_' . $v])) {
				if (mb_strlen($devices['consumption_' . $v], 'UTF-8') < 50) {


					$devicesClean['consumption_' . $v] = strip_tags(trim($devices['consumption_' . $v]));
				} else {
					$data["exception"] = "consumption_'.$v Lenght too long";
					$data["error_code"] = "23671";

					return exit(json_encode($data));
				}
			}

			if (isset($devices['per_device_time_duration_' . $v])) {

				if (mb_strlen($devices['per_device_time_duration_' . $v], 'UTF-8') < 50) {

					$devicesClean['per_device_time_duration_' . $v] = strip_tags(trim($devices['per_device_time_duration_' . $v]));
				} else {

					$data["exception"] = "per_device_time_duration_'.$v Lenght too long";
					$data["error_code"] = "23672";

					return exit(json_encode($data));
				}
			}

			if (isset($devices['mode_device_' . $v])) {

				if (mb_strlen($devices['mode_device_' . $v], 'UTF-8') < 50) {

					$devicesClean['mode_device_' . $v] = strip_tags(trim($devices['mode_device_' . $v]));
				} else {

					$data["exception"] = "mode_device_'.$v Lenght too long";
					$data["error_code"] = "23673";

					return exit(json_encode($data));
				}
			}

			if (isset($devices['device_id_' . $v])) {

				if (mb_strlen($devices['device_id_' . $v], 'UTF-8') < 50) {

					$devicesClean['device_id_' . $v] = strip_tags(trim($devices['device_id_' . $v]));
				} else {


					$data["exception"] = "device_id_'.$v Lenght too long";
					$data["error_code"] = "23674";

					return exit(json_encode($data));
				}
			}


			if (isset($devices['points_per_device_' . $v])) {

				if (mb_strlen($devices['points_per_device_' . $v], 'UTF-8') < 50) {

					$devicesClean['points_per_device_' . $v] = strip_tags(trim($devices['points_per_device_' . $v]));
				} else {


					$data["exception"] = "points_per_device_'.$v Lenght too long";
					$data["error_code"] = "23675";

					return exit(json_encode($data));
				}
			}
		}

		$this->load->model('Generalpurposes', '', TRUE);

		$variablesReadyToInsert["devices"] = json_encode($devicesClean);

		$variablesReadyToInsert["timestampReceived"] = $this->Generalpurposes->createGMTtimestampOffset();
		$this->load->library('GeneralException');


		if ($id_job === TRUE &&
				$total_score === TRUE &&
				$daily_score === TRUE &&
				$user_id === TRUE &&
				$timestamp_user_logged_in === TRUE &&
				$timestamp_user_logged_out === TRUE &&
				$energy_program === TRUE &&
				$level_game === TRUE &&
				$job_name === TRUE
		) {

			$this->Insertdata->InsertdataTablError('GameUserActions', $variablesReadyToInsert);
			//  $this->Insertdata->InsertdataTablError('GameUserActions', $variablesReadyToInsert);
			return exit(json_encode($data));
		} else {

			$data["exception"] = "try again later";
			$data["error_code"] = "2367";
			return exit(json_encode($data));
		}




		// echo "--consumption_1--".$devices['consumption_1']."----max----".$max;
		// $array = json_decode($devices,true);
		//  echo "<br>devices:$array[consumption_1] -- devices ";
		exit;



		return exit(json_encode($data));
	}

	function isValidDate($date) {
		if (preg_match("/^(((((1[26]|2[048])00)|[12]\d([2468][048]|[13579][26]|0[48]))-((((0[13578]|1[02])-(0[1-9]|[12]\d|3[01]))|((0[469]|11)-(0[1-9]|[12]\d|30)))|(02-(0[1-9]|[12]\d))))|((([12]\d([02468][1235679]|[13579][01345789]))|((1[1345789]|2[1235679])00))-((((0[13578]|1[02])-(0[1-9]|[12]\d|3[01]))|((0[469]|11)-(0[1-9]|[12]\d|30)))|(02-(0[1-9]|1\d|2[0-8])))))$/", $date)) {
			return $date;
		}
		return null;
	}

	function postRecommendations_post() {


		$data = [];


		if (mb_strlen($this->post('email'), 'UTF-8') > 50) {
			exit("email Lenght too long");
		} elseif (mb_strlen($this->post('email'), 'UTF-8') < 1) {
			exit("email variable has no value");
		}

		$data["email"] = $this->security->xss_clean(trim(strip_tags($this->post('email'))));

		if (filter_var($data["email"], FILTER_VALIDATE_EMAIL) === FALSE) {
			exit("email format is wrong.." . $data["email"]);
		}


		if (mb_strlen($this->post('message'), 'UTF-8') > 250) {
			exit("message Lenght too long");
		} elseif (mb_strlen($this->post('message'), 'UTF-8') < 1) {
			exit("message variable has no value");
		}

		$data["message"] = $this->security->xss_clean(trim(strip_tags($this->post('message'))));

		$data["dateFrom"] = $this->security->xss_clean(trim(strip_tags($this->post('dateFrom'))));

		if (mb_strlen($this->post('dateFrom'), 'UTF-8') > 40) {
			exit("dateFrom Lenght too long");
		} elseif (mb_strlen($this->post('dateFrom'), 'UTF-8') < 1) {
			exit("dateFrom variable has no value");
		}


		if ($this->is_timestamp($data["dateFrom"]) === FALSE) {
			exit("dateFrom format is wrong");
		}

		$data["dateTo"] = $this->security->xss_clean(trim(strip_tags($this->post('dateTo'))));

		if (mb_strlen($this->post('dateTo'), 'UTF-8') > 40) {
			exit("dateTo Lenght too long");
		} elseif (mb_strlen($this->post('dateTo'), 'UTF-8') < 1) {

			exit("dateTo variable has no value");
		}

		if ($this->is_timestamp($data["dateTo"]) === FALSE) {
			exit("dateTo format is wrong");
		}

		if ($data["dateTo"] < $data["dateFrom"]) {
			exit("dateTo must be after dateFrom");
		}

		$this->load->model('Generalpurposes', '', TRUE);

		$data["timeRecordInserted"] = $this->Generalpurposes->createGMTtimestampOffset();

		$this->load->model('SelectData2', '', TRUE);

		$queryEmail = $this->SelectData2->SearchUserByUseremail($data["email"]);

		$emailIsAliveToDB = FALSE;

		foreach ($queryEmail->result() as $row) {
			$emailIsAliveToDB = isset($row->UserName) ? TRUE : FALSE;
		}

		if ($emailIsAliveToDB === FALSE) {
			exit("Wrong email account");
		}

		$query = $this->SelectData2->SelectIfRecomedationExist($data);

		$addToDB = TRUE;

		foreach ($query->result() as $row) {

			$addToDB = isset($row->email) ? FALSE : TRUE;

			//   if (isset($row->email)){   echo "\n  emailRow ".$row->email;
			//  $addToDB = FALSE;
			//}  
		}

		IF ($addToDB === TRUE) {

			$num = (int) $this->Insertdata->InsertdataRec("RecomedationsService", $data);

			if ($num) {
				return exit(json_encode(array("status" => "Recommendation added successfully.")));
			} else {
				return exit(json_encode(array("status" => "Please try again later.")));
			}
		} else {

			return exit(json_encode(array("status" => "Record allready exists.")));
		}
	}

	function getQuestionaire_post() {

		$data = [];
		$dataExport = [];
		$livePage = 1;
		$travel = 120;
		$sizeof = 0;

		try {

			/*
			 * 
			 * 
			  {
			  "dateFrom": "06/05/2018",
			  "dateTo": "10/04/2019",
			  "page": "2"
			  }
			 * $this->post('dateTo')
			 * 
			 */
//echo "<br>--dateFrom-- ".(bool)strtotime($this->post('dateFrom'))." |<br>";
// echo "<br>substr:: ".substr_count($this->post('dateFrom'), '/')." --<br>";
			$tempDate = [];
			$tempDate2 = [];
			$printQuestionaire = [];

			if (substr_count($this->post('dateFrom'), '/') == 2) {
				$tempDate = explode('/', $this->post('dateFrom'));
			} else {
				exit("dateFrom format is wrong");
			}

			if (substr_count($this->post('dateTo'), '/') == 2) {
				$tempDate2 = explode('/', $this->post('dateTo'));
			} else {

				exit("dateTo format is wrong");
			}


			//echo "2--".$tempDate[2]."--0".$tempDate[0]."--1".$tempDate[1];
			//echo "<br>return::".$this->isValidDate($tempDate[2]."-".$tempDate[0]."-".$tempDate[1]);
			//echo "<br>-- ". checkdate($tempDate[2], $tempDate[0], $tempDate[1]);


			if (mb_strlen($this->post('dateFrom'), 'UTF-8') > 50) {// 
				exit("dateFrom Lenght too long");
			} elseif (mb_strlen($this->post('dateFrom'), 'UTF-8') < 1) {

				exit("dateFrom variable has no value");
			} elseif (mb_strlen($this->isValidDate($tempDate[2] . "-" . $tempDate[0] . "-" . $tempDate[1]), 'UTF-8') < 1) {//&& !empty($this->isValidDate($tempDate[2]."-".$tempDate[0]."-".$tempDate[1]))
				exit("dateFrom format is wrong");
			} elseif (mb_strlen((bool) strtotime($this->post('dateFrom')), 'UTF-8') < 1) {

				exit("dateFrom not a valid date");
			}


			if (mb_strlen($this->post('dateTo'), 'UTF-8') > 50) {// 
				exit("dateTo Lenght too long");
			} elseif (mb_strlen($this->post('dateTo'), 'UTF-8') < 1) {

				exit("dateTo variable has no value");
			} elseif (mb_strlen($this->isValidDate($tempDate2[2] . "-" . $tempDate2[0] . "-" . $tempDate2[1]), 'UTF-8') < 1) {//&& !empty($this->isValidDate($tempDate[2]."-".$tempDate[0]."-".$tempDate[1]))
				exit("dateTo format is wrong");
			} elseif (mb_strlen((bool) strtotime($this->post('dateTo')), 'UTF-8') < 1) {

				exit("dateTo not a valid date");
			}

			if (mb_strlen($livePage, 'UTF-8') > 50) {// 
				exit("page Lenght too long");
			}

			$data["dateFrom"] = strip_tags(trim($this->post('dateFrom')));
			$data["dateTo"] = strip_tags(trim($this->post('dateTo')));
			$livePage = (int) strip_tags(trim($this->post('page')));



			$from = DateTime::createFromFormat('d-m-Y', str_replace('/', '-', $data["dateFrom"]), new DateTimeZone('UTC'));
			$to = DateTime::createFromFormat('d-m-Y', str_replace('/', '-', $data["dateTo"]), new DateTimeZone('UTC'));

			$page = 1;
			$limit = 120; //$limit; 
			$start = 0;
			if (isset($livePage) && $livePage != "" && $livePage > 1) {
				$page = $livePage;
				if (!is_numeric($page)) {
					$page = 1;
				}
				$start = ($page - 1) * $limit;
			}


			list(
					$timestamp,
					$Residentin_h_1,
					$resid_0_12_2,
					$resid_13_22_3,
					$resid_23_45_4,
					$resid_46_65_5,
					$doyouownorre1_6,
					$group1_7,
					$HowManyresiden_work_8,
					$timepeopleathome_9,
					$hiedulevwithhome_10,
					$pleSelectHomeType_11,
					$whatEnergyClassIsForAspecificAppliance_12,
					$HowManEnerClassAppliHav,
					$muilSockWithSwit,
					$DoYoUseNatLigSunDay,
					$DoYoLeaLigInUnoccRoom,
					$HavYouIssuEnerCertForHouse,
					$TheMetricKwhRepreWhat,
					$TheDiffOfKwAndKwh,
					$HavYouTakePartDemRespoEve,
					$whatIsTheAppliConsMaxEner,
					$areYReadInDemResEveLowHomEneCon,
					$whatIsAProsumer,
					$doYouHaveResInYourHouse,
					$DoYouKnowWhatDeregMarket,
					$HavYouTakenInDynamiPriciProgram,
					$DoKnowWhtTimeOfUseis,
					$AreYPayBillEveMon
					) = $this->SelectData->SelectQuestionaire((int) $from->getTimestamp(), (int) $to->getTimestamp(), $start, $travel);

			$sizeof = sizeof($timestamp);

			for ($i = 0; $i < $sizeof; $i++) {

				$printQuestionaire[$i] = json_encode([
					"timestamp" => $timestamp[$i],
					"numOfResidInHouse" => $Residentin_h_1[$i],
					"numOfResidBet0and12" => $resid_0_12_2[$i],
					"numOfResidBet13and22" => $resid_13_22_3[$i],
					"numOfResidBet23and45" => $resid_23_45_4[$i],
					"numOfResidBet46and65" => $resid_46_65_5[$i],
					"DoyouOwnOrRent" => $doyouownorre1_6[$i],
					"timeSpentAtHomePerResident" => $group1_7[$i],
					"howManyResidentWork" => $HowManyresiden_work_8[$i],
					"atWhatTimeThereMorePeopleAtHome" => $timepeopleathome_9[$i],
					"highestEduLevelWithinHome" => $hiedulevwithhome_10[$i],
					"pleSelectHomeType" => $pleSelectHomeType_11[$i],
					"whatAnEnergyClassIsForSpecificAppliance" => $whatEnergyClassIsForAspecificAppliance_12[$i],
					"HowManEnerClassAppliHav" => $HowManEnerClassAppliHav[$i],
					"DoYouUseMultipleSocSwit" => $muilSockWithSwit[$i],
					"DoYouUseNatLigInSunDay" => $DoYoUseNatLigSunDay[$i],
					"DoYouLeaLigInUnoccpuRoom" => $DoYoLeaLigInUnoccRoom[$i],
					"HavIssuEnerCertiForYourHouse" => $HavYouIssuEnerCertForHouse[$i],
					"MetricKwhRepreWhat" => $TheMetricKwhRepreWhat[$i],
					"WhatIsTheDiffOfKwAndKwh" => $TheDiffOfKwAndKwh[$i],
					"HavYouEverTakenPartInDemandRespo" => $HavYouTakePartDemRespoEve[$i],
					"WhaIsTheAppliaThatConsTheMaxEner" => $whatIsTheAppliConsMaxEner[$i],
					"AreYReadInDemResEveLowHomEneCon" => $areYReadInDemResEveLowHomEneCon[$i],
					"whatIsAProsumer" => $whatIsAProsumer[$i],
					"doYouHaveResInYourHouse" => $doYouHaveResInYourHouse[$i],
					"doYouKnowWhatDeregMarket" => $DoYouKnowWhatDeregMarket[$i],
					"havYouTakenInDynamiPriciProgram" => $HavYouTakenInDynamiPriciProgram[$i],
					"DoKnowWhtTimeOfUseis" => $DoKnowWhtTimeOfUseis[$i],
					"AreYPayBillEveMon" => $AreYPayBillEveMon[$i],
				]);
			}



			$dataExport = array("status" => "200",
				"dateFrom" => $from->getTimestamp(),
				"dateTo" => $to->getTimestamp(),
				"dateFromTimest" => $data["dateFrom"],
				"dateToTimest" => $data["dateTo"],
				"questionaire" => $printQuestionaire
			);

			$healthy = ["\"{", "}\"", "\\"];

			$yummy = ["{", "}", ""];

			return exit(str_replace($healthy, $yummy, json_encode($dataExport)));
		} catch (Exception $ex) {
			log_message('error', '-----------catch it ' . $ex->getMessage());
		}
	}

	function actionsgsrn_post() {

		$data = [];
		$dataExport = [];
		$timestamp = [];
		$type_of_action = [];
		$action = [];
		$os = [];
		$browser = [];
		$printActions = [];
		$livePage = 1;
		$travel = 120;

		if (mb_strlen($this->post('dateFrom'), 'UTF-8') > 50) {// 
			exit("dateFrom Lenght too long");
		}

		if (mb_strlen($this->post('dateTo'), 'UTF-8') > 50) {// 
			exit("dateTo Lenght too long");
		}

		if (mb_strlen($this->post('page'), 'UTF-8') > 50) {// 
			exit("page Lenght too long");
		}


		$data["dateFrom"] = strip_tags(trim($this->post('dateFrom')));
		$data["dateTo"] = strip_tags(trim($this->post('dateTo')));

		$livePage = (int) strip_tags(trim($this->post('page')));
		//   $datefrom = strtotime($data["dateFrom"]);
		//   $dateto = strtotime($data["dateTo"]);
		$from = DateTime::createFromFormat('d-m-Y', str_replace('/', '-', $data["dateFrom"]), new DateTimeZone('UTC'));
		$to = DateTime::createFromFormat('d-m-Y', str_replace('/', '-', $data["dateTo"]), new DateTimeZone('UTC'));

		$page = 1;
		$limit = 120; //$limit; 
		$start = 0;
		if (isset($livePage) && $livePage != "" && $livePage > 1) {
			$page = $livePage;
			if (!is_numeric($page)) {
				$page = 1;
			}
			$start = ($page - 1) * $limit;
		}

		list( $timestamp, $type_of_action, $action, $os, $browser ) = $this->SelectData->SelectActionsB((int) $from->getTimestamp(), (int) $to->getTimestamp(), $start, $travel);

		$sizeof = sizeof($timestamp);

		for ($i = 0; $i < $sizeof; $i++) {

			$printActions[$i] = json_encode(["timestamp" => $timestamp[$i],
				"type_of_action" => $type_of_action[$i],
				"action" => $action[$i],
				"os" => $os[$i],
				"browser" => $browser[$i],
			]);
		}


		$dataExport = array("status" => "200",
			"dateFrom" => $from->getTimestamp(),
			"dateTo" => $to->getTimestamp(),
			"dateFromTimest" => $data["dateFrom"],
			"dateToTimest" => $data["dateTo"],
			"actions" => $printActions
				//"timestamp" => $timestamp,
				// "type_of_action" => $type_of_action,
				// "action" => $action,
				// "os" => $os,
				// "browser" => $browser,
		);
//return exit(htmlspecialchars(json_encode($dataExport), ENT_QUOTES, 'UTF-8'));
		// $printActions[$i] =  str_replace("\"{","{",json_encode($dataExport));
		$healthy = ["\"{", "}\"", "\\"];

		$yummy = ["{", "}", ""];

		return exit(str_replace($healthy, $yummy, json_encode($dataExport)));



		/*
		  $data = [];
		  $dataExport = [];
		  $timestamp = [];
		  $type_of_action = [];
		  $action = [];
		  $os = [];
		  $browser = [];

		  $data["dateFrom"] = strip_tags(trim($this->post('dateFrom')));
		  $data["dateTo"] = strip_tags(trim($this->post('dateTo')));

		  //   $datefrom = strtotime($data["dateFrom"]);
		  //   $dateto = strtotime($data["dateTo"]);
		  $from = DateTime::createFromFormat('d-m-Y', str_replace('/', '-', $data["dateFrom"]), new DateTimeZone('UTC'));
		  $to = DateTime::createFromFormat('d-m-Y', str_replace('/', '-', $data["dateTo"]), new DateTimeZone('UTC'));

		  list( $timestamp, $type_of_action, $action, $os, $browser ) = $this->SelectData->SelectActions((int) $from->getTimestamp(), (int) $to->getTimestamp());

		  $dataExport = array("status" => "200",
		  "dateFrom" => $from->getTimestamp(),
		  "dateTo" => $to->getTimestamp(),
		  "dateFromTimest" => $data["dateFrom"],
		  "dateToTimest" => $data["dateTo"],
		  "timestamp" => $timestamp,
		  "type_of_action" => $type_of_action,
		  "action" => $action,
		  "os" => $os,
		  "browser" => $browser,
		  );

		  return exit(json_encode($dataExport));

		 */
	}

	function socialstatus_post() {


		$postParametes = [];
		$groupName = [];
		$CreatorName = [];
		$queryResult;
		$socialActivity = [];

		//$postParametes["email"] = strip_tags(trim($this->post('email')));

		if (mb_strlen($this->post('username'), 'UTF-8') > 60) {// 
			exit("username Lenght too long");
		}

		if (mb_strlen($this->post('username'), 'UTF-8') < 1) {// 
			exit("You have to define username to get user social groups");
		}

		$postParametes["username"] = strip_tags(trim($this->post('username')));

		$this->load->model('SelectData2', '', TRUE);

		$queryResult = $this->SelectData2->RetrieveFriendsNamesBasedOnUserName($postParametes["username"]);

		foreach ($queryResult->result() as $row) {

			$postParametes[] = $row->usrGroups;
			$groupName[] = $row->AdminName == $postParametes["username"] ? "EC leader" : "member";

			$socialActivity[] = json_encode(["roleUser" => $row->AdminName == $postParametes["username"] ? "EC leader" : "member",
				"userGroups" => $row->usrGroups,
				"username" => $row->AdminName,
			]);
		}

		$healthy = ["\"{", "}\"", "\\"];
		$yummy = ["{", "}", ""];

		return exit(str_replace($healthy, $yummy, json_encode($socialActivity)));
	}

	function logingsrn_post() {

		$Credential = [];

		$Credential["username"] = strip_tags(trim($this->post('username')));
		$Credential["password"] = strip_tags(trim($this->post('password')));

		$userStatus = "invalid";

		if (mb_strlen($Credential["username"], 'UTF-8') > 50) {// 
			exit("Username Lenght too long");
		}

		if (mb_strlen($Credential["password"], 'UTF-8') > 50) {// 
			exit("Password Lenght too long");
		}

		$Credential["token"] = "";

		$this->load->model('Auth', '', TRUE);

		$queryResult = $this->Auth->AuthorizeUser($Credential["username"], $Credential["password"]);

		foreach ($queryResult->result() as $row) {

			if ($row->User_ID && password_verify($Credential["password"], $row->Password)) {
				$userStatus = "valid";
				$Credential["token"] = $row->PasswordToken;
			}
		}

		$data = array("status" => "200", "username" => $Credential["username"], "token" => $Credential["token"], "userStatus" => $userStatus
		);

		return exit(json_encode($data));
	}

	function refreshtoken_post() {

		$userID = strip_tags(trim($this->post('username')));
		$password = strip_tags(trim($this->post('password')));

		if (mb_strlen($userID, 'UTF-8') > 50) {//
			exit("Username Lenght too long");
		}

		if (mb_strlen($password, 'UTF-8') > 50) {//
			exit("Password Lenght too long");
		}

		$arrayCode = $this->Auth2calls->getCodeToken($userID);
		$array = json_decode($arrayCode, true);
		$outcome = $this->Auth2calls->getCodeRefreshToken($array["code"], $userID, $password);
		$array_2 = json_decode($outcome, true);

		$updatearray = [];
		$updatearray["userid"] = $userID;
		$updatearray["password"] = $password;
		$updatearray["PasswordToken"] = $array_2["access_token"];

		$this->UpdateData->updateTokenUserCredentials($updatearray);

		sleep(3);

		return exit($outcome);
	}

	function is_timestamp($timestamp) {
		if ((is_numeric($timestamp) && (int) $timestamp == $timestamp) && strtotime(date('d-m-Y H:i:s', $timestamp)) === (int) $timestamp) {
			return $timestamp;
		} else
			return false;
	}

	function istokenvalid_post() {
//b4625fcf1c3882792d8e66f6e525b3ec99485938
		$Credential = [];

		$token_id = strip_tags(trim($this->post('tokenid')));

		if (mb_strlen($token_id, 'UTF-8') > 150) {//
			exit("Token Lenght too long");
		}


		return exit(json_encode($this->Auth2calls->ConfirmToken($token_id)));
	}

	//put your code here
	//https://socialenergy.intelen.com/index.php/webservices/mdmenergygsrn

	function mdmenergygsrn_get() {

		$data = array("status" => "200");
		return exit(json_encode($data));
	}

	private function _setError($errorText = "", $errorType = "", $errorCode = "") {
		$this->output->set_status_header($errorCode, $errorText);
		exit("error");
	}

}
