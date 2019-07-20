<?php 

if(isset($_POST['edit'])){
   
    $id = $_POST['edit_id'];
    $name = mysqli_real_escape_string($con,$_POST['name']);
    $section =$_POST['section'];
    $job = mysqli_real_escape_string($con,$_POST['job']);
    $phone = mysqli_real_escape_string($con,$_POST['phone']);

    if(is_numeric($section))
    {
        $sql = "UPDATE tbl_personel SET name='".$name."' , section=".$section." , job='".$job."', phone='".$phone."' WHERE id=".$id;
        $stmt = $con->prepare($sql);
        $stmt->execute();   
    }  
    
}

if(isset($_POST['remove'])){

    $id = $_POST['remove_id'];
    $sql = "Delete From tbl_personel WHERE id=".$id;
    $con->query($sql);      

}

if(isset($_POST['add'])){

    $name = mysqli_real_escape_string($con,$_POST['name']);
    $section  = $_POST['section'];
    $job = mysqli_real_escape_string($con,$_POST['job']);
    $phone = mysqli_real_escape_string($con,$_POST['phone']);

    if(is_numeric($section))
    {
        $sql = "INSERT INTO tbl_personel (name, section , job,phone)
        VALUES ('".$name."' , ".$section." , '".$job ."','".$phone."')";
        $con->query($sql); 
    }
    }
?>

