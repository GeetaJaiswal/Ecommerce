<?php 
function insertPaymentLaser($Arr) {
	$ci = & get_instance();
	$ci->load->database();
	$ci->db->insert('transaction_logs',$Arr);
	return true;
}