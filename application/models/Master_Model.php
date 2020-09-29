<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Master_Model extends CI_Model{

  // Save Data...
  public function save_data($tbl_name, $data){
    $this->db->insert($tbl_name, $data);
    $insert_id = $this->db->insert_id();
    return  $insert_id;
  }
  // Update Data...
  public function update_info($id_type, $id, $tbl_name, $data){
    $this->db->where($id_type, $id)
    ->update($tbl_name, $data);
  }
  // Delete Data...
  public function delete_info($id_type, $id, $tbl_name){
    $this->db->where($id_type, $id)
    ->delete($tbl_name);
  }

  /************************* Get List ***************************/

  // Get List.. Company Id... Order...
  public function get_list($company_id,$id,$order,$tbl_name){
    $this->db->select('*');
    if($company_id != ''){
      $this->db->where('company_id', $company_id);
    }
    $this->db->order_by($id, $order);
    $this->db->from($tbl_name);
    $query = $this->db->get();
    $result = $query->result();
    return $result;
  }

  // Get List.. Company Id... 2 check fields... Order...
  public function get_list_by_id2($company_id,$col_name1,$col_val1,$col_name2,$col_val2,$order_col,$order,$tbl_name){
    $this->db->select('*');
    if($company_id != ''){
      $this->db->where('company_id', $company_id);
    }
    if($col_name1 != ''){
      $this->db->where($col_name1,$col_val1);
    }
    if($col_name2 != ''){
      $this->db->where($col_name2,$col_val2);
    }
    if($order_col != ''){
      $this->db->order_by($order_col, $order);
    }
    $this->db->from($tbl_name);
    $query = $this->db->get();
    $result = $query->result();
    return $result;
  }

  // Get List.. Company Id... 3 check fields... Order...
  public function get_list_by_id3($company_id,$col_name1,$col_val1,$col_name2,$col_val2,$col_name3,$col_val3,$order_col,$order,$tbl_name){
    $this->db->select('*');
    if($company_id != ''){
      $this->db->where('company_id', $company_id);
    }
    if($col_name1 != ''){
      $this->db->where($col_name1,$col_val1);
    }
    if($col_name2 != ''){
      $this->db->where($col_name2,$col_val2);
    }
    if($col_name3 != ''){
      $this->db->where($col_name3,$col_val3);
    }
    if($order_col != ''){
      $this->db->order_by($order_col, $order);
    }
    $this->db->from($tbl_name);
    $query = $this->db->get();
    $result = $query->result();
    return $result;
    // $q = $this->db->last_query();
    // return $q;
  }

/****************************************** Get Information ***************************/

  // get Info List...
  public function get_info($id_type, $id, $tbl_name){
    $this->db->select('*');
    $this->db->where($id_type, $id);
    $this->db->from($tbl_name);
    $query = $this->db->get();
    $result = $query->result();
    return $result;
  }

  public function get_info_fields3($fields, $company_id, $col_name1, $val1, $col_name2, $val2, $col_name3, $val3, $tbl_name){
    $this->db->select($fields);
    if($company_id != ''){
      $this->db->where('company_id', $company_id);
    }
    if($col_name1 != ''){
      $this->db->where($col_name1, $val1);
    }
    if($col_name2 != ''){
      $this->db->where($col_name2, $val2);
    }
    if($col_name3 != ''){
      $this->db->where($col_name3, $val3);
    }
    $this->db->from($tbl_name);
    $query = $this->db->get();
    $result = $query->result();
    return $result;
    // $q = $this->db->last_query();
    // return $q;
  }

  public function get_info_fields4($fields, $company_id, $col_name1, $val1, $col_name2, $val2, $col_name3, $val3, $col_name4, $val4, $order_col, $order, $tbl_name){
    $this->db->select($fields);
    if($company_id != ''){
      $this->db->where('company_id', $company_id);
    }
    if($col_name1 != ''){
      $this->db->where($col_name1, $val1);
    }
    if($col_name2 != ''){
      $this->db->where($col_name2, $val2);
    }
    if($col_name3 != ''){
      $this->db->where($col_name3, $val3);
    }
    if($col_name4 != ''){
      $this->db->where($col_name4,$col_val4);
    }
    if($order_col != ''){
      $this->db->order_by($order_col, $order);
    }
    $this->db->from($tbl_name);
    $query = $this->db->get();
    $result = $query->result();
    return $result;
    // $q = $this->db->last_query();
    // return $q;
  }
  /**************************** Get Array Info ***********************************/
  public function get_info_arr($id_type, $id, $tbl_name){
    $this->db->select('*');
    $this->db->where($id_type, $id);
    $this->db->from($tbl_name);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  public function get_info_arr_fields($fields,$id_type, $id, $tbl_name){
    $this->db->select($fields);
    $this->db->where($id_type, $id);
    $this->db->from($tbl_name);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  public function get_info_arr_fields3($fields, $company_id, $col_name1, $val1, $col_name2, $val2, $col_name3, $val3, $tbl_name){
    $this->db->select($fields);
    if($company_id != ''){
      $this->db->where('company_id', $company_id);
    }
    if($col_name1 != ''){
      $this->db->where($col_name1, $val1);
    }
    if($col_name2 != ''){
      $this->db->where($col_name2, $val2);
    }
    if($col_name3 != ''){
      $this->db->where($col_name3, $val3);
    }
    $this->db->from($tbl_name);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
    // $q = $this->db->last_query();
    // return $q;
  }

/******************************* Check Duplicate *****************************/
  public function check_duplication($company_id,$value,$field_name,$table_name){
    $this->db->select($field_name);
    if($company_id != ''){
      $this->db->where('company_id', $company_id);
    }
    $this->db->where($field_name,$value);
    $this->db->from($table_name);
    $query = $this->db->get();
    $result = $query->num_rows();
    return $result;
  }

/****************************** Get Count ******************************/
  // Get Count...
  public function get_count($id_type,$company_id,$col1,$val1,$col2,$val2,$col3,$val3,$tbl_name){
    $this->db->select($id_type);
    if($company_id != ''){
      $this->db->where('company_id', $company_id);
    }
    if($col1 != ''){
      $this->db->where($col1, $val1);
    }
    if($col2 != ''){
      $this->db->where($col2, $val2);
    }
    if($col3 != ''){
      $this->db->where($col3, $val3);
    }

    $this->db->from($tbl_name);
    $query =  $this->db->get();
    $result = $query->num_rows();
    return $result;
  }

/****************************** Get Sum ******************************/
  public function get_sum($company_id,$tot_field_name,$col1,$val1,$col2,$val2,$col3,$val3,$tbl_name){
    $this->db->select('SUM('.$tot_field_name.') as total');
    if($company_id != ''){
      $this->db->where('company_id', $company_id);
    }
    if($col1 != ''){
      $this->db->where($col1, $val1);
    }
    if($col2 != ''){
      $this->db->where($col2, $val2);
    }
    if($col3 != ''){
      $this->db->where($col3, $val3);
    }
    $this->db->from($tbl_name);
    $query =  $this->db->get();
    $result = $query->result_array();
    if($result){ $total = $result[0]['total']; }
    else{ $total = 0;  }
    return $total;
  }

/********************************************************/
  public function get_count_no($company_id, $field_name, $tbl_name){
    $this->db->select('MAX('.$field_name.') as num');
    if($company_id != ''){
      $this->db->where('company_id', $company_id);
    }
    $this->db->from($tbl_name);
    $query = $this->db->get();
    $result =  $query->result_array();
    if($result){
      $old_num = $result[0]['num'];
    } else{
      $old_num = 0;
    }
    $value = $old_num + 1;
    return $value;
  }

  //
  public function get_count_no3($company_id, $field_name, $col1, $val1, $col2, $val2, $col3, $val3, $tbl_name){
    $this->db->select('MAX('.$field_name.') as num');
    if($company_id != ''){
      $this->db->where('company_id', $company_id);
    }
    if($col1 != ''){
      $this->db->where($col1, $val1);
    }
    if($col2 != ''){
      $this->db->where($col2, $val2);
    }
    if($col3 != ''){
      $this->db->where($col3, $val3);
    }
    $this->db->from($tbl_name);
    $query = $this->db->get();
    $result =  $query->result_array();
    if($result){
      $old_num = $result[0]['num'];
    } else{
      $old_num = 0;
    }
    $value = $old_num + 1;
    return $value;
  }

/********************************************************************************************/

  public function package_list($company_id){
    $this->db->select('smm_package.*,smm_gst_slab.*');
    $this->db->where('smm_package.company_id', $company_id);
    $this->db->join('smm_gst_slab','smm_gst_slab.gst_slab_id = smm_package.gst_slab_id','LEFT');
    $this->db->from('smm_package');
    $query = $this->db->get();
    $result = $query->result();
    return $result;
  }

    // Topic Report...
      public function topic_report_list_all($company_id){
          $this->db->select('topic.*,section.*,medium.*,class.*,batch.*,subject.*');
          $this->db->where('topic.company_id', $company_id);
          $this->db->join('section','topic.section_id = section.section_id','LEFT');
          $this->db->join('medium','topic.medium_id = medium.medium_id','LEFT');
          $this->db->join('class','topic.class_id = class.class_id','LEFT');
          $this->db->join('batch','topic.batch_id = batch.batch_id','LEFT');
          $this->db->join('subject','topic.subject_id = subject.subject_id','LEFT');
          $this->db->from('topic');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
      }



}
?>
