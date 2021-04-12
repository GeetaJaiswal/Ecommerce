<?php

class Product_filter_model extends CI_Model
{
 function fetch_filter_type($type)
 {
  $this->db->distinct();
  $this->db->select($type);
  $this->db->from('products');
  $this->db->where('status', 'active');
  return $this->db->get();
 }

 function make_query($minimum_price, $maximum_price)
 {
  $key = $this->session->userdata('key');
    $query = "SELECT * FROM products WHERE status = 1 AND (category LIKE '%".$key."%' or name LIKE '%".$key."%' or brand LIKE '%".$key."%' or model LIKE '%".$key."%' or description LIKE '%".$key."% ') AND price BETWEEN '".$minimum_price."' AND '".$maximum_price."' ";

  // $minimum_price = 10;
  // $maximum_price = 500;
  // $query = "SELECT * FROM products WHERE status = 1 AND price BETWEEN '".$minimum_price."' AND '".$maximum_price."' OR name LIKE 'oil' OR brand LIKE 'oil' OR model LIKE 'oil' OR description LIKE 'oil' OR category LIKE 'oil'";

  
 
  // if(isset($minimum_price, $maximum_price) && !empty($minimum_price) &&  !empty($maximum_price))
  // {
  //  $query .= "
  //   AND product_price BETWEEN '".$minimum_price."' AND '".$maximum_price."'
  //  ";
  // }

  // if(isset($brand))
  // {
  //  $brand_filter = implode("','", $brand);
  //  $query .= "
  //   AND product_brand IN('".$brand_filter."')
  //  ";
  // }

  // if(isset($ram))
  // {
  //  $ram_filter = implode("','", $ram);
  //  $query .= "
  //   AND product_ram IN('".$ram_filter."')
  //  ";
  // }

  // if(isset($storage))
  // {
  //  $storage_filter = implode("','", $storage);
  //  $query .= "
  //   AND product_storage IN('".$storage_filter."')
  //  ";
  // }
  return $query;
 }

 function count_all($minimum_price, $maximum_price)
 {
  $query = $this->make_query($minimum_price, $maximum_price);
  $data = $this->db->query($query);
  return $data->num_rows();
 }

 function fetch_data($limit, $start, $minimum_price, $maximum_price)
 {
  $query = $this->make_query($minimum_price, $maximum_price);

  // $query .= ' LIMIT '.$start.', ' . $limit;

  $data = $this->db->query($query);

  $output = '';
  if($data->num_rows() > 0)
  {
   foreach($data->result_array() as $row)
   {
    $output .= '
    <div class="col-sm-4 col-lg-3 col-md-3">
     <div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:300px;">
      <img src="'.base_url().'uploads/'. $row['product_img'] .'" alt="" class="img-responsive" style="padding: 25px; width: 200px; height: 200px;" >
      <a href="'.base_url().'product/detailproduct/'.$row['id'].'"><p align="center"><strong>'.$row['name'] .'</a></strong></p></a>
      <p align="center">'.$row['brand'].'</p>
      <h4 style="text-align:center;" class="text-danger" >Rs.'. $row['price'] .'</h4>
     </div> 
    </div>
    ';
   }
  }
  else
  {
   $output = '<h3>No Data Found</h3>';
  }
  return $output;
 }
}

?>
