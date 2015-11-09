<?php
// this class is in charge of database operations in creating/editing/retrieving account(s)
class Account_model extends CI_Model {

  public function __construct(){}

  // prevent SQL injection and XSS
  public function character_filter($s){
    if(get_magic_quotes_gpc()){ 
        $s=stripslashes($s);         
    }
    $s=mysql_real_escape_string($s);
    return $s;
  }

  public function check_username($un){
    $un = $this->character_filter($un);
  	$query = $this->db->query('select * from customers where cus_username="'.$un.'"');
  	return $query->result_array();
  }

  public function retrieve_userid($un){
    $un = $this->character_filter($un);
    $query = $this->db->query('select * from customers where cus_username="'.$un.'"');
    //$query = $this->db->get('special');

    return $query->result_array();

  }
  public function create_new_account($un, $pw0, $fn, $ln, $em){
    $un = $this->character_filter($un);
    $pw0 = $this->character_filter($pw0);
    $fn = $this->character_filter($fn);
    $ln = $this->character_filter($ln);
    $em = $this->character_filter($em);
    return $this->db->simple_query('INSERT INTO customers(customerid, cus_username, cus_password, cus_fname, cus_lname,cus_email) VALUES (NULL, "'.$un.'", PASSWORD("'.$pw0.'"), "'.$fn.'", "'.$ln.'","'.$em.'");');
  }

  public function retrieve_acc_info($id){
    $id = $this->character_filter($id);
    $query = $this->db->query('select * from customers where customerid="'.$id.'"');
    //$query = $this->db->get('special');
    return $query->result_array();
  }

  public function update_account($un, $fn, $ln, $em, $id){
     $un = $this->character_filter($un);
     $fn = $this->character_filter($fn);
     $ln = $this->character_filter($ln);
     $em = $this->character_filter($em);
     $id = $this->character_filter($id);
     return $this->db->simple_query('UPDATE customers SET cus_username = "'.$un.'",cus_fname = "'.$fn.'",cus_lname = "'.$ln.'",
cus_email = "'.$em.'" WHERE customerid ="'.$id.'" LIMIT 1 ;');
  }

  public function update_password($pw0, $id){
    $pw0 = $this->character_filter($pw0);
    $id = $this->character_filter($id);
    return $this->db->simple_query('UPDATE customers SET cus_password = PASSWORD("'.$pw0.'") WHERE customers.customerid ='.$id);
  }
}

?>