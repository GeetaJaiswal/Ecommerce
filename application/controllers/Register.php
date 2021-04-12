<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
		$this->load->model('register_model');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	public function index()
	{
		// $this->load->view('register');
		// $this->load->view('modal_user_signup_form.php');
	}

	// public function register()
	// {
	// 	//print_r($this->input->post()); exit;
	// 	$name = $this->input->post('name');
	// 	$email = $this->input->post('email');
	// 	$password = $this->input->post('password');

	// 	$this->form_validation->set_rules('name','Name','required');
	// 	$this->form_validation->set_rules('email','Email','required|valid_email|is_unique[users.email]');
	// 	$this->form_validation->set_rules('password','Password','required|alpha_numeric|min_length[5]');

	// 	if($this->form_validation->run()==FALSE)
	// 	{
	// 		$this->load->view('register');
	// 	}
	// 	else
	// 	{
	// 		$this->load->model('Register_model');

	// 		$data=[
	// 			'name'=>$name,
	// 			'email'=>$email,
	// 			'password'=>md5($password),
	// 		];
			
	// 		$last_id = $this->Register_model->signupData($data);

	// 		if($last_id)
	// 		{
	// 			$this->session->set_flashdata('signupSuccess','you have successfully registerd please login');
	// 			redirect('register/register');
	// 		}
	// 	}
	// }


	// public function user_registeration()
	// {
		// print_r($this->input->post()); exit;
		// $name = $this->input->post('name');
		// $email = $this->input->post('email');
		// $password = $this->input->post('password');

// 		$this->form_validation->set_rules('username','Name','required');
// 		$this->form_validation->set_rules('user_email','Email','required|valid_email|is_unique[users.email]');
// 		$this->form_validation->set_rules('user_password','Password','required|alpha_numeric|min_length[5]');

// 		if($this->form_validation->run()==FALSE)
// 		{
// 			// $this->load->view('register');
// 			return "No";
// 		}
// 		else
// 		{
// 			$this->load->model('Register_model');

// 			 $username = $this->input->post('username');
// 		     $user_email = $this->input->post('user_email');
// 		     $user_password = $this->input->post('user_password'); 

// 			$data=[
// 				'name'=>$username,
// 				'email'=>$user_email,
// 				'password'=>md5($user_password),
// 			];
			
// 			$last_id = $this->Register_model->signupData($data);

// 			if($last_id)
// 			{
// 				echo "YES";
// 				$this->session->set_flashdata('signupSuccess','you have successfully registerd please login');
// 				redirect('product/search');
// 				// redirect('register/register');
// 			}
// 		}
// 	}
	
// }

public function user_registeration()
{
	$this->form_validation->set_rules('username','Name','required');
		$this->form_validation->set_rules('user_email','Email','required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('user_password','Password','required|alpha_numeric|min_length[5]');

		if($this->form_validation->run()==FALSE)
		{
			// echo validation_errors();
			$response = array(
				'status'=>'error',
				'message'=>validation_errors()
			);
		}
		else
		{
			$this->load->model('Register_model');
			$formdata = array(
			'name' => $this->input->post('username',true),
 		    'email' => $this->input->post('user_email',true),
 		    'password' => md5($this->input->post('user_password',true)),
 		);

			$this->session->set_userdata('user_email',$this->input->post('user_email'));
			$this->session->set_userdata('user_password',$this->input->post('user_password'));

			$ret = $this->Register_model->signupData($formdata);
            if($ret)
            {
				$response = array(
					'status'=>'success',
					'message'=>"<h4 style='text-align:center; color:green;'>You signed up successfully<br>"
				);
		   } 
		}
		//$this->load->view('header',$response);
		//$this->output->set_content_type('application/json')->set_output(json_encode($response));
echo json_encode($response);
//$this->lo
}



public function sendemail()    // Technical suneja codeigniter step by step 
	{
		$email = $this->session->userdata('user_email');
		$password = $this->session->userdata('user_password');

				$this->load->library('email');
			    // $this->email->from(set_value('email'),set_value('name'));
			    $this->email->from('geetaverma6653@gmail.com','Geeta');
			    //$this->email->to("$user_email");
			    $this->email->to($email);
			    $this->email->subject("Registration Greeting..");
			    $message = "Thank You for Registratiion";
			    $message .= "\r\n Password: $password";
			    $this->email->message($message);
			    $this->email->set_newline("\r\n");
			    // $this->email->send();

			     if($this->email->send()) {
			     	echo "Your e-mail has been sent!";
			     	redirect('product/index');
			   		 }
				 else {
				    show_error($this->email->print_debugger());
				  }
			}

}