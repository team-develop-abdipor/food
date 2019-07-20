<?php
  
  if(isset($_GET['confirm']) && isset($_GET['order_num']))
  {
    include("../application/config.php");
            
    // Check connection

    if ($con->connect_error) 
    {
        die("Connection failed: " . $con->connect_error);
    }
    else 
    { 
      if($_GET['confirm'] == 1)
      {
         $sql = "UPDATE tbl_order SET confirm_order=1 WHERE order_num=".$_GET['order_num'];
         $stmt = $con->prepare($sql);
         $stmt->execute(); 
      }  
	  else  if($_GET['confirm'] == 2)
	  {
 		$sql = "UPDATE tbl_order SET confirm_order=2 WHERE order_num=".$_GET['order_num'];
         $stmt = $con->prepare($sql);
         $stmt->execute(); 
	  }    
    }                   
    $con->close();
 }
?>




