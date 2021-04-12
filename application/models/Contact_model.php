<?php
defined('BASEPATH') OR EXIT('No direct access allowed');

class Contact_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}	

	function contact($formdata)
	{
		$this->db->insert('contact',$formdata);
		return $this->db->insert_id();
	}
}
?>