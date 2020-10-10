<?php
class Reseller_Model extends CI_Model{

  function check_login($mobile, $password, $web_reseller_id){
    $this->db->select('*');
    $this->db->where('reseller_mobile', $mobile);
    $this->db->where('reseller_password', $password);
    $this->db->where('reseller_addedby', $web_reseller_id);
    $this->db->where('reseller_added_type', '2');
    $this->db->where('reseller_status', '1');
    $this->db->from('smm_reseller');
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  function reseller_package_list($smm_res_company_id,$smm_added_reseller_id){
    $this->db->select('smm_reseller_package.*, smm_package.*');
    $this->db->from('smm_reseller_package');
    $this->db->where('smm_reseller_package.company_id', $smm_res_company_id);
    $this->db->where('smm_reseller_package.reseller_id', $smm_added_reseller_id);
    $this->db->join('smm_package','smm_reseller_package.package_id = smm_package.package_id','left');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
  }

  function reseller_package_list_by_category($smm_res_company_id,$smm_added_reseller_id,$package_category_id){
    $this->db->select('smm_reseller_package.*, smm_package.*');
    $this->db->from('smm_reseller_package');
    $this->db->where('smm_package.package_category_id', $package_category_id);
    $this->db->where('smm_reseller_package.company_id', $smm_res_company_id);
    $this->db->where('smm_reseller_package.reseller_id', $smm_added_reseller_id);
    $this->db->join('smm_package','smm_reseller_package.package_id = smm_package.package_id','left');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
  }

  function reseller_package_details($smm_res_company_id,$smm_added_reseller_id,$package_id){
    $this->db->select('smm_reseller_package.*, smm_package.*');
    $this->db->from('smm_reseller_package');
    $this->db->where('smm_reseller_package.company_id', $smm_res_company_id);
    $this->db->where('smm_reseller_package.reseller_id', $smm_added_reseller_id);
    $this->db->where('smm_reseller_package.package_id', $package_id);
    $this->db->join('smm_package','smm_reseller_package.package_id = smm_package.package_id','left');
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  // Ticket List...
  public function reseller_ticket_list($reseleer_id){
    $this->db->select('smm_ticket.*, smm_project.client_id');
    $this->db->from('smm_ticket');
    $this->db->where('smm_project.client_id', $reseleer_id);
    $this->db->order_by('smm_ticket.ticket_id','DESC');
    $this->db->join('smm_project','smm_ticket.project_id = smm_project.project_id','left');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
  }

  // Task List...
  public function reseller_task_list($reseleer_id){
    $this->db->select('smm_task.*, smm_project.client_id, smm_project.project_name');
    $this->db->from('smm_task');
    $this->db->where('smm_project.client_id', $reseleer_id);
    $this->db->order_by('smm_task.task_id','DESC');
    $this->db->join('smm_project','smm_task.project_id = smm_project.project_id','left');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
  }

  // Reseller List...
  public function reseller_project_revision_list($reseleer_id){
    $this->db->select('smm_project_revision.*, smm_project.client_id, smm_project.project_name');
    $this->db->from('smm_project_revision');
    $this->db->where('smm_project.client_id', $reseleer_id);
    $this->db->order_by('smm_project_revision.project_revision_id','DESC');
    $this->db->join('smm_project','smm_project_revision.project_id = smm_project.project_id','left');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
  }

}
?>
