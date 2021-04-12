<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class order_checkout extends CI_Controller{
    
    public function  __construct(){
        parent::__construct();
        
        // Load form library
        $this->load->library('user_agent');
        // Load product model
        //$this->load->model('checkout_model');
        }
    
    public function index(){
        // Redirect if the cart is empty
        if($this->cart->total_items() <= 0){
            redirect('product/');
        }
    }

    // public function pay()
    // {
    //     $data['inputs'] = $this->input->post();
    //     $data['razorpay_key'] = [
    //         'keyId'=>'rzp_test_MvYpNVxH82Otvy',
    //         'secretKey'=>'mbx4frtsBCn4DutX970InH9n',
    //     ];
    //     $this->load->view('razorpay/Razorpay',$data);
    // }

    // public function success()
    // {
    //     $data['response'] = $this->input->post();
    //     $data['razorpay_key'] = [
    //         'keyId'=>'rzp_test_MvYpNVxH82Otvy',
    //         'secretKey'=>'mbx4frtsBCn4DutX970InH9n',
    //     ];
    //     $this->load->view('razorpay/Razorpay_fetch_payment',$data);
    // }

    // public function myaccount()
    // {
    //     echo '<h3>Payment inserted successfully.</h3>';
    // } 
}

