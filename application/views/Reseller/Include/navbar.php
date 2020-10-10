<?php
  $smm_reseller_id = $this->session->userdata('smm_reseller_id');
  $smm_res_company_id = $this->session->userdata('smm_res_company_id');
  $web_reseller_id = $this->session->userdata('web_reseller_id');
  // $smm_role_id = $this->session->userdata('smm_role_id');
  $company_info = $this->Master_Model->get_info_arr_fields('company_name, company_shortname, company_logo','company_id', $smm_res_company_id, 'company');
  $reseller_info = $this->Master_Model->get_info_arr_fields('reseller_name, reseller_logo','reseller_id', $smm_reseller_id, 'smm_reseller');

  $web_reseller_info = $this->Master_Model->get_info_arr_fields('web_setting_name, web_setting_logo, web_setting_favicon','reseller_id', $web_reseller_id, 'smm_web_setting');
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <?php
      $wallet_amount = $this->Master_Model->get_sum($smm_res_company_id,'commission_amount','reseller_id',$smm_reseller_id,'','','','','smm_commission');
      $redeem_amount = $this->Master_Model->get_sum($smm_res_company_id,'redeem_request_amount','reseller_id',$smm_reseller_id,'redeem_request_status','1','','','smm_redeem_request');
      if(!$wallet_amount){ $wallet_amount = '0'; }
      if(!$redeem_amount){ $redeem_amount = '0'; }
      $wallet_balance = $wallet_amount - $redeem_amount;
    ?>
    <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url(); ?>Reseller/Res_Invoice/redeem_request">
        Wallet Amount : <b>₹<?php echo $wallet_balance; ?></b>
      </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
          <i class="far fa-user"></i>
          <?php echo $reseller_info[0]['reseller_name']; ?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- <div class="dropdown-item"> -->
            <div class="row">
              <div class="col-6 text-center">
                <a href="<?php echo base_url(); ?>Reseller/Res_User/profile" class="dropdown-item py-4">
                <!-- <a href="" class="dropdown-item py-4"> -->
                  <i class="far fa-user f-22"></i><br>Profile
                </a>
              </div>
              <div class="col-6 text-center">
                <a href="<?php echo base_url(); ?>Reseller/Res_User/dashboard" class="dropdown-item py-4">
                  <i class="fas fa-th f-22"></i><br>Dashboars
                </a>
              </div>
            </div>
          <!-- </div> -->
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url(); ?>Reseller/Res_User/logout" class="dropdown-item dropdown-footer"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
      </li>
    <!-- <li class="nav-item">
      <a class="nav-link" href="<?php echo base_url(); ?>User/logout">
        <i class="fas fa-sign-out-alt"></i>
      </a>
    </li> -->
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
        <i class="fas fa-th-large"></i>
      </a>
    </li>
  </ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <?php if($web_reseller_info[0]['web_setting_logo']){ ?>
      <img src="<?php echo $web_reseller_info[0]['web_setting_logo']; ?>" alt="" class="brand-image elevation-3" style="opacity: .8">
    <?php } ?>
    <span class="brand-text font-weight-light f-16"><?php echo $web_reseller_info[0]['web_setting_name']; ?></span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <?php if($reseller_info[0]['reseller_logo']){ ?>
          <img src="<?php echo $reseller_info[0]['reseller_logo'];  ?>" class="img-circle elevation-2" alt="User Image">
        <?php } ?>
      </div>
      <div class="info">
        <a href="<?php echo base_url(); ?>Reseller/Res_User/profile" class="d-block"><?php echo $reseller_info[0]['reseller_name']; ?></a>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="<?php echo base_url(); ?>Reseller/Res_User/dashboard" class="nav-link head">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url(); ?>Reseller/Res_User/become_reseller" class="nav-link head">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Become Reseller
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a target="_blank" href="https://vcclhosting.com/" class="nav-link head">
            <i class="nav-icon fas fa-tags"></i>
            <p>
              Buy Domain & Hosting
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?php echo base_url(); ?>Reseller/Res_Master/web_setup_request" class="nav-link head">
            <i class="nav-icon fas fa-globe"></i>
            <p>
              Website Setup Request
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link head">
            <i class="nav-icon far fa-money-bill-alt"></i>
            <p>
              Package
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a  href="<?php echo base_url(); ?>Reseller/Res_Package/package_list" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Packages From Admin</p>
              </a>
            </li>
            <li class="nav-item">
              <a  href="<?php echo base_url(); ?>Reseller/Res_Package/my_package_list" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>My Packages</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_reseller_coupon)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Reseller/Res_Package/reseller_coupon" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Coupon</p>
              </a>
            </li>

          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link head">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Reseller Section
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a  href="<?php echo base_url(); ?>Reseller/Res_Master/reseller" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Reseller</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="<?php echo base_url(); ?>Reseller/Res_Invoice/order_list" class="nav-link head">
            <i class="nav-icon fas fa-th"></i>
            <p>Order</p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link head">
            <i class="nav-icon fas fa-list"></i>
            <p>
              Invoice
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>Reseller/Res_Invoice/invoice_setting" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Invoice Setting</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>Reseller/Res_Invoice/invoice_list" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Invoice List(By Admin)</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>Reseller/Res_Invoice/invoice_to_cust_list" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Invoice List(To Customer)</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>Reseller/Res_Invoice/commission_list" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Commission</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link head">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Project
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>Reseller/Res_Project/project" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Project</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_ticket)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Reseller/Res_Project/ticket" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Ticket</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_task)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Reseller/Res_Project/task" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Task</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_project_revision)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Reseller/Res_Project/project_revision" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Project Revision </p>
              </a>
            </li>

          </ul>
        </li>




        <li class="nav-item">
          <a target="_blank" href="<?php echo base_url(); ?>Reseller/Res_Invoice/redeem_request" class="nav-link head">
            <i class="nav-icon far fa-money-bill-alt"></i>
            <p>
              Redeem Request
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?php echo base_url(); ?>Reseller/Res_Master/announcement" class="nav-link head">
            <i class="nav-icon fas fa-bullhorn"></i>
            <p>Announcement</p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link head">
            <i class="nav-icon fas fa-globe"></i>
            <p>
              Website
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="display: none;">
            <li class="nav-item">
              <a href="<?php echo base_url(); ?>Reseller/Res_Master/web_setting" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Web Setting</p>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a <?php if(isset($update_slider)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Reseller/Res_Master/slider" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Slider</p>
              </a>
            </li> -->
            <li class="nav-item">
              <a <?php if(isset($update_testimonial)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Reseller/Res_Master/testimonial" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Testimonial</p>
              </a>
            </li>
            <li class="nav-item">
              <a <?php if(isset($update_blog)){ echo 'href="'.$act_link.'"'; } else{ ?> href="<?php echo base_url(); ?>Reseller/Res_Master/blog" <?php } ?> class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Blog</p>
              </a>
            </li>
          </ul>
        </li>



      </nav>
    <!-- /.sidebar-menu -->
    </div>
  <!-- /.sidebar -->
  </aside>
