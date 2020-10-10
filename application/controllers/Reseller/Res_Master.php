<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Res_Master extends CI_Controller{
  public function __construct(){
    parent::__construct();
    date_default_timezone_set('Asia/Kolkata');
  }

/********************************* Reseller ***********************************/

  // Add Reseller...
  public function reseller(){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    // $this->form_validation->set_rules('reseller_name', 'reseller title', 'trim|required');
    // if ($this->form_validation->run() != FALSE) {
    //   $reseller_status = $this->input->post('reseller_status');
    //   if(!isset($reseller_status)){ $reseller_status = '1'; }
    //   $save_data = $_POST;
    //   $save_data['reseller_status'] = $reseller_status;
    //   $save_data['company_id'] = $smm_res_company_id;
    //   $save_data['reseller_added_type'] = '2';
    //   $save_data['reseller_addedby'] = $smm_reseller_id;
    //   $reseller_id = $this->Master_Model->save_data('smm_reseller', $save_data);
    //
    //   $save_web_setting = array(
    //     'company_id' => $company_id,
    //     'reseller_id' => $reseller_id,
    //     'web_setting_name' => $_POST['reseller_name'],
    //     'web_setting_address' => $_POST['reseller_address'],
    //     'country_id' => $_POST['country_id'],
    //     'state_id' => $_POST['state_id'],
    //     'city_id' => $_POST['city_id'],
    //     'web_setting_addedby_type' => 2,
    //   );
    //   $web_setting_id = $this->Master_Model->save_data('smm_web_setting', $save_web_setting);
    //
    //   if($_FILES['reseller_logo']['name']){
    //     $time = time();
    //     $image_name = 'reseller_'.$reseller_id.'_'.$time;
    //     $config['upload_path'] = 'assets/images/reseller/';
    //     $config['allowed_types'] = 'jpg|jpeg|png|gif';
    //     $config['file_name'] = $image_name;
    //     $filename = $_FILES['reseller_logo']['name'];
    //     $ext = pathinfo($filename, PATHINFO_EXTENSION);
    //     $this->upload->initialize($config); // if upload library autoloaded
    //     if ($this->upload->do_upload('reseller_logo') && $reseller_id && $image_name && $ext && $filename){
    //       $reseller_logo_up['reseller_logo'] =  base_url().'assets/images/reseller/'.$image_name.'.'.$ext;
    //       $this->Master_Model->update_info('reseller_id', $reseller_id, 'smm_reseller', $reseller_logo_up);
    //       // unlink("assets/images/tours/".$reseller_logo_old);
    //       $this->session->set_flashdata('upload_success','File Uploaded Successfully');
    //     }
    //     else{
    //       $error = $this->upload->display_errors();
    //       $this->session->set_flashdata('upload_error',$error);
    //     }
    //   }
    //   $this->session->set_flashdata('save_success','success');
    //   header('location:'.base_url().'Reseller/Res_Master/reseller');
    // }
    // $data['country_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','country_name','ASC','country');
    // $data['branch_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','branch_name','ASC','smm_branch');

    $data['reseller_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'reseller_added_type','2','reseller_addedby',$smm_reseller_id,'','','reseller_id','DESC','smm_reseller');
    $data['page'] = 'Reseller';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Master/reseller', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

  // // Edit Reseller...
  // public function edit_reseller($reseller_id){
  //   $smm_reseller_id = $this->session->userdata('smm_reseller_id');
  //   $smm_res_company_id = $this->session->userdata('smm_res_company_id');
  //
  //   if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }
  //
  //   $this->form_validation->set_rules('reseller_name', 'reseller title', 'trim|required');
  //   if ($this->form_validation->run() != FALSE) {
  //     $reseller_status = $this->input->post('reseller_status');
  //     if(!isset($reseller_status)){ $reseller_status = '1'; }
  //     $update_data = $_POST;
  //     unset($update_data['old_reseller_logo']);
  //     $update_data['reseller_status'] = $reseller_status;
  //     $this->Master_Model->update_info('reseller_id', $reseller_id, 'smm_reseller', $update_data);
  //
  //     if($_FILES['reseller_logo']['name']){
  //       $time = time();
  //       $image_name = 'reseller_'.$reseller_id.'_'.$time;
  //       $config['upload_path'] = 'assets/images/reseller/';
  //       $config['allowed_types'] = 'jpg|jpeg|png|gif';
  //       $config['file_name'] = $image_name;
  //       $filename = $_FILES['reseller_logo']['name'];
  //       $ext = pathinfo($filename, PATHINFO_EXTENSION);
  //       $this->upload->initialize($config); // if upload library autoloaded
  //       if ($this->upload->do_upload('reseller_logo') && $reseller_id && $image_name && $ext && $filename){
  //         $reseller_logo_up['reseller_logo'] =  base_url().'assets/images/reseller/'.$image_name.'.'.$ext;
  //         $this->Master_Model->update_info('reseller_id', $reseller_id, 'smm_reseller', $reseller_logo_up);
  //         if($_POST['old_reseller_logo']){
  //           $unlink_image = str_replace(base_url(), "",$_POST['old_reseller_logo']);
  //           unlink($unlink_image);
  //         }
  //         $this->session->set_flashdata('upload_success','File Uploaded Successfully');
  //       }
  //       else{
  //         $error = $this->upload->display_errors();
  //         $this->session->set_flashdata('upload_error',$error);
  //       }
  //     }
  //     $this->session->set_flashdata('update_success','success');
  //     header('location:'.base_url().'Reseller/Res_Master/reseller');
  //   }
  //   $reseller_info = $this->Master_Model->get_info_arr('reseller_id',$reseller_id,'smm_reseller');
  //   if(!$reseller_info){ header('location:'.base_url().'Reseller/Res_Master/reseller'); }
  //   $data['update'] = 'update';
  //   $data['update_reseller'] = 'update';
  //   $data['reseller_info'] = $reseller_info[0];
  //   $data['act_link'] = base_url().'Reseller/Res_Master/edit_reseller/'.$reseller_id;
  //   $state_id = $reseller_info[0]['state_id'];
  //   $country_id = $reseller_info[0]['country_id'];
  //   $data['country_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','country_name','ASC','country');
  //   $data['state_list'] = $this->Master_Model->get_list_by_id3('','country_id',$country_id,'','','','','state_name','ASC','state');
  //   $data['city_list'] = $this->Master_Model->get_list_by_id3('','state_id',$state_id,'','','','','city_name','ASC','city');
  //   // $data['branch_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','branch_name','ASC','smm_branch');
  //
  //   $data['reseller_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'reseller_added_type','2','reseller_addedby',$smm_reseller_id,'','','reseller_id','DESC','smm_reseller');
  //   $data['page'] = 'Edit Reseller';
  //   $this->load->view('Reseller/Include/head', $data);
  //   $this->load->view('Reseller/Include/navbar', $data);
  //   $this->load->view('Reseller/Res_Master/reseller', $data);
  //   $this->load->view('Reseller/Include/footer', $data);
  // }

  // Delete Reseller...
  // public function delete_reseller($reseller_id){
  //   $smm_reseller_id = $this->session->userdata('smm_reseller_id');
  //   $smm_res_company_id = $this->session->userdata('smm_res_company_id');
  //
  //   if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }
  //   $reseller_info = $this->Master_Model->get_info_arr_fields('reseller_logo, reseller_id', 'reseller_id', $reseller_id, 'smm_reseller');
  //   if($reseller_info){
  //     $reseller_logo = $reseller_info[0]['reseller_logo'];
  //     if($reseller_logo){ unlink("assets/images/reseller/".$reseller_logo); }
  //   }
  //   $this->Master_Model->delete_info('reseller_id', $reseller_id, 'smm_reseller');
  //   $this->session->set_flashdata('delete_success','success');
  //   header('location:'.base_url().'Reseller/Res_Master/reseller');
  // }

/*********************************** Slider *********************************/

  // Add Slider....
  public function slider(){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');

    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $this->form_validation->set_rules('slider_name', 'Slider Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $slider_status = $this->input->post('slider_status');
      if(!isset($slider_status)){ $slider_status = '1'; }
      $save_data = $_POST;
      $save_data['slider_status'] = $slider_status;
      $save_data['company_id'] = $smm_res_company_id;
      $save_data['slider_addedby_type'] = '2';
      $save_data['slider_addedby'] = $smm_reseller_id;
      $slider_id = $this->Master_Model->save_data('smm_slider', $save_data);

      if($_FILES['slider_image']['name']){
        $time = time();
        $image_name = 'slider_'.$slider_id.'_'.$time;
        $config['upload_path'] = 'assets/images/slider/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['slider_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('slider_image') && $slider_id && $image_name && $ext && $filename){
          $slider_image_up['slider_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('slider_id', $slider_id, 'smm_slider', $slider_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Reseller/Res_Master/slider');
    }

    $data['slider_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'slider_addedby_type','2','slider_addedby',$smm_reseller_id,'','','slider_id','DESC','smm_slider');
    $data['page'] = 'Slider';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Master/slider', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

  // Edit/Update Slider...
  public function edit_slider($slider_id){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $this->form_validation->set_rules('slider_name', 'Slider Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $slider_status = $this->input->post('slider_status');
      if(!isset($slider_status)){ $slider_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_slider_img']);
      $update_data['slider_status'] = $slider_status;
      $save_data['slider_addedby_type'] = '2';
      $this->Master_Model->update_info('slider_id', $slider_id, 'smm_slider', $update_data);

      if($_FILES['slider_image']['name']){
        $time = time();
        $image_name = 'slider_'.$slider_id.'_'.$time;
        $config['upload_path'] = 'assets/images/slider/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['slider_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('slider_image') && $slider_id && $image_name && $ext && $filename){
          $slider_image_up['slider_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('slider_id', $slider_id, 'smm_slider', $slider_image_up);
          if($_POST['old_slider_img']){ unlink("assets/images/slider/".$_POST['old_slider_img']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Reseller/Res_Master/slider');
    }

    $slider_info = $this->Master_Model->get_info_arr('slider_id',$slider_id,'smm_slider');
    if(!$slider_info){ header('location:'.base_url().'Reseller/Res_Master/slider'); }
    $data['update'] = 'update';
    $data['update_slider'] = 'update';
    $data['slider_info'] = $slider_info[0];
    $data['act_link'] = base_url().'Reseller/Res_Master/edit_slider/'.$slider_id;

    $data['slider_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'slider_addedby_type','2','slider_addedby',$smm_reseller_id,'','','slider_id','DESC','smm_slider');
    $data['page'] = 'Edit Slider';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Master/slider', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

  //Delete Slider...
  public function delete_slider($slider_id){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $slider_info = $this->Master_Model->get_info_arr_fields('slider_image, slider_id', 'slider_id', $slider_id, 'smm_slider');
    if($slider_info){
      $slider_image = $slider_info[0]['slider_image'];
      if($slider_image){ unlink("assets/images/slider/".$slider_image); }
    }
    $this->Master_Model->delete_info('slider_id', $slider_id, 'smm_slider');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Reseller/Res_Master/slider');
  }


/*********************************** Testimonial *********************************/

  // Add Testimonial....
  public function testimonial(){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $this->form_validation->set_rules('testimonial_name', 'Batch Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $testimonial_status = $this->input->post('testimonial_status');
      if(!isset($testimonial_status)){ $testimonial_status = '1'; }
      $save_data = $_POST;
      $save_data['testimonial_status'] = $testimonial_status;
      $save_data['company_id'] = $smm_res_company_id;
      $save_data['testimonial_addedby_type'] = '2';
      $save_data['testimonial_addedby'] = $smm_reseller_id;
      $testimonial_id = $this->Master_Model->save_data('smm_testimonial', $save_data);

      if($_FILES['testimonial_image']['name']){
        $time = time();
        $image_name = 'testimonial_'.$testimonial_id.'_'.$time;
        $config['upload_path'] = 'assets/images/testimonial/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['testimonial_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('testimonial_image') && $testimonial_id && $image_name && $ext && $filename){
          $testimonial_image_up['testimonial_image'] =  base_url().'assets/images/testimonial/'.$image_name.'.'.$ext;
          $this->Master_Model->update_info('testimonial_id', $testimonial_id, 'smm_testimonial', $testimonial_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Reseller/Res_Master/testimonial');
    }
    $data['testimonial_no'] = $this->Master_Model->get_count_no($smm_res_company_id, 'testimonial_no', 'smm_testimonial');

    $data['testimonial_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'testimonial_addedby_type','2','testimonial_addedby',$smm_reseller_id,'','','testimonial_id','DESC','smm_testimonial');
    $data['page'] = 'Testimonial';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Master/testimonial', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

  // Edit/Update Testimonial...
  public function edit_testimonial($testimonial_id){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $this->form_validation->set_rules('testimonial_name', 'First Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $testimonial_status = $this->input->post('testimonial_status');
      if(!isset($testimonial_status)){ $testimonial_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_testimonial_img']);
      $update_data['testimonial_status'] = $testimonial_status;
      $this->Master_Model->update_info('testimonial_id', $testimonial_id, 'smm_testimonial', $update_data);

      if($_FILES['testimonial_image']['name']){
        $time = time();
        $image_name = 'testimonial_'.$testimonial_id.'_'.$time;
        $config['upload_path'] = 'assets/images/testimonial/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['testimonial_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('testimonial_image') && $testimonial_id && $image_name && $ext && $filename){
          $testimonial_image_up['testimonial_image'] =  base_url().'assets/images/testimonial/'.$image_name.'.'.$ext;
          $this->Master_Model->update_info('testimonial_id', $testimonial_id, 'smm_testimonial', $testimonial_image_up);
          if($_POST['old_testimonial_img']){
            $unlink_image = str_replace(base_url(), "",$_POST['old_testimonial_img']);
            unlink($unlink_image);
          }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Reseller/Res_Master/testimonial');
    }

    $testimonial_info = $this->Master_Model->get_info_arr('testimonial_id',$testimonial_id,'smm_testimonial');
    if(!$testimonial_info){ header('location:'.base_url().'Master/testimonial'); }
    $data['update'] = 'update';
    $data['update_testimonial'] = 'update';
    $data['testimonial_info'] = $testimonial_info[0];
    $data['act_link'] = base_url().'Reseller/Res_Master/edit_testimonial/'.$testimonial_id;

    $data['testimonial_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'testimonial_addedby_type','2','testimonial_addedby',$smm_reseller_id,'','','testimonial_id','DESC','smm_testimonial');
    $data['page'] = 'Edit Testimonial';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Master/testimonial', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

  //Delete Testimonial...
  public function delete_testimonial($testimonial_id){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $testimonial_info = $this->Master_Model->get_info_arr_fields('testimonial_image, testimonial_id', 'testimonial_id', $testimonial_id, 'smm_testimonial');
    if($testimonial_info){
      $testimonial_image = $testimonial_info[0]['testimonial_image'];
      if($testimonial_image){
        $unlink_image = str_replace(base_url(), "",$testimonial_image);
        unlink($unlink_image);
      }
    }
    $this->Master_Model->delete_info('testimonial_id', $testimonial_id, 'smm_testimonial');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Reseller/Res_Master/testimonial');
  }


/*********************************** Blog *********************************/

  // Add Blog....
  public function blog(){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');

    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $this->form_validation->set_rules('blog_name', 'Blog Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $blog_status = $this->input->post('blog_status');
      if(!isset($blog_status)){ $blog_status = '1'; }
      $save_data = $_POST;
      $save_data['blog_status'] = $blog_status;
      $save_data['company_id'] = $smm_res_company_id;
      $save_data['blog_addedby_type'] = '2';
      $save_data['blog_addedby'] = $smm_reseller_id;
      $blog_id = $this->Master_Model->save_data('smm_blog', $save_data);

      if($_FILES['blog_image']['name']){
        $time = time();
        $image_name = 'blog_'.$blog_id.'_'.$time;
        $config['upload_path'] = 'assets/images/blog/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['blog_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('blog_image') && $blog_id && $image_name && $ext && $filename){
          $blog_image_up['blog_image'] =  base_url().'assets/images/blog/'.$image_name.'.'.$ext;
          $this->Master_Model->update_info('blog_id', $blog_id, 'smm_blog', $blog_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Reseller/Res_Master/blog');
    }

    $data['blog_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'blog_addedby_type','2','blog_addedby',$smm_reseller_id,'','','blog_id','DESC','smm_blog');
    $data['page'] = 'Blog';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Master/blog', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

  // Edit/Update Blog...
  public function edit_blog($blog_id){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $this->form_validation->set_rules('blog_name', 'Blog Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $blog_status = $this->input->post('blog_status');
      if(!isset($blog_status)){ $blog_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_blog_img']);
      $update_data['blog_status'] = $blog_status;
      $save_data['blog_addedby_type'] = '2';
      $this->Master_Model->update_info('blog_id', $blog_id, 'smm_blog', $update_data);

      if($_FILES['blog_image']['name']){
        $time = time();
        $image_name = 'blog_'.$blog_id.'_'.$time;
        $config['upload_path'] = 'assets/images/blog/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['blog_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('blog_image') && $blog_id && $image_name && $ext && $filename){
          $blog_image_up['blog_image'] =  base_url().'assets/images/blog/'.$image_name.'.'.$ext;
          $this->Master_Model->update_info('blog_id', $blog_id, 'smm_blog', $blog_image_up);
          if($_POST['old_blog_img']){
            $unlink_image = str_replace(base_url(), "",$_POST['old_blog_img']);
            unlink($unlink_image);
          }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Reseller/Res_Master/blog');
    }

    $blog_info = $this->Master_Model->get_info_arr('blog_id',$blog_id,'smm_blog');
    if(!$blog_info){ header('location:'.base_url().'Reseller/Res_Master/blog'); }
    $data['update'] = 'update';
    $data['update_blog'] = 'update';
    $data['blog_info'] = $blog_info[0];
    $data['act_link'] = base_url().'Reseller/Res_Master/edit_blog/'.$blog_id;

    $data['blog_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'blog_addedby_type','2','blog_addedby',$smm_reseller_id,'','','blog_id','DESC','smm_blog');
    $data['page'] = 'Edit Blog';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Master/blog', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

  //Delete Blog...
  public function delete_blog($blog_id){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $blog_info = $this->Master_Model->get_info_arr_fields('blog_image, blog_id', 'blog_id', $blog_id, 'smm_blog');
    if($blog_info){
      $blog_image = $blog_info[0]['blog_image'];
      if($blog_image){
        $unlink_image = str_replace(base_url(), "",$blog_image);
        unlink($unlink_image);
      }
    }
    $this->Master_Model->delete_info('blog_id', $blog_id, 'smm_blog');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Reseller/Res_Master/blog');
  }


/************************************* Web Setting **************************************/
  public function web_setting(){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $this->form_validation->set_rules('web_setting_name', 'web_setting title', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $update_data = $_POST;
      unset($update_data['old_web_setting_logo']);
      unset($update_data['old_web_setting_favicon']);
      // $update_data['reseller_status'] = $reseller_status;
      // $update_data['reseller_addedby'] = '0';
      $this->Master_Model->update_info('reseller_id', $smm_reseller_id, 'smm_web_setting', $update_data);

      if($_FILES['web_setting_logo']['name']){
        $time = time();
        $image_name = 'web_setting_logo'.$smm_reseller_id.'_'.$time;
        $config['upload_path'] = 'assets/images/web_setting/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['web_setting_logo']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('web_setting_logo') && $smm_reseller_id && $image_name && $ext && $filename){
          $web_setting_logo_up['web_setting_logo'] =  base_url().'assets/images/web_setting/'.$image_name.'.'.$ext;
          $this->Master_Model->update_info('reseller_id', $smm_reseller_id, 'smm_web_setting', $web_setting_logo_up);
          if($_POST['old_web_setting_logo']){
            $unlink_image = str_replace(base_url(), "",$_POST['old_web_setting_logo']);
            unlink($unlink_image);
          }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      if($_FILES['web_setting_favicon']['name']){
        $time = time();
        $image_name = 'web_setting_favicon'.$smm_reseller_id.'_'.$time;
        $config['upload_path'] = 'assets/images/web_setting/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['web_setting_favicon']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('web_setting_favicon') && $smm_reseller_id && $image_name && $ext && $filename){
          $web_setting_favicon_up['web_setting_favicon'] =  base_url().'assets/images/web_setting/'.$image_name.'.'.$ext;
          $this->Master_Model->update_info('reseller_id', $smm_reseller_id, 'smm_web_setting', $web_setting_favicon_up);
          if($_POST['old_web_setting_favicon']){
            $unlink_image = str_replace(base_url(), "",$_POST['old_web_setting_favicon']);
            unlink($unlink_image);
          }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Reseller/Res_Master/web_setting');
    }

    $web_setting_info = $this->Master_Model->get_info_arr('reseller_id',$smm_reseller_id,'smm_web_setting');
    if(!$web_setting_info){ header('location:'.base_url().'Reseller/Res_User/dashboard'); }
    $data['update'] = 'update';
    $data['update_web_setting'] = 'update';
    $data['web_setting_info'] = $web_setting_info[0];
    // $data['act_link'] = base_url().'Res_Master/edit_web_setting/'.$smm_reseller_id;
    $state_id = $web_setting_info[0]['state_id'];
    $country_id = $web_setting_info[0]['country_id'];
    $data['country_list'] = $this->Master_Model->get_list_by_id3('','','','','','','','country_name','ASC','country');
    $data['state_list'] = $this->Master_Model->get_list_by_id3('','country_id',$country_id,'','','','','state_name','ASC','state');
    $data['city_list'] = $this->Master_Model->get_list_by_id3('','state_id',$state_id,'','','','','city_name','ASC','city');
    // $data['branch_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','branch_name','ASC','smm_branch');

    $data['page'] = 'Website Settings';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Master/web_setting', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }



/*********************************** Web Setup Request *********************************/

  // Add Web Setup Request....
  public function web_setup_request(){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');

    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $this->form_validation->set_rules('web_setup_request_no', 'Web Setup Request Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      // $web_setup_request_status = $this->input->post('web_setup_request_status');
      // if(!isset($web_setup_request_status)){ $web_setup_request_status = '1'; }
      $save_data = $_POST;
      $save_data['web_setup_request_status'] = '0';
      $save_data['reseller_id'] = $smm_reseller_id;
      $save_data['company_id'] = $smm_res_company_id;
      $save_data['web_setup_request_addedby_type'] = '2';
      $save_data['web_setup_request_addedby'] = $smm_reseller_id;
      $web_setup_request_id = $this->Master_Model->save_data('smm_web_setup_request', $save_data);

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Reseller/Res_Master/web_setup_request');
    }

    $data['web_setup_request_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'web_setup_request_addedby_type','2','web_setup_request_addedby',$smm_reseller_id,'','','web_setup_request_id','DESC','smm_web_setup_request');
    $data['page'] = 'Web Setup Request';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Master/web_setup_request', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

  // Edit/Update Web Setup Request...
  public function edit_web_setup_request($web_setup_request_id){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $this->form_validation->set_rules('web_setup_request_no', 'Web Setup Request Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $update_data = $_POST;
      $this->Master_Model->update_info('web_setup_request_id', $web_setup_request_id, 'smm_web_setup_request', $update_data);

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Reseller/Res_Master/web_setup_request');
    }

    $web_setup_request_info = $this->Master_Model->get_info_arr('web_setup_request_id',$web_setup_request_id,'smm_web_setup_request');
    if(!$web_setup_request_info){ header('location:'.base_url().'Reseller/Res_Master/web_setup_request'); }
    $data['update'] = 'update';
    $data['update_web_setup_request'] = 'update';
    $data['web_setup_request_info'] = $web_setup_request_info[0];
    $data['act_link'] = base_url().'Reseller/Res_Master/edit_web_setup_request/'.$web_setup_request_id;

    $data['web_setup_request_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'web_setup_request_addedby_type','2','web_setup_request_addedby',$smm_reseller_id,'','','web_setup_request_id','DESC','smm_web_setup_request');
    $data['page'] = 'Edit Web Setup Request';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Master/web_setup_request', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

  //Delete Web Setup Request...
  public function delete_web_setup_request($web_setup_request_id){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $web_setup_request_info = $this->Master_Model->get_info_arr_fields('web_setup_request_image, web_setup_request_id', 'web_setup_request_id', $web_setup_request_id, 'smm_web_setup_request');
    if($web_setup_request_info){
      $web_setup_request_image = $web_setup_request_info[0]['web_setup_request_image'];
      if($web_setup_request_image){ unlink("assets/images/web_setup_request/".$web_setup_request_image); }
    }
    $this->Master_Model->delete_info('web_setup_request_id', $web_setup_request_id, 'smm_web_setup_request');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Reseller/Res_Master/web_setup_request');
  }


























/*********************************** Announcement *********************************/

  // Add Announcement....
  public function announcement(){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $this->form_validation->set_rules('announcement_name', 'Batch Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $announcement_status = $this->input->post('announcement_status');
      if(!isset($announcement_status)){ $announcement_status = '1'; }
      $save_data = $_POST;
      $save_data['announcement_status'] = $announcement_status;
      $save_data['company_id'] = $smm_res_company_id;
      $save_data['announcement_addedby_type'] = '2';
      $save_data['announcement_addedby'] = $smm_reseller_id;
      $announcement_id = $this->Master_Model->save_data('smm_announcement', $save_data);

      if($_FILES['announcement_image']['name']){
        $time = time();
        $image_name = 'announcement_'.$announcement_id.'_'.$time;
        $config['upload_path'] = 'assets/images/announcement/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['announcement_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('announcement_image') && $announcement_id && $image_name && $ext && $filename){
          $announcement_image_up['announcement_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('announcement_id', $announcement_id, 'smm_announcement', $announcement_image_up);
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'Reseller/Res_Master/announcement');
    }
    $data['branch_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','branch_name','ASC','smm_branch');
    $data['department_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','department_name','ASC','smm_department');

    $data['announcement_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'announcement_addedby_type','2','announcement_addedby',$smm_reseller_id,'','','announcement_id','DESC','smm_announcement');
    $data['page'] = 'Announcement';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Master/announcement', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

  // Edit/Update Announcement...
  public function edit_announcement($announcement_id){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $this->form_validation->set_rules('announcement_name', 'First Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $announcement_status = $this->input->post('announcement_status');
      if(!isset($announcement_status)){ $announcement_status = '1'; }
      $update_data = $_POST;
      unset($update_data['old_announcement_img']);
      $update_data['announcement_status'] = $announcement_status;
      $this->Master_Model->update_info('announcement_id', $announcement_id, 'smm_announcement', $update_data);

      if($_FILES['announcement_image']['name']){
        $time = time();
        $image_name = 'announcement_'.$announcement_id.'_'.$time;
        $config['upload_path'] = 'assets/images/announcement/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['file_name'] = $image_name;
        $filename = $_FILES['announcement_image']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $this->upload->initialize($config); // if upload library autoloaded
        if ($this->upload->do_upload('announcement_image') && $announcement_id && $image_name && $ext && $filename){
          $announcement_image_up['announcement_image'] =  $image_name.'.'.$ext;
          $this->Master_Model->update_info('announcement_id', $announcement_id, 'smm_announcement', $announcement_image_up);
          if($_POST['old_announcement_img']){ unlink("assets/images/announcement/".$_POST['old_announcement_img']); }
          $this->session->set_flashdata('upload_success','File Uploaded Successfully');
        }
        else{
          $error = $this->upload->display_errors();
          $this->session->set_flashdata('upload_error',$error);
        }
      }

      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'Reseller/Res_Master/announcement');
    }

    $announcement_info = $this->Master_Model->get_info_arr('announcement_id',$announcement_id,'smm_announcement');
    if(!$announcement_info){ header('location:'.base_url().'Reseller/Res_Master/announcement'); }
    $data['update'] = 'update';
    $data['update_announcement'] = 'update';
    $data['announcement_info'] = $announcement_info[0];
    $data['act_link'] = base_url().'Reseller/Res_Master/edit_announcement/'.$announcement_id;
    $data['branch_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','branch_name','ASC','smm_branch');
    $data['department_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'','','','','','','department_name','ASC','smm_department');

    $data['announcement_list'] = $this->Master_Model->get_list_by_id3($smm_res_company_id,'announcement_addedby_type','2','announcement_addedby',$smm_reseller_id,'','','announcement_id','DESC','smm_announcement');
    $data['page'] = 'Edit Announcement';
    $this->load->view('Reseller/Include/head', $data);
    $this->load->view('Reseller/Include/navbar', $data);
    $this->load->view('Reseller/Res_Master/announcement', $data);
    $this->load->view('Reseller/Include/footer', $data);
  }

  //Delete Announcement...
  public function delete_announcement($announcement_id){
    $smm_reseller_id = $this->session->userdata('smm_reseller_id');
    $smm_res_company_id = $this->session->userdata('smm_res_company_id');
    if($smm_reseller_id == '' || $smm_res_company_id == ''){ header('location:'.base_url().'Reseller/Res_User'); }

    $announcement_info = $this->Master_Model->get_info_arr_fields('announcement_image, announcement_id', 'announcement_id', $announcement_id, 'smm_announcement');
    if($announcement_info){
      $announcement_image = $announcement_info[0]['announcement_image'];
      if($announcement_image){ unlink("assets/images/announcement/".$announcement_image); }
    }
    $this->Master_Model->delete_info('announcement_id', $announcement_id, 'smm_announcement');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'Reseller/Res_Master/announcement');
  }






/**********************************************************************************************/

  // Check Duplication
  public function check_duplication(){
    $column_name = $this->input->post('column_name');
    $column_val = $this->input->post('column_val');
    $table_name = $this->input->post('table_name');
    $company_id = '';
    $cnt = $this->Master_Model->check_duplication($company_id,$column_val,$column_name,$table_name);
    echo $cnt;
  }


  // get_state_by_country
  public function get_state_by_country(){
    $country_id = $this->input->post('country_id');
    $state_list = $this->Master_Model->get_list_by_id3('','country_id',$country_id,'','','','','state_name','ASC','state');
    echo "<option value='' selected >Select State</option>";
    foreach ($state_list as $list) {
      echo "<option value='".$list->state_id."'> ".$list->state_name." </option>";
    }
  }

  // get_city_by_state
  public function get_city_by_state(){
    $state_id = $this->input->post('state_id');
    $city_list = $this->Master_Model->get_list_by_id3('','state_id',$state_id,'','','','','city_name','ASC','city');
    echo "<option value='' selected >Select City</option>";
    foreach ($city_list as $list) {
      echo "<option value='".$list->city_id."'> ".$list->city_name." </option>";
    }
  }
}
?>
