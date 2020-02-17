


 <header class="main-header">

<!-- Logo -->
<a href="index.php" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><b>C</b>PE</span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><b>CPE</b>NPU</span>
</a>

<!-- Header Navbar -->
<nav class="navbar navbar-static-top" role="navigation">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>
  <!-- Navbar Right Menu -->
  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- Messages: style can be found in dropdown.less-->
      <li class="dropdown messages-menu">
        <!-- Menu toggle button -->
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        
          <span class="label label-success"></span>
        </a>
        <ul class="dropdown-menu">
         
          <li>
            <!-- inner menu: contains the messages -->
            <ul class="menu">
              <li><!-- start message -->
                <a href="#">
                  <div class="pull-left">
                    <!-- User Image -->
                   
                  </div>
                  <!-- Message title and timestamp -->
                  <h4>
                
                  </h4>
                  <!-- The message -->
                  <p></p>
                </a>
              </li>
              <!-- end message -->
            </ul>
            <!-- /.menu -->
          </li>
          <li class="footer"><a href="#"></a></li>
        </ul>
      </li>
      <!-- /.messages-menu -->

      <!-- Notifications Menu -->
      <li class="dropdown notifications-menu">
        <!-- Menu toggle button -->
       
      <!-- User Account Menu -->
      <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="dist/img/<?php echo $s_userPicture; ?>" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?php echo $s_userFullname; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                      <img src="dist/img/<?php echo $s_userPicture; ?>" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $s_userFullname; ?>
                    </p>
                  </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="profile" class="btn btn-default btn-flat">โปรไฟล์</a>
            </div>
            <div class="pull-right">
              <a href="logout.php" class="btn btn-default btn-flat">ออกจากระบบ</a>
            </div>
          </li>
        </ul>
      </li>
      <!-- Control Sidebar Toggle Button -->
      
    </ul>
  </div>
</nav>
</header>
