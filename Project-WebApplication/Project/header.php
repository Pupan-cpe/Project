 <?php
    $menu_active = basename($_SERVER['REQUEST_URI']);

    ?>



 <header class="navbar navbar-inverse navbar-fixed-top wet-asphalt" role="banner">
     <div class="container">
         <div class="navbar-header">
             <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                 <span class="sr-only">Toggle navigation</span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
                 <span class="icon-bar"></span>
             </button>
             <a class="navbar-brand" href="index.php"><img src="images/logogo.png" alt="logo"></a>
         </div>
         <div class="collapse navbar-collapse">
             <ul class="nav navbar-nav navbar-right">
                 <?php
                    switch ($menu_active) {
                        case "index.php":
                            echo ' <li class="active"><a href="index.php">หน้าหลัก</a></li>
                            <li><a href="about-us.php">เกี่ยวกับเรา</a></li>';
                            break;

                        case "about-us.php":
                            echo ' <li ><a href="index.php">หน้าหลัก</a></li>
                            <li class="active" ><a href="about-us.php">เกี่ยวกับเรา</a></li>';
                            break;

                           

                                // case "portfolio.php":
                                //     echo ' <li ><a href="index.php">หน้าหลัก</a></li>
                                //     <li  ><a href="about-us.php">เกี่ยวกับเรา</a></li>
                                //     <li class="active" ><a href="portfolio.php">ผลงาน</a></li>';
                                //     break;

                    }
                    ?>
                
                 <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">อื่นๆ <i class="icon-angle-down"></i></a>
                     <ul class="dropdown-menu">
                         <li><a href="career.html">รับสมัครงาน</a></li>
                         
                     </ul>
                 </li>
                
                 <li><a href="admin/index.php">เข้าสู่ระบบ</a></li>
             </ul>
         </div>
     </div>
 </header>