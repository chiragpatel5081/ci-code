<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_model 
{     
    public function cafe_role()
    {     
        $this->db->select('*'); 
        $this->db->from('cafe_role'); 
        $this->db->where('role_status','0');     
        $data = $this->db->get();
        return $data->result();
    } 
    public function User_list()
    {     
        $this->db->select('*'); 
        $this->db->from('cafe_admin a');
        $this->db->join('cafe_role r', 'a.admin_role = r.role_id', 'left');          
        $this->db->where('a.admin_status','0');           
        $this->db->where('a.admin_type','user');           
        $data = $this->db->get();
        return $data->result();
    } 
    public function user_Add($data)
    {         
        if($this->db->insert('cafe_admin',$data))
        {
            return true;              
        }
        else
        {
            return false;               
        }            
    } 
    public function edit($admin_id)
    {     
        $this->db->select('*'); 
        $this->db->from('cafe_admin');        
        $this->db->where('admin_id',$admin_id);           
        $data = $this->db->get();
        return $data->result();
    }
    public function update($admin_id,$data)
    {
        $this->db->where('admin_id',$admin_id);
        return $this->db->update('cafe_admin',$data);
    }
    public function delete($admin_id)
    {     
        $data = array('admin_status' =>1);
        
        $this->db->where('admin_id',$admin_id);
        if($this->db->update('cafe_admin',$data))                  
        {
           
            return true;
        }
        else
        {
           return false;               
        }          
    }
    public function update_password($data,$admin_id)
    {
        $this->db->where('admin_id',$admin_id);
        return $this->db->update('cafe_admin',$data);
    }
}
?>        