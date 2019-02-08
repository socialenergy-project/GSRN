<?php

header('Access-Control-Allow-Origin: *');
require(APPPATH . '/libraries/REST_Controller.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Webservices2
 *
 * @author John Papagiannis <intelen>
 */
class Webservices2 extends REST_Controller {

	//put your code here

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

	function changestatusrecommendations_post() {



		try {
			$username = "";
			$id = 0;
			if (mb_strlen($this->post('username'), 'UTF-8') > 60) {

				log_message('error', '------------username Lenght too long:: ');
				throw new Exception("username Lenght too long");
				//exit("username Lenght too long");
			} elseif (mb_strlen($this->post('username'), 'UTF-8') < 1) {

				log_message('error', '------------username has no value ');
				throw new Exception("username has no value");
				//exit("username has no value");
			}


			if (mb_strlen($this->post('id'), 'UTF-8') > 20) {

				log_message('error', '------------id Lenght too long:: ');
				throw new Exception("id Lenght too long");
			} elseif (mb_strlen($this->post('id'), 'UTF-8') < 1) {

				log_message('error', '------------id has no value ');
				throw new Exception("id has no value");
			}

			$id = (int) $this->post('id');
			$username = trim(strip_tags($this->post('username')));
			$data = [];

			$this->load->model('FilterRec', '', TRUE);
			$this->load->model('SelectData2', '', TRUE);

			$data = $this->FilterRec->filterRecValues($this->SelectData2->GetRecomedationAboutUser($username, $id));

			if (sizeof($data) < 1) {

				log_message('error', '------------user does not exist:: ');
				throw new Exception("user does not exist!");
			}

			if (isset($data[0]["status"]) && mb_strlen($data[0]["status"], 'UTF-8') < 1) {

				$this->UpdateData->recomedationRead($username, $id, "read");
			}

			echo json_encode(array("code" => "200"));
		} catch (Exception $e) {
			exit($e->getMessage());
		}
	}

}
