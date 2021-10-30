<?php

Class EmailController extends CI_Controller {
    
    Public Function __construct()
    {
        
        parent::__construct();
        
        if(!$this->session->userdata('logged_in')){
            redirect('login','refresh');
        }
    }
    
    public function index() {
        redirect('EmailController/send_email');
    }

    public function send_email() {

        $this->email->from('dba@snmail.org', 'Naandhan');
        $this->email->to('helpdesk@snmail.org');

        $this->email->subject('This is a html email');
        $html = 'This is an <b>HTML</b> email';
        $this->email->message($html);

        $this->email->send();

        echo $this->email->print_debugger();
    }
}

