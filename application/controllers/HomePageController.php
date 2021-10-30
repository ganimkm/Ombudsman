<?php

    Class HomePageController extends MY_Controller {

    Public Function __construct()
    {
        
        parent::__construct();
        
        $this->load->model('HomePageModel');
        
    }

    Public function index()
    {
        $data = $this->data;     

        $home_page = $this->HomePageModel->Get_Home_Page($this->data['user_id']);     
        $data['is_admin'] = $this->data['is_admin'];
        
        redirect($home_page[0]['home_page_url']); 
        
    }

}