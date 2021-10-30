<?php

Class IncidentMailController extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('helpdesk/ticket/IncidentModel');

    }

    function index() 
    {
        
        $incident_mail = $this->IncidentModel->get_incident_mail('0');

        foreach( $incident_mail as $counter => $row ){

            $from = $this->config->item('smtp_user');
            $to = $row['to_email_address'];
            $subject = $row['subject'];
            $message = $row['message'];

            $this->email->set_newline("\r\n");
            $this->email->from($from);
            $this->email->to($to);
            $this->email->subject($subject);
            $this->email->message($message);

            if ($this->email->send()) {

                $data_to_store = array(
                    'mail_sent' => '1',
                    'last_update_user_id' => '3100002'
                );
                
                if($this->IncidentModel->update_incident_mail($row['incident_number'],$data_to_store))
                {
                    $data['flash_message'] = TRUE; 
                }else{
                    $data['flash_message'] = FALSE; 
                }

            } else {
                show_error($this->email->print_debugger());
            }

        }

     }
     
}
?>