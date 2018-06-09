<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('user_model');
        date_default_timezone_set('Asia/Kolkata');

    }
    public function index() 
    {
        $data['User_list'] = $this->user_model->User_list();
        $this->load->view('user/list',$data);
    }
    public function userAdd()
    {
        $data['cafe_role'] = $this->user_model->cafe_role();
        $this->load->view('user/add', $data);
    }
    public function user_Add() {
       

        $this->form_validation->set_rules('first_name', 'first name', 'required|alpha');

        $this->form_validation->set_rules('last_name', 'last name', 'required|alpha');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        $this->form_validation->set_rules('phone', 'phone', 'required|numeric');

        $this->form_validation->set_rules('user_type', 'user type', 'required');

        $this->form_validation->set_rules('password', 'password', 'required|min_length[6]');

        $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'required|matches[password]');
        
        $username = $this->input->post('username');

        $this->form_validation->set_rules('username', 'username', 'required|trim|callback_alias_exist_check[' . $username . ']');


        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if ($this->form_validation->run() == false) {

            $this->session->set_flashdata('error', 'User Not Addded');

            $this->userAdd();

        } else {

            $data = array(                

                'admin_prefix' => $this->input->post('admin_prefix'),

                'admin_first_name' => $this->input->post('first_name'),

                'admin_last_name' => $this->input->post('last_name'),

                'admin_email' => $this->input->post('email'),

                'admin_mobile' => $this->input->post('phone'),

                'admin_role' => $this->input->post('user_type'),

                'admin_username' => $this->input->post('username'),

                'admin_password' => md5($this->input->post('password')),

                'admin_create_date' => date('Y-m-d H:i:s'),

                'admin_create_by' => $this->session->userdata('admin_id'),

            );

            if ($this->user_model->user_Add($data)) {

                $this->session->set_flashdata('message', 'User Added Successfull');

                redirect('user','refresh');

            } else {

                $this->session->set_flashdata('error', 'User Not Added');

                $this->userAdd();

            }

        }

    }
    public function alias_exist_check($username) {

        $query = $this->db->get_where('cafe_admin', array('admin_username' => $username));

        if ($query->num_rows() != 0) {

            $this->form_validation->set_message('alias_exist_check', 'username Already exists.');

            return FALSE;

        } else {

            return TRUE;

        }

    }
    public function edit($admin_id) {

        $data['data'] = $this->user_model->edit($admin_id);
        $data['cafe_role'] = $this->user_model->cafe_role();        
        $this->load->view('user/edit', $data);
    }

    public function update() {

        $admin_id = $this->input->post('admin_id');        

        $this->form_validation->set_rules('username', 'username', 'required|trim|callback_alias_exist[' . $admin_id . ']');

        $this->form_validation->set_rules('first_name', 'first name', 'required|alpha');

        $this->form_validation->set_rules('last_name', 'last name', 'required|alpha');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        $this->form_validation->set_rules('phone', 'phone', 'required|numeric');

        $this->form_validation->set_rules('user_type', 'user type', 'required');

        

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if ($this->form_validation->run() == false) {

            $this->session->set_flashdata('error', 'User Update Not Successfull');

            $this->edit($admin_id);

        } else {

            $data = array(                

                'admin_prefix' => $this->input->post('admin_prefix'),

                'admin_first_name' => $this->input->post('first_name'),

                'admin_last_name' => $this->input->post('last_name'),

                'admin_email' => $this->input->post('email'),

                'admin_mobile' => $this->input->post('phone'),

                'admin_username' => $this->input->post('username'),

                'admin_role' => $this->input->post('user_type'),

                'admin_update_date' => date('Y-m-d H:i:s'),

                'admin_update_by' => $this->session->userdata('admin_id'),

            );

            if ($this->user_model->update($admin_id, $data)) {

                $this->session->set_flashdata('message', 'User Updated Successfull');

                redirect('user', 'refresh');

            } else {
                $this->session->set_flashdata('error', 'User Update Not Successfull');
                $this->edit($admin_id);
            }

        }

    }
    public function alias_exist($username,$admin_id) {

        $query = $this->db->get_where('cafe_admin', array('admin_username' => $username,'admin_id !=' => $admin_id));

        if ($query->num_rows() != 0) {

            $this->form_validation->set_message('alias_exist', 'username Already exists.');

            return FALSE;

        } else {

            return TRUE;

        }

    }

    public function delete($admin_id) {

        if($this->user_model->delete($admin_id))
        {
            $this->session->set_flashdata('message', 'Delete User Successfull');
            redirect('User', 'refresh');
        }
        else{
            $this->session->set_flashdata('error', 'Delete User Not Successfull');
            redirect('User', 'refresh');
        }    

    }     

    public function change_password($admin_id) {

        $data['data'] = $this->user_model->edit($admin_id);
        $this->load->view('user/password', $data);

    }



    public function update_password() {

        $admin_id = $this->input->post('admin_id');

        

        
        $this->form_validation->set_rules('password', 'password', 'required|min_length[6]');

        $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'required|matches[password]');
        
       

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if ($this->form_validation->run() == false) {

            $this->session->set_flashdata('error', 'Username or password Not Update Successfull');

            $this->change_password($admin_id);

        } else {

            $data = array(               
                'admin_password' => md5($this->input->post('password')),
            );

            if ($this->user_model->update_password($data, $admin_id)) {

                $this->session->set_flashdata('message', 'Username or password Updated Successfull');                
                $this->edit($admin_id);


            } else {
                $this->session->set_flashdata('error', 'Username or password Not Update Successfull');
                $this->change_password($admin_id);

            }
        }

    }    
}
?>