<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_model extends CI_model 
{     
    public function list()
    {     
        $this->db->select('*'); 
        $this->db->from('cafe_sell s'); 
        $this->db->join('cafe_customer c','s.sell_customer_id=c.customer_id', 'left');
        $this->db->order_by('sell_id', 'DESC');
        $this->db->where('sell_status','0');    
        $data = $this->db->get();
        return $data->result();
    }  
    public function cafe_sell_list()
    {     
        $this->db->select('*'); 
        $this->db->from('cafe_sell'); 
        $this->db->where('sell_status','0');    
        $data = $this->db->get();
        return $data->result();
    }
    public function pay_list()
    {     
        $this->db->select('*'); 
        $this->db->from('cafe_pay'); 
        $this->db->where('pay_status','0');    
        $data = $this->db->get();
        return $data->result();
    }
    public function pay_edit($sell_id)
    {     
        $this->db->select('*'); 
        $this->db->from('cafe_sell s'); 
        $this->db->join('cafe_sell_pro sp','s.sell_id=sp.sell_pro_sell_id', 'left'); 
        $this->db->join('cafe_products p', 'sp.sell_pro_product_id=p.product_id', 'left');
        $this->db->join('cafe_unit u', 'p.product_unit_id=u.unit_id', 'left'); 
        $this->db->join('cafe_customer c','s.sell_customer_id=c.customer_id', 'left');         
        $this->db->where('s.sell_id',$sell_id);   
        $data = $this->db->get();
        return $data->result();
    }    
    public function view_data($sell_id)
    {     
        $this->db->select('*'); 
        $this->db->from('cafe_expense e'); 
        $this->db->join('cafe_business b','e.exp_business_location=b.business_id', 'left'); 
        $this->db->join('cafe_expense_category ec','e.exp_category_id=ec.exp_cat_id', 'left'); 
        $this->db->join('cafe_admin a','on e.exp_for_role=a.admin_id', 'left');
        $this->db->join('cafe_role r', 'a.admin_role = r.role_id', 'left'); 
        $this->db->where('sell_status','0');    
        $this->db->where('sell_id',$sell_id);    
        $data = $this->db->get();
        return $data->row_array();
    } 
    public function Add_data($data)
    {         
        if($this->db->insert('cafe_sell',$data))
        {
            $lastid=$this->db->insert_id();
            return $lastid;              
        }
        else
        {
            return false;               
        }            
    } 
    public function sales_pay($sell_id,$data)
    {         
        if($this->db->insert('cafe_pay',$data))
        {
            $data = array('sell_pay' =>1);        
            $this->db->where('sell_id',$sell_id);
            $this->db->update('cafe_sell',$data);
            return true;              
        }
        else
        {
            return false;               
        }            
    } 
    public function Add_pro($pro)
    {         
        if($this->db->insert('cafe_sell_pro',$pro))
        {            
            return true;              
        }
        else
        {
            return false;               
        }            
    } 
    public function edit($sell_id)
    {     
        $this->db->select('*'); 
        $this->db->from('cafe_sell');        
        $this->db->where('sell_id',$sell_id);           
        $data = $this->db->get();
        return $data->result();
    }
    public function edit_pro($sell_id)
    {     
        $this->db->select('*'); 
        $this->db->from('cafe_sell s'); 
        $this->db->join('cafe_sell_pro sp','s.sell_id=sp.sell_pro_sell_id', 'left'); 
        $this->db->join('cafe_products p', 'sp.sell_pro_product_id=p.product_id', 'left');
        $this->db->join('cafe_unit u', 'p.product_unit_id=u.unit_id', 'left');          
        $this->db->where('sell_id',$sell_id);   
        $data = $this->db->get();
        return $data->result();
    }
    public function update($sell_id,$data)
    {
        $this->db->where('sell_id',$sell_id);
        return $this->db->update('cafe_sell',$data);
    }
    public function delete($sell_id)
    {     
        $data = array('sell_status' =>1);
        
        $this->db->where('sell_id',$sell_id);
        if($this->db->update('cafe_sell',$data))                  
        {
            $data = array('sell_pro_status' =>1);        
            $this->db->where('sell_pro_sell_id',$sell_id);
            $this->db->update('cafe_sell_pro',$data);
            return true;
        }
        else
        {
           return false;               
        }          
    } 

    public function product_id($id) {
        $this->db->select('*');
        $this->db->from('cafe_products p');
        $this->db->join('cafe_unit u', 'p.product_unit_id=u.unit_id', 'left');
        $this->db->join('cafe_category c', 'p.product_category_id=c.cat_id', 'left');
        $this->db->join('cafe_sub_category sc', 'p.product_sub_category_id=sc.sub_id', 'left');
        $this->db->join('cafe_tax t', 'p.product_tax=t.tax_id', 'left');
        $this->db->where('product_status', 0);
        $this->db->where('product_id', $id);
        $this->db->order_by('product_id', 'DESC');
        return $this->db->get()->row_array();
    }   
}
?>        