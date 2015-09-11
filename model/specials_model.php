<?php
class Specials_model extends CI_Model {

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
  public function get_all_special(){
  	$query = $this->db->query('select * from special s, category c, products p where s.productid = p.productid and p.categoryid=c.categoryid');
  	//$query = $this->db->get('special');
    return $query->result_array();
  }
  public function get_certain_special($cid){
    $cid = $this->character_filter($cid);
  	$query = $this->db->query('select * from special s, category c, products p where s.productid = p.productid and p.categoryid=c.categoryid and c.categoryid='.$cid);
  	//$query = $this->db->get('special');
  	$res_cer_spe = array();
  	$res_cer_spe = $query->result_array();
    return $res_cer_spe;
  }

  public function is_special($pid){
    $pid = $this->character_filter($pid);
  	$query = $this->db->query('select * from special s, products p where s.productid=p.productid and p.productid='.$pid);
  	//$query = $this->db->get('special');
  	return $query->result_array();
 
  }


}



?>