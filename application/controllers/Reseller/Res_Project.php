<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Res_Project extends CI_Controller{
  public function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Kolkata');
  }

/********************************* Project ***********************************/
  // Add Project...
  public function project(){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'client_id',$smm_reseller_id,'','','','','project_id','ASC','smm_project');
    $data['page'] = 'Project';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Project/project', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

  // Edit/Update Project...
  public function project_details($project_id = null){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $project_info = $this->Master_Model->get_info_arr('project_id',$project_id,'smm_project');
    if(!$project_info){ header('location:'.base_url().'Reseller/Res_Project/project'); }

    $data['project_info'] = $project_info[0];
    $data['page'] = 'Project Details';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Project/project_details', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }


/*********************************** Ticket *********************************/

  // Add Ticket....
  public function ticket(){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $this->form_validation->set_rules('ticket_title', 'Ticket Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $ticket_status = $this->input->post('ticket_status');
      if(!isset($ticket_status)){ $ticket_status = '1'; }
      $save_data = $_POST;
      // $save_data['ticket_status'] = $ticket_status;
      $save_data['company_id'] = $smm_res_company_id;
      $save_data['ticket_addedby_type'] = '2';
      $save_data['ticket_addedby'] = $smm_reseller_id;
      $ticket_id = $this->Master_Model->save_data('smm_ticket', $save_data);

      if($_FILES['ticket_image']['name']){
        $time = time();
        $image_name = 'ticket_'.$ticket_id.'_'.$time;
        $config['upload_path'] = 'assets/images/ticket/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['ticket_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('ticket_image') && $ticket_id && $image_name && $ext && $filename){
          $ticket_image_up['ticket_image'] =  base_url().'assets/images/ticket/'.$image_name.'.'.$ext;
          $this->Master_Model->update_info('ticket_id', $ticket_id, 'smm_ticket', $ticket_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Reseller/Res_Project/ticket');
    }
    $data['ticket_no'] = $this->Master_Model->get_count_no($smm_res_company_id, 'ticket_no', 'smm_ticket');
    $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'client_id',$smm_reseller_id,'','','','','project_name','ASC','smm_project');

    $data['ticket_list'] = $this->Reseller_Model->reseller_ticket_list($smm_reseller_id);
    $data['page'] = 'Ticket';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Project/ticket', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

  // Edit/Update Ticket...
  public function edit_ticket($ticket_id){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $this->form_validation->set_rules('ticket_title', 'Ticket Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $ticket_status = $this->input->post('ticket_status');
      if(!isset($ticket_status)){ $ticket_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_ticket_image']);
      $this->Master_Model->update_info('ticket_id', $ticket_id, 'smm_ticket', $update_data);

      if($_FILES['ticket_image']['name']){
        $time = time();
        $image_name = 'ticket_'.$ticket_id.'_'.$time;
        $config['upload_path'] = 'assets/images/ticket/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['ticket_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('ticket_image') && $ticket_id && $image_name && $ext && $filename){
          $ticket_image_up['ticket_image'] =  base_url().'assets/images/ticket/'.$image_name.'.'.$ext;
          $this->Master_Model->update_info('ticket_id', $ticket_id, 'smm_ticket', $ticket_image_up);
          if($_POST['old_ticket_img']){ unlink("".$_POST['old_ticket_img']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Reseller/Res_Project/ticket');
    }

    $ticket_info = $this->Master_Model->get_info_arr('ticket_id',$ticket_id,'smm_ticket');
    if(!$ticket_info){ header('location:'.base_url().'Reseller/Res_Project/ticket'); }
    $data['update'] = 'update';
    $data['update_ticket'] = 'update';
    $data['ticket_info'] = $ticket_info[0];
    $data['act_link'] = base_url().'Reseller/Res_Project/edit_ticket/'.$ticket_id;
    $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'client_id',$smm_reseller_id,'','','','','project_name','ASC','smm_project');

    $data['ticket_list'] = $this->Reseller_Model->reseller_ticket_list($smm_reseller_id);
    $data['page'] = 'Edit Ticket';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Project/ticket', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

  //Delete Ticket...
  public function delete_ticket($ticket_id){
    $smm_reseller_id = $this->session->userdata('smm_user_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' && $smm_res_company_id == ''){ header('location:'.base_url().'User'); }
    $ticket_info = $this->Master_Model->get_info_arr_fields('ticket_image, ticket_id', 'ticket_id', $ticket_id, 'smm_ticket');
    if($ticket_info){
      $ticket_image = $ticket_info[0]['ticket_image'];
      if($ticket_image){ unlink("assets/images/ticket/".$ticket_image); }
    }
    $this->Master_Model->delete_info('ticket_id', $ticket_id, 'smm_ticket');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Reseller/Res_Project/ticket');
  }

/********************************* Task  ***********************************/
  // Add Task ...
  public function task(){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $this->form_validation->set_rules('task_title', 'Task Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      // $task_status = $this->input->post('task_status');
      // if(!isset($task_status)){ $task_status = '1'; }
      $save_data = $_POST;
      // unset($save_data['task_assign_to']);
      unset($save_data['task_file_name']);
      unset($save_data['task_file_image']);
      unset($save_data['input']);

      // $task_assign_to=implode(',', $_POST['task_assign_to']);
      // $save_data['task_assign_to'] = $task_assign_to;
      $save_data['task_status'] = '0';
      $save_data['company_id'] = $smm_res_company_id;
      $save_data['task_addedby'] = $smm_reseller_id;
      $save_data['task_addedby_type'] = '2';
      $task_id = $this->Master_Model->save_data('smm_task', $save_data);

      if(isset($_FILES['task_file_image']['name'])){
        $this->load->library('upload');
        $files = $_FILES;
        $cpt = count($_FILES['task_file_image']['name']);
        for($i=0; $i<$cpt; $i++)
        {
          $j = $i+1;
          $time = time();
          $image_name = 'task_file_'.$task_id.'_'.$j.'_'.$time;
          $_FILES['task_file_image']['name']= $files['task_file_image']['name'][$i];
          $_FILES['task_file_image']['type']= $files['task_file_image']['type'][$i];
          $_FILES['task_file_image']['tmp_name']= $files['task_file_image']['tmp_name'][$i];
          $_FILES['task_file_image']['error']= $files['task_file_image']['error'][$i];
          $_FILES['task_file_image']['size']= $files['task_file_image']['size'][$i];
          $config['upload_path'] = 'assets/images/task/';
          $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|docx|doc';
          $config['file_name'] = $image_name;
          $config['overwrite']     = FALSE;
          $filename = $files['task_file_image']['name'][$i];
          $ext = pathinfo($filename, PATHINFO_EXTENSION);
          $this->upload->initialize($config);
          $task_file_name = $_POST['task_file_name'][$i];
          if($this->upload->do_upload('task_file_image') && $filename && $ext ){
            $file_data['task_file_image'] = base_url().'assets/images/task/'.$image_name.'.'.$ext;
            $file_data['task_id'] = $task_id;
            $file_data['company_id'] = $smm_res_company_id;
            $file_data['task_file_name'] = $task_file_name;
            $this->Master_Model->save_data('smm_task_file', $file_data);
          }
          else{
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('status',$this->upload->display_errors());
          }
        }
      }

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Reseller/Res_Project/task');
    }
    $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'client_id',$smm_reseller_id,'','','','','project_name','ASC','smm_project');
    $data['task_status_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','task_status_id','ASC','smm_task_status');
    // $data['user_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','user_name','ASC','user');

    $data['task_list'] = $this->Reseller_Model->reseller_task_list($smm_reseller_id);
    $data['page'] = 'Task';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Project/task', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

  // Edit/Update Task...
  public function edit_task($task_id){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $this->form_validation->set_rules('task_title', 'Task Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $update_data = $_POST;
      unset($update_data['old_task_image']);
      unset($update_data['task_file_name']);
      unset($update_data['task_file_image']);
      unset($update_data['input']);
      $this->Master_Model->update_info('task_id', $task_id, 'smm_task', $update_data);

      if(isset($_FILES['task_file_image']['name'])){
        $this->load->library('upload');
        $files = $_FILES;
        $cpt = count($_FILES['task_file_image']['name']);
        for($i=0; $i<$cpt; $i++)
        {
          $j = $i+1;
          $time = time();
          $image_name = 'task_file_'.$task_id.'_'.$j.'_'.$time;
          $_FILES['task_file_image']['name']= $files['task_file_image']['name'][$i];
          $_FILES['task_file_image']['type']= $files['task_file_image']['type'][$i];
          $_FILES['task_file_image']['tmp_name']= $files['task_file_image']['tmp_name'][$i];
          $_FILES['task_file_image']['error']= $files['task_file_image']['error'][$i];
          $_FILES['task_file_image']['size']= $files['task_file_image']['size'][$i];
          $config['upload_path'] = 'assets/images/task/';
          $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|docx|doc';
          $config['file_name'] = $image_name;
          $config['overwrite']     = FALSE;
          $filename = $files['task_file_image']['name'][$i];
          $ext = pathinfo($filename, PATHINFO_EXTENSION);
          $this->upload->initialize($config);
          $task_file_name = $_POST['task_file_name'][$i];
          if($this->upload->do_upload('task_file_image') && $filename && $ext ){
            $file_data['task_file_image'] = base_url().'assets/images/task/'.$image_name.'.'.$ext;
            $file_data['task_id'] = $task_id;
            $file_data['company_id'] = $smm_res_company_id;
            $file_data['task_file_name'] = $task_file_name;
            $this->Master_Model->save_data('smm_task_file', $file_data);
          }
          else{
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('status',$this->upload->display_errors());
          }
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Reseller/Res_Project/task');
    }

    $task_info = $this->Master_Model->get_info_arr('task_id',$task_id,'smm_task');
    if(!$task_info){ header('location:'.base_url().'Reseller/Res_Project/task'); }
    $data['update'] = 'update';
    $data['update_task'] = 'update';
    $data['task_info'] = $task_info[0];
    $data['act_link'] = base_url().'Reseller/Res_Project/edit_task/'.$task_id;
    // $data['task_category_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'task_category_status','1','task_category_type',$task_category_type,'','','task_category_name','ASC','smm_task_category');
    $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'client_id',$smm_reseller_id,'','','','','project_name','ASC','smm_project');
    $data['task_status_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'task_status_status','1','','','','','task_status_id','ASC','smm_task_status');
    // $data['user_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','user_name','ASC','user');
    $data['task_file_list'] = $this->Master_Model->get_list_by_id3('','task_id',$task_id,'','','','','task_file_id','DESC','smm_task_file');

    $data['task_list'] = $this->Reseller_Model->reseller_task_list($smm_reseller_id);
    $data['page'] = 'Task';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Project/task', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

  // Delete Task File
  public function delete_task_file(){
    $task_file_id = $this->input->post('task_file_id');
    $task_file_info = $this->Master_Model->get_info_arr_fields('task_file_image, task_file_id', 'task_file_id', $task_file_id, 'smm_task_file');
    if($task_file_info){
      $task_file_image = $task_file_info[0]['task_file_image'];
      if($task_file_image){ unlink("".$task_file_image); }
    }
    $this->Master_Model->delete_info('task_file_id', $task_file_id, 'smm_task_file');
  }


/********************************* Project Revision  ***********************************/
  // Add Project Revision ...
  public function project_revision(){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $this->form_validation->set_rules('project_revision_title', 'Project Revision Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      // $project_revision_status = $this->input->post('project_revision_status');
      // if(!isset($project_revision_status)){ $project_revision_status = '1'; }
      $save_data = $_POST;
      $save_data['project_revision_date'] = date('d-m-Y');
      unset($save_data['project_revision_file_name']);
      unset($save_data['project_revision_file_image']);
      unset($save_data['input']);

      $save_data['project_revision_status'] = '0';
      $save_data['company_id'] = $smm_res_company_id;
      $save_data['project_revision_addedby'] = $smm_reseller_id;
      $save_data['project_revision_addedby_type'] = '2';
      $project_revision_id = $this->Master_Model->save_data('smm_project_revision', $save_data);

      if(isset($_FILES['project_revision_file_image']['name'])){
        $this->load->library('upload');
        $files = $_FILES;
        $cpt = count($_FILES['project_revision_file_image']['name']);
        for($i=0; $i<$cpt; $i++)
        {
          $j = $i+1;
          $time = time();
          $image_name = 'project_revision_file_'.$project_revision_id.'_'.$j.'_'.$time;
          $_FILES['project_revision_file_image']['name']= $files['project_revision_file_image']['name'][$i];
          $_FILES['project_revision_file_image']['type']= $files['project_revision_file_image']['type'][$i];
          $_FILES['project_revision_file_image']['tmp_name']= $files['project_revision_file_image']['tmp_name'][$i];
          $_FILES['project_revision_file_image']['error']= $files['project_revision_file_image']['error'][$i];
          $_FILES['project_revision_file_image']['size']= $files['project_revision_file_image']['size'][$i];
          $config['upload_path'] = 'assets/images/project_revision/';
          $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|docx|doc';
          $config['file_name'] = $image_name;
          $config['overwrite']     = FALSE;
          $filename = $files['project_revision_file_image']['name'][$i];
          $ext = pathinfo($filename, PATHINFO_EXTENSION);
          $this->upload->initialize($config);
          $project_revision_file_name = $_POST['project_revision_file_name'][$i];
          if($this->upload->do_upload('project_revision_file_image') && $filename && $ext ){
            $file_data['project_revision_file_image'] = base_url().'assets/images/project_revision/'.$image_name.'.'.$ext;
            $file_data['project_revision_id'] = $project_revision_id;
            $file_data['company_id'] = $smm_res_company_id;
            $file_data['project_revision_file_name'] = $project_revision_file_name;
            $this->Master_Model->save_data('smm_project_revision_file', $file_data);
          }
          else{
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('status',$this->upload->display_errors());
          }
        }
      }

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Reseller/Res_Project/project_revision');
    }
    $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'client_id',$smm_reseller_id,'','','','','project_name','ASC','smm_project');
    $data['project_revision_category_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','project_revision_category_id','ASC','smm_project_revision_category');
    // $data['user_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','user_name','ASC','user');

    $data['project_revision_list'] = $this->Reseller_Model->reseller_project_revision_list($smm_reseller_id);
    $data['page'] = 'Project Revision';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Project/project_revision', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

  // Edit/Update Project Revision...
  public function edit_project_revision($project_revision_id){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $this->form_validation->set_rules('project_revision_title', 'Project Revision Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $update_data = $_POST;
      unset($update_data['old_project_revision_image']);
      unset($update_data['project_revision_file_name']);
      unset($update_data['project_revision_file_image']);
      unset($update_data['input']);
      $this->Master_Model->update_info('project_revision_id', $project_revision_id, 'smm_project_revision', $update_data);

      if(isset($_FILES['project_revision_file_image']['name'])){
        $this->load->library('upload');
        $files = $_FILES;
        $cpt = count($_FILES['project_revision_file_image']['name']);
        for($i=0; $i<$cpt; $i++)
        {
          $j = $i+1;
          $time = time();
          $image_name = 'project_revision_file_'.$project_revision_id.'_'.$j.'_'.$time;
          $_FILES['project_revision_file_image']['name']= $files['project_revision_file_image']['name'][$i];
          $_FILES['project_revision_file_image']['type']= $files['project_revision_file_image']['type'][$i];
          $_FILES['project_revision_file_image']['tmp_name']= $files['project_revision_file_image']['tmp_name'][$i];
          $_FILES['project_revision_file_image']['error']= $files['project_revision_file_image']['error'][$i];
          $_FILES['project_revision_file_image']['size']= $files['project_revision_file_image']['size'][$i];
          $config['upload_path'] = 'assets/images/project_revision/';
          $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|docx|doc';
          $config['file_name'] = $image_name;
          $config['overwrite']     = FALSE;
          $filename = $files['project_revision_file_image']['name'][$i];
          $ext = pathinfo($filename, PATHINFO_EXTENSION);
          $this->upload->initialize($config);
          $project_revision_file_name = $_POST['project_revision_file_name'][$i];
          if($this->upload->do_upload('project_revision_file_image') && $filename && $ext ){
            $file_data['project_revision_file_image'] = base_url().'assets/images/project_revision/'.$image_name.'.'.$ext;
            $file_data['project_revision_id'] = $project_revision_id;
            $file_data['company_id'] = $smm_res_company_id;
            $file_data['project_revision_file_name'] = $project_revision_file_name;
            $this->Master_Model->save_data('smm_project_revision_file', $file_data);
          }
          else{
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('status',$this->upload->display_errors());
          }
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Reseller/Res_Project/project_revision');
    }

    $project_revision_info = $this->Master_Model->get_info_arr('project_revision_id',$project_revision_id,'smm_project_revision');
    if(!$project_revision_info){ header('location:'.base_url().'Reseller/Res_Project/project_revision'); }
    $data['update'] = 'update';
    $data['update_project_revision'] = 'update';
    $data['project_revision_info'] = $project_revision_info[0];
    $data['act_link'] = base_url().'Reseller/Res_Project/edit_project_revision/'.$project_revision_id;
    // $data['project_revision_category_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'project_revision_category_status','1','project_revision_category_type',$project_revision_category_type,'','','project_revision_category_name','ASC','smm_project_revision_category');
    $data['project_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'client_id',$smm_reseller_id,'','','','','project_name','ASC','smm_project');
    $data['project_revision_category_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','project_revision_category_id','ASC','smm_project_revision_category');
    // $data['user_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','user_name','ASC','user');
    $data['project_revision_file_list'] = $this->Master_Model->get_list_by_id3('','project_revision_id',$project_revision_id,'','','','','project_revision_file_id','DESC','smm_project_revision_file');

    $data['project_revision_list'] = $this->Reseller_Model->reseller_project_revision_list($smm_reseller_id);
    $data['page'] = 'Project Revision';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Project/project_revision', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

  // Delete Project Revision File
  public function delete_project_revision_file(){
    $project_revision_file_id = $this->input->post('project_revision_file_id');
    $project_revision_file_info = $this->Master_Model->get_info_arr_fields('project_revision_file_image, project_revision_file_id', 'project_revision_file_id', $project_revision_file_id, 'smm_project_revision_file');
    if($project_revision_file_info){
      $project_revision_file_image = $project_revision_file_info[0]['project_revision_file_image'];
      if($project_revision_file_image){ unlink("".$project_revision_file_image); }
    }
    $this->Master_Model->delete_info('project_revision_file_id', $project_revision_file_id, 'smm_project_revision_file');
  }



}
?>
