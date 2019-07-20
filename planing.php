<?php 
    session_start();
    include('application/config.php');
    include('functions.php');

    $query=mysqli_query($con,"select access from tbl_users WHERE id=".$_SESSION['user_id']);
    $resulte=mysqli_fetch_array($query);

    $acsseses = unserialize($resulte[0]);
    
    //تبدیل آرایه رشته ای به آرایه عددی
    $acsseses = array_map(function($arr) {
        return intval($arr);
    }, $acsseses);

    if(in_array(15,$acsseses)) {  
    
        $query=mysqli_query($con,"select AppName,LogoUrl from tbl_setting");
        $resulte=mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" href="<?php echo "uploads/".$resulte[1]; ?>" type="image/png" sizes="16x16">
    <title><?php echo $resulte[0];  ?> </title>
    <!--This page css - Morris CSS -->
    <link href="assets/node_modules/morrisjs/morris.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <link href="css/menu.css" rel="stylesheet">
    <link href="css/share.css" rel="stylesheet">
    <link href="css/planing.css" rel="stylesheet">
    <link href="fontawesom/css/all.css" rel="stylesheet">
    <link href="include/diagram/morris/morris.css" rel="stylesheet">
    <link href="include/diagram/chart/style.css" rel="stylesheet">
    <link href="dist/css/pages/stylish-tooltip.css" rel="stylesheet">
    <link href="dist/css/pages/floating-label.css" rel="stylesheet">

    <!--Morris JavaScript -->
    <script src="include/diagram/morris/jquery.min.js"></script>
    <script src="include/diagram/morris/raphael-min.js"></script>
    <script src="include/diagram/morris/morris.min.js"></script>
    <script src="assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <script src="assets/node_modules/popper/popper.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    
    <script src="assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="dist/js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="assets/node_modules/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="assets/node_modules/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <script src="dist/js/pages/jasny-bootstrap.js"></script>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->


<script src="assets/node_modules/datatables/jquery.dataTables.min.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->


</head>

<body class="skin-default fixed-layout">
    <div id="main-wrapper">
        <?php include('include/header.php'); ?>
        <?php include('include/menu.php'); ?>
        
        <div class="page-wrapper">
            <div class="container-fluid">
                <?php include('include/planing.php'); ?>  
            </div>
        </div>

        <?php include('include/SettingSidebar.php'); ?>  
        <?php include('include/footer.php'); ?>

    </div>

 
</body>
</html>
<?php } else{ ?><script>window.location='index.php'</script><?php } ?>