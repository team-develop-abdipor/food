<?php  

if(isset($_POST['edit'])){
      
    $id = $_POST['edit_id'];
    $username = mysqli_real_escape_string($con,$_POST['username']);
    $section = $_POST['section'];
    $access = array_filter($_POST['access'] ,'is_numeric');
    $pass = md5(mysqli_real_escape_string($con,$_POST['pass']));


    $query=mysqli_query($con,"select * from tbl_users WHERE username='".$username."' and id<>".$id);
    
    if(mysqli_fetch_array($query))
    {
        echo "<script type='text/javascript'>alert('نام کاربری تکرای است.');</script>";
    }
   else if($_POST["section_id"] == 0){
 
        $sql = "UPDATE tbl_users SET username='".$username."' , pass='".$pass."' WHERE id=".$id;
        $stmt = $con->prepare($sql);
        $stmt->execute();  
    }
    else if(is_numeric($section))
    {
        $sql = "UPDATE tbl_users SET username='".$username."' , pass='".$pass."', section=".$section." , access='".serialize($access)."' WHERE id=".$id;
        $stmt = $con->prepare($sql);
        $stmt->execute();   
    }     
    
}

if(isset($_POST['remove'])){

    $id = $_POST['remove_id'];
    $sql = "Delete From tbl_users WHERE id=".$id;
    $con->query($sql);      

}



if(isset($_POST['add'])){

   
    $username = mysqli_real_escape_string($con,$_POST['username']);
    $section = $_POST['section'];
    $access = array_filter($_POST['access'] ,'is_numeric');
    $pass =   md5(mysqli_real_escape_string($con,$_POST['pass']));

    $query=mysqli_query($con,"select * from tbl_users WHERE username='".$username."'");
    
    if(mysqli_fetch_array($query))
    {
        echo "<script type='text/javascript'>alert('نام کاربری تکرای است.');</script>";
    }
    else if(is_numeric($section))
    {
        $sql = "INSERT INTO tbl_users (username, pass ,section,access)
        VALUES ('".$username."' , '". $pass."',".$section." ,'".serialize($access)."')";
        $con->query($sql);  
    }
    }
?>


<div class="row">
    <div class="row page-titles pagetitle title"> 
         <div class="col-lg-10">
            <div class="row">    
            <i class="fonticon fas fa-users"></i>  
            <h3 >کاربران</h3>
            </div>
        </div>
        
        <div class="col-lg-2">
            <button id="addButton" type="submit" class="btn btn-success" data-toggle="modal" data-target="#Add">
                <strong> افزودن کاربر جدید </strong>   
                <i class="icon-plus"></i>
            </button>
        </div>
    </div>  
</div>

