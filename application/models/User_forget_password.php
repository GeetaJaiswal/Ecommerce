<?php
defined('BASEPATH') OR EXIT('No direct access allowed');

class User_forget_password extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function forget_password_email_exist($email_address)
	{
		$this->db->where('email',$email_address);
    	$query = $this->db->get('users');
	    if ($query->num_rows() > 0){
	        return true;
	    }
	    else{
	        return false;
	    }
	}

	function reset_password($user_email, $new_password, $confirm_password)
	{
		return $this->db->where('email',$user_email)
				->update('users',['password'=>md5($new_password)]);
	}
}