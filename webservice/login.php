<?php
  
$uname= $_GET['user'];
$pass= md5($_GET['pass']);

include("../application/config.php");

    unset($myarray);
    $query=mysqli_query($con,"select * from tbl_users WHERE username='$uname' && pass='$pass' ");
    $res=mysqli_fetch_array($query);
    if($res)
    {
      

        $acsseses = unserialize($res['access']);
        //تبدیل آرایه رشته ای به آرایه عددی
        $acsseses = array_map(function($arr) {
            return intval($arr);
        }, $acsseses);

        //تعیین سطح دسترسی اندروید
        unset($accessArray);
        foreach($acsseses as $aceess){
            if($aceess==12 || $aceess==13 || $aceess==14)
            {
                $qry=mysqli_query($con,"select access from tbl_access where id=".$aceess);
                $accesslayer = mysqli_fetch_array($qry);

                 $accessArray[] =array(
                    "access" => $accesslayer[0]                  	
                );
            }
        }
        
        $qry=mysqli_query($con,"select Name from tbl_section where id=".$res["section"]);
        $section = mysqli_fetch_array($qry);
             
        $myarray[] =array(
            "resulte" =>"1",
            "section"=>$section[0],
            "access"=>$accessArray
        );

   
       $json["list"]= $myarray;
		echo json_encode($json,JSON_UNESCAPED_SLASHES); 
        
    }
    else
    {
        $myarray[] =array(
            "resulte" =>"0",
        );
        $json["list"]= $myarray;
		echo json_encode($json,JSON_UNESCAPED_SLASHES);    
    }

  
   