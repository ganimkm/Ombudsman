<?php

Class LoginController extends CI_Controller{
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('loginmodel');
        $this->load->model('usermodel');
    }

    function index() 
    {
        
        $this->form_validation->set_rules('user_id', 'User ID', 'trim|required|callback_is_user_valid');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_validate_user');
                
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><strong>Error !</strong> ','</div>');
       
        
        if($this->form_validation->run() == false) {
            
            $this->load->view('login');   

        } else { 

            redirect('home','refresh');
        }       
     }
     

    public function is_user_valid()
    {
        
        $user_id = $this->input->post('user_id');
        $result = $this->usermodel->get_user($user_id);
        
        if (empty($result)) {
            
            $this->form_validation->set_message('is_user_valid','Invalid User ID Or Password!. please try again.');
            return false;    
        }
    }
    
    public function is_email_valid()
    {
        
        $user_id = $this->input->post('user_id');
        $result = $this->usermodel->get_user($user_id);
        
        if ($result[0]['email'] == '') {
            
            $this->form_validation->set_message('is_email_valid','EMail Address not Registered!. please try again.');
            return false;    
        }
    }
    
    public function reset_password_valid()
    {
        
        $user_id = $this->uri->segment(3);
        $password = $this->uri->segment(4);
        
        $result = $this->usermodel->get_user($user_id);
        
        $reset_password=$result[0]['password'];
        
        if($reset_password != $password) {
            
            $this->form_validation->set_message('reset_password_valid','Reset Password Incorrect! please try again.');
            return false;    
        }
    }
    
    public function validate_user()
    {
        
        $user_id = $this->input->post('user_id');
        $password = $this->input->post('password');
        
        $result = $this->loginmodel->validate_user($user_id);
        
        if (!empty($result)) {
            
            $decode_password=$this->encrypt->decode($result[0]['password']);
            
            if($decode_password == $password) {

                $result = $this->loginmodel->get_user_data($user_id);

                $sess_array = array();

                    foreach($result as $row) {

                        $sess_array = array(
                            'user_id' => $row->user_id,
                            'user_name' => $row->user_name,
                            'is_admin' => $row->is_admin,
                            'is_active' => $row->is_active,
                            'is_ticket_resolver' => $row->is_ticket_resolver, 
                            'designation' => $row->designation);

                        $this->session->set_userdata('logged_in', $sess_array);

                    }      

            }else{

                $this->form_validation->set_message('validate_user','Invalid User ID Or Password!. please try again');
                return false;

            }
        
        }
  
    } 
    
    public function reset_password()
    {

        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            $this->form_validation->set_rules('user_id', 'user id', 'trim|required|callback_is_user_valid|callback_is_email_valid');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><strong>Error !</strong> ','</div>');
            
            //if the form has passed through the validation
            if ($this->form_validation->run()){
               
               $user_id = $this->input->post('user_id');
               $reset_password= $this->utility->random_password(64);
               
               $user = $this->usermodel->get_user($user_id);
           
               $subject='password reset';
                
               $message='<p>hi ' . $user[0]['user_name'] . ',</p>
                         <p>a password reset request has been recieved for your login at ' . $user_id . '.</p>
                         <p>to reset your password, please follow this link: <a href="'. base_url() . 'login/update_password/' . $user_id .'/' . $reset_password . '">reset password</a>.</p>
                         <p>with best regards<br>
                         </p>';
                
               if($this->send_email('ombudsman@snmail.org','edesk',$user[0]['email'],null,$subject,$message) == true)
               {
                   $data_to_store = array(
                        'password' => $reset_password
                    );

                    //if the insert has returned true then we show the flash message
                    if($this->loginmodel->update_password($user_id, $data_to_store) == true)
                    {
                        $this->session->set_flashdata('flash_message', 'updated');
                    }else{
                        $this->session->set_flashdata('flash_message', 'not_updated');
                    }

                    redirect('login/reset_password');
                   
               }

            }//validation run

        }
        
        $this->load->view('reset_password');   

    }
    
    public function update_password()
    {
  
        $data['user_id'] = $this->uri->segment(3);
        $data['password'] = $this->uri->segment(4);
        
        if ($this->input->server('REQUEST_METHOD') === 'POST'){
 
            $this->form_validation->set_rules('user_id', 'user id', 'trim|required|callback_is_user_valid|callback_reset_password_valid');
            $this->form_validation->set_rules('password', 'new password', 'trim|required');
            $this->form_validation->set_rules('confirm_password', 'new password again', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><strong>Error !</strong> ','</div>');
            
            //if the form has passed through the validation
            if ($this->form_validation->run()){
                
               $user_id = $this->input->post('user_id');
               $password= $this->input->post('password');
              
               $data_to_store = array(
                    'password' => $this->encrypt->encode($password)
                );

                //if the insert has returned true then we show the flash message
                if($this->loginmodel->update_password($user_id, $data_to_store) == true)
                {
                    $this->session->set_flashdata('flash_message', 'updated');
                    redirect('login');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }   
                
            }//validation run

        }

        $this->load->view('update_password',$data);   

    }
    
    public function logout(){
        
     //remove all session data
     $this->session->unset_userdata('logged_in');
     $this->session->sess_destroy();
     
     redirect('login', 'refresh');
     
    }
    
    function send_email($from,$from_name=null,$to,$cc=null,$subject,$message) {

        if ($from_name == null){
            $from_name=$from;
        }
 
        $this->email->from($from, $from_name);
        $this->email->to($to);
        
        if ($cc != null){
            $this->email->cc($cc);
        }
        
        $this->email->subject($subject);
        $this->email->message($message);

        $this->email->send();

        return $this->email->print_debugger();
        
    }
    
}
?>