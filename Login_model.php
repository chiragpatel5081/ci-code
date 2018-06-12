<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	
	/*public function user_login($email,$password) 
	{
		$pass=md5($password);
        $this->db->select('*');
		$this->db->from('admin');
		$this->db->where('email',$email);
		$this->db->where('password',$pass);
		$user=$this->db->get();		
		if ($user) 
		{			
	        return $user->result();	
		}
		else{
			return false;
		}		
	}*/		
}
