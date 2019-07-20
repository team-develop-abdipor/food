<?php
 
    $page=$_GET['page'];
       
 	include("../application/config.php");
		
    // Check connection
    if ($con->connect_error) 
    {
	
        die("Connection failed: " . $con->connect_error);
    }
    else 
    {	
		
         if($page>0)
        { 
            $sqlCont="SELECT count(*) from tbl_order where confirm_order=0 GROUP BY order_num";
            $result = $con->query($sqlCont);
            $rowcount=$result->num_rows;
            $total= ($page)*20;
              
            $sql="ELECT * FROM tbl_order where confirm_order=0 GROUP BY order_num  ORDER BY id DESC limit $total, 20";
            $result = $con->query($sql);
            // output data of each row

			unset($myarray);
           // output data of each row
            while ($row = $result->fetch_assoc()) 
            { 	
			  	//واکشی سفارش های فاکتور	 
		 	
				$sql="SELECT * FROM tbl_order where order_num=".$row['order_num'];
				$res = $con->query($sql);
			 
				unset($orders);
				while($order =$res->fetch_assoc())
				{	
					$Foodquery=mysqli_query($con,"select name from tbl_subcategory where id=".$order['food_id']);
					$Foodname = mysqli_fetch_array($Foodquery);
					
					$orders[] =array(
					"food_id" => $order['food_id'],
					"food_name" =>$Foodname[0],
					"unit"=>$order['unit'],
					"price"=>$order['price'],
					"total"=>$order['total']  	
					);				
				}
					
			    $sectionquery=mysqli_query($con,"select Name from  tbl_section  where id=".$row['section']);
				$section = mysqli_fetch_array($sectionquery);
				  
				//مشخصات فاکتور
				$myarray[] = array(
					"id" => $row['id'],
					"res_id" => $row['res_id'],
					"name"=>$row['name'],
					"no_people"=>$row['no_people'],
					"datetime" => $row['datetime'],
					"phone" => $row['phone'],
					"escort"=>$row['escort'],
					"comment"=>$row['comment'],
					"notify" => $row['notify'],
					"status" => $row['status'],
					"confirm_order"=>$row['confirm_order'],
					"reg_id"=>$row['reg_id'],
					"device" => $row['device'],
					"device_id" => $row['device_id'],
					"order_num"=>$row['order_num'],
					"section_id" => $row['section'],
					"section" => $section[0],
					"job"=>$row['job'],
					"orders"=>$orders
					 );		 			 
            } 
	    	$json["list"]= $myarray;
			echo json_encode($json,JSON_UNESCAPED_SLASHES);    
        } 
        else
		{	 	
            $sql = "SELECT * FROM tbl_order where confirm_order=0 GROUP BY order_num  ORDER BY id DESC LIMIT 20";
            $result = $con->query($sql);

			unset($myarray);
           // output data of each row
            while ($row = $result->fetch_assoc()) 
            { 
			
			  	//واکشی سفارش های فاکتور	 
		 	
				$sql="SELECT * FROM tbl_order where order_num=".$row['order_num'];
				$res = $con->query($sql);
			 
				unset($orders);
				while($order =$res->fetch_assoc())
				{	
					$Foodquery=mysqli_query($con,"select name from tbl_subcategory where id=".$order['food_id']);
					$Foodname = mysqli_fetch_array($Foodquery);
					
					$orders[] =array(
					"food_id" => $order['food_id'],
					"food_name" =>$Foodname[0],
					"unit"=>$order['unit'],
					"price"=>$order['price'],
					"total"=>$order['total']  	
					);				
				}
					
			    $sectionquery=mysqli_query($con,"select Name from  tbl_section  where id=".$row['section']);
				$section = mysqli_fetch_array($sectionquery);
				  
				//مشخصات فاکتور
				$myarray[] = array(
					"id" => $row['id'],
					"res_id" => $row['res_id'],
					"name"=>$row['name'],
					"no_people"=>$row['no_people'],
					"datetime" => $row['datetime'],
					"phone" => $row['phone'],
					"escort"=>$row['escort'],
					"comment"=>$row['comment'],
					"notify" => $row['notify'],
					"status" => $row['status'],
					"confirm_order"=>$row['confirm_order'],
					"reg_id"=>$row['reg_id'],
					"device" => $row['device'],
					"device_id" => $row['device_id'],
					"order_num"=>$row['order_num'],
					"section_id" => $row['section'],
					"section" => $section[0],
					"job"=>$row['job'],
					"orders"=>$orders
					 );		 			 
            } 
	    	$json["list"]= $myarray;
			echo json_encode($json,JSON_UNESCAPED_SLASHES);  	
		}
    }
    