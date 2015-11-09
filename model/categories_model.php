<?php
class Categories_model extends CI_Model {

public function __construct(){}

public function character_filter($s){
    if(get_magic_quotes_gpc()){ 
        $s=stripslashes($s);         
    }
    $s=mysql_real_escape_string($s);
    return $s;
}

public function get_all_categories(){
	$query = $this->db->query('select * from category');
  return $query->result_array();
}

public function get_certian_category($id){
  $id = $this->character_filter($id);
	$query = $this->db->query('select * from category where categoryid='.$id);
	$res_cer_cate = array();
	$res_cer_cate = $query->result_array();
  if(count($res_cer_cate) != 0) {
  	return $res_cer_cate[0]['categoryname'];
  }
  else {
  	return '';
  }
}
}


?>