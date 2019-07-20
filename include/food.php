<?php

if(isset($_POST['add'])){

    $cat_id = $_POST['category'];
    $name = mysqli_real_escape_string($con,$_POST['name']);
    $perice = mysqli_real_escape_string($con,$_POST['price']);
    $desc = mysqli_real_escape_string($con,$_POST['desc']);
    $image = Upload('image','uploads/image/','',TRUE,'uploads/','200','97');
    $supply = mysqli_real_escape_string($con,$_POST['supply']);

    $query=mysqli_query($con,"select * from tbl_subcategory WHERE name='".$name."'");
    
    if(mysqli_fetch_array($query))
    {
        echo "<script type='text/javascript'>alert('غذا وارد شده موجود می باشد.');</script>";
    }
    else
    {
        $sql= "insert into tbl_subcategory (cat_id,name,image,price,supply,description) VALUE ($cat_id,'$name','$image',$perice,$supply,'$desc')";
        $con->query($sql);  
    }
    
 
}

if(isset($_POST['edit'])){

   

    $id = $_POST['edit_id'];
    $cat_id = $_POST['category'];
    $name = mysqli_real_escape_string($con,$_POST['name']);
    $price = mysqli_real_escape_string($con,$_POST['price']);
    $desc = mysqli_real_escape_string($con,$_POST['desc']);
   
    $supply = mysqli_real_escape_string($con,$_POST['supply']);

    if(isset_file('image'))
    {
        $image = Upload('image','uploads/image/','',TRUE,'uploads/','200','97');
    }
    else
    {
        $image =  $_POST['image_url'];
    }
 
    $query=mysqli_query($con,"select * from tbl_subcategory WHERE name='".$name."' and id <>".$id);
    
    if(mysqli_fetch_array($query))
    {
        echo "<script type='text/javascript'>alert('غذا وارد شده موجود می باشد.');</script>";
    }
    else if(is_numeric($cat_id))
    {
        $sql = "UPDATE tbl_subcategory SET cat_id=".$cat_id." , name='".$name."', image='".$image."', price=".$price.
        ", supply=".$supply." , description='".$desc ."' WHERE id=".$id;
        $stmt = $con->prepare($sql);
        $stmt->execute();     
    }    
}

if(isset($_POST['remove'])){

    $id = $_POST['remove_id'];
    $sql = "Delete From tbl_subcategory WHERE id=".$id;
    $con->query($sql);      
    
    }

?>



<script type="text/javascript">     
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if ( (charCode > 31 && charCode < 48) || charCode > 57) {
            return false;
        }
        return true;
    }
</script>

<div class="row">
    <div class="row page-titles pagetitle title"> 
         <div class="col-lg-10">
            <div class="row">    
            <i class="fonticon fas fa-hamburger"></i>  
            <h3 > منو غذا</h3>
            </div>
        </div>
        
        <div class="col-lg-2">
            <button id="addButton" type="submit" class="btn btn-success" data-toggle="modal" data-target="#Add">
                <strong> افزودن غذا جدید </strong>   
                <i class="icon-plus"></i>
            </button>
        </div>
    </div>  
</div>
         

