<?php

$qury=mysqli_query($con,"select * from tbl_setting");
while($data=mysqli_fetch_array($qury)){ 

    $AppName = $data["AppName"];
    $Maneger = $data["Maneger"];
    $LogoUrl = $data["LogoUrl"];
    $status = $data["status"];
    $message = $data["message"];
    $version = $data["version"];
    $id = $data["id"];

}

$display="none";
if(isset($_POST["save"])){


 
  mysqli_real_escape_string($con,$_POST['version']);
  $AppName = mysqli_real_escape_string($con,$_POST['AppName']);
  $Maneger = mysqli_real_escape_string($con,$_POST['Maneger']);
  if(isset_file('LogoUrl'))
  {
    $LogoUrl = Upload( "LogoUrl",'uploads/image/','',TRUE,'uploads/','200','97');
  }
 
  $status = $_POST["status"];
  $message = mysqli_real_escape_string($con,$_POST['message']);
  $version = mysqli_real_escape_string($con,$_POST['version']);

  if(is_numeric($status))
  {
     
    $sql = "UPDATE tbl_setting SET AppName='".$AppName."' , Maneger='".$Maneger."', LogoUrl='".$LogoUrl."', status=".$status.
    ", message='".$message."' , version='".$version ."' WHERE id=".$id;
    $stmt = $con->prepare($sql);
    $stmt->execute(); 

    $display="block";
 
  }  
}
 
?>
        

  <div class="row">
    <div class="row page-titles pagetitle title">     
        <i class="fonticon fas fa-chart-pie"></i>
        <h3 >آمار</h3>
    </div>
  </div>

  <div class="row">
  <div id="body">
   <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div id="contorols">
                        
            <div id="res" style="display:<?php echo $display; ?>">
                <strong>تغییرات با موفقیت ذخیره شد.</strong>
            </div>

            <form method="post" action=""  enctype="multipart/form-data">

                <?php
                  $qury=mysqli_query($con,"select * from tbl_setting");
                  while($data=mysqli_fetch_array($qury)){ 
                ?>
                                  
                <div class="row">
                      <label class="label" for="AppName">نام برنامه:</label>
                      <input type="text" id="AppName" name="AppName"  minlength="1"  maxlength="100" value="<?php echo $AppName; ?>"> 
                </div> 

                <div class="row">
                      <label class="label" for="Maneger">نام مدیریت:</label>
                      <input type="text" id="Maneger" name="Maneger"  minlength="1"  maxlength="100" value="<?php echo $Maneger; ?>"> 
                </div>

                              
                <div class="row">
                      <label class="label" for="LogoUrl">لوگو:</label>
                      <input type="file" accept="image/*" id="LogoUrl" name="LogoUrl" class="form-control" aria-describedby="fileHelp">
                      <img src="uploads/<?php echo $LogoUrl; ?>" alt=""  style="border-radius: 50%; width:60px;height:60px;"> 
                </div>              

                <div class="row">
                    <label class="label" for="message">وضعیت:</label>
                    <select name="status" id="status" class="dropdown">
                        <option value="0" <?php if($status == 0) echo "selected" ?>>غیرفعال</option>
                        <option value="1" <?php if($status == 1) echo "selected" ?>>فعال</option>
                    </select>
                </div>                           
                                
                <div class="row">
                    <label class="label" for="version"> نسخه :</label>
                    <input type="text" id="version" name="version"  minlength="1"  maxlength="10" value="<?php echo $version; ?>"> 
                </div>

                <div class="row">
                      <label class="label" for="message"> توضیحات :</label>
                      <textarea id="message" name="message"  minlength="1"  maxlength="150"><?php echo $message;?></textarea>
                </div>

                <div class="row">
                      <button type="submit" name="save"  id="save" class="btn btn-success">ذخیره تغییرات</button>
                </div>
              <?php
              }
              ?>
            </form>
          <div>
      </div>                   
    </div> 
  </div>                   
</div> 
</div> 
  </div><!-- end container -->
</div> <!-- end row -->