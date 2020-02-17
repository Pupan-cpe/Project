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

          <!-- search form (Optional)
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form> -->
      <!-- search form (Optional) -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form> -->
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
    <li class="header">เมนูหลัก</li>
    
    <li class="treeview">
      <a href="#"><i class="glyphicon glyphicon-scale"></i> <span>เครื่องชั่ง
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
      </a>  
      <ul class="treeview-menu">
        <li><a href="scale01.php">เครื่องชั่งที่ 1</a></li>
        <li><a href="scale02.php">เครื่องชั่งที่ 2</a></li>
        
      </ul>
    </li>


    <li class="treeview">
      <a href="#"><i class="fa fa-database"></i> <span>ข้อมูลสินค้า
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
      </a>  

      <ul class="treeview-menu">
    
    <li><a href="product.php"><i class="fa fa-shopping-basket"></i> <span>โรงงานที่1</span></a></li>
    <li><a href="product2.php"><i class="fa fa-shopping-basket"></i> <span>โรงงานที่2</span></a></li>
        
      </ul>
    </li>
  
    <!-- Optionally, you can add icons to the links -->
    <li class="#"><a href="customer.php"><i class="fa fa-male"></i> <span>ข้อมูลลูกค้า</span></a></li>
    <!-- <li class="#"><a href="employee.php"><i class="fa fa-vcard-o"></i> <span>ข้อมูลพนักงาน</span></a></li> -->
   
    <li><a href="product_type.php"><i class="	glyphicon glyphicon-refresh"></i> <span>ประเภทสินค้า</span></a></li>
    <li><a href="sale.php"><i class="fa fa-link"></i> <span>ข้อมูลการรับซื้อ</span></a></li>
    <!-- <li><a href="calender.php"><i class="fa fa-calendar"></i> <span>ปฏิทินวันหยุด</span></a></li> -->
    <li><a href="user.php"><i class="fa fa-male"></i> <span>ข้อมูลผู้ใช้งานระบบ</span></a></li>

    
 

    <li class="header">รายงาน</li>
      <li><a href="report3.php"><i class="fa fa-check-circle"></i> <span>สรุปยอดรับซื้อ </span></a></li>
      <li><a href="img_all.php"><i class="fa fa-id-card"></i> <span>คลังรูปภาพ</span></a></li>
      <!-- <li><a href="cust_report.php"><i class="fa fa-address-card"></i> <span>รายงานพนักงาน</span></a></li> -->
         
         
            </ul>
        
    </section>
    <!-- /.sidebar -->
  </aside>