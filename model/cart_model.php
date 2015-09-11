<?php
class Cart_model extends CI_Model {

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

  public function does_exist($cid, $pid) {
    $cid = $this->character_filter($cid);
    $pid = $this->character_filter($pid);
  	$query = $this->db->query('select * from cart where customerid="'.$cid.'" and productid="'.$pid.'";');
  	//$query = $this->db->get('special');
    return $query->result_array();
  }
  public function cart_insert($cid, $pid, $qty) {
     $cid = $this->character_filter($cid);
    $pid = $this->character_filter($pid);
    $qty = $this->character_filter($qty);
  	 $sql = 'INSERT INTO cart(cartindex,customerid,productid,productqtty) VALUES (NULL , "'.$cid.'", "'.$pid.'", "'.$qty.'");';

	 return $this->db->simple_query($sql);
  }
  public function cart_update($cid, $pid, $qty) {
    $cid = $this->character_filter($cid);
    $pid = $this->character_filter($pid);
    $qty = $this->character_filter($qty);
  	 $sql = 'UPDATE cart SET productqtty = "'.$qty.'" WHERE customerid="'.$cid.'" and productid="'.$pid.'" ;';

	 return $this->db->simple_query($sql);
  }
  public function cart_num($cid) {
    $cid = $this->character_filter($cid);
  	$query = $this->db->query('select * from cart where customerid="'.$cid.'";');
  	//$query = $this->db->get('special');
    return $query->num_rows();
  }

   public function cart_certain_customer($cid) {
    $cid = $this->character_filter($cid);
  	$query = $this->db->query('select * from cart where customerid='.$cid);
  	//$query = $this->db->get('special');
    return $query->result_array();
  }
  public function cart_delete($cid, $pid) {
    $cid = $this->character_filter($cid);
    $pid = $this->character_filter($pid);
  	$query = $this->db->query('DELETE FROM cart WHERE customerid='.$cid.' and productid = '.$pid.' LIMIT 1');
  	//$query = $this->db->get('special');
    //return $query->result_array();
  }
  public function cart_delete_all($cid) {
    $cid = $this->character_filter($cid);
  	return $this->db->simple_query('DELETE FROM cart WHERE customerid ='.$cid);
  	//$query = $this->db->get('special');
    //return $query->result_array();
  }
  public function recommand($cart) {
  	$c1 = '';
	$c2 = '';
	$isOne = true;
	if($this->session->userdata('customer_id') === false) {  // not logged in
	    foreach($cart as $item) {
          $item['pro_id'] = $this->character_filter($item['pro_id']);
	        if($isOne) {
	            $isOne = false;
	            $c1 = ' od.proid ='.$item['pro_id'];
	        }
	        else {
	            $c1 = $c1.' or od.proid ='.$item['pro_id'];
	        }
	        $c2 = $c2.' and  od.proid<>'.$item['pro_id'];
	    }
	    $sql_recommand = 'select od.proid,p.productname, p.singer, p.productprice, p.productimg, c.categoryname, sum(od.proqtty) as s from  orderdetail od, products p, category c  where od.orderindex in (select distinct po.orderindex from placedorder po, orderdetail od where po.orderindex = od.orderindex and ('.$c1.')) and od.proid = p.productid and p.categoryid = c.categoryid '.$c2.'  group by od.proid  order by s desc';
	}
	else {
		foreach($cart as $item) {
          $item['productid'] = $this->character_filter($item['productid']);
	        if($isOne) {
	            $isOne = false;
	            $c1 = ' od.proid ='.$item['productid'];
	        }
	        else {
	            $c1 = $c1.' or od.proid ='.$item['productid'];
	        }
	        $c2 = $c2.' and  od.proid<>'.$item['productid'];
	    }
	    $sql_recommand = 'select od.proid,p.productname, p.singer, p.productprice, p.productimg, c.categoryname, sum(od.proqtty) as s from  orderdetail od, products p, category c  where od.orderindex in (select distinct po.orderindex from placedorder po, orderdetail od where po.orderindex = od.orderindex and po.customerid<>'.$this->session->userdata('customer_id').' and ('.$c1.')) and od.proid = p.productid and p.categoryid = c.categoryid '.$c2.'  group by od.proid  order by s desc';
	}


  	$query = $this->db->query($sql_recommand);
  	//$query = $this->db->get('special');
    return $query->result_array();
  }
    public function cart_all($cid) {
      $cid = $this->character_filter($cid);
  	$query = $this->db->query('select * from cart where customerid="'.$cid.'";');
  	//$query = $this->db->get('special');
    return $query->result_array();
  }


  



 



}



?>