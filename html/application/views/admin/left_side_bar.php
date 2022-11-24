<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a class="brand-link">
      <img src="<?php echo public_url('admin/AdminLTE-master/'); ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Trang Quản Trị</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <!-- <div class="image">
          <img src="<?php echo public_url('admin/AdminLTE-master/'); ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> -->
        <div class="info">
          <a href="#" class="d-block">Xin chào, <?php echo $this->session->userdata('name')  ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>Tài khoản QTV <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <?php if($this->session->userdata('group_id') < '2'): ?>
              <li class="nav-item"><a href="<?php echo admin_url('admin/add') ?>" class="nav-link"><p>Tạo Mới QTV</p></a></li>
              <li class="nav-item"><a href="<?php echo admin_url('admin/index') ?>" class="nav-link"><p>Danh sách QTV</p></a></li>
              <?php endif; ?>
              <li class="nav-item"><a href="<?php echo admin_url('admin/edit') ?>" class="nav-link"><p>Đổi Mật Khẩu</p></a></li>
            </ul>
          </li>
          <?php if($this->session->userdata('group_id') < '2'): ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>Thông Tin Website <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="<?php echo admin_url('site_info/edit/1') ?>" class="nav-link"><p>Chỉnh Sửa Thông Tin Website</p></a></li>
            </ul>
          </li>
          <?php endif; ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>Dự Án <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="<?php echo admin_url('project/add') ?>" class="nav-link"><p>Tạo Mới Dự Án</p></a></li>
              <li class="nav-item"><a href="<?php echo admin_url('project/index') ?>" class="nav-link"><p>Danh sách Dự Án</p></a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>Chủ Đầu Tư <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="<?php echo admin_url('chu_dau_tu/add') ?>" class="nav-link"><p>Tạo Mới Chủ Đầu Tư</p></a></li>
              <li class="nav-item"><a href="<?php echo admin_url('chu_dau_tu/index') ?>" class="nav-link"><p>Danh sách Chủ Đầu Tư</p></a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>Tin Tức <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="<?php echo admin_url('news/add') ?>" class="nav-link"><p>Tạo Mới Tin Tức</p></a></li>
              <li class="nav-item"><a href="<?php echo admin_url('news/index') ?>" class="nav-link"><p>Danh sách Tin Tức</p></a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <p>banner <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="<?php echo admin_url('banner/add') ?>" class="nav-link"><p>Tạo Mới banner</p></a></li>
              <li class="nav-item"><a href="<?php echo admin_url('banner/index') ?>" class="nav-link"><p>Danh sách banner</p></a></li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>