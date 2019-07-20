<?php

 $factor = json_decode(file_get_contents('php://input'),true);
// $factor  = json_decode(stripslashes($_POST['req']),true);



  include('../application/config.php');
   
    $now = new DateTime();
    $date=$now->format('Y-m-d');
    $order_num = $now->format('YmdHis');
    $res_id = $factor['res_id'];
    $name = $factor['name'];
    $no_people = $factor['no_people'];
    $phone = $factor['phone'];
    $escort = $factor['escort']; 
    $comment = $factor['comment'];
    $notify =0; 
    $status = $factor['status'];
    $reg_id = $factor['reg_Id'];
    $device = $factor['device'];
    $device_id = $factor['device_id'];
    $job = $factor['job'];
    $section = $factor['section'];

 
    foreach($factor["orders"] as $orders){
 
      $query="insert into tbl_order
      (`res_id`, `name`, `no_people`, `datetime`, `phone`,`escort`,`comment`,`notify`,`status`,`reg_id`,`device`,`device_id`,`food_id`,`unit`,`price`,`total`,`job`,`order_num`,`section`)
      VALUES
      (
      '".$res_id."',
      '".$name."',
      '".$no_people."',
      '".$date."',
      '".$phone."',
      '".$escort."',
      '".$comment."',
      '".$notify."',
      '".$status."',
      '".$reg_id."',
      '".$device ."',
      '".$device_id."',
      '".$orders["food_id"]."',
      '".$orders["unit"]."',
      '".$orders["price"]."',
      '".$orders["total"]."',
      '".$job."',
      '".$order_num."',
      '".$section."'    
      )";
 

 
		if (mysqli_query($con, $query)) {
       //کاهش موجودی غذا
        $qry=mysqli_query($con,"select supply from tbl_subcategory where id=".$orders['food_id']);
        $supply = mysqli_fetch_array($qry);  
        $supply= $supply[0]-$orders["unit"];
        $sql = "UPDATE tbl_subcategory SET supply=".$supply." WHERE id=".$orders['food_id'];
        $stmt = $con->prepare($sql);
        $stmt->execute();   
 
			echo "New order created successfully.<br>";
		} else 
		{ 
			echo "Error:". mysqli_error($con)."<br>";
		}
 
    }

      mysqli_close($con);
