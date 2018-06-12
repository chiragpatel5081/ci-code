<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('login_model');
    }

    public function index() {
        //if ($this->session->userdata('admin_id') != '') {
            redirect('Dashboard');
        /*} else {
            $this->load->view('login/login'); 
        }*/
    }

    public function check() {
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            if ($user = $this->login_model->user_login($email, $password)) {
                $arraydata = array(
                    'admin_id' => $user[0]->admin_id,
                    'email' => $user[0]->email,
                    'user_type' => $user[0]->user_type,
                    'department' => $user[0]->a_designation_id,
                    'a_store_id' => $user[0]->a_store_id,
                    'first_name' => $user[0]->first_name,
                    'last_name' => $user[0]->last_name,
                );
                $this->session->set_userdata($arraydata);
                /* echo "admin_id: ". $this->session->userdata('admin_id');    			
                  echo "user_type: ". $this->session->userdata('user_type'); */
                $this->session->set_flashdata('message', 'Login Successfull');
                redirect('user');
            } else {

                $this->session->set_flashdata('error', 'Wrong email or password!');
                redirect('login');
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        $keys = array('admin_id', 'email');
        $this->session->unset_userdata($keys);
        $this->session->set_flashdata('message', 'Logout Successfull');

        redirect('login');
    }

    public function profile_data() {
        $this->login_model->profile_data();
    }

    //date('Y-m-j H:i:s');
}
