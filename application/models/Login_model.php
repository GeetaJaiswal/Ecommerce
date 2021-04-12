<?php
class Login_model extends CI_Model{
	public function login($formdata){
		$this->db->where('email',$formdata['email']);
		$this->db->where('password',md5($formdata['password']));
		$res = $this->db->get('users');
		if($res->num_rows())
		{
			return $res->row()->id;
		}
	}
}
?>