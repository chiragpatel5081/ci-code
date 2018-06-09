<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model('sales_model');
        $this->load->model('product_model');
        $this->load->model('Customer_model');
        $this->load->model('user_model');
        $this->load->model('Settings_shop_model');
        $this->load->model('settings_business_model');
        $this->load->model('Settings_invoice_model');
        $this->load->model('Report_customer_model');
        date_default_timezone_set('Asia/Kolkata');

    }
    public function index() 
    {
        $data['list'] = $this->sales_model->list();
        $this->load->view('sales/list',$data);
    }
    public function add()
    {

        $data['cafe_sell_list'] = $this->sales_model->cafe_sell_list();
        $data['products'] = $this->product_model->ProductList();
        $data['customer'] = $this->Customer_model->CustomerList();        
        $this->load->view('sales/add',$data);
    }
    public function product_id() {
        $id = $this->input->post('pro_id');
        $product= $this->sales_model->product_id($id);
        echo json_encode($product);
    }
    public function Add_data() {
               
       $pro_all_id=$this->input->post('pro_id_my');               
       $p_id=json_encode($pro_all_id);
       
        $this->form_validation->set_rules('sub_total', 'Product Not Select!', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if ($this->form_validation->run() == false) {

            $this->session->set_flashdata('error', 'sales Not Addded');
            $this->add();

        } else {
            $data = array(
                'sell_invoice_no'     => $this->input->post('sell_invoice_no'),            
                'sell_customer_id'      => $this->input->post('customer_id'),                        
                'sell_total'            => $this->input->post('main_total'),
                'sell_igst'             => $this->input->post('igst'),
                'sell_sgst'             => $this->input->post('sgst'),
                'sell_cgst'             => $this->input->post('cgst'),
                'sell_inclusive'        => $this->input->post('radio_2'),
                'sell_total_igst'       => $this->input->post('total_igst'),
                'sell_total_sgst'       => $this->input->post('total_sgst'),
                'sell_total_cgst'       => $this->input->post('total_cgst'),
                'sell_total_tax'        => $this->input->post('total_tax'),
                'sell_total_tax_val'    => $this->input->post('total_tax_val'),
                'sell_sub_total'        => $this->input->post('sub_total'),
                'sell_pro_all_id'       => $p_id,
                'sell_create_by'        => $this->session->userdata('admin_id'),
                'sell_create_date'      => date('Y-m-d H:i:s'),
            );     

            if ($lastid=$this->sales_model->Add_data($data)) 
            {
                for ($i=0;$i<count($pro_all_id);$i++)
                {           
                     $pro = array(
                        'sell_pro_product_id'       => $pro_all_id[$i],
                        'sell_pro_inv_no'           => $this->input->post('sell_invoice_no'),             
                        'sell_pro_sell_id'          => $lastid,                        
                        'sell_pro_qty'              => $this->input->post('qty_'.$pro_all_id[$i]),
                        'sell_pro_price'            => $this->input->post('price_'.$pro_all_id[$i]),
                        'sell_pro_total'            => $this->input->post('total_'.$pro_all_id[$i]),
                        'sell_pro_create_date'      => date('Y-m-d H:i:s'),
                    );                     
                    $this->sales_model->Add_pro($pro);
                } 

                $this->session->set_flashdata('message', 'Sales Add Successfull');
                redirect('sales', 'refresh');

            } else {
                $this->session->set_flashdata('error', 'Sales Add Not Successfull');
                $this->Add_data();
            }
        }      
    }  

 public function pay($sell_id) {

    $data['pay'] = $this->sales_model->pay_list();        
    $data['data'] = $this->sales_model->pay_edit($sell_id);        
    $this->load->view('sales/pay', $data);
}  

public function delete($sell_id) {

    if($this->sales_model->delete($sell_id))
    {
        $this->session->set_flashdata('message', 'Delete Expense Successfull');
        redirect('sales', 'refresh');
    }
    else{
        $this->session->set_flashdata('error', 'Delete Expense Not Successfull');
        redirect('sales', 'refresh');
    }    

} 
public function  view_data($sell_id) 
{

    $data['cafe_sell_list'] = $this->sales_model->cafe_sell_list();
    $data['products'] = $this->product_model->ProductList();
    $data['customer'] = $this->Customer_model->CustomerList(); 
    $data['data'] = $this->sales_model->edit($sell_id);        
    $data['pro'] = $this->sales_model->edit_pro($sell_id);  
    $this->load->view('sales/view_data',$data);
}
public function sales_pay(){
    $sell_id=$this->input->post('sell_id');
    
        $data = array(
            'pay_reference_no'  => $this->input->post('pay_reference_no'),            
            'pay_sell_id'       => $this->input->post('sell_id'),                        
            'pay_date'          => date('Y-m-d',strtotime(str_replace('/', '-',$this->input->post('pay_date')))),
            'pay_description'   => $this->input->post('pay_description'),
            'pay_create_by'     => $this->session->userdata('admin_id'),
            'pay_create_date'   => date('Y-m-d H:i:s'),
        );
        if ($this->sales_model->sales_pay($sell_id,$data)) 
        {
            $this->session->set_flashdata('message', 'Sales Pay Successfull');
            redirect('sales', 'refresh');

        } else {
            $this->session->set_flashdata('error', 'Sales Pay Not Successfull');
            $this->pay();
        } 

}
public function pdf($sell_id){
        

  
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        ob_start();
        $html = ob_get_clean();
        $html = utf8_encode($html);
        
        $data['business'] = $this->settings_business_model->list();
        $data['invoice'] = $this->Settings_invoice_model->list();
        $data['shop'] = $this->Settings_shop_model->list();
        $data['cafe_sell_list'] = $this->sales_model->cafe_sell_list();
        $data['products'] = $this->product_model->ProductList();
        $data['customer'] = $this->Customer_model->CustomerList(); 
        $data['sales'] = $this->sales_model->edit($sell_id);        
        $data['pro'] = $this->sales_model->edit_pro($sell_id);
        $html = $this->load->view('sales/pdf', $data, true);
       
        $pdf->allow_charset_conversion=true;
        $pdf->charset_in='UTF-8';        
        $pdf->autoLangToFont = true;

        $pdf->WriteHTML($html);
        $pdf->Output('INV-'.$data['pro'][0]->sell_invoice_no.'pdf','I');
    }
    public function print($sell_id){  
                
        $data['business'] = $this->settings_business_model->list();
        $data['invoice'] = $this->Settings_invoice_model->list();
        $data['shop'] = $this->Settings_shop_model->list();
        $data['cafe_sell_list'] = $this->sales_model->cafe_sell_list();
        $data['products'] = $this->product_model->ProductList();
        $data['customer'] = $this->Customer_model->CustomerList(); 
        $data['sales'] = $this->sales_model->edit($sell_id);        
        $data['pro'] = $this->sales_model->edit_pro($sell_id);
        $this->load->view('sales/pdf', $data);               
        
    }
    public function  customer_data($customer_id) 
    {

        $data['customer_data'] = $this->Report_customer_model->customer_data($customer_id);
        $this->load->view('sales/customer_data',$data);
    }

}
?>