<!--Add Modal -->
<div class="row">
  <div   class="modal fade" mame="RejectModal" id="Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content"  >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title ModalTitle" id="exampleModalLabel"> افزودن کاربر جدید</h4>
            </div>

            <form action="" method="post">

                <div class="Row modal-body">

                    <div id="EditBody">
                      
                        <div class="row">
                            <div class="col-md-12" >
                                <label class="form-check-label labele" for="username" class="usernamelable">
                                        <strong> نام کاربری: </strong>
                                    </label> 
                                <input  type="text" class="input" id="username"  name="username" placeholder="نام کاربری" minlength="3" maxlength="40"  value="" required=""
                                oninvalid="this.setCustomValidity('لطفا نام کاربری را بین 3 تا 40 کارکتر وارد نمایید.')" oninput="setCustomValidity('')" >
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12" >
                                <label class="form-check-label labele" for="pass" class="labele">
                                     <strong>  رمز عبور: </strong>
                                </label> 
                                <input  class="input"  type="password" id="pass"  name="pass" placeholder="رمز عبور" minlength="5" maxlength="40"  value="" required=""
                                oninvalid="this.setCustomValidity('لطفا رمز عبور را بین 5 تا 40 کارکتر وارد نمایید.')" oninput="setCustomValidity('')"  > 
                            </div>
                        </div>

                        
                        <div class="row">
                            <div class="col-md-12" >
                                <label class="form-check-label labele" for="Repass" class="labele">
                                     <strong>   تکرار رمز  : </strong>
                                </label> 
                                <input  class="input"  type="password" id="Repass"  name="Repass" placeholder="تکرار رمز عبور" minlength="5" maxlength="40"  value="" required=""
                                oninvalid="this.setCustomValidity('تکرار رمز عبور منطبق نمی باشد.')" oninput="setCustomValidity('')"  > 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-check-label labele" for="section"  id="sectionLabel">
                                     <strong>بخش: </strong>
                                </label> 

                                <select   name="section" id="section" class="dropdown">
                                    <?php
                                    $qry=mysqli_query($con,"select * from tbl_section where Category=1");

                                    while($sections=mysqli_fetch_array($qry)){
                                    ?>
                                        <option value="<?php echo $sections["id"]; ?>"><?php echo $sections["Name"]; ?></option>
                                    <?php
                                    }
                                    ?>     
                                </select>
                            </div>    
                        </div>

                        <div class="row">
                            <div class="col-md-12" >
                       
                                <label class="form-check-label center" for="access" class="labele" id="accesslable">
                                    <strong>سطوح دسترسی: </strong>
                                </label> 

                             
                                    <select class="form-control" style="margin-left:-17px;" name="access[]"  id="access"   multiple required=""  oninvalid="this.setCustomValidity('لطفا سطوح دسترسی کاربر را مشخص کنید.')" oninput="setCustomValidity('')">
                                            <optgroup label="وب">
                                               <?php
                                                    $qry=mysqli_query($con,"select * from tbl_access where platform=0");

                                                    while($sections=mysqli_fetch_array($qry)){
                                                    ?>
                                                        <option value="<?php echo $sections["id"]; ?>"><strong><?php echo $sections["access"]; ?></strong></option>
                                                    <?php
                                                    }
                                                ?> 
                                            </optgroup>
                                            <optgroup label="اندروید">
                                            <?php
                                                    $qry=mysqli_query($con,"select * from tbl_access where platform=1");

                                                    while($sections=mysqli_fetch_array($qry)){
                                                    ?>
                                                        <option value="<?php echo $sections["id"]; ?>"><strong><?php echo $sections["access"]; ?></strong></option>
                                                    <?php
                                                    }
                                                ?>
                                            </optgroup>
                                      
                                        </select>
                                    </div>
                                </div>
                                
                           

                    
                       </div>
                    </div>
                
                <div class="modal-footer rtl">
                    <button type="submit" name="add"  class="btn btn-success" title="افزودن">افزودن</button>
                        &nbsp;&nbsp;
                    <button type="button" class="btn btn-primary" data-dismiss="modal" title="انصراف">انصراف</button>
                </div>

            </form>
        
        </div>
    </div>
</div> 
</div> 