<!--Add Modal -->
<div class="row">
    <div   class="modal fade" mame="Addmodal" id="Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content"  >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title ModalTitle" id="exampleModalLabel"> افزودن غذا جدید</h4>
                </div>

                <form  action="" method="post"  enctype="multipart/form-data">
                    <div class="row modal-body">

                    <div id="EditBody">
                        
                            <div class="row">
                                <div class="col-md-12" >
                                    <label class="labele">دسته غذا:</label>
                                    <select name="category" id="category" class="dropdown">
                                        <?php
                                        $allcat=mysqli_query($con,"select * from tbl_foodcategory");
                                        while($all=mysqli_fetch_array($allcat)){
                                        ?>
                                        <option value="<?php echo $all['id']; ?>">
                                            <strong><?php echo $all['name']; ?></strong>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div> 
                            
                            <div class="row">
                                <div class="col-md-12" >
                                    <label class="labele" style="margin-top:22px !important;width:55px;" for="name">نام غذا:</label>
                                    <input type="text" id="name" name="name"  minlength="1"  maxlength="100" required="" 
                                    oninvalid="this.setCustomValidity('نام غذا را وارد نمایید')" oninput="setCustomValidity('')" placeholder="نام غذا">
                                </div> 
                            </div> 
                        
                        
                            <div class="row">
                                <div class="col-md-12" >
                                    <label class="labele" style="width:70px;"> تصویر:</label>
                                    <input type="file" accept="image/*" class="form-control" name="image" id="image" aria-describedby="fileHelp" required="" 
                                    oninvalid="this.setCustomValidity('تصویر غذا را وارد نمایید')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="col-md-12" >
                                    <label class="labele" style="margin-top:20px;width:72px;" for="price">قیمت(تومان):</label>
                                    
                                    <input class="span2" id="price" name="price" minlength="3" maxlength="10" type="text" onkeypress="return isNumber(event)" onpaste="return false;" required="" 
                                    oninvalid="this.setCustomValidity('قیمت غذا را وارد نمایید')" oninput="setCustomValidity('')" placeholder="قیمت" >           
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="col-md-12" >
                                    <label class="labele" for="supply" style="width:46px;">موجودی:</label>
                                        <input class="span2" id="supply" name="supply" min="0" max="999999999" maxlength="9" type="number"  onkeypress="return isNumber(event)" onpaste="return false;" value="0" required=""
                                        oninvalid="this.setCustomValidity('لطفا موجودی را وارد نمایید.')" oninput="setCustomValidity('')" >
                                </div>
                            </div>
                        
                        
                            <div class="row">
                                <div class="col-md-12" >
                                    <label class="labele" style="width:52px;" for="desc">توضیحات:</label>
                                    <textarea class="input-large" name="desc"  id="desc" maxlength="1000"></textarea>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                    
                    <div class="modal-footer rtl">  
                        <button type="submit" name="add"  class="btn btn-success" title="افزودن">افزودن</button>
                        &nbsp&nbsp
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
                                <th class="center tableRow"><strong> ردیف</th>
                                <th class="center tableRow"> <strong> نام غذا </strong> </th>
                                <th class="center tableRow"> <strong> عکس</strong> </th>
                                <th class="center tableRow"> <strong> دسته بندی</strong> </th>
                                <th class="center tableRow"> <strong> قیمت</strong> </th>
                                <th class="center tableRow"> <strong> موجودی</strong> </th>
                                <th class="center tableRow col-md-6"  style="width:310px !important;" > <strong> توضیحات</strong> </th>
                                <th class="center tableRow"> <strong> اقدامات</strong> </th>
                            </tr>
                           </thead>
                        <tbody>
                        <?php
                        
                        $row=0;
                        $qury=mysqli_query($con,"select * from tbl_subcategory ORDER BY id DESC");
                        while($data=mysqli_fetch_array($qury)){?>
                            <tr>
                                <td class="center tableRow">
                                    <br>
                                    <strong> <?php echo PersianNumber(++$row); ?> </strong>
                                </td>

                                <td class="center tableRow">
                                    <br>
                                        <strong><?php echo $data['name']; ?></strong>
                                </td>

                                <td class="center tableRow">
                                    <img src="uploads/<?php echo $data["image"]; ?>" alt="<?php echo $food["name"]; ?>" style="border-radius: 50%; width:60px;height:60px;">
                                </td>
                                
                                <?php $foodnamef=mysqli_query($con,"select * from tbl_foodcategory WHERE id='".$data['cat_id']."'");
                                $foodname=mysqli_fetch_array($foodnamef); ?>
                                <td class="center tableRow">
                                    <br>
                                    <strong> <?php echo $foodname['name']; ?></strong> 
                                </td>

                                <td class="center tableRow"> 
                                    <br>
                                    <strong> <?php  echo PersianNumber($data['price']); ?></strong>                                         
                                </td>

                                <td class="center tableRow">
                                    <br>
                                        <strong><?php echo PersianNumber($data['supply']); ?></strong>
                                </td>

                                <td class="center tableRow" style="width:310px !important;">
                                    <?php echo substr($data['description'],0,280); ?> 
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
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h4 class="modal-title ModalTitle" id="exampleModalLabel">ویرایش غذا</h4>
                                                </div>

                                                <form  action="" method="post"  enctype="multipart/form-data">
                                                    <div class="row modal-body">       
                                                        <div id="EditBody">
                                                            <div class="row">
                                                                    <div class="row">
                                                                        <div class="col-md-12" >
                                                                            <label class="labele" style="width:68px !important;">دسته غذا:</label>
                                                                            <select  data-style="form-control btn-secondary" class="dropdown" id="Category" name="category">
                                                                                <?php
                                                                                    $allcat=mysqli_query($con,"select * from tbl_foodcategory");
                                                                                    while($all=mysqli_fetch_array($allcat)){
                                                                                    ?>
                                                                                    <option value="<?php echo $all['id']; ?>" <?php if($all['id'] == $data['cat_id']) echo "selected"; ?>>
                                                                                        <strong><?php echo $all['name']; ?></strong>
                                                                                    </option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div> 
                                                                
                                                                    <div class="row">
                                                                        <div class="col-md-12" >
                                                                            <label class="labele" style="margin-top:22px !important;width:55px;" for="name">نام غذا:</label>
                                                                            <input type="text" id="name" name="name"  minlength="1"  maxlength="100" required="" value="<?php echo $data['name']; ?>"
                                                                            oninvalid="this.setCustomValidity('نام غذا را وارد نمایید')" oninput="setCustomValidity('')" placeholder="نام غذا">
                                                                        </div> 
                                                                    </div> 
                                                                
                                                            
                                                                    <div class="row">
                                                                        <div class="col-md-12" >
                                                                            <label class="labele" style="width:70px;"> تصویر:</label>
                                                                            <input type="file" accept="image/*" class="form-control" name="image" id="image" aria-describedby="fileHelp">
                                                                            <img src="uploads/<?php echo $data["image"]; ?>" alt="<?php echo $food["name"]; ?>" style="border-radius: 50%; width:60px;height:60px;">
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-12" >
                                                                            <label class="labele" style="margin-top:20px;width:72px;" for="price">قیمت(تومان):</label>
                                                                        
                                                                            <input class="span2" id="price" name="price" minlength="3" maxlength="10" type="text" onkeypress="return isNumber(event)" onpaste="return false;" required="" 
                                                                            oninvalid="this.setCustomValidity('قیمت غذا را وارد نمایید')" oninput="setCustomValidity('')" placeholder="قیمت" value="<?php echo $data['price']; ?>">           
                                                                        </div>
                                                                    </div>
                                                            
                                                                    <div class="row">
                                                                        <div class="col-md-12" >
                                                                            <label class="labele" for="supply" style="width:46px;">موجودی:</label>
                                                                                <input class="span2" id="supply" name="supply" min="0" max="999999999" maxlength="9" type="number"  onkeypress="return isNumber(event)" onpaste="return false;" value="0" required=""
                                                                                oninvalid="this.setCustomValidity('لطفا موجودی را وارد نمایید.')" oninput="setCustomValidity('')" value="<?php echo $data['supply']; ?>">
                                                                        </div>
                                                                    </div>
                                                            
                                                            
                                                                    <div class="row">
                                                                        <div class="col-md-12" >
                                                                            <label class="labele" style="width:53px;" for="desc">توضیحات:</label>
                                                                            <textarea class="input-large" name="desc"  id="desc" maxlength="1000"><?php echo $data['description']; ?></textarea>
                                                                        </div>
                                                                    </div>
                                                            
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="modal-footer rtl">  
                                                        <button type="submit" name="edit"  class="btn btn-info" title="بروزرسانی">بروزرسانی</button>
                                                        &nbsp&nbsp
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal" title="انصراف">انصراف</button>
                                                        <input type="hidden" name="edit_id" value="<?php echo $data['id']; ?>">
                                                        <input type="hidden" name="image_url" value="<?php echo $data['image']; ?>">
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
                                                <h4 class="modal-title ModalTitle" id="exampleModalLabel"> حذف غذا</h4>
            
                                            </div>

                                            <div class="modal-body">
                                                <div class="center">
                                                    <strong>آیا شما مطئن هستید که میخواهید غذا <?php echo $data['name'] ?> را حذف نمایید؟</strong>           
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
                        <?php } ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>

    </div>                               
  </div>


 
 
 