<?php
class Website_Model extends CI_Model{

  function check_login($email, $password){
    $query = $this->db->select('*')
      ->where('customer_email', $email)
      ->where('customer_password', $password)
      ->from('customer')
      ->get();
    $result = $query->result_array();
    return $result;
  }

}
?>
