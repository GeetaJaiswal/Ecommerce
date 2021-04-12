<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
		$this->load->model('register_model');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	/*public function userLogin()
	{
		//print_r($this->input->post());
		$email = $this->input->post('email');
		$password  = $this->input->post('pwd');

			$this->load->model('login_model');

			
			$num_rows = $this->login_model->login($email,$password);

			if($num_rows>0)
			{
				$this->session->set_flashdata('loginSuccess','you have successfully logged in');
				redirect('welcome');
			}else
			{
				echo "wrong";
			}
	}
		/*else
		{
			$this->load->model('Register_model');

			$data=[
				'name'=>$name,
				'email'=>$email,
				'password'=>md5($password),
			];
			
			$last_id = $this->Register_model->signupData($data);

			if($last_id)
			{
				$this->session->set_flashdata('signupSuccess','you have successfully registerd please login');
				redirect('register/register');
			}


}*/

	public function userLogin()
	{
			$this->form_validation->set_rules('user_login_email','Email','required|valid_email');
			$this->form_validation->set_rules('user_login_password','Password','required');

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
				$this->load->model('login_model');
				$formdata = array(
	 		    'email' => $this->input->post('user_login_email',true),
	 		    'password' => $this->input->post('user_login_password',true),
	 			);
				$last_id = $this->login_model->login($formdata);
				 // print_r($last_id);
				// exit;
				if($last_id)
				{
					$this->session->set_userdata('userid',$last_id);
					$response = array(
					'status'=>'success'
					
					// 'message'=>"<h4 style='text-align:center; color:green;'>you have successfully logged in</h4><br>"
					);
					// $this->output
					// ->set_content_type('application/json')
					// ->set_output(json_encode($response));
					// redirect('product/index');
				}
				else
				{
					$response = array(
					'status'=>'login_error',
					'message'=>"<h4 style='text-align:center; color:red;'>Invalid Email or Password</h4><br>"
				);
				}
				
			}
			echo json_encode($response);
	}

	public function logout()
	{
		$this->session->unset_userdata('userid');
		return redirect('product');
	}

}