<div class="row">
    <div id="body">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive m-t-40">
                        <table id="example23" class="display  table-bordered table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="center tableRow">ردیف</th>
                                    <th class="center tableRow">نام کاربری</th>
                                    <th class="center tableRow">بخش</th>
                                    <th class="center tableRow col-md-6">سطح دسترسی </th>
                                    <th class="center tableRow">اقدامات</th>
                                </tr>
                            </thead>
                                <tbody>
                                    <?php
                                        $row=0;
                                        $query=mysqli_query($con,"select * from tbl_users ORDER BY id ASC");
                                        while($data=mysqli_fetch_array($query)){ 
                                            
                                            $qry=mysqli_query($con,"select Name from tbl_section WHERE id=".$data['section']);
                                             $section=mysqli_fetch_array($qry); 
                                            
                                            ?>
                                            <tr>
                                                <td class="center tableRow">
                                                    <strong> <?php echo PersianNumber(++$row); ?></strong>
                                                </td>
                                                <td class="center tableRow">
                                                    <strong> <?php echo $data['username']; ?></strong>
                                                </td>

                                                <td class="center tableRow">
                                                    <strong> <?php if($section[0]==null) echo "ادمین اصلی"; else echo $section[0]; ?></strong>
                                                </td>


                                                <td class="center tableRow">
                                                    <?php
                                                        //واکشی آرایه از دیتابیس
                                                        $acsseses = unserialize($data['access']);
                                                        //تبدیل آرایه رشته ای به آرایه عددی
                                                        $acsseses = array_map(function($arr) {
                                                            return intval($arr);
                                                        }, $acsseses);

                                                        $qry=mysqli_query($con,"select access from tbl_access where id IN (".implode(',',$acsseses).")");

                                                        $showAccess="";
                                                        $count=0;
                                                        while($access=mysqli_fetch_array($qry)){

                                                            if($count>0)
                                                            {
                                                                $showAccess .=  " ، "; 
                                                            }                                             
                                                                $showAccess .=  $access[0];
                                                                $count++;
                                                        } 

                                                    ?>
                                                        <strong><?php  echo $showAccess; ?></strong>

                                                </td>


                                                <td class="center tableRow">
                                                    <?php 

                                                        $qry=mysqli_query($con,"select id from tbl_users WHERE id=".$_SESSION['user_id']);
                                                        $resulte=mysqli_fetch_array($qry);

                                                     
                                                    
                                                         if( $data["id"] ==  $resulte[0] || $_SESSION['user_id']==28){ ?>

                                                        <button type="submit" class="btn btn-info" data-toggle="modal" data-target="#Edit<?php echo $data['id']; ?>">
                                                            <strong> ویراش </strong>   
                                                        </button>

                                                        <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#Remove<?php echo $data['id']; ?>">
                                                            <strong> حذف </strong>   
                                                        </button>

                                                    <?php   } ?>
                                                </td>
 
                                                    <!--Edite Modal -->
                                                    <div class="row tableRow">
                                                        <div   class="modal fade" mame="RejectModal" id="Edit<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content"  >
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        <h4 class="modal-title ModalTitle" id="exampleModalLabel">ویرایش کاربر</h4>
                                                                    </div>
                                                                       
                                                                    <form action="" method="post">

                                                                        <div class="modal-body">

                                                                            <div id="EditBody">
                                                                            
                                                                                <div class="row">
                                                                                    <div class="col-md-12" >
                                                                                        <label class="form-check-label labele" for="username" class="usernamelable">
                                                                                                <strong> نام کاربری: </strong>
                                                                                            </label> 
                                                                                        <input  type="text" class="input" id="username"  name="username" placeholder="نام کاربری" minlength="5" maxlength="40"  value="<?php echo $data['username']; ?>" required=""
                                                                                        oninvalid="this.setCustomValidity('لطفا نام کاربری را بین 5 تا 40 کارکتر وارد نمایید.')" oninput="setCustomValidity('')" >
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="col-md-12" >
                                                                                        <label class="form-check-label labele" for="pass" class="labele">
                                                                                            <strong>  رمز عبور: </strong>
                                                                                        </label> 
                                                                                        <input  class="input"  type="password" id="pass"  name="pass" placeholder="رمز عبور" minlength="5" maxlength="40"  value="" required=""
                                                                                        oninvalid="this.setCustomValidity('لطفا رمز عبور را بین 5 تا 40 کارکتر وارد نمایید.')" oninput="setCustomValidity('')"  > 
                                                                                    </div>
                                                                                </div>

                                                                                <?php  if($data['section'] != 0) {?>
                                                                                <div class="row" style="display:<?php if($data['section'] != 0) echo "none"; ?>">
                                                                                    <div class="col-md-12">
                                                                                        <label class="form-check-label labele" for="section"  id="sectionLabel">
                                                                                            <strong>بخش: </strong>
                                                                                        </label> 

                                                                                        <select   name="section" id="section" class="dropdown">
                                                                                            <?php
                                                                                            $qry=mysqli_query($con,"select * from tbl_section where Category=1");

                                                                                            while($sections=mysqli_fetch_array($qry)){
                                                                                            ?>
                                                                                                <option value="<?php echo $sections["id"]; ?>" <?php if($sections["id"] == $data['section']) echo "selected"; ?>><?php echo $sections["Name"]; ?></option>
                                                                                            <?php
                                                                                            }
                                                                                            ?>     
                                                                                        </select>
                                                                                    </div>    
                                                                                </div>

                                                                                <div class="row">
                                                                                    <div class="col-md-12" >
                                                                            
                                                                                        <label class="form-check-label center" for="access" class="labele" id="accesslable">
                                                                                            <strong>سطوح دسترسی: </strong>
                                                                                        </label> 

                                                                                        <select class="form-control" style="margin-left:-17px;" name="access[]"  id="access"   multiple required=""  oninvalid="this.setCustomValidity('لطفا سطوح دسترسی کاربر را مشخص کنید.')" oninput="setCustomValidity('')">

                                                                                        <?php

                                                                                            //واکشی آرایه از دیتابیس
                                                                                            $acsseses = unserialize($data["access"]);
                                                                                            //تبدیل آرایه رشته ای به آرایه عددی
                                                                                            $acsseses = array_map(function($arr) {
                                                                                                return intval($arr);
                                                                                            }, $acsseses);

                                                                                            ?>
                                                                                            <optgroup label="وب">
                                                                                                <?php
                                                                                                    $qry=mysqli_query($con,"select * from tbl_access where platform=0");

                                                                                                    while($sections=mysqli_fetch_array($qry)){
                                                                                                    ?>
                                                                                                        <option value="<?php echo $sections["id"]; ?>" <?php if(in_array($sections["id"],$acsseses)) echo "selected"; ?>><strong><?php echo $sections["access"]; ?></strong></option>
                                                                                                    <?php
                                                                                                    }
                                                                                                ?> 
                                                                                            </optgroup>
                                                                                            <optgroup label="اندروید">
                                                                                                <?php
                                                                                                    $qry=mysqli_query($con,"select * from tbl_access where platform=1");

                                                                                                    while($sections=mysqli_fetch_array($qry)){
                                                                                                    ?>
                                                                                                        <option value="<?php echo $sections["id"]; ?>" <?php if(in_array($sections["id"],$acsseses)) echo "selected"; ?>><strong><?php echo $sections["access"]; ?></strong></option>
                                                                                                    <?php
                                                                                                    }
                                                                                                ?>
                                                                                            </optgroup>
                                                                                    
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                                <?php } ?>
            
                                                                            </div>
                                                                        </div>
                                                                    
                                                                        <div class="modal-footer rtl">
                                                                            <button type="submit" name="edit"  class="btn btn-info" title="یروزرسانی">یروزرسانی</button>
                                                                            <button type="button" class="btn btn-primary" data-dismiss="modal" title="انصراف">انصراف</button>
                                                                            <input type="hidden" name="edit_id" value="<?php echo $data['id']; ?>">
                                                                            <input type="hidden" name="section_id" value="<?php echo $data['section']; ?>">
                                                                        </div>

                                                                    </form>
                           
                                                                                                                                        
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    </div> 

                                                    <!--Remve Modal -->
                                                    <div class="row tableRow">
                                                        <div   class="modal fade" mame="RejectModal" id="Remove<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content"  >
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    <h4 class="modal-title ModalTitle" id="exampleModalLabel"> حذف کاربر</h4>
        
                                                                    
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="center">
                                                                            <strong>آیا  مطمئن هستید که میخواهید کاربر <br>
                                                                            <?php echo $data['username'] ?><br>
                                                                            را حذف نمایید؟</strong>            
                                                                    </div>

                                                                </div>
                                                                
                                                                <div class="modal-footer rtl">
                                                                    
                                                                    <form action="" method="post">
                                                                        <button type="submit" name="remove"  class="btn btn-danger" title="حذف">حذف</button>
                                                                        <button type="button" class="btn btn-primary" data-dismiss="modal" title="انصراف">انصراف</button>
                                                                        <input type="hidden" name="remove_id" value="<?php echo $data['id']; ?>">
                                                                    </form>
                                                                </div>
                                                                
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    </div> 
                                                  
                                                </tr>
                                                
                                        <?php } 
                                    ?>
                                </tbody>
                        </table>
                    </div>
               </div>
        </div> 
     </div> 
    </div><!-- end container -->
</div> <!-- end row -->

          

<script type="text/javascript">
    $(function() {
        $(".preloader").fadeOut();
    });
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    });
    // ============================================================== 
    // Login and Recover Password 
    // ============================================================== 
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });

    var password = document.getElementById("pass")
  , confirm_password = document.getElementById("Repass");

    function validatePassword(){
    if(password.value != confirm_password.value) {
        confirm_password.setCustomValidity("تکرار رمز عبور منطبق نمی باشد.");
    } else {
        confirm_password.setCustomValidity('');
    }
    }


    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
    </script>



