<?php
defined('BASEPATH') OR EXIT('No direct access allowed');

class Product_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function all_product($id='')
	{
		// $this->db->limit(8);
		// return $this->db->get_where('products',array('status'=>'active'))->result();
	if($id){
			$this->db->where('id',$id);
			$query = $this->db->get('products');
			$result = ($query->num_rows()>0)?$query->row_array():array();
		}else{
			$query = $this->db->get('products');
			$result = ($query->num_rows()>0)?$query->result_array():array();
		}

		//return fetched data
		return !empty($result)?$result:false;
	}


	function product_select_by_id($id)
	{
		$this->db->where('id',$id);
		return $this->db->get('products')->row();
	}

	function select_data($query)
	{
		$result = $this->db->query($query);
		foreach($result->result_array() as $row)
		{
			return $row;
		}
	}

	function set($key)
	{
		$this->db->select("*");
		$this->db->like('name',$key);
		$this->db->or_like('category',$key);
		$this->db->or_like('brand',$key);
		$this->db->or_like('model',$key);
		$this->db->or_like('description',$key);
		return $this->db->get('products')->result();
	}

	/*
     * Fetch order data from the database
     * @param id returns a single record
     */
//     public function getOrder($id){
//         $this->db->select('r.*, p.name as product_name, p.price as product_price, p.currency as product_price_currency');
//         $this->db->from($this->order.' as r');
// 		$this->db->join($this->products.' as p', 'p.id = r.product_id', 'left');
//         $this->db->where('r.id', $id);
//         $query  = $this->db->get();
//         return ($query->num_rows() > 0)?$query->row_array():false;
//     }
    
//     /*
//      * Insert transaction data in the database
//      * @param data array
//      */
//     public function insertOrder($data){
//         $insert = $this->db->insert($this->order,$data);
//         return $insert?$this->db->insert_id():false;
//     }
 }
?>