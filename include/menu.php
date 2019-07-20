<?php

$query=mysqli_query($con,"select access from tbl_users WHERE id=".$_SESSION['user_id']);
$resulte=mysqli_fetch_array($query);


$acsseses = unserialize($resulte[0]);
//تبدیل آرایه رشته ای به آرایه عددی
$acsseses = array_map(function($arr) {
    return intval($arr);
}, $acsseses);

?>

<aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
   
                        <li> 
                            <a class="waves-effect waves-dark" href="dashboard.php">
                                <span class="menufont">
                                    <i  class="fas fa-home"></i>
                                    <span class="hide-menu">
                                     صفحه اصلی
                                   </span>  
                                </span>
                            </a>
                        </li>

                        <?php if(in_array(7,$acsseses) || in_array(9,$acsseses)) { ?>
                        <li> 
                            <a class="has-arrow waves-effect waves-dark">
                
                                <span class="menufont">
                                    <i  class="fas fa-hamburger"></i>
                                    <span class="hide-menu">
                                     رستوران
                                   </span>  
                                </span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li class="menufont"><a href="foodcategory.php">دسته بندی غذا</a></li>
                                <li class="menufont"><a href="food.php">منو غذاها</a></li>
                            </ul>
                        </li>
                        <?php } 
                        if(in_array(6,$acsseses))
                        {    
                            $sqlCont="SELECT count(*) from tbl_order where confirm_order=0 group by order_num";
                            $result = $con->query($sqlCont);
                            $count=$result->num_rows;         
                        ?>
                        <li> 
                            <a class="waves-effect waves-dark" href="orders.php" >
                            <span class="badge badge-pill badge-primary text-white ml-auto"><?php echo $count; ?></span>
                                <span class="menufont">
                                    <i  class="fas fa-book-reader"></i>
                                    <span class="hide-menu">
                                        سفارشات
                                   </span>  
                                </span>
                                
                            </a>
                        </li>
                        <?php 
                        } 
                        if(in_array(4,$acsseses)) { ?>
                        <li> 
                            <a class="waves-effect waves-dark" href="parts.php">
                                <span class="menufont">
                                    <i  class="fas fa-columns"></i>
                                    <span class="hide-menu">
                                     بخش ها
                                   </span>  
                                </span>
                                
                            </a>
                        </li>
                        <?php }
                        if(in_array(5,$acsseses)) {?>
                        <li> 
                            <a class="waves-effect waves-dark" href="patients.php">
                                <span class="menufont">
                                    <i  class="fas fa-procedures"></i>
                                    <span class="hide-menu">
                                     بیماران
                                   </span>  
                                </span>
                                
                            </a>
                        </li>
                        <?php } 
                        if(in_array(8,$acsseses)) {
                        ?>
                        <li> 
                            <a class="waves-effect waves-dark" href="personel.php">
                                <span class="menufont">
                                    <i  class="fas fa-user-md"></i>
                                    <span class="hide-menu">
                                     پرسنل
                                   </span>  
                                </span>
                                
                            </a>
                        </li>
                        <?php } 
                        if(in_array(9,$acsseses)) { 
                        ?>
                        <li> 
                            <a class="waves-effect waves-dark" href="kitchen.php">
                                <span class="menufont">
                                    <i  class="fas fa-utensils"></i>
                                    <span class="hide-menu">
                                     آشپزخانه
                                   </span>  
                                </span>
                                
                            </a>
                        </li>  
                        <?php } 
                        if(in_array(15,$acsseses)) { 
                        ?>
                        <li> 
                            <a class="waves-effect waves-dark" href="planing.php">
                                <span class="menufont">
                                    <i  class="fas fa-calendar-alt"></i>
                                    <span class="hide-menu">
                                     برنامه غذایی
                                   </span>  
                                </span>
                                
                            </a>
                        </li>
                        <?php }
                        
                        if(in_array(3,$acsseses)) {
                        ?>
                        <li> 
                            <a class="waves-effect waves-dark" href="report.php">
                                <span class="menufont">
                                    <i  class="fas fa-print"></i>
                                    <span class="hide-menu">
                                     گزارشگیری
                                   </span>  
                                </span>
                                
                            </a>
                        </li>
                        <?php } 
                        
                        if(in_array(2,$acsseses)) {  
                        ?>
                        <li> 
                            <a class="waves-effect waves-dark" href="users.php">
                                <span class="menufont">
                                    <i  class="fas fa-user"></i>
                                    <span class="hide-menu">
                                    کاربران
                                   </span>  
                                </span>
                                
                            </a>
                        </li>
                        <?php }  

                        if(in_array(1,$acsseses)) { ?>
                        <li> 
                            <a class="waves-effect waves-dark" href="webservice.php">
                                <span class="menufont">
                                    <i  class="fas fa-server"></i>
                                    <span class="hide-menu">
                                    وب سرویس ها 
                                   </span>  
                                </span>
                                
                            </a>
                        </li>
                        <?php }

                        if(in_array(10,$acsseses)) {
                         ?>
                        <li> 
                            <a class="waves-effect waves-dark" href="setting.php">
                                <span class="menufont">
                                    <i  class="fas fa-cog"></i>
                                    <span class="hide-menu">
                                     تنظیمات 
                                   </span>  
                                </span>
                                
                            </a>
                        </li>
                        <?php } ?>

                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
