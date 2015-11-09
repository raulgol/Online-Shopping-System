<?php
class Customer_model extends CI_Model {

public function __construct(){}

public function character_filter($s){
    if(get_magic_quotes_gpc()){ 
        $s=stripslashes($s);         
    }
    $s=mysql_real_escape_string($s);
    return $s;
}

public function does_exist($username, $password) {
	$username = $this->character_filter($username);
	$password = $this->character_filter($password);
	$query = $this->db->query('select * from customers where cus_username="'.$username.'" and cus_password=password("'.$password.'")');
  return $query->result_array();
}

}
?>