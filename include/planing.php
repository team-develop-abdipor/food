<?php

$qury=mysqli_query($con,"select * from tbl_setting");
 

$display="none";
if(isset($_POST["save"])){


  $image = Upload( "image",'uploads/image/','',TRUE,'uploads/','200','97');
  

  $sql = "INSERT INTO tbl_planing (image)VALUES ('".$image."')";
  $con->query($sql); 

  $display="block";
}
 
?>
        

  <div class="row">
    <div class="row page-titles pagetitle title">     
        <i class="fonticon fas fa-calendar-alt"></i>
        <h3 >برنامه غذایی</h3>
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
                      <label class="label" for="LogoUrl"> عکس:</label>
                      <input type="file" accept="image/*" id="image" name="image" class="form-control" aria-describedby="fileHelp"  required="" 
                      oninvalid="this.setCustomValidity('تصویر را وارد نمایید')" oninput="setCustomValidity('')">
                </div>              

                                        
                                
            
                <div class="row">
                      <button type="submit" name="save"  id="save" class="btn btn-success">ذخیره </button>
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