<div class="row">
    <div class="row page-titles pagetitle title"> 
         <div class="col-lg-10">
            <div class="row">    
            <i class="fonticon fas fa-user-md"></i>  
            <h3>پرسنل</h3>
            </div>
        </div>
        
        <div class="col-lg-2">
            <button id="addButton" type="submit" class="btn btn-success" data-toggle="modal" data-target="#Add">
                <strong> افزودن پرسنل جدید </strong>   
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
                    <h4 class="modal-title ModalTitle" id="exampleModalLabel"> افزودن پرسنل جدید</h4>                  
                </div>

                <form action="" method="post">
                    <div class="modal-body">
                        <div id="EditBody">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-check-label label" for="defaultCheck1" class="label">
                                    <strong>   نام و نام خانوادگی: </strong>
                                    </label> 
                                    <input  type="text" id="name"  name="name" placeholder="نام و نام خانوادگی" max="200" min="1" value="<?php echo $data['Name']; ?>" required=""
                                    oninvalid="this.setCustomValidity('نام بخش را وارد نمایید')" oninput="setCustomValidity('')" >
                                </div>    
                            </div>   
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-check-label label" for="section" class="label">
                                    <strong> بخش : </strong>
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
                                <div class="col-md-12">
                                    <label class="form-check-label label" for="defaultCheck1" >
                                    <strong>  رده شغلی: </strong>
                                    </label>
                                    <input  type="text" id="job" name="job" min="0" max="999999999" placeholder="رده شغلی"> 
                                </div>    
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-check-label label" for="defaultCheck1" class="label">
                                    <strong>  تلفن تماس: </strong>
                                    </label>
                                    <input  type="text" id="phone" name="phone" min="0" max="999999999" placeholder="تلفن تماس"> 
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
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="center tableRow" id="RowTitle"><strong>ردیف</strong></th>
                                    <th class="center tableRow" id="NameTitle"><strong> نام و نام خانوادگی</strong></th>
                                    <th class="center tableRow" id="sectionTitle"><strong>بخش</strong></th>
                                    <th class="center tableRow" id="jobTitle"><strong>رده شغلی</strong></th>
                                    <th class="center tableRow" id="phoneTitle"><strong>تلفن تماس </strong></th>
                                    <th class="center tableRow" id="ActionTitle"><strong>اقدامات</strong></th>
                                </tr>
                            </thead>
                         <tbody>
                        <?php

                        $row=0;
                        $query=mysqli_query($con,"select * from tbl_personel ORDER BY id DESC");
                        while($data=mysqli_fetch_array($query)){ ?>
                            <tr>
                                <td class="center tableRow">
                                    <strong> <?php echo PersianNumber(++$row); ?></strong>
                                </td>
                                <td class=" center tableRow">
                                    <strong> <?php echo $data['name']; ?></strong>
                                </td>
                            
                                <?php
                                $qry=mysqli_query($con,"select Name from tbl_section where id=".$data['section']);
                                $section = mysqli_fetch_array($qry);
                                ?>
                                <td class="center tableRow">
                                    <strong><?php echo PersianNumber($section[0]); ?></strong>
                                </td>

                                <td class="center tableRow">
                                    <strong><?php echo PersianNumber($data['job']); ?></strong>
                                </td>

                                <td class="center tableRow">
                                    <strong><?php echo PersianNumber($data['phone']); ?></strong>
                                </td>


                                <td class="center tableRow">
                                        
                                    <button type="submit" class="btn btn-info" data-toggle="modal" data-target="#Edit<?php echo $data['id']; ?>">
                                        <strong> ویراش </strong>   
                                    </button>

                                
                                    <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#Remove<?php echo $data['id']; ?>">
                                        <strong> حذف </strong>   
                                    </button>

                                </td>
                                <!--Edit Modal -->
                                <div class="row">
                                    <div   class="modal fade" mame="RejectModal" id="Edit<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content"  >
                                                <div class="modal-header ModalTitle">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h4 class="modal-title ModalTitle" id="exampleModalLabel">ویرایش مشخصات پرسنل</h4>                                                 
                                                </div>

                                                <form action="" method="post">
                                                    <div class="modal-body">
                                                        <div id="EditBody">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label class="form-check-label label" for="defaultCheck1" class="label">
                                                                    <strong>   نام و نام خانوادگی: </strong>
                                                                    </label> 
                                                                    <input  type="text" id="name"  name="name" placeholder="نام و نام خانوادگی" max="200" min="1"   required="" value="<?php echo $data['name']; ?>" 
                                                                    oninvalid="this.setCustomValidity('نام بخش را وارد نمایید')" oninput="setCustomValidity('')" >
                                                                </div>    
                                                            </div>   
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label class="form-check-label label" for="defaultCheck1" class="label">
                                                                    <strong> بخش : </strong>
                                                                    </label>

                                                                    <select   name="section" id="section" class="dropdown">
                                                                        <?php
                                                                        $qry=mysqli_query($con,"select * from tbl_section where Category=1");

                                                                        while($sections=mysqli_fetch_array($qry)){
                                                                        ?>
                                                                            <option value="<?php echo $sections["id"]; ?>" <?php if($sections["id"]==$data['section']) echo "selected"; ?>><?php echo $sections["Name"]; ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>     
                                                                    </select>
                                                                </div>    
                                                            </div>
                                                                
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label class="form-check-label label" for="defaultCheck1" >
                                                                    <strong>  رده شغلی: </strong>
                                                                    </label>
                                                                    <input  type="text" id="job" name="job" min="0" max="999999999" placeholder="رده شغلی" value="<?php echo $data['job']; ?>"> 
                                                                </div>    
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label class="form-check-label label" for="defaultCheck1" class="label">
                                                                    <strong>  تلفن تماس: </strong>
                                                                    </label>
                                                                    <input  type="text" id="phone" name="phone" min="0" max="999999999" placeholder="تلفن تماس" value="<?php echo $data['phone']; ?>"> 
                                                                </div>    
                                                            </div>
                                                                
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer rtl">
                                                        <button type="submit" name="edit"  class="btn btn-info" title="بروزرسانی">بروزرسانی</button>
                                                        &nbsp;&nbsp;
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal" title="انصراف">انصراف</button>
                                                        <input type="hidden" name="edit_id" value="<?php echo $data['id']; ?>">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> 
                                </div> 

                                <!--Remve Modal -->
                                <div class="row">
                                    <div   class="modal fade" mame="RejectModal" id="Remove<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content"  >
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h4 class="modal-title ModalTitle" id="exampleModalLabel"> حذف پرسنل</h4>                                       
                                            </div>
                                            <div class="modal-body">
                                                <div class="center">
                                                    <strong>آیا شما مطمئن هستید که میخواهید پرسنل <?php echo $data['name'] ?> را حذف نمایید؟</strong>         
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
         
