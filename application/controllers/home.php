<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function index() {
        $this->load->model('User_model');
        $data['all_data'] = $this->User_model->viewAll();
        $this->load->view('home',$data);
    }
}
