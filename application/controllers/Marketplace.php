<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Marketplace
 *
 * @author John Papagiannis <intelen>
 */
class Marketplace extends CI_Controller {

	//put your code here
	public $newProductIntoSystem;
	public $userIdSession;
	public $userLastTimeLogin;
	public $username;
	public $usrlevel;
	public $usremail;
	public $dataComponets = [];

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('SelectData', '', TRUE);
		$this->load->model('Random', '', TRUE);
		$this->load->library('session');
		$this->load->model('Trackusers', '', TRUE);
		$this->load->model('Generalpurposes', '', TRUE);
		$this->load->model('SelectData2', '', TRUE);
		$this->load->model('ViewUsersProcess', '', TRUE);

		$this->newProductIntoSystem = $this->session->flashdata('newProductIntoSystem');

		if ($this->session->userdata('logged_in') !== 1) {
			redirect('Login');
			exit;
		} else {
			$this->usremail = $this->session->userdata('email');
			$this->usrlevel = $this->session->userdata('user_level');
			$this->username = $this->session->userdata('username');
			$this->userIdSession = $this->session->userdata('userid');
			$this->userLastTimeLogin = $this->SelectData->LastDateUserLogin($this->userIdSession) === 0 ? "" : $this->Generalpurposes->timestampTOdate($this->SelectData->LastDateUserLogin($this->userIdSession));
			$this->dataComponets = $this->SelectData->SelectComponet();
		}
	}

	public function dproupd() {

		if (!$this->input->is_AJAX_request()) {
			exit('none AJAX calls rejected!');
		}

		$data = [];


		if (mb_strlen($this->input->post('imgName'), 'UTF-8') > 3 &&
				mb_strlen($this->input->post('imgFlag'), 'UTF-8') > 3 &&
				mb_strlen($this->input->post('prodID'), 'UTF-8') > 0
		) {


			$data["imgName"] = strip_tags(trim($this->input->post('imgName')));

			$data["imgFlag"] = strip_tags(trim($this->input->post('imgFlag')));

			$data["fieldName"] = "Upload_Pic";

			$data["ProductID"] = (int) strip_tags(trim($this->input->post('prodID')));

			$this->load->model('UpdateData', '', TRUE);

			$this->UpdateData->updateStatusProPicture($data);
			//var_dump($data);

			echo json_encode(array('result' => 200, 'post' => 1));
		} elseif (
				mb_strlen($this->input->post('imgName2'), 'UTF-8') > 3 &&
				mb_strlen($this->input->post('imgFlag2'), 'UTF-8') > 3 &&
				mb_strlen($this->input->post('prodID'), 'UTF-8') > 0
		) {



			$data["imgName"] = strip_tags(trim($this->input->post('imgName2')));

			$data["imgFlag"] = strip_tags(trim($this->input->post('imgFlag2')));

			$data["fieldName"] = "Upload_Pic_2";

			$data["ProductID"] = (int) strip_tags(trim($this->input->post('prodID')));

			$this->load->model('UpdateData', '', TRUE);

			$this->UpdateData->updateStatusProPicture($data);
			//var_dump($data);

			echo json_encode(array('result' => 200, 'post' => 1));
		} elseif (
				mb_strlen($this->input->post('imgName3'), 'UTF-8') > 3 &&
				mb_strlen($this->input->post('imgFlag3'), 'UTF-8') > 3 &&
				mb_strlen($this->input->post('prodID'), 'UTF-8') > 0
		) {


			$data["imgName"] = strip_tags(trim($this->input->post('imgName3')));

			$data["imgFlag"] = strip_tags(trim($this->input->post('imgFlag3')));

			$data["fieldName"] = "Upload_Pic_3";

			$data["ProductID"] = (int) strip_tags(trim($this->input->post('prodID')));

			$this->load->model('UpdateData', '', TRUE);

			$this->UpdateData->updateStatusProPicture($data);


			echo json_encode(array('result' => 200, 'post' => 1));
		}
	}

	public function proupd() {

		if (!$this->input->is_AJAX_request()) {
			exit('none AJAX calls rejected!');
		}

		$data = [];
		$formSerializeString = "";
		$formSerialize = [];
		$max = 0;

		$formSerializeString = strip_tags(trim($this->input->post('formSerialize')));

		$data["Upload_Pic"] = strip_tags(trim($this->input->post('pic')));

		$data["Upload_Pic_2"] = strip_tags(trim($this->input->post('pic2')));

		$data["Upload_Pic_3"] = strip_tags(trim($this->input->post('pic3')));

		$data["ProductID"] = (int) strip_tags(trim($this->input->post('proID')));

		parse_str($formSerializeString, $formSerialize);
		//print_r($formSerialize);
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');




		$this->form_validation->set_rules('Product_Title', 'Product Title', 'required|min_length[2]|max_length[50]|trim');
		$this->form_validation->set_rules('Product_Short_Desc', 'Product Short Description', 'required|min_length[2]|max_length[250]|trim');
		$this->form_validation->set_rules('Product_Main_Desc', 'Product Main Description', 'required|min_length[2]|max_length[450]|trim');
		$this->form_validation->set_rules('Product_Price', 'Price', 'required|min_length[2]|max_length[50]|trim');
		$this->form_validation->set_rules('Main_Category', 'Main Category', 'required|min_length[2]|max_length[50]|trim');
		$this->form_validation->set_rules('Sub_Category', 'Sub Category', 'required|min_length[2]|max_length[50]|trim');
		$this->form_validation->set_rules('Sub_Category3', 'Sub Category Level 3', 'required|min_length[2]|max_length[50]|trim');


		if (mb_strlen($this->input->post('Product_Title'), 'UTF-8') > 0) {

			$data["Product_Title"] = $this->input->post('Product_Title');
		}

		if (mb_strlen($this->input->post('Product_Short_Desc'), 'UTF-8') > 0) {

			$data["Product_Short_Desc"] = $this->input->post('Product_Short_Desc');
		}

		if (mb_strlen($this->input->post('Product_Main_Desc'), 'UTF-8') > 0) {

			$data["Product_Main_Desc"] = $this->input->post('Product_Main_Desc');
		}

		if (mb_strlen($this->input->post('Product_Price'), 'UTF-8') > 0) {

			$data["Product_Price"] = $this->input->post('Product_Price');
		}

		if (mb_strlen($this->input->post('Main_Category'), 'UTF-8') > 0) {

			$data["Main_Category"] = $this->input->post('Main_Category');
		}

		if (mb_strlen($this->input->post('Sub_Category'), 'UTF-8') > 0) {

			$data["Sub_Category"] = $this->input->post('Sub_Category');
		}

		if (mb_strlen($this->input->post('Sub_Category3'), 'UTF-8') > 0) {

			$data["Sub_Category3"] = $this->input->post('Sub_Category3');
		}

		$configPic = array(
			'upload_path' => "./upload/",
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
			'overwrite' => TRUE,
			'max_size' => "100000", //"2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb) 100000
			'max_height' => "3100",
			'max_width' => "3100"
		);

		$this->load->library('upload', $configPic);

		if (isset($_FILES['uploadImage_id1']['name']) && mb_strlen($_FILES['uploadImage_id1']['name'], 'UTF-8') > 0) {

			if ($this->upload->do_upload('uploadImage_id1')) {
				$data["upload_data"] = array('upload_data' => $this->upload->data());

				$data["Upload_Pic"] = $_FILES['uploadImage_id1']['name'];

				$this->do_resize($data["Upload_Pic"]);
			} else {
				$error = array('error' => $this->upload->display_errors());
				$data["errorUploadImage"] = $error["error"];
			}
		}

		if (isset($_FILES['uploadImage_id2']['name']) && mb_strlen($_FILES['uploadImage_id2']['name'], 'UTF-8') > 0) {

			if ($this->upload->do_upload('uploadImage_id2')) {
				$data["upload_data2"] = array('upload_data' => $this->upload->data());

				$data["Upload_Pic_2"] = $_FILES['uploadImage_id2']['name'];

				$this->do_resize($data["Upload_Pic_2"]);
			} else {
				$error = array('error' => $this->upload->display_errors());

				$data["errorUploadImage2"] = $error["error"];
			}
		}


		if (isset($_FILES['uploadImage_id3']['name']) && mb_strlen($_FILES['uploadImage_id3']['name'], 'UTF-8') > 0) {

			if ($this->upload->do_upload('uploadImage_id3')) {
				$data["upload_data3"] = array('upload_data' => $this->upload->data());

				$data["Upload_Pic_3"] = $_FILES['uploadImage_id3']['name'];

				$this->do_resize($data["Upload_Pic_3"]);
			} else {
				$error = array('error' => $this->upload->display_errors());

				$data["errorUploadImage3"] = $error["error"];
			}
		}



		if ($this->form_validation->run() == FALSE ||
				( (isset($data["errorUploadImage"]) && mb_strlen($data["errorUploadImage"], 'UTF-8') > 1) || (isset($data["errorUploadImage2"]) && mb_strlen($data["errorUploadImage2"], 'UTF-8') > 1) || (isset($data["errorUploadImage3"]) && mb_strlen($data["errorUploadImage3"], 'UTF-8') > 1))) {

			$errors = validation_errors() . "\n";
			//echo json_encode(['error'=>$errors]);

			exit(json_encode(array('result' => 200, 'post' => 2, 'error' => $errors)));
		}
	
		$this->load->model('UpdateData', '', TRUE);

		$this->UpdateData->updateDetailsProduct($data);
		//var_dump($data);

		echo json_encode(array('result' => 200, 'post' => 1));
	}

	public function reprod() {

		if (!$this->input->is_AJAX_request()) {
			exit('none AJAX calls rejected!');
		}

		$flag = FALSE;
		$data = [];

		$data["proID"] = (int) strip_tags(trim($this->input->post('proID')));

		$data["pic"] = strip_tags(trim($this->input->post('pic')));

		$data["pic2"] = strip_tags(trim($this->input->post('pic2')));

		$data["pic3"] = strip_tags(trim($this->input->post('pic3')));

		if (mb_strlen($data["proID"], 'UTF-8') > 7) {
			$data["proID"] = 0;
		}

		if ($data["proID"] > 0) {

			$this->load->model('RemoveRows', '', TRUE);
			if (isset($data["pic"]) && mb_strlen($data["pic"], 'UTF-8') > 0) {
			

				unlink("./upload/" . $data["pic"]);
				unlink("./thum/" . $data["pic"]);

//
			}

			if (isset($data["pic2"]) && mb_strlen($data["pic2"], 'UTF-8') > 0) {

				unlink("./upload/" . $data["pic2"]);
				unlink("./thum/" . $data["pic2"]);

				
			}

			if (isset($data["pic3"]) && mb_strlen($data["pic3"], 'UTF-8') > 0) {

				unlink("./upload/" . $data["pic3"]);
				unlink("./thum/" . $data["pic3"]);

			
			}


			$flag = $this->RemoveRows->RmoeveMarketPlacepro("", $data["proID"]);
		}

		if ($flag === TRUE) {
			echo json_encode(array('result' => 200, 'post' => 1));
		} else {
			echo json_encode(array('result' => 200, 'post' => 0));
		}
	}

	public function do_resize($filename) {
	
		$source_path = './upload/' . $filename;
		$target_path = './thum/';
		$config_manip = array(
			'image_library' => 'gd2',
			'source_image' => $source_path,
			'new_image' => $target_path,
			'maintain_ratio' => TRUE,
			'create_thumb' => TRUE,
			'thumb_marker' => '',
			'width' => 150,
			'height' => 150
		);
		$this->load->library('image_lib', $config_manip);
		if (!$this->image_lib->resize()) {
			echo $this->image_lib->display_errors();
		}
		// clear //
		$this->image_lib->clear();
	}

	public function upprod() {

		if (!$this->input->is_AJAX_request()) {
			exit('none AJAX calls rejected!');
		}

		$data = [];

		$data["proID"] = (int) strip_tags(trim($this->input->post('proID')));
		$data["proSTA"] = (int) strip_tags(trim($this->input->post('proSTA')));

		if ($data["proSTA"] == 2) {
			$data["proSTA"] = "On AIR";
		} else {
			$data["proSTA"] = "Pending";
		}

		if (mb_strlen($data["proID"], 'UTF-8') > 7) {
			$data["proID"] = 0;
		}

		if ($data["proID"] > 0) {
			$this->load->model('UpdateData', '', TRUE);
			$this->UpdateData->updateStatusProduct($data);
		}

		echo json_encode(array('result' => 200));
	}

	public function index() {

		$data_2 = array();
		$data = array();

		$data_2["ViewMarketplace"] = "on";
		$data_2["newProductIntoSystem"] = $this->newProductIntoSystem;

		$ownID = 0;
		if ($this->usrlevel == 3) {
			
			$ownID = $this->userIdSession;
			
		}
		
		$data = array_merge($this->loadUsers($ownID), $data_2);
		
		
		$data["ActiveTips"] = $this->SelectData->SelectTipsFromSerice($this->usremail); //$this->SelectData->SelectDisplayTips();
		$data["lastTimeLogin"] = $this->userLastTimeLogin;
		$data["username"] = $this->username;
		$data = array_merge($this->returnAllUsrOfGroups($this->userIdSession), $data);
		$data["usrlevel"] = $this->usrlevel;
		$data = array_merge($this->dataComponets, $data);
		if ($this->usrlevel == 3) {
			$data["userIdSession"] = $this->userIdSession . $this->Generalpurposes->createXrandomNumber();
		}
		$this->load->view('viewmarketplace', $data);
	}

	public function loadUsers($ownID=null) {
		$this->load->model('ViewMarketplaceProcess', '', TRUE);
		return $this->ViewMarketplaceProcess->processViewProductsRecords($this->SelectData->SelectMarketProduct($ownID));
	}

	public function returnAllUsrOfGroups($usrID) {
		return $this->ViewUsersProcess->processViewFriendsRecorsMembers($this->SelectData2->returnMemberofAllGroups($usrID));
	}

}
