<?php
class Products_model extends CI_Model {

  public function __construct()
  {
    
  }
public function character_filter($s){
    if(get_magic_quotes_gpc()){ 
        $s=stripslashes($s);         
    }
    $s=mysql_real_escape_string($s);
    return $s;
}
  //public function get_all_categories(){
  	//$query = $this->db->query('select * from category');
  	//$query = $this->db->get('special');
   // return $query->result_array();
  //}

  public function get_certian_products($id){
    $id = $this->character_filter($id);
  	$query = $this->db->query('select * from products p, category c where p.categoryid=c.categoryid and c.categoryid='.$id);
  	//$query = $this->db->get('special');

  	return $query->result_array();

  }
  public function get_a_product($id){
    $id = $this->character_filter($id);
    $query = $this->db->query('select * from  category cate, products p where  p.productid='.$id.' and p.categoryid = cate.categoryid limit 1');
    //$query = $this->db->get('special');

    return $query->result_array();

  }
  public function get_a_certain_product_price($id){
    $id = $this->character_filter($id);
    $query = $this->db->query('select productprice from products where productid='.$id);
    //$query = $this->db->get('special');

    return $query->result_array();

  }



}



?>