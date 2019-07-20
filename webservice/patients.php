<?php

	$page=$_GET['page'];
 	$id = $_GET['id'];


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
	
 
            $sqlCont="SELECT count(*) from tbl_patients";
            $result = $con->query($sqlCont);
            $rowcount=$result->num_rows;
            $total= ($page)*20;
         
            $sql="SELECT * FROM tbl_patients where Section=".$id." limit $total, 20";
            $result = $con->query($sql);
            // output data of each row
            
          
			unset($myarray);
     
   
            // output data of each row
            while ($row = $result->fetch_assoc()) 
            {		
              $myarray[] = array("id" => $row['id'], "Name" => $row['Name'],"Code"=>$row['Code'],"Section"=>$row['Section']);
            }  

		  	$json["list"]= $myarray;
			echo json_encode($json,JSON_UNESCAPED_SLASHES);
  
            //end json 
        } 
        else{
			
            $sql = "SELECT * FROM tbl_patients where Section=".$id." ORDER BY id DESC LIMIT 20";
            $result = $con->query($sql);
            
            if ($result->num_rows > 0) 
            {
                // output data of each row
              	unset($myarray);
     
				// output data of each row
				while ($row = $result->fetch_assoc()) 
				{		
					$myarray[] = array("id" => $row['id'], "Name" => $row['Name'],"Code"=>$row['Code'],"Section"=>$row['Section']);
				}  

				$json["list"]= $myarray;
				echo json_encode($json,JSON_UNESCAPED_SLASHES);
          
                //end json
            }	 	
        }
    }