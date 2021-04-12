<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

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
		$this->load->model('contact_model');
		$this->load->library('cart','email');
		$this->load->helper('form');
	}

	public function index()
	{
		$this->load->view('contact');
	}

	public function contact_validation()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('contact_name','Name', 'trim|required');
		$this->form_validation->set_rules('contact_subject','Subject', 'trim|required');
		$this->form_validation->set_rules('contact_email','Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('contact_msg','Message', 'trim|required');
		$this->form_validation->set_error_delimiters("<div class='text-danger'>","</div>");
		if($this->form_validation->run())
		{
			$formdata = array(
			'name' => $this->input->post('contact_name',true),
 		    'subject' => $this->input->post('contact_subject',true),
 		    'email' => $this->input->post('contact_email',true),
 		    'message' => $this->input->post('contact_msg',true),
 			);

			$this->load->model('contact_model');
			$result = $this->contact_model->contact($formdata);
			if($result)
			{
				$config['mailtype'] = 'html';
				$this->email->initialize($config);
			    // $this->email->from(set_value('email'),set_value('name'));
			    $this->email->from($formdata['email'],$formdata['name']);
			    //$this->email->to("$user_email");
			    $this->email->to('geetaverma6653@gmail.com');
			    $this->email->subject($formdata['subject']);
			    $link = base_url('forget_password/reset_password');
			    $message = $formdata['message'];
			    $this->email->message($message);
			    $this->email->set_newline("\r\n");

			    // $this->email->send();
			     if($this->email->send()) {
			     	//echo "Your e-mail has been sent!";
			     	$this->session->set_flashdata('msg_sent','Your message has been sent');
					$this->load->view('contact');
			   		 }
				 else {
				    show_error($this->email->print_debugger());
				  }
				}
			else
			{
				$this->session->set_flashdata('msg_not_sent','There is a problem to send your message');
				$this->load->view('contact');
			}
		}
	 	else
	 	{
	 		$this->load->view('contact');
	 	}
	 }
}
