<?php
class Order_model extends CI_Model {

public function __construct(){}

public function character_filter($s){
    if(get_magic_quotes_gpc()){ 
        $s=stripslashes($s);         
    }
    $s=mysql_real_escape_string($s);
    return $s;
}

public function orders($cid) {
  $cid = $this->character_filter($cid);
	$query = $this->db->query('select * from placedorder where customerid='.$cid);
  return $query->result_array();
}

public function order_detail($oid) {
  $oid = $this->character_filter($oid);
  $query = $this->db->query('select * from  placedorder where orderindex='.$oid);
  return $query->result_array();
}

public function one_order_detail($oid) {
  $oid = $this->character_filter($oid);
  $query = $this->db->query('select * from orderdetail where orderindex='.$oid);
  return $query->result_array();
}

public function all_orders() {
  $query = $this->db->query('select * from placedorder;');
  return $query->result_array();
}

public function max_order_index() {
  $query = $this->db->query('select MAX(orderindex) as m from placedorder;');
  $temp = array();
  $temp = $query->result_array();
  return $temp[0]['m'];
}

public function place_order($orderindex, $id, $date, $totalprice, $billing_addr, $shipping_addr) {
  $orderindex = $this->character_filter($orderindex);
  $id = $this->character_filter($id);
  $date = $this->character_filter($date);
  $totalprice = $this->character_filter($totalprice);
  $billing_addr = $this->character_filter($billing_addr);
  $shipping_addr = $this->character_filter($shipping_addr);
  return $this->db->simple_query('INSERT INTO placedorder (orderindex,customerid,orderdate,totalcost,billing_addr,shipping_addr)
                    VALUES ("'.$orderindex.'", "'.$id.'", "'.$date.'", "'.$totalprice.'", "'.$billing_addr.'", "'.$shipping_addr.'");');
}

public function insert_order_detail($orderindex, $productid, $productqtty, $price, $is_special) {
  $orderindex = $this->character_filter($orderindex);
  $productid = $this->character_filter($productid);
  $productqtty = $this->character_filter($productqtty);
  $price = $this->character_filter($price);
  $is_special = $this->character_filter($is_special);
  return $this->db->simple_query('INSERT INTO orderdetail (od_index,orderindex,proid,proqtty,proprice, is_special)VALUES 
                                   (NULL ,"'.$orderindex.'","'.$productid.'","'.$productqtty.'","'.$price.'","'.$is_special.'");');
}



}



?>