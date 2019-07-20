<?php

    include("../application/config.php");
    
    // Check connection
    if ($con->connect_error) 
    {
        die("Connection failed: " . $con->connect_error);
    }
    else 
    {
		//تعداد سفارش های تایید نشده
		$sqlCont="SELECT count(*) from tbl_order where confirm_order=0 group by order_num";
		$result = $con->query($sqlCont);
		$count=$result->num_rows;  

		unset($setting);
		$sql="SELECT * FROM tbl_setting";
		$result = $con->query($sql);
		while($row =$result->fetch_assoc())
		{
			$setting[] = array("status" => $row['status'], "message" => $row['message'],"version"=>$row['version'],"count_order"=>$count);
		}


		$json["list"]= $setting;

			echo json_encode($json,JSON_UNESCAPED_SLASHES);
 
    }

     
     
