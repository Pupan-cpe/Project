<aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="dist/img/<?php echo $s_userPicture; ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p> <?php echo $s_userFullname; ?></p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- search form (Optional) -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">เมนูหลัก</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="order.php"><i class="fa fa-paypal"></i> <span>ข้อมูลการสั่งซื้อ</span></a></li>
            <li><a href="customer.php"><i class="fa fa-male"></i> <span>ข้อมูลลูกค้า</span></a></li>
            <li><a href="employee.php"><i class="fa fa-apple"></i> <span>ข้อมูลพนักงาน</span></a></li>
            <li><a href="news.php"><i class="fa fa-newspaper-o"></i> <span>ข่าวสารบริษัท</span></a></li>
            <li><a href="calendar.php"><i class="fa fa-calendar"></i> <span>ข้อมูลปฏิทินกิจกรรม</span></a></li>
            <li><a href="product.php"><i class="fa fa-barcode"></i> <span>ข้อมูลสินค้า</span></a></li>
            <li><a href="product_type.php"><i class="fa fa-bars"></i> <span>ข้อมูลประเภทสินค้า</span></a></li>
            <li><a href="user.php"><i class="fa fa-user"></i> <span>ข้อมูลผู้ใช้งานระบบ</span></a></li>
            
            <!-- <li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="#">Link in level 2</a></li>
                <li><a href="#">Link in level 2</a></li>
              </ul>
            </li> -->
            
            <li class="header">รายงาน</li>
            <li><a href="report1.php"><i class="fa fa-bars"></i> <span>จำนวนสินค้าแยกตามประเภท</span></a></li>
            <li><a href="#"><i class="fa fa-bars"></i> <span>รายงานยอดขาย</span></a></li>
            <li><a href="#"><i class="fa fa-cube"></i> <span>รายงานพนักงาน</span></a></li>
            <li><a href="product_barcode.php"><i class="fa fa-bar-chart"></i> <span>รายงานสินค้า</span></a></li>
            <li><a href="cust_report.php"><i class="fa fa-female"></i> <span>รายงานลูกค้า</span></a></li>
            <li><a href="#"><i class="fa fa-star"></i> <span>รายงานสินค้าคงเหลือ</span></a></li>
            
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>