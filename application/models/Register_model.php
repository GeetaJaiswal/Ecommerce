<?php
class Register_model extends CI_Model{

	public function signupData($formdata){

		$this->db->insert('users',$formdata);
		return $this->db->insert_id();
	}
}

?>