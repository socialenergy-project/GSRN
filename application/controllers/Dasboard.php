<?php

error_reporting(1);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of doasboard
 *
 * @author John Papagiannis <intelen>
 */
class Dasboard extends CI_Controller
{

    //put your code here

    public $newQuestIntoSystem;
    public $userIdSession;
    public $userLastTimeLogin;
    public $username;
    public $usrlevel;
    public $usremail;
	public $usrPlatfromCredits;
	public $dataComponets = [];

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->model('SaveData', '', TRUE);
        $this->load->model('Conprocess', '', TRUE);
        $this->load->model('UpdateData', '', TRUE);
        $this->load->model('SelectData', '', TRUE);
        $this->load->model('SelectData2', '', TRUE);
        $this->load->model('ViewUsersProcess', '', TRUE);
        $this->load->model('Trackusers', '', TRUE);
        $this->load->model('Generalpurposes', '', TRUE);
        $this->load->model('Random', '', TRUE);
        $this->load->model('GameModule', '', TRUE);
        $this->load->model('Lcmsbridge', '', TRUE);
        $this->load->model('MarketPlacebridge', '', TRUE);
        $this->load->model('FilterRec', '', TRUE);

        $this->newQuestIntoSystem = $this->session->flashdata('newQuestIntoSystem');

