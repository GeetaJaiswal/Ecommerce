<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
	{
		parent::__construct();
		$this->load->model('product_model');
		$this->load->library('cart','user_agent');
		$this->load->helper('form');
        $this->load->library('stripe_lib'); 
	}

	function index()
	{
        $data = array();
		$data['product'] = $this->product_model->all_product();
		$this->load->view('home',$data);
	}


    // function purchase($id){
    //     $data = array();
        
    //     // Get product data from the database
    //     $product = $this->product_model->all_product($id);
        
    //     // If payment form is submitted with token
    //     if($this->input->post('stripeToken')){
    //         // Retrieve stripe token, card and user info from the submitted form data
    //         $postData = $this->input->post();
    //         $postData['product'] = $product;
            
    //         // Make payment
    //         $paymentID = $this->payment($postData);
            
    //         // If payment successful
    //         if($paymentID){
    //             redirect('payment_status/'.$paymentID);
    //         }else{
    //             $apiError = !empty($this->stripe_lib->api_error)?' ('.$this->stripe_lib->api_error.')':'';
    //             $data['error_msg'] = 'Transaction has been failed!'.$apiError;
    //         }
    //     }
        
    //     // Pass product data to the details view
    //     $data['product'] = $product;
    //     $this->load->view('details', $data);
    // }





    //     function payment($postData){
        
    //     // If post data is not empty
    //     if(!empty($postData)){
    //         // Retrieve stripe token, card and user info from the submitted form data
    //         $token  = $postData['stripeToken'];
    //         $name = $postData['name'];
    //         $email = $postData['email'];
    //         $card_number = $postData['card_number'];
    //         $card_number = preg_replace('/\s+/', '', $card_number);
    //         $card_exp_month = $postData['card_exp_month'];
    //         $card_exp_year = $postData['card_exp_year'];
    //         $card_cvc = $postData['card_cvc'];
            
    //         // Unique order ID
    //         $orderID = strtoupper(str_replace('.','',uniqid('', true)));
            
    //         // Add customer to stripe
    //         $customer = $this->stripe_lib->addCustomer($email, $token);
            
    //         if($customer){
    //             // Charge a credit or a debit card
    //             $charge = $this->stripe_lib->createCharge($customer->id, $postData['product']['name'], $postData['product']['price'], $orderID);
                
    //             if($charge){
    //                 // Check whether the charge is successful
    //                 if($charge['amount_refunded'] == 0 && empty($charge['failure_code']) && $charge['paid'] == 1 && $charge['captured'] == 1){
    //                     // Transaction details 
    //                     $transactionID = $charge['balance_transaction'];
    //                     $paidAmount = $charge['amount'];
    //                     $paidAmount = ($paidAmount/100);
    //                     $paidCurrency = $charge['currency'];
    //                     $payment_status = $charge['status'];
                        
                        
    //                     // Insert tansaction data into the database
    //                     $orderData = array(
    //                         'product_id' => $postData['product']['id'],
    //                         'buyer_name' => $name,
    //                         'buyer_email' => $email,
    //                         'card_number' => $card_number,
    //                         'card_exp_month' => $card_exp_month,
    //                         'card_exp_year' => $card_exp_year,
    //                         'paid_amount' => $paidAmount,
    //                         'paid_amount_currency' => $paidCurrency,
    //                         'txn_id' => $transactionID,
    //                         'payment_status' => $payment_status
    //                     );
    //                     $orderID = $this->product->insertOrder($orderData);
                        
    //                     // If the order is successful
    //                     if($payment_status == 'succeeded'){
    //                         return $orderID;
    //                     }
    //                 }
    //             }
    //         }
    //     }
    //     return false;
    // }
    
    // function payment_status($id){
    //     $data = array();
        
    //     // Get order data from the database
    //     $order = $this->product->getOrder($id);
        
    //     // Pass order data to the view
    //     $data['order'] = $order;
    //     $this->load->view('payment-status', $data);
    // }



	function detailproduct($id)
	{
		$data['product'] = $this->product_model->product_select_by_id($id);
		$this->load->view('detailed_product',$data);
	}

	function insert_cart_data()
    {    
        // Fetch specific product by ID
        $id = $this->input->post('id');
        $data = $this->product_model->select_data("SELECT * FROM products WHERE id ='$id'");
        //return var_dump($data);
        
        // Add product to the cart
        
            $id    = $data['id'];
            $qty    = $data['quantity'];
            $price    = $data['price'];
            $name    = $data['name'];
            $image = $data['product_img'];
        

        $values = array(
        	'id'     => $id,
         	'qty'    => $qty,
            'price'  => $price,
            'name'   => $name,
            'image'  => $image
        );

        $this->cart->insert($values);
        redirect(base_url().'product/view_cart');
    }

    function view_cart()
    { 
    	$data['product'] = $this->cart->contents();
    	$this->load->view('cart', $data);
    }

    function update_cart()
    {
        //$update = 0;
    	$id = $this->input->post('id');
    	$qty = $this->input->post('qty');

    	$data = array(
        'rowid' => $id,
        'qty'   => $qty
        );
        $this->load->library('cart');
        $this->cart->update($data);      
        // Return response
        print_r($data);
       
        // echo $update?'ok':'err';
    }
    

    function delete_cart_item()
    {
    	$id = $this->uri->segment(3);
    	$this->cart->remove($id);
    	redirect(base_url('product/view_cart'));
    }

    function enter_details()
    {
    	$this->load->view('enter_details');
    }

    function search()
    {
        $key = $this->input->post('key',true);
        $this->session->set_userdata('key',$key);
        $data['store'] = $this->product_model->set($key);
        // print_r($data);
        $this->load->view('search',$data);
    }
}
