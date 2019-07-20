<?php
    $cat=$_GET["cat"];
    include("../application/config.php");
    
    // Check connection
    if ($con->connect_error) 
    {
        die("Connection failed: " . $con->connect_error);
    }
    else 
    {
		unset($section);
		$sql="SELECT * FROM tbl_section where Category=".$cat;
		$result = $con->query($sql);
		while($row =$result->fetch_assoc())
		{
			$section[] = array("id" => $row['id'], "Name" => $row['Name'],"Number"=>$row['Number'],"Category"=>$row['Category']);
		}

		$json["list"]= $section;

			echo json_encode($json,JSON_UNESCAPED_SLASHES);
 
    }
