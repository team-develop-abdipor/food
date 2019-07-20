<?php
    $qury =mysqli_query($con,"select * from tbl_setting");
    while($data=mysqli_fetch_array($qury)){ 

        $AppName = $data["AppName"];
        $Maneger = $data["Maneger"];
        $LogoUrl = $data["LogoUrl"];
    } 
?>
<header class="topbar" style="border-bottom: 2px #FF8800 solid !important;">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div id="header">
            <div class="row">
           
                    <div id="logo">
                       <a href="dashboard.php">
                          <img src="uploads/<?php echo $LogoUrl; ?>" alt="" height="60" width="60" style="border-radius: 50%;">      
                        </a>      
                    </div> 
                    
                    <div id="title">
                        <div class="row">
                            <a href="dashboard.php">
                                <h2><?php echo $AppName; ?></h2>
                            </a> 
                        </div> 
                        <div class="row">
                            <h4><?php  echo $Maneger; ?></h4>
                        </div> 
                    </div> 
              
            </div> 
        </div>
        
        <div class="navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"> <a class="nav-link nav-toggler d-block d-sm-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
            </ul>

            <ul class="navbar-nav my-lg-0">
                <li>
                    <?php
                        /*  $query=mysqli_query($con,"select username from tbl_users WHERE id=".$_SESSION['user_id']);
                        $res=mysqli_fetch_array($query);*/
                    ?>
                    
                    <a  style="color:#fff;" href="include/logout.php">
                        <strong>خروج </strong>
                        <i class="fa fa-sign-out-alt"></i>
                    </a>
                    <strong style="color:#fff;"><?php echo "admin"//$res[0]; ?></strong></h3>
    
                
                </li>
                </ul>


            <ul class="navbar-nav my-lg-0">
                <li class="nav-item right-side-toggle"> <a class="nav-link  waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>
                
                </ul>

            
            
        </div>
    </nav>
</header>