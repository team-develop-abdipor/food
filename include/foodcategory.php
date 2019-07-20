 
<?php 

if(isset($_POST['edit'])){
   
     
    $name = mysqli_real_escape_string($con,$_POST['Name']); 

    $query=mysqli_query($con,"select * from tbl_foodcategory WHERE name='".$name."' and id <>".$id);
    
    if(mysqli_fetch_array($query))
    {
        echo "<script type='text/javascript'>alert('دسته غذایی وارد شده موجود می باشد.');</script>";
    }
    else
    {
        $sql = "UPDATE tbl_foodcategory SET Name='".$name."' WHERE id=".$id;
        $stmt = $con->prepare($sql);
        $stmt->execute();     
    }
}

if(isset($_POST['remove'])){

    $id = $_POST['remove_id'];
    $sql = "Delete From tbl_foodcategory WHERE id=".$id;
    $con->query($sql);      

}

if(isset($_POST['add'])){

    $name = mysqli_real_escape_string($con,$_POST['Name']);

    $query=mysqli_query($con,"select * from tbl_foodcategory WHERE name='".$name."'");
    
    if(mysqli_fetch_array($query))
    {
        echo "<script type='text/javascript'>alert('دسته غذایی وارد شده موجود می باشد.');</script>";
    }
    else
    {         
        $sql = "INSERT INTO tbl_foodcategory(Name)
        VALUES ('".$name."')";
        $con->query($sql);
    }
}
?>
 
 <div class="row">
    <div class="row page-titles pagetitle title"> 
         <div class="col-lg-10">
            <div class="row">    
            <i class="fonticon fas fa-hamburger"></i>  
            <h3 >دسته بندی غذا</h3>
            </div>
        </div>

        
        <div class="col-lg-2">
            <button id="addButton" type="submit" class="btn btn-success" data-toggle="modal" data-target="#Add">
                <strong> افزودن دسته جدید </strong>   
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

                    <h4 class="modal-title ModalTitle" id="exampleModalLabel"> افزودن دسته جدید</h4>

                    
                </div>
                <form action="" method="post">

                   
                        <div class="row modal-body">
                            <div id="EditBody">
                                <div class="row">
                                    <label class="form-check-label labele" for="defaultCheck1" id="label">
                                        <strong> نام دسته: </strong>
                                    </label> 
                                    <input class="form-control input-sm"  type="text" id="name"  name="Name" placeholder="نام دسته" max="200" min="1" value="<?php echo $data['name']; ?>" required=""
                                    oninvalid="this.setCustomValidity('نام دسته را وارد نمایید')" oninput="setCustomValidity('')" >                                                      
                                </div>
                            </div>
                        </div>
                   

                   
                        <div class="modal-footer rtl">
                            <button type="submit" name="add"  class="btn btn-success" title="بروزرسانی">افزودن</button>
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
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="center tableRow"><strong> ردیف </strong></th>
                                    <th class="center tableRow" id="NameTitle"><strong>نام دسته</strong></th>
                                    <th class="center tableRow"><strong>اقدامات</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                    <?php

                    $rows=0;
                    $query=mysqli_query($con,"select * from tbl_foodcategory order by id DESC");
                    while($data=mysqli_fetch_array($query)){
                    ?>
                    <tr class="center tableRow">
                        <td class="center"><strong> <?php echo Persiannumber(++$rows); ?></strong></td>
                        <td class="center" id="NameTitle"><strong><?php echo $data['name']; ?></strong></td>
                        
                        <td class="center">
                        
                            <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#Show<?php echo $data['id']; ?>">
                                <strong> نمایش </strong>   
                            </button>

                            <button type="submit" class="btn btn-info" data-toggle="modal" data-target="#Edit<?php echo $data['id']; ?>">
                                <strong> ویراش </strong>   
                            </button>
                                
                            <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#Remove<?php echo $data['id']; ?>">
                                <strong> حذف </strong>   
                            </button>
                        </td>
                     
                    </div> 
                </div> 
                    <!--Edit Modal -->
                    <div class="row">
                        <div   class="modal fade" mame="RejectModal" id="Edit<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content"  >
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title ModalTitle" id="exampleModalLabel">ویرایش  دسته</h4>
        
                                    </div>

                                    <form action="" method="post">

                                        <div class="row modal-body">
                                            <div id="EditBody">
                                                <div class="row">
                                                    <label class="form-check-label labele" for="defaultCheck1" id="label">
                                                    <strong> نام دسته: </strong>
                                                    </label> 
                                                    <input class="form-control input-sm"  type="text" id="name"  name="Name" placeholder="نام دسته" max="200" min="1" value="<?php echo $data['name']; ?>" required=""
                                                    oninvalid="this.setCustomValidity('نام دسته را وارد نمایید')" oninput="setCustomValidity('')" >                                                      
                                                 </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer rtl">
                                            <button type="submit" name="edit"  class="btn btn-success" title="بروزرسانی">بروزرسانی</button>
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
                                    <h4 class="modal-title ModalTitle" id="exampleModalLabel"> حذف دسته</h4>
        
                                </div>
                                <div class="modal-body">
                                    <div class="center">
                                            <strong>آیا شما مطئن هستید که میخواهید دسته <?php echo $data['name'] ?> را حذف نمایید؟</strong>
                                            
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

                    <!--show Modal -->
                    <div class="row">
                        <div class="modal fade" mame="RejectModal" id="Show<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: scroll;">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content" style="width:820px; left:40% !important;">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                
                                            <h4 class="modal-title ModalTitle" id="exampleModalLabel">نمایش غذاهای دسته <?php echo $data['name']; ?></h4>
                                                                            
                                    </div> 

                                    <div class="modal-body">
                                    
                                    <div style="float:right;text-align: right;width:100%;margin-right:40px;">

                                    <div style="float:right;width:90%;margin:10px 0px;">

                                        <div style="border:1px green solid; width:100%; height:27px;background:green;color:#fff;">
                                            <div style="float:right; width:40px;;text-align: center;">
                                                <strong>  ردیف </strong>
                                            </div>    

                                            <div style="float:right;width:150px;text-align: center;">
                                                <strong>  نام غذا </strong>
                                            </div>  

                                            <div style="float:right;width:75px;text-align: center;">
                                                <strong>  عکس  </strong>
                                            </div>  

                                            <div style="float:right; width:70px;text-align: center;">
                                                <strong> قیمت  </strong>
                                            </div> 

                                            <div style="float:right; width:70px;text-align: center;">
                                                <strong>  موجودی  </strong>
                                            </div>  

                                            <div style="float:right; width:300px;text-align: center;">
                                                <strong>  توضیحات  </strong>
                                            </div> 
                                        </div>

                                    
                                    <?php 
                                        
                                        $sum=0;
                                        $row =0;
                                        $foods=mysqli_query($con,"select * from tbl_subcategory where cat_id=".$data['id']." ORDER BY id DESC ");
                                        foreach ($foods as $food){ 
                                        ?>
                                        <div style="border-bottom:1px green solid;border-left:1px green solid;border-right:1px green solid; width:100%; min-height:50px;">
                                        
                                            <div style="float:right;width:40px;text-align:center;margin-top:10px;">
                                                <strong> <?php echo PersianNumber(++$row); ?>  </strong>
                                            </div>  
                                        
                                            <div style="float:right;width:150px;text-align:center;margin-top:10px;">
                                                <strong>  <?php echo $food["name"]; ?>  </strong>
                                            </div>  

                                            <div style="float:right;width:75px;text-align:center;margin-top:5px;">
                                                <img src="uploads/<?php echo $food["image"]; ?>" alt="" style="border-radius: 50%; width:40px;height:40px;">
                                            </div>  

                                            <div style="float:right;width:70px;text-align:center;margin-top:10px;">
                                                <strong> <?php echo PersianNumber($food['price']); ?>  </strong>
                                            </div>  

                                            <div style="float:right;width:70px;text-align:center;margin-top:10px;">
                                                <strong> <?php echo PersianNumber($food['supply']); ?>  </strong>
                                            </div>  

                                            <div style="float:right;width:295px;text-align:center;margin-top:5px;">
                                            <strong> <?php echo substr($food['description'],0,165); ?> </strong>
                                            </div>  
                                        </div>

                                    <?php } ?>
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

