<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    
        
        
        hello world
<?php


set_time_limit(4000); 
         //
// Connect to gmail
//$imapPath = '{imap.gmail.com:993/imap/ssl}INBOX';
$username = 'dba@snmail.org';
$password = 'Server@2012';
$server='snmail.org';

// try to connect 
//$inbox = imap_open($imapPath,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());
$openmail = imap_open('{'.$server.'/notls}', $username, $password);
 
   /* ALL - return all messages matching the rest of the criteria
    ANSWERED - match messages with the \\ANSWERED flag set
    BCC "string" - match messages with "string" in the Bcc: field
    BEFORE "date" - match messages with Date: before "date"
    BODY "string" - match messages with "string" in the body of the message
    CC "string" - match messages with "string" in the Cc: field
    DELETED - match deleted messages
    FLAGGED - match messages with the \\FLAGGED (sometimes referred to as Important or Urgent) flag set
    FROM "string" - match messages with "string" in the From: field
    KEYWORD "string" - match messages with "string" as a keyword
    NEW - match new messages
    OLD - match old messages
    ON "date" - match messages with Date: matching "date"
    RECENT - match messages with the \\RECENT flag set
    SEEN - match messages that have been read (the \\SEEN flag is set)
    SINCE "date" - match messages with Date: after "date"
    SUBJECT "string" - match messages with "string" in the Subject:
    TEXT "string" - match messages with text "string"
    TO "string" - match messages with "string" in the To:
    UNANSWERED - match messages that have not been answered
    UNDELETED - match messages that are not deleted
    UNFLAGGED - match messages that are not flagged
    UNKEYWORD "string" - match messages that do not have the keyword "string"
    UNSEEN - match messages which have not been read yet*/
 
// search and get unseen emails, function will return email ids
 if ($openmail) {

                                    echo  "You have ".imap_num_msg($openmail). " messages in your inbox\n\r";

                                    for($i=1; $i <= 100; $i++) {
                                   
                                                $header = imap_header($openmail,$i);
                                                echo "<br>";
                                                echo $header->Subject." (".$header->Date.")";
                                    }

                        echo "\n\r";
                        $msg = imap_fetchbody($openmail,1,"","FT_PEEK");
                       
                        /*
                        $msgBody = imap_fetchbody ($openmail, $i, "2.1");
                        if ($msgBody == "") {
                        $partno = "2.1";
                        $ msgBody = imap_fetchbody ($openmail, $i, $partno);
                        }

                        $ msgBody = trim(substr(quoted_printable_decode($msgBody), 0, 200));
                       
                        */
                        echo $msg;
                        imap_close($openmail);
                        }



                        else {

                        echo "False";

                        }

/*

class Email_reader {
 
	// imap server connection
	public $conn;
 
	// inbox storage and inbox message count
	private $inbox;
	public $msg_cnt;
 
	// email login credentials
	private $server = 'snmail.org';
	private $user   = 'dba@snmail.org';
	private $pass   = 'Server@2012';
	private $port   = 143; // adjust according to server settings
 
	// connect to the server and get the inbox emails
	function __construct() {
		$this->connect();
		$this->inbox();
	}
 
	// close the server connection
	function close() {
		$this->inbox = array();
		$this->msg_cnt = 0;
 
		imap_close($this->conn);
	}
 
	// open the server connection
	// the imap_open function parameters will need to be changed for the particular server
	// these are laid out to connect to a Dreamhost IMAP server
	function connect() {
		$this->conn = imap_open('{'.$this->server.'/notls}', $this->user, $this->pass);
	}
 
	// move the message to a new folder
	function move($msg_index, $folder='INBOX.Processed') {
		// move on server
		imap_mail_move($this->conn, $msg_index, $folder);
		imap_expunge($this->conn);
 
		// re-read the inbox
		$this->inbox();
	}
 
	// get a specific message (1 = first email, 2 = second email, etc.)
	function get($msg_index=NULL) {
		if (count($this->inbox) <= 0) {
			return array();
		}
		elseif ( ! is_null($msg_index) && isset($this->inbox[$msg_index])) {
			return $this->inbox[$msg_index];
		}
 
		return $this->inbox[0];
	}
 
	// read the inbox
	function inbox() {
		$this->msg_cnt = imap_num_msg($this->conn);
 
		$in = array();
		for($i = 1; $i <= 50; $i++) {
			$in[] = array(
				'index'     => $i,
				'header'    => imap_headerinfo($this->conn, $i),
				'body'      => imap_body($this->conn, $i),
				'structure' => imap_fetchstructure($this->conn, $i)
			);
                           
		}
 
		$this->inbox = $in;            
               
	}
 
}

ini_set('max_execution_time', 14000);

$instance= new Email_reader();
$emails=$instance->inbox();

foreach($emails as $mail) {
	
	$headerInfo = $mail['header'];
	
	$output .= $headerInfo->subject.'<br/>';
	$output .= $headerInfo->toaddress.'<br/>';
	$output .= $headerInfo->date.'<br/>';
	$output .= $headerInfo->fromaddress.'<br/>';
	$output .= $headerInfo->reply_toaddress.'<br/>';
	/*
	$emailStructure = imap_fetchstructure($inbox,$mail);
	
	if(!isset($emailStructure->parts)) {
		 $output .= imap_body($inbox, $mail, FT_PEEK); 
	} else {
	    //	
	}
     
        
        
   echo $output;
   $output = '';
}
*/
    ?>
        
      
</html>
