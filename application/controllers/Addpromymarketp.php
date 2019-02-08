<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Addpromymarketp
 *
 * @author John Papagiannis <intelen>
 */
class Addpromymarketp extends CI_Controller
{

    //put your code here

    public $userIdSession;
    public $userLastTimeLogin;
    public $username;
    public $usrlevel;
    public $usremail;
	public $dataComponets = [];

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('SelectData', '', TRUE);
        $this->load->model('Random', '', TRUE);
        $this->load->library('session');
        $this->load->model('Trackusers', '', TRUE);
        $this->load->model('Generalpurposes', '', TRUE);
        $this->load->model('SelectData2', '', TRUE);
        $this->load->model('ViewUsersProcess', '', TRUE);

        if ($this->session->userdata('logged_in') !== 1)
        {
            redirect('Login');
            exit;
        }
        else
        {
            $this->usremail = $this->session->userdata('email');
            $this->usrlevel = $this->session->userdata('user_level');
            $this->username = $this->session->userdata('username');
            $this->userIdSession = $this->session->userdata('userid');
            $this->userLastTimeLogin = $this->SelectData->LastDateUserLogin($this->userIdSession) === 0 ? "" : $this->Generalpurposes->timestampTOdate($this->SelectData->LastDateUserLogin($this->userIdSession));
            $this->dataComponets = $this->SelectData->SelectComponet();
			
		}
    }

    public function index()
    {

        $data = [];
        $userWhereaboutData = [];
        $data = $this->createheader();
        $data["usrlevel"] = $this->usrlevel;

        $data = array_merge($this->dataComponets, $data);
        $this->load->view('addpromarkplace', $data);
        /// $this->load->view('profile', $data);
    }

    public function saveproduct()
    {

        if ($_SERVER['REQUEST_METHOD'] != 'POST')
        {

            $this->index();
        }

        $data = [];
        $data["errorUploadImage"] = "";
        $data["errorUploadImage2"] = "";
        $data["errorUploadImage3"] = "";
        $receivedData = [];
        $configPic = [];

        $data = $this->createheader();

        $receivedData["Product_Title"] = strip_tags(trim($this->input->post("Product_Title")));
        $receivedData["Product_Short_Desc"] = strip_tags(trim($this->input->post("Product_Short_Desc")));
        $receivedData["Product_Main_Description"] = strip_tags(trim($this->input->post("Product_Main_Desc")));
        $receivedData["Price"] = strip_tags(trim($this->input->post("Product_Price")));
        $receivedData["Main_Category"] = strip_tags(trim($this->input->post("Main_Category")));
        $receivedData["Sub_Category"] = strip_tags(trim($this->input->post("Sub_Category")));
        $receivedData["Sub_Category_Level_3"] = strip_tags(trim($this->input->post("Sub_Category3")));
        $receivedData["Timestamp_Created"] = $this->Generalpurposes->createGMTtimestampOffset();

        $receivedData = $this->security->xss_clean($receivedData);
        $data = array_merge($receivedData, $data);
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $this->form_validation->set_rules('Product_Title', 'Product Title', 'required|min_length[2]|max_length[50]|trim');
        $this->form_validation->set_rules('Product_Short_Desc', 'Product Short Description', 'required|min_length[2]|max_length[250]|trim');
        $this->form_validation->set_rules('Product_Main_Desc', 'Product Main Description', 'required|min_length[2]|max_length[450]|trim');
        $this->form_validation->set_rules('Product_Price', 'Price', 'required|min_length[2]|max_length[50]|trim');
        $this->form_validation->set_rules('Main_Category', 'Main Category', 'required|min_length[2]|max_length[50]|trim');
        $this->form_validation->set_rules('Sub_Category', 'Sub Category', 'required|min_length[2]|max_length[50]|trim');
        $this->form_validation->set_rules('Sub_Category3', 'Sub Category Level 3', 'required|min_length[2]|max_length[50]|trim');


        $configPic = array(
            'upload_path' => "./upload/",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => TRUE,
            'max_size' => "100000", //"2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb) 100000
            'max_height' => "3100",
            'max_width' => "3100"
        );

        $this->load->library('upload', $configPic);

        if (isset($_FILES['uploadImage_id1']['name']) && mb_strlen($_FILES['uploadImage_id1']['name'], 'UTF-8') > 0)
        {

            if ($this->upload->do_upload('uploadImage_id1'))
            {
                $data["upload_data"] = array('upload_data' => $this->upload->data());

                $receivedData["Upload_Pic"] = $_FILES['uploadImage_id1']['name'];

                $this->do_resize($receivedData["Upload_Pic"]);
            }
            else
            {
                $error = array('error' => $this->upload->display_errors());
                $data["errorUploadImage"] = $error["error"];
            }
        }


        if (isset($_FILES['uploadImage_id2']['name']) && mb_strlen($_FILES['uploadImage_id2']['name'], 'UTF-8') > 0)
        {

            if ($this->upload->do_upload('uploadImage_id2'))
            {
                $data["upload_data2"] = array('upload_data' => $this->upload->data());

                $receivedData["Upload_Pic_2"] = $_FILES['uploadImage_id2']['name'];

                $this->do_resize($receivedData["Upload_Pic_2"]);
            }
            else
            {
                $error = array('error' => $this->upload->display_errors());
				
                $data["errorUploadImage2"] = $error["error"];
            }
        }


        if (isset($_FILES['uploadImage_id3']['name']) && mb_strlen($_FILES['uploadImage_id3']['name'], 'UTF-8') > 0)
        {

            if ($this->upload->do_upload('uploadImage_id3'))
            {
                $data["upload_data3"] = array('upload_data' => $this->upload->data());

                $receivedData["Upload_Pic_3"] = $_FILES['uploadImage_id3']['name'];

                $this->do_resize($receivedData["Upload_Pic_3"]);
            }
            else
            {
                $error = array('error' => $this->upload->display_errors());
				
                $data["errorUploadImage3"] = $error["error"];
            }
        }



        if ($this->form_validation->run() == FALSE || (mb_strlen($data["errorUploadImage"], 'UTF-8') > 1 || mb_strlen($data["errorUploadImage2"], 'UTF-8') > 1 || mb_strlen($data["errorUploadImage3"], 'UTF-8') > 1)//|| ! $this->upload->do_upload()//
        )
        {

               }
        else
        {
            $receivedData["UsrLevel"] = $this->usrlevel;
			$receivedData["UserID"] = $this->userIdSession;
            $receivedData["StatusPro"] = "Pending";

			
		
			
            $this->load->model('Insertdata', '', TRUE);
            $this->Insertdata->InsertdataTable('ProductNum', $receivedData);
            $this->session->set_flashdata('newProductIntoSystem', "on");
            redirect('marketplace');
        }
        //var_dump($receivedData);
        $data["usrlevel"] = $this->usrlevel;
        $this->load->view('addpromarkplace', $data);
    }

    public function createheader()
    {

        $data = [];
        $userWhereaboutData = [];

        $data["AddProductMyMarketPlce"] = "on";
        $data["ActiveTips"] = $this->SelectData->SelectTipsFromSerice($this->usremail);//$this->SelectData->SelectDisplayTips();
        $data["lastTimeLogin"] = $this->userLastTimeLogin;
        $data["username"] = $this->username;
        $data = array_merge($this->returnAllUsrOfGroups($this->userIdSession), $data);
        return $data;
    }

    public function do_resize($filename)
    {
       


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
        if (!$this->image_lib->resize())
        {
            echo $this->image_lib->display_errors();
        }
    
        $this->image_lib->clear();
    }

    public function returnAllUsrOfGroups($usrID)
    {
        return $this->ViewUsersProcess->processViewFriendsRecorsMembers($this->SelectData2->returnMemberofAllGroups($usrID));
    }

}
