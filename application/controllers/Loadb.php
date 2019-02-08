<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Loadb
 *
 * @author John Papagiannis <intelen>
 */
error_reporting(0);

class Loadb extends CI_Controller
{

    public $userIdSession;

    //put your code here
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('Conprocess', '', TRUE);
        $this->load->model('SaveData', '', TRUE);
        $this->load->model('UpdateData', '', TRUE);
        $this->load->model('SelectData', '', TRUE);
        $this->load->library('session');
        if ($this->session->userdata('logged_in') !== 1)
        {
            redirect('Login');
            exit;
        }
        else
        {
            $this->userIdSession = $this->session->userdata('userid');
        }
    }

    public function index()
    {
       
        $Data = [];

        $Data["Dashboard"] = "ON";
        $Data["ActiveTips"] = $this->SelectData->SelectDisplayTips();

        $this->load->view('loadb_widget', $Data);
    }

    function details()
    {

        if (!$this->input->is_AJAX_request())
            exit('none AJAX calls rejected!');

        $query_argument = [];

        $query_argument["postJson"] = strip_tags(trim($this->input->post('postJson')));
        $query_argument["dataId"] = strip_tags(trim($this->input->post('dataId')));

        echo json_encode(array(
            'result' => 200,
            'json' => $query_argument["postJson"], //str_replace("\\","",$query_argument["postJson"]),
            'dataId' => $query_argument["dataId"],
                ), JSON_UNESCAPED_SLASHES);

   
    }

    function saveformation()
    {

        if (!$this->input->is_AJAX_request())
            exit('none AJAX calls rejected!');



        $query_argument = [];
        $query = "";
        $index = 0;
        $flag = true;
        // $date_local = new \DateTime();
        //$date_utc = new \DateTime(null, new \DateTimeZone("UTC"));

        $date_utc = new \DateTime(null, new \DateTimeZone("UTC"));
        $UTC_offset = '+00:00';
        $timezone = new \DateTimeZone(str_replace(':', '', $UTC_offset));
        $date_utc->setTimezone($timezone);

        //grid

        $query_argument["grid"] = strip_tags(trim($this->input->post('grid')));
        $query_argument["user_id"] = 0;
        $query_argument["timestamp"] = $date_utc->getTimestamp();
        $query_argument["json"] = strip_tags(trim($this->input->post('formation')));

        $query = $this->Conprocess->selectUserIDGridID($query_argument);

        foreach ($query->result() as $row)
        {

            if (isset($row->user_id))
            {

                $flag = false;
            }

            $index++;
        }

        if ($flag === true)
        {

            $this->SaveData->StoreFormationDashboard($query_argument);
        }
        else
        {

            $this->UpdateData->updateRecordUserIDgridID($query_argument);
        }

        echo json_encode(array('result' => 200));
    }

    function grids()
    {

        if (!$this->input->is_AJAX_request())
            exit('none AJAX calls rejected!');

        $arguments = [];

        $Json = [];

        $index = 0;

        $arguments["user_id"] = strip_tags(trim($this->input->post('userId')));

        $query = $this->Conprocess->loadGridUserID($arguments);

        foreach ($query->result() as $row)
        {

            $Json[$row->grid] = str_replace(" ", "", str_replace("\\n", "", $row->json));

        }

        echo json_encode(str_replace("\\", "", $Json));
        //  echo json_encode( str_replace("\"","",str_replace("\\","",$Json)));
    }

    function consM()
    {

        if (!$this->input->is_AJAX_request())
            exit('none AJAX calls rejected!');

        $searchDateFrom = "";
        $searchDateTo = "";
        $query = "";
        $mac_list = "";
        $index = 0;

        $kwh = [];
        $label_date = [];
        $query_argument = [];

        $label_dateMuilt = [];
        $kwhMuilt = [];

        $mac_list = strip_tags(trim($this->input->post('macD')));

        $query_argument["mac_where"] = " mac=" . $this->db->escape($mac_list) . " and ";

        $query_argument["searchDateFrom"] = strtotime(strip_tags(trim($this->input->post('searchDateFrom'))));

        $query_argument["searchDateTo"] = strtotime(strip_tags(trim($this->input->post('searchDateTo'))));

        $query_argument["timeD"] = "%Y-%m-%dT%H:%i";

        $mac_list_max = 1;

        $query = $this->Conprocess->ReturnCons($query_argument);


        foreach ($query->result() as $row)
        {

            if ($row->kwh > 0)
            {

                $kwh_{0}[$index] = $row->kwh * 14;
            }
            else
            {

                $kwh_{0}[$index] = $row->kwh;
            }
            $label_date_{0}[$index] = $row->interval_value;
            $index++;
        }

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

        echo json_encode($kwhMuilt);

        // echo json_encode(array('result' => $kwh, 'labels' => $label_date));
    }

    public function loadDiv()
    {


        if (!$this->input->is_AJAX_request())
        {
            exit('none AJAX calls rejected!');
        }
        elseif (sizeof($this->input->post()) > 7)
        {
            exit('none AJAX calls rejected!');
        }
        elseif ($this->input->post('divID') > 5) //mb_strlen($this->input->post('divID'), 'UTF-8')
        {

            exit('none AJAX calls rejected!');
        }

        $content = "";
        //divID
        if ($this->input->post('divID') > 3 || $this->input->post('divID') < 0)
        {
            exit('parameter is wrong!');
        }


        if ($this->input->post('divID') == 0)
        {

            $content = $this->input->post('divID') . "---Loaded---";
        }
        elseif ($this->input->post('divID') == 1)
        {

            $content = "<table>";
            $content .="<td>Learning object( number of learning objects seeing )</td><td><strong style='color:yellow;'> 5</strong> </td></tr><tr>";
            $content .="<td>Learning object unfinished ( quizz / tests ) ( number of learning objects unfinished )</td> <td><strong style='color:yellow;'> 5</strong></td> </tr><tr>";
            $content .="<td>Learning object finished ( quizz / tests ) ( number of learning objects seeing ) - Total score</td>  <td><strong style='color:yellow;'>50</strong></td>  </tr><tr>";
            $content .="<td>Recommendation learning object.</td><td>---</td>";
            // $content .= "---Loaded---</table>".$this->input->post('divID')  ;
        }
        elseif ($this->input->post('divID') == 2)
        {

            $content = "<table>";
            $content .="<td>Last time played ( at timestamp ) </td><td> <strong style='color:yellow;'>2017-09-13 12:31:03 </strong></td><tr><tr><td>Total score</td><td> <strong style='color:yellow;'>50</strong> </td></tr><tr>";
            $content .="<td>Level game</td><td>  <strong style='color:yellow;'>4</strong> </td></tr><tr></table>";
            // $content .=  "---Loaded---</table>".$this->input->post('divID');
        }

        echo json_encode(array(
            'sql ' => "query",
            'html' => "loadHTML",
            'divcontent' => $content
        ));

        exit;
    }

}
