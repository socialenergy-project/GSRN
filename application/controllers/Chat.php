<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Chat
 *
 * @author John Papagiannis <intelen>
 */
class Chat extends CI_Controller
{

    //put your code here

    public $username;

    function __construct()
    {

        parent::__construct();
        //$this->load->model('Insertdata', '', TRUE);
        $this->load->library('session');
        //$this->load->model('Generalpurposes', '', TRUE);
        $this->load->model('Chatfun', '', TRUE);
        

        if ($this->session->userdata('logged_in') !== 1)
        {
            $this->username = "";
        }
        else
        {
            $this->username = $this->session->userdata('username');
        }
    }

    public function trafficLight()
    {

        if (!$this->input->is_AJAX_request())
        {
            exit('none AJAX calls rejected!');
        }


        if ($this->input->get('action') == "chatheartbeat")
        {
            $this->chatHeartbeat();
        }
        if ($this->input->get('action') == "sendchat")
        {
            $this->sendChat($this->input->post('to'),$this->input->post('message'));
        }
        if ($this->input->get('action') == "closechat")
        {
            $this->closeChat();
        }
        if ($this->input->get('action') == "startchatsession")
        {
            $this->startChatSession();
        }
    }

    public function chatHeartbeat()
    {
        
       
       
        $query =  $this->Chatfun->SelectChatRecords($this->username);
	$items = '';

	$chatBoxes = array();

	while ($chat = mysqli_fetch_array($query->result_id,MYSQLI_ASSOC)) {

		if (!isset($_SESSION['openChatBoxes'][$chat['from']]) && isset($_SESSION['chatHistory'][$chat['from']])) {
			$items = $_SESSION['chatHistory'][$chat['from']];
		}

		$chat['message'] = $this->sanitize($chat['message']);

		$items .= <<<EOD
					   {
			"s": "0",
			"f": "{$chat['from']}",
			"m": "{$chat['message']}"
	   },
EOD;

	if (!isset($_SESSION['chatHistory'][$chat['from']])) {
		$_SESSION['chatHistory'][$chat['from']] = '';
	}

	$_SESSION['chatHistory'][$chat['from']] .= <<<EOD
						   {
			"s": "0",
			"f": "{$chat['from']}",
			"m": "{$chat['message']}"
	   },
EOD;
		
		unset($_SESSION['tsChatBoxes'][$chat['from']]);
		$_SESSION['openChatBoxes'][$chat['from']] = $chat['sent'];
	}

	if (!empty($_SESSION['openChatBoxes'])) {
	foreach ($_SESSION['openChatBoxes'] as $chatbox => $time) {
		if (!isset($_SESSION['tsChatBoxes'][$chatbox])) {
			$now = time()-strtotime($time);
			$time = date('g:iA M dS', strtotime($time));

			$message = "Sent at $time";
			if ($now > 180) {
				$items .= <<<EOD
{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;

	if (!isset($_SESSION['chatHistory'][$chatbox])) {
		$_SESSION['chatHistory'][$chatbox] = '';
	}

	$_SESSION['chatHistory'][$chatbox] .= <<<EOD
		{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;
			$_SESSION['tsChatBoxes'][$chatbox] = 1;
		}
		}
	}
}

$this->Chatfun->UpdateChatRecord($this->username);
	//$sql = "update chat set recd = 1 where chat.to = '".mysql_real_escape_string($_SESSION['username'])."' and recd = 0";
	//$query = mysql_query($sql);

	if ($items != '') {
		$items = substr($items, 0, -1);
	}
header('Content-type: application/json');
?>
{
		"items": [
			<?php echo $items;?>
        ]
}

<?php
        
        
    }

    public function sendChat($to,$message)
    {
        
        
        $from = $this->username;
	$to = strip_tags(trim($to));//$this->input->post('to') -  $_POST['to'];
	$message =  $message;//$_POST['message'];

	$_SESSION['openChatBoxes'][$to] = date('Y-m-d H:i:s', time());
	
	$messagesan = $this->sanitize($message);

	if (!isset($_SESSION['chatHistory'][$to])) {
		$_SESSION['chatHistory'][$to] = '';
	}

	$_SESSION['chatHistory'][$to] .= <<<EOD
					   {
			"s": "1",
			"f": "{$to}",
			"m": "{$messagesan}"
	   },
EOD;


	unset($_SESSION['tsChatBoxes'][$to]);

        $this->Chatfun->insertRecordDB($from,$to,$message);
       
	echo "1";
        
    }

    public function closeChat()
    {
        
        unset($_SESSION['openChatBoxes'][$_POST['chatbox']]);
	
	echo "1";
        
    }

    public function startChatSession()
    {
       	$items = '';
	if (!empty($_SESSION['openChatBoxes'])) {
		foreach ($_SESSION['openChatBoxes'] as $chatbox => $void) {
			$items .= $this->chatBoxSession($chatbox);
		}
	}


	if ($items != '') {
		$items = substr($items, 0, -1);
	}

header('Content-type: application/json');
?>
{
		"username": "<?php echo $this->username;?>",
		"items": [
			<?php echo $items;?>
        ]
}

<?php
        
        
        
    }
    
    
    function chatBoxSession($chatbox) {
	
	$items = '';
	
	if (isset($_SESSION['chatHistory'][$chatbox])) {
		$items = $_SESSION['chatHistory'][$chatbox];
	}

	return $items;
}


function sanitize($text) {
        $text = strip_tags($text);
	$text = htmlspecialchars($text, ENT_QUOTES);
	$text = str_replace("\n\r","\n",$text);
	$text = str_replace("\r\n","\n",$text);
	$text = str_replace("\n","<br>",$text);
	return $text;
}
    

}
