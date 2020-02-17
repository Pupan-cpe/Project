<!DOCTYPE html>
<html lang="en">
<?php

include 'head.php';
?>
<!--/head-->

<?php include 'header.php'; ?>
<!--/header-->

<section id="title" class="emerald">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h1>ผลงาน</h1>
                <p>Pellentesque habitant morbi tristique senectus et netus et malesuada</p>
            </div>
            <div class="col-sm-6">
                <ul class="breadcrumb pull-right">
                    <li><a href="index.php">หน้าหลัก</a></li>
                    <li class="active">ผลงาน</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!--/#title-->

<section id="portfolio" class="container">
    <ul class="portfolio-filter">
        <li><a class="btn btn-default active" href="#" data-filter="*">All</a></li>
        <li><a class="btn btn-default" href="#" data-filter=".bootstrap">Bootstrap</a></li>
        <li><a class="btn btn-default" href="#" data-filter=".html">HTML</a></li>
        <li><a class="btn btn-default" href="#" data-filter=".wordpress">Wordpress</a></li>
    </ul>
    <!--/#portfolio-filter-->

    <ul class="portfolio-items col-3">
        <li class="portfolio-item apps">
            <div class="item-inner">
                <img src="images/portfolio/thumb/item1.jpg" alt="">
                <h5>Lorem ipsum dolor sit amet</h5>
                <div class="overlay">
                    <a class="preview btn btn-danger" href="images/portfolio/full/item1.jpg" rel="prettyPhoto"><i class="icon-eye-open"></i></a>
                </div>
            </div>
        </li>
        <!--/.portfolio-item-->
        <li class="portfolio-item joomla bootstrap">
            <div class="item-inner">
                <img src="images/portfolio/thumb/item2.jpg" alt="">
                <h5>Lorem ipsum dolor sit amet</h5>
                <div class="overlay">
                    <a class="preview btn btn-danger" href="images/portfolio/full/item2.jpg" rel="prettyPhoto"><i class="icon-eye-open"></i></a>
                </div>
            </div>
        </li>
        <!--/.portfolio-item-->
        <li class="portfolio-item bootstrap wordpress">
            <div class="item-inner">
                <img src="images/portfolio/thumb/item3.jpg" alt="">
                <h5>Lorem ipsum dolor sit amet</h5>
                <div class="overlay">
                    <a class="preview btn btn-danger" href="images/portfolio/full/item3.jpg" rel="prettyPhoto"><i class="icon-eye-open"></i></a>
                </div>
            </div>
        </li>
        <!--/.portfolio-item-->
        <li class="portfolio-item joomla wordpress apps">
            <div class="item-inner">
                <img src="images/portfolio/thumb/item4.jpg" alt="">
                <h5>Lorem ipsum dolor sit amet</h5>
                <div class="overlay">
                    <a class="preview btn btn-danger" href="images/portfolio/full/item4.jpg" rel="prettyPhoto"><i class="icon-eye-open"></i></a>
                </div>
            </div>
        </li>
        <!--/.portfolio-item-->
        <li class="portfolio-item joomla html">
            <div class="item-inner">
                <img src="images/portfolio/thumb/item5.jpg" alt="">
                <h5>Lorem ipsum dolor sit amet</h5>
                <div class="overlay">
                    <a class="preview btn btn-danger" href="images/portfolio/full/item5.jpg" rel="prettyPhoto"><i class="icon-eye-open"></i></a>
                </div>
            </div>
        </li>
        <!--/.portfolio-item-->
        <li class="portfolio-item wordpress html">
            <div class="item-inner">
                <img src="images/portfolio/thumb/item6.jpg" alt="">
                <h5>Lorem ipsum dolor sit amet</h5>
                <div class="overlay">
                    <a class="preview btn btn-danger" href="images/portfolio/full/item6.jpg" rel="prettyPhoto"><i class="icon-eye-open"></i></a>
                </div>
            </div>
        </li>
        <!--/.portfolio-item-->
    </ul>
</section>
<!--/#portfolio-->

<section id="bottom" class="wet-asphalt">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <h4>About Us</h4>
                <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.</p>
                <p>Pellentesque habitant morbi tristique senectus.</p>
            </div>
            <!--/.col-md-3-->

            <div class="col-md-3 col-sm-6">
                <h4>Company</h4>
                <div>
                    <ul class="arrow">
                        <li><a href="#">The Company</a></li>
                        <li><a href="#">Our Team</a></li>
                        <li><a href="#">Our Partners</a></li>
                        <li><a href="#">Our Services</a></li>
                        <li><a href="#">Faq</a></li>
                        <li><a href="#">Conatct Us</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Use</a></li>
                        <li><a href="#">Copyright</a></li>
                    </ul>
                </div>
            </div>
         <!--/#about-us-->
    <?php include 'bottom.php'; ?>
    <!--/#bottom-->

    <?php include 'footer.php'; ?>


            </body>

</html>