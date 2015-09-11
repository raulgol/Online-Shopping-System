<?php
class Address_model extends CI_Model {

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

  public function shipping_addr_retrieve($cid) {
    $cid = $this->character_filter($cid);

  	$query = $this->db->query('select * from address where customerid='.$cid.' LIMIT 1');
  	//$query = $this->db->get('special');
    return $query->result_array();
  }
  public function shipping_addr_insert($cid, $sa_fn, $sa_addr, $sa_city, $sa_state, $sa_zip, $sa_pn) {
    $cid = $this->character_filter($cid);
    $sa_fn = $this->character_filter($sa_fn);
    $sa_addr = $this->character_filter($sa_addr);
    $sa_city = $this->character_filter($sa_city);
    $sa_state = $this->character_filter($sa_state);
    $sa_zip = $this->character_filter($sa_zip);
    $sa_pn = $this->character_filter($sa_pn);

  	return $this->db->simple_query('INSERT INTO address(addressid,customerid,fullname,addressline,city,state,zip,phonenumber)VALUES ("", "'.$cid.'", "'.$sa_fn.'", "'.$sa_addr.'", "'.$sa_city.'", "'.$sa_state.'", "'.$sa_zip.'", "'.$sa_pn.'");');     
  }
  public function shipping_addr_update($cid, $sa_fn, $sa_addr, $sa_city, $sa_state, $sa_zip, $sa_pn) {
    $cid = $this->character_filter($cid);
    $sa_fn = $this->character_filter($sa_fn);
    $sa_addr = $this->character_filter($sa_addr);
    $sa_city = $this->character_filter($sa_city);
    $sa_state = $this->character_filter($sa_state);
    $sa_zip = $this->character_filter($sa_zip);
    $sa_pn = $this->character_filter($sa_pn);
  	return $this->db->simple_query('UPDATE address SET fullname = "'.$sa_fn.'",addressline = "'.$sa_addr.'",city = "'.$sa_city.'",state = "'.$sa_state.'",zip = "'.$sa_zip.'",phonenumber = "'.$sa_pn.'" WHERE customerid = "'.$cid.'" LIMIT 1;');     
  }
  public function billing_addr_retrieve($cid) {
    $cid = $this->character_filter($cid);
  	$query = $this->db->query('select * from billing_address where b_customerid ='.$cid.' LIMIT 1');
  	//$query = $this->db->get('special');
    return $query->result_array();
  }
  public function card_info_retrieve($cid) {
     $cid = $this->character_filter($cid);
  	$query = $this->db->query('select * from cardinfo where customerid ='.$cid.' LIMIT 1');
  	//$query = $this->db->get('special');
    return $query->result_array();
  }
  public function billing_addr_insert($cid, $ba_addr, $ba_ct, $ba_st, $ba_zip, $ba_pn) {
     $cid = $this->character_filter($cid);
      $ba_addr = $this->character_filter($ba_addr);
       $ba_ct = $this->character_filter($ba_ct);
        $ba_st = $this->character_filter($ba_st);
         $ba_zip = $this->character_filter($ba_zip);
          $ba_pn = $this->character_filter($ba_pn);
  	return $this->db->simple_query('
        							INSERT INTO billing_address (b_addressid,b_customerid,b_addressline,b_city,b_state,b_zip,b_phonenumber)VALUES (NULL ,
         							"'.$cid.'", "'.$ba_addr.'", "'.$ba_ct.'", "'.$ba_st.'", "'.$ba_zip.'", "'.$ba_pn.'");');     
  }
  public function billing_addr_update($cid, $ba_addr, $ba_ct, $ba_st, $ba_zip, $ba_pn) {
    $cid = $this->character_filter($cid);
      $ba_addr = $this->character_filter($ba_addr);
       $ba_ct = $this->character_filter($ba_ct);
        $ba_st = $this->character_filter($ba_st);
         $ba_zip = $this->character_filter($ba_zip);
          $ba_pn = $this->character_filter($ba_pn);
  	return $this->db->simple_query('
        	UPDATE billing_address SET b_addressline = "'.$ba_addr.'",b_city = "'.$ba_ct.'",b_state = "'.$ba_st.'",b_zip = "'.$ba_zip.'",b_phonenumber = "'.$ba_pn.'" WHERE b_customerid = "'.$cid.'" LIMIT 1;
        ');     
  }
  public function card_info_insert($cid, $ba_nm, $ba_cn, $ba_month, $ba_year, $ba_cvv) {
    $cid = $this->character_filter($cid);
    $ba_nm = $this->character_filter($ba_nm);
    $ba_cn = $this->character_filter($ba_cn);
    $ba_month = $this->character_filter($ba_month);
    $ba_year = $this->character_filter($ba_year);
    $ba_cvv = $this->character_filter($ba_cvv);
  	return $this->db->simple_query('
        INSERT INTO cardinfo (cardinfoid,customerid,nameoncard,cardnumber,expire_month,expire_year,cvv)
            VALUES ("", "'.$cid.'", "'.$ba_nm.'", "'.$ba_cn.'", "'.$ba_month.'", "'.$ba_year.'", "'.$ba_cvv.'");      ');     
  }
  public function card_info_update($cid, $ba_nm, $ba_cn, $ba_month, $ba_year, $ba_cvv) {
    $cid = $this->character_filter($cid);
    $ba_nm = $this->character_filter($ba_nm);
    $ba_cn = $this->character_filter($ba_cn);
    $ba_month = $this->character_filter($ba_month);
    $ba_year = $this->character_filter($ba_year);
    $ba_cvv = $this->character_filter($ba_cvv);
  	return $this->db->simple_query('
        UPDATE cardinfo SET nameoncard = "'.$ba_nm.'",cardnumber = "'.$ba_cn.'",expire_month = "'.$ba_month.'",expire_year = "'.$ba_year.'",cvv = "'.$ba_cvv.'" WHERE customerid = "'.$cid.'" LIMIT 1;
        ');     
  }


}



?>