        if ($this->session->userdata('logged_in') !== 1)
        {
            redirect('Login');
            exit;
        }
        else
        {
            $this->usrlevel = $this->session->userdata('user_level');
            $this->username = $this->session->userdata('username');
            $this->userIdSession = $this->session->userdata('userid');
            
            $this->usremail = $this->session->userdata('email');
            
            //$this->userLastTimeLogin = date('Y-m-d H:i:s', $this->SelectData->LastDateUserLogin($this->userIdSession));
            $this->userLastTimeLogin = $this->SelectData->LastDateUserLogin($this->userIdSession) === 0 ? "" : $this->Generalpurposes->timestampTOdate($this->SelectData->LastDateUserLogin($this->userIdSession));
            $this->dataComponets = $this->SelectData->SelectComponet(); 	
			
			$num = $this->FilterRec->filterRecValuesActions($this->SelectData2->countVisitsOfUser($this->userIdSession)) * 0.1;
			
		    $num2 = $this->FilterRec->filterRecValuesActionsTLG($this->SelectData2->getTotalScoreOfLcmsGame($this->userIdSession, $this->username)) ;

		    $this->usrPlatfromCredits = number_format($num + $num2);
			//echo $this->usrPlatfromCredits;
	        
		}
    }

    public function index()
    {

        $userWhereaboutData = [];
        $data = [];
        $dataSelect = [];

        $data["Dashboard2"] = "on";
        $data["newQuestIntoSystem"] = $this->newQuestIntoSystem;
        $data["ActiveTips"] = $this->SelectData->SelectTipsFromSerice($this->usremail);//$this->SelectData->SelectDisplayTips();		
		//$this->userIdSession		
		list($data["GroupMessage"], $data["GroupMessageID"]) = $this->SelectData->GetNewServiceNames($this->userIdSession);
		
        $data["lastTimeLogin"] = $this->userLastTimeLogin;
        $data["username"] = $this->username;
        $data = array_merge($this->returnAllUsrOfGroups($this->userIdSession), $data);
        $data["usrlevel"] = $this->usrlevel;
        $dataSelect["UserID"] = $this->userIdSession;
        $query = $this->Conprocess->loadPositionWidgets($dataSelect);


        foreach ($query->result() as $row)
        {

            if (isset($row->Position_1))
            {

                if ($row->Position_1 == "drag-wizzardGift_1")
                {

                    $data["box_1"] = $this->getEnergyProfileActivity($this->userIdSession);
                      }
                elseif ($row->Position_1 == "drag-wizzardGift_2")
                {

                    $returnValue = $this->getLcmsProfileActivity($this->userIdSession);
                    $data["box_1"] = $returnValue[0];
                    $data["box_1gr"] = $returnValue[1];
                }
                elseif ($row->Position_1 == "drag-wizzardGift_3")
                {

                    $returnValue = $this->getGameProfileActivity($this->username);
                    $data["box_1"] = $returnValue[0];
                    $data["box_1gr"] = $returnValue[1];
                 }
                elseif ($row->Position_1 == "drag-wizzardGift_4")
                {

                    $returnValue = $this->getMarketPlaceProfileActivity($this->userIdSession);
                    $data["box_1"] = $returnValue[0];
                    $data["box_1gr"] = $returnValue[1];

                  }
            }


            if (isset($row->Position_2))
            {

                if ($row->Position_2 == "drag-wizzardGift_1")
                {

                    $data["box_2"] = $this->getEnergyProfileActivity($this->userIdSession);
                }
                elseif ($row->Position_2 == "drag-wizzardGift_2")
                {

                    $returnValue = $this->getLcmsProfileActivity($this->userIdSession);
                    $data["box_2"] = $returnValue[0];
                    $data["box_2gr"] = $returnValue[1];
                 }
                elseif ($row->Position_2 == "drag-wizzardGift_3")
                {

                    $returnValue = $this->getGameProfileActivity($this->username);
                    $data["box_2"] = $returnValue[0];
                    $data["box_2gr"] = $returnValue[1];
                }
                elseif ($row->Position_2 == "drag-wizzardGift_4")
                {
                    $returnValue = $this->getMarketPlaceProfileActivity($this->userIdSession);
                    $data["box_2"] = $returnValue[0];
                    $data["box_2gr"] = $returnValue[1];
                   }
            }


            if (isset($row->Position_3))
            {


                if ($row->Position_3 == "drag-wizzardGift_1")
                {

                    $data["box_3"] = $this->getEnergyProfileActivity($this->userIdSession);
                   }
                elseif ($row->Position_3 == "drag-wizzardGift_2")
                {

                    $returnValue = $this->getLcmsProfileActivity($this->userIdSession);
                    $data["box_3"] = $returnValue[0];
                    $data["box_3gr"] = $returnValue[1];
                    }
                elseif ($row->Position_3 == "drag-wizzardGift_3")
                {



                    $returnValue = $this->getGameProfileActivity($this->username);
                    $data["box_3"] = $returnValue[0];
                    $data["box_3gr"] = $returnValue[1];
                    }
                elseif ($row->Position_3 == "drag-wizzardGift_4")
                {
                    $returnValue = $this->getMarketPlaceProfileActivity($this->userIdSession);
                    $data["box_3"] = $returnValue[0];
                    $data["box_3gr"] = $returnValue[1];
                               }
            }

            if (isset($row->Position_4))
            {

                if ($row->Position_4 == "drag-wizzardGift_1")
                {

                    $data["box_4"] = $this->getEnergyProfileActivity($this->userIdSession);

                              }
                elseif ($row->Position_4 == "drag-wizzardGift_2")
                {

                    $returnValue = $this->getLcmsProfileActivity($this->userIdSession);
                    $data["box_4"] = $returnValue[0];
                    $data["box_4gr"] = $returnValue[1];
                 }
                elseif ($row->Position_4 == "drag-wizzardGift_3")
                {

                    //$this->getGameProfileActivity($this->username);

                    $returnValue = $this->getGameProfileActivity($this->username);
                    $data["box_4"] = $returnValue[0];
                    $data["box_4gr"] = $returnValue[1];
                               }
                elseif ($row->Position_4 == "drag-wizzardGift_4")
                {
                    $returnValue = $this->getMarketPlaceProfileActivity($this->userIdSession);
                    $data["box_4"] = $returnValue[0];
                    $data["box_4gr"] = $returnValue[1];
                 }
            }
        }
		
		
		$data["usrPlatfromCredits"] = $this->usrPlatfromCredits;
		
         $data = array_merge($this->dataComponets, $data);
         $this->load->view('loaddoshboard', $data);
    }

    function positionR()
    {

        sleep(2);
        if (!$this->input->is_AJAX_request())
        {
            exit('none AJAX calls rejected!');
        }

        $DroppableID[] = "contentG1";
        $DroppableID[] = "contentG2";
        $DroppableID[] = "contentG3";
        $DroppableID[] = "contentG4";

        $removedInstance = "";
        $arguments = [];


        if (in_array(strip_tags(trim($this->input->post('whereto'))), $DroppableID))
        {

            $removedInstance = strip_tags(trim($this->input->post('whereto')));

            if ($removedInstance == "contentG1")
            {
                $arguments["FieldName"] = "Position_1";
            }
            elseif ($removedInstance == "contentG2")
            {
                $arguments["FieldName"] = "Position_2";
            }
            elseif ($removedInstance == "contentG3")
            {
                $arguments["FieldName"] = "Position_3";
            }
            elseif ($removedInstance == "contentG4")
            {
                $arguments["FieldName"] = "Position_4";
            }

            $arguments["droppableID"] = "";

            $arguments["UserID"] = $this->userIdSession;

            $this->UpdateData->updateRecordDashboardPosition($arguments);

            echo json_encode(array('result' => 200));
        }
        else
        {

            echo json_encode(array('result' => 201));
        }
    }

    function position()
    {
        sleep(2);
        if (!$this->input->is_AJAX_request())
        {
            exit('none AJAX calls rejected!');
        }

        $arguments = [];

        $DroppableID[] = "drag-wizzardGift_1";
        $DroppableID[] = "drag-wizzardGift_2";
        $DroppableID[] = "drag-wizzardGift_3";
        $DroppableID[] = "drag-wizzardGift_4";

        $baseID[] = "droppableGifts";
        $baseID[] = "droppableGifts_2";
        $baseID[] = "droppableGifts_3";
        $baseID[] = "droppableGifts_4";

        $arguments["droppableID"] = "";
        $arguments["baseID"] = "";


        if (in_array(strip_tags(trim($this->input->post('droppableID'))), $DroppableID))
        {

            $arguments["droppableID"] = strip_tags(trim($this->input->post('droppableID')));
        }

        if (in_array(strip_tags(trim($this->input->post('baseID'))), $baseID))
        {

            $arguments["baseID"] = strip_tags(trim($this->input->post('baseID')));
        }

        // $arguments["baseID"] = strip_tags(trim($this->input->post('baseID')));

        if (mb_strlen($arguments["droppableID"], 'UTF-8') &&
                mb_strlen($arguments["baseID"], 'UTF-8')
        )
        {
            $arguments["FieldName"] = $arguments["baseID"];

            if ($arguments["FieldName"] == "droppableGifts")
            {
                $arguments["FieldName"] = "Position_1";
            }
            elseif ($arguments["FieldName"] == "droppableGifts_2")
            {
                $arguments["FieldName"] = "Position_2";
            }
            elseif ($arguments["FieldName"] == "droppableGifts_3")
            {
                $arguments["FieldName"] = "Position_3";
            }
            elseif ($arguments["FieldName"] == "droppableGifts_4")
            {
                $arguments["FieldName"] = "Position_4";
            }

            $date_utc = new \DateTime(null, new \DateTimeZone("UTC"));
            $UTC_offset = '+00:00';
            $timezone = new \DateTimeZone(str_replace(':', '', $UTC_offset));
            $date_utc->setTimezone($timezone);

            $arguments["timestamp"] = $date_utc->getTimestamp();
            //$arguments["userID"] = "User";
            // $this->SaveData->StoreFormationMainDashboard($arguments);  
            // echo "SaveDB!"; 
            $arguments["Timestamp"] = $arguments["timestamp"];
            $arguments["UserID"] = $this->userIdSession;

            if ($arguments["droppableID"] == "drag-wizzardGift_1")
            {

                // $arguments["FieldName"] = "Position_1";
                $arguments["Position_1"] = $arguments["droppableID"];
                $arguments["Position_2"] = "";
                $arguments["Position_3"] = "";
                $arguments["Position_4"] = "";
                $arguments["content"] = $this->getEnergyProfileActivity($this->userIdSession);
               }
            else if ($arguments["droppableID"] == "drag-wizzardGift_2")
            {

                // $arguments["FieldName"] = "Position_2";
                $arguments["Position_1"] = "";
                $arguments["Position_2"] = $arguments["droppableID"];
                $arguments["Position_3"] = "";
                $arguments["Position_4"] = "";
                //$arguments["content"] = $this->getLcmsProfileActivity($this->userIdSession);

                $returnValue = $this->getLcmsProfileActivity($this->userIdSession);
                $arguments["content"] = $returnValue[0];

                   }
            else if ($arguments["droppableID"] == "drag-wizzardGift_3")
            {

                // $arguments["FieldName"] = "Position_3";
                $arguments["Position_1"] = "";
                $arguments["Position_2"] = "";
                $arguments["Position_3"] = $arguments["droppableID"];
                $arguments["Position_4"] = "";
                //$this->getGameProfileActivity($this->username);

                $returnValue = $this->getGameProfileActivity($this->username);
                $arguments["content"] = $returnValue[0];

             }
            else if ($arguments["droppableID"] == "drag-wizzardGift_4")
            {

                //$arguments["FieldName"] = "Position_4";
                $arguments["Position_1"] = "";
                $arguments["Position_2"] = "";
                $arguments["Position_3"] = "";
                $arguments["Position_4"] = $arguments["droppableID"];
                $returnValue = $this->getMarketPlaceProfileActivity($this->userIdSession);
                $arguments["content"] = $returnValue[0];
             }

            $flagInto = false;
            $index = 0;

            $query = $this->Conprocess->loadPositionWidgets($arguments);

            foreach ($query->result() as $row)
            {

                if (isset($row->UserID))
                {

                    $flagInto = true;
                }

                $index++;
            }

            if ($flagInto === true)
            {

                $this->UpdateData->updateRecordDashboardPosition($arguments);
            }
            else
            {

                $this->SaveData->StoreFormationPDashboard($arguments);
            }
        }





        echo json_encode(array('result' => 200
            , 'droppableID' => $arguments["droppableID"]
            , 'baseID' => $arguments["baseID"]
            , 'content' => $arguments["content"]
            , 'graph' => isset($returnValue[1]) ? $returnValue[1] : ""
        ));
    }

    public function returnAllUsrOfGroups($usrID)
    {
        return $this->ViewUsersProcess->processViewFriendsRecorsMembers($this->SelectData2->returnMemberofAllGroups($usrID));
    }

    public function getEnergyProfileActivity($usrID)
    {


        return "<div class='scrollID' style=' overflow: auto;height:220px;'>"
                . "<table id='cont'><th>My Energy profile</th>"
                . "<th><strong style='cursor: pointer;' class='posti' data-id='pos_2'> <i class='material-icons'>close</i></strong></th>"
                . "<tr>"
                . "<td>Meter Name:</td><td>Consuption:</td>"
                . "<tr>"
                . "<tr><td>-</td><td>-</td>"
                . "<tr><td>-</td><td>-</td>"
                . "</table></div>";
    }

    public function getMarketPlaceProfileActivity($usrID)
    {

        $StringTable = "<div class='scrollID' style=' overflow: auto;height:220px;'>"
                . "<table id='cont'><th>Market place</th>"
                . "<th><strong style='cursor: pointer;' class='posti' data-id='pos_2'> <i class='material-icons'>close</i></strong></th>"
                . "<tr>"
                . "<td>Most popular:</td><td>Most popular by you:</td>"
                . "<tr>";


        $max = 0;
        $ProAllClicks = [];
        $ProPerUserCLicks = [];
        $kwhMuilt = [];
        $peruserclick = [];

        $data = $this->MarketPlacebridge->filterMarketValues($this->SelectData2->RetrieveMostPopularProductPerUserANDALL($usrID));

//
        $ProAllClicks = $data["Product_TitleAllClicks"];
        $ProPerUserCLicks = $data["Product_TitlePerCurrentUser"];

        $peruserclick = $data["Product_PerClicksPost"];

        $max = sizeof($ProAllClicks);

        if ($max > 0)
        {
            for ($i = 0; $i < $max && $i < 5; $i++)
            {

                $StringTable .=
                        "<td>$ProAllClicks[$i]</td>"
                        . "<td>$ProPerUserCLicks[$i]</td></tr>";

                $kwh_{0}[$i] = $peruserclick[$i]; //$i; //$daily_score[$i];
                $label_date_{0}[$i] = $ProPerUserCLicks[$i]; //$i; // $energy_program[$i];
            }


            $mac_list_max = 1;
            for ($ii = 0; $ii < $mac_list_max; $ii++)
            {

                if (isset($kwh_{$ii}) === TRUE)
                {
                    $kwhMuilt["kwh_{$ii}"] = $kwh_{$ii};
                }

                if (isset($label_date_{$ii}) === TRUE)
                {
                    $kwhMuilt["label_date_{$ii}"] = $label_date_{$ii};
                }
            }

            $kwhMuilt["max"] = $mac_list_max;
        }
        else
        {

            $StringTable .="<tr><td>-</td><td>-</td>"
                    . "<tr><td>-</td><td>-</td>";
        }


        $kwhMuilt["label"] = "Widget - Market";
        $returnData[0] = $StringTable.="</table></div>";
        $returnData[1] = $kwhMuilt;
        return $returnData;

        // return $StringTable.="</table></div>";


    }

    public function getLcmsProfileActivity($usrName)
    {
       

        $data = [];
        $Competence = [];
        $Timestamp = [];
        $kwhMuilt = [];

        $StringTable = "<div class='scrollID' style=' overflow: auto;height:220px;'>"
                . "<table id='cont'><th>Learning objects Quizz</th>"
                . "<th><strong style='cursor: pointer;' class='posti' data-id='pos_2'> <i class='material-icons'>close</i></strong></th>"
                . "<tr>"
                . "<td>Competence:</td><td>Date:</td>"
                . "<tr>";

        $max = 0;
//
        $data = $this->Lcmsbridge->filterGameValues($this->Lcmsbridge->getLoadLCMSActivity($usrName));

        $Competence = $data["CompTitle"];
        $Timestamp = $data["RecordSavedAt"];

        $max = sizeof($Competence);

        if ($max > 0)
        {
            for ($i = 0; $i < $max && $i < 5; $i++)
            {

                $StringTable .= "<td>$Competence[$i]</td>"
                        . "<td>" . date("d/m/Y h:i:s", $Timestamp[$i]) . "</td></tr>";

                $kwh_{0}[$i] = 1; //$i; //$daily_score[$i];
                $label_date_{0}[$i] = date("d/m/Y h:i:s", $Timestamp[$i])." - ".substr($Competence[$i], 0, 15).".."; //$i; // $energy_program[$i];
            }

            $mac_list_max = 1;
            for ($ii = 0; $ii < $mac_list_max; $ii++)
            {

                if (isset($kwh_{$ii}) === TRUE)
                {
                    $kwhMuilt["kwh_{$ii}"] = $kwh_{$ii};
                }

                if (isset($label_date_{$ii}) === TRUE)
                {
                    $kwhMuilt["label_date_{$ii}"] = $label_date_{$ii};
                }
            }

            $kwhMuilt["max"] = $mac_list_max;
        }
        else
        {

            $StringTable .="<tr><td>-</td><td>-</td>"
                    . "<tr><td>-</td><td>-</td>";
        }

        $kwhMuilt["label"] = "Widget - Lcms";
        $returnData[0] = $StringTable.="</table></div>";
        $returnData[1] = $kwhMuilt;
        return $returnData;
        // return $StringTable.="</table></div>";
    }

    public function getGameProfileActivity($usrName)
    {
        $data = [];
        $energy_program = [];
        $total_score = [];
        $daily_score = [];
        $timestamp_user_logged_in = [];
        $kwhMuilt = [];

        $StringTable = "<div class='scrollID' style=' overflow: auto;height:220px;'><table id='cont' >"
                . "<th colspan='2'>Game profile ( Game Activity )</th>"
                . "<th><strong style='cursor: pointer;' class='posti' data-id='pos_3'> <i class='material-icons'>close</i></strong></th>"
                . "<tr>"
                . "<td>ENERGY PROGRAM</td><td>LOGGED IN</td><td>DAILY SCORE</td>"
                . "<tr>";

        $max = 0;

        $data = $this->GameModule->filterGameValues($this->GameModule->getLoadGameActivity($usrName));

        $energy_program = $data["energy_program"];

        $total_score = $data["total_score"];
        $daily_score = $data["daily_score"];
        $timestamp_user_logged_in = $data["timestamp_user_logged_in"];

        $max = sizeof($energy_program);

        if ($max > 0)
        {
            for ($i = 0; $i < $max && $i < 5; $i++)
            {

                $StringTable .= "<td>$energy_program[$i]</td>"
                        . "<td>" . date("d/m/Y h:i:s", $timestamp_user_logged_in[$i]) . "</td>"
                        . "<td>$daily_score[$i]</td></tr>";

                $kwh_{0}[$i] = $daily_score[$i]; //$i; //$daily_score[$i];
                $label_date_{0}[$i] = date("d/m/Y h:i:s", $timestamp_user_logged_in[$i]);//$energy_program[$i]." DailyScore: ".$daily_score[$i]; //$i; // $energy_program[$i];
            }


            $mac_list_max = 1;
            for ($ii = 0; $ii < $mac_list_max; $ii++)
            {

                if (isset($kwh_{$ii}) === TRUE)
                {
                    $kwhMuilt["kwh_{$ii}"] = $kwh_{$ii};
                }

                if (isset($label_date_{$ii}) === TRUE)
                {
                    $kwhMuilt["label_date_{$ii}"] = $label_date_{$ii};
                }
            }

            $kwhMuilt["max"] = $mac_list_max;
        }
        else
        {

            $StringTable .="<tr><td>-</td><td>-</td>"
                    . "<tr><td>-</td><td>-</td>";
        }
        $kwhMuilt["label"] = "Widget - Game";
        $returnData[0] = $StringTable.="</table></div>";
        $returnData[1] = $kwhMuilt;
        return $returnData;
        // return $StringTable.="</table></div>";
        //return $this->GameModule->filterGameValues($this->GameModule->getLoadGameActivity($userName));
    }

}
