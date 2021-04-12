<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class forget_password extends CI_Controller {

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
		$this->load->model('user_forget_password');
		$this->load->helper('form');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->load->view('forget_password');
	}

	public function reset_password()
	{
		$this->load->view('reset_password');
	}

	public function user_reset_password()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('new_password',' New Password', 'required');
		$this->form_validation->set_rules('confirm_password','Confirm Password', 'required');
		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|matches[confirm_password]');
		$this->form_validation->set_error_delimiters("<div class='text-danger'>","</div>");

		if($this->form_validation->run())
		{
			$user_email = $this->session->userdata('user_email');
			$new_password = $this->input->post('new_password');
			$confirm_password = $this->input->post('confirm_password');
			$this->load->model('user_forget_password');
			$ret = $this->user_forget_password->reset_password($user_email, $new_password, $confirm_password);
			if($ret)
			{
				$this->session->set_flashdata('password_update','Your password has been updated');
				$this->load->view('reset_password');
			}
			$this->load->view('reset_password');
		}
		else
		{
			$this->session->set_flashdata('password_not_update','There is a problem to update your password');
			$this->load->view('reset_password');
		}
	}

	public function forget_password_email()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email_address','Email', 'trim|required|valid_email');
		$this->form_validation->set_error_delimiters("<div class='text-danger'>","</div>");
		if($this->form_validation->run())
		{
			$email_address = $this->input->post('email_address');
			$this->load->model('user_forget_password');
			$email = $this->user_forget_password->forget_password_email_exist($email_address);
			if($email)
			{
				$this->load->library('email');
			    // $this->email->from(set_value('email'),set_value('name'));
			    $this->email->from('geetaverma6653@gmail.com','Geeta');
			    //$this->email->to("$user_email");
			    $this->email->to($email_address);
			    $this->email->subject("Password Reset..");
			    $link = base_url('forget_password/reset_password');
			    $message = "Click on the link to reset your password";
			    $message .= "\r\n $link";
			    $this->email->message($message);
			    $this->email->set_newline("\r\n");
			    // $this->email->send();

			     if($this->email->send()) {
			     	//echo "Your e-mail has been sent!";
			     	$this->session->set_flashdata('email_found','Check your email to reset your password');
				$this->load->view('forget_password');
			   		 }
				 else {
				    show_error($this->email->print_debugger());
				  }
			}
			else
			{
				$this->session->set_flashdata('email_not_found','You entered wrong detail');
				$this->load->view('forget_password');
			}
		}
		else
		{
			$this->load->view('forget_password');
		}
	}
}
