<?php  

if(isset($_POST['edit'])){
    
    $id = $_POST['edit_id'];
    $number = $_POST['Sectionnumber'];
    $name = mysqli_real_escape_string($con,$_POST['name']);
    $cat = $_POST['cat'];
    $query=mysqli_query($con,"select * from tbl_section WHERE Name='".$name."' and id <>".$id);
    
    if(mysqli_fetch_array($query))
    {
        echo "<script type='text/javascript'>alert(' بخش وارد شده موجود می باشد.');</script>";
    }
    else if(is_numeric($cat) && is_numeric($number))
    {
        
        $sql = "UPDATE tbl_section SET Name='".$name."' , Number=".$number." , Category=".$cat." WHERE id=".$id;
        $stmt = $con->prepare($sql);
        $stmt->execute();  
    }      
    
}

if(isset($_POST['remove'])){

    $id = $_POST['remove_id'];
    $sql = "Delete From tbl_section WHERE id=".$id;
    $con->query($sql);      

}

if(isset($_POST['add'])){

    $name = mysqli_real_escape_string($con,$_POST['name']);

    $query=mysqli_query($con,"select * from tbl_section WHERE Name='".$name."'");
    $number= $_POST['AddSectionnumber'];
    $section = $_POST['section'];
    $cat = $_POST['cat'];
    $section = $_POST['section'];

    if(mysqli_fetch_array($query))
    {
        echo "<script type='text/javascript'>alert('بخش وارد شده موجود می باشد.');</script>";
    }
    else
    {
        if(is_numeric($cat) && is_numeric($number))
        {
            $sql = "INSERT INTO tbl_section (Name, Number,Category)
            VALUES ('".$name."' , '".$number."',".$cat .")";
            $con->query($sql);
        }
    }
}
?>

<div class="row">
    <div class="row page-titles pagetitle title"> 
         <div class="col-lg-10">
            <div class="row">    
            <i class="fonticon fas fa-columns"></i>  
            <h3 >بخش ها</h3>
            </div>
        </div>
        
        <div class="col-lg-2">
            <button id="addButton" type="submit" class="btn btn-success" data-toggle="modal" data-target="#Add">
                <strong> افزودن بخش جدید </strong>   
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
                    <h4 class="modal-title ModalTitle" id="exampleModalLabel"> افزودن بخش جدید</h4>
                </div>

                <form action="" method="post">
                    <div class="Row modal-body">
                        <div id="EditBody">
                          
                            <div class="row">
                                <div class="col-md-12" >
                                    <label class="form-check-label labele" for="defaultCheck1" id="namelabel">
                                        <strong> نام بخش: </strong>
                                    </label> 
                                    <input class="form-control input-sm"  type="text" id="name"  name="name" placeholder="نام بخش" max="200" min="1" value="" required=""
                                    oninvalid="this.setCustomValidity('نام بخش را وارد نمایید')" oninput="setCustomValidity('')" >
                                </div>
                            </div>
                                
                            <div class="row">
                                <div class="col-md-12" >
                                    <label class="form-check-label labele" for="AddSectionnumber" id="Sectionlabel">
                                        <strong> تعداد  : </strong>
                                    </label> 
                                    <input class="span2" id="AddSectionnumber" name="AddSectionnumber" minlength="1" maxlength="9" type="text" onkeypress="return isNumber(event)" onpaste="return false;" required="" 
                                    oninvalid="this.setCustomValidity('تعداد را وارد نمایید')" oninput="setCustomValidity('')" placeholder="تعداد" >    
                                </div>  
                            </div>

                            <div class="row">
                                <div class="col-md-12" >
                                    <div id="category">
                                        <input type="radio" name="cat" value="0" checked><strong>بیماران</strong> 
                                       <br>
                                        <input type="radio" name="cat" value="1"><strong>پرسنل</strong> 
                                    </div>
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
    <div id="body">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive m-t-40">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="center tableRow" id="RowTitle">ردیف</th>
                                    <th class="center tableRow" id="PartNameitle"> نام بخش</th>
                                    <th class="center tableRow" id="PartCattle">دسته بندی</th>
                                    <th class="center tableRow" id="PartNumitle">تعداد</th>
                                    <th class="center tableRow" id="PartActionitle">اقدامات</th>
                                </tr>
                            </thead>
                        <tbody>
                        <?php

                        $row=0;
                        $query=mysqli_query($con,"select * from tbl_section ORDER BY id DESC");
                        while($data=mysqli_fetch_array($query)){ ?>
                            <tr>
                                <td class="center tableRow">
                                    <strong> <?php echo PersianNumber(++$row); ?></strong>
                                </td>
                                <td class="center tableRow">
                                    <strong> <?php echo $data['Name']; ?></strong>
                                </td>
                                <td class="center tableRow">
                                    <strong>
                                        <?php
                                          if($data['Category']==0) 
                                          echo "بیماران";
                                          else echo "پرسنل";
                                          ?>
                                     
                                     </strong>
                                </td>
                                <td class="center tableRow">
                                    <strong><?php echo PersianNumber($data['Number']); ?></strong>
                                </td>
                                <td class="center tableRow">
            
                                    <button type="submit" class="btn btn-info" data-toggle="modal" data-target="#Edit<?php echo $data['id']; ?>">
                                        <strong> ویراش </strong>   
                                    </button>

                                    <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#Remove<?php echo $data['id']; ?>">
                                        <strong> حذف </strong>   
                                    </button>

                                </td>
                                    <!--Edite Modal -->
                                    <div class="row">
                                        <div   class="modal fade" mame="RejectModal" id="Edit<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content"  >
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <h4 class="modal-title ModalTitle" id="exampleModalLabel">ویرایش بخش</h4>
                                                    </div>

                                                    <form action="" method="post">
                                                        <div class="row modal-body">
                                                            <div id="EditBody">
                                                            
                                                                <div class="row">
                                                                    <div class="col-md-12" >
                                                                        <label class="form-check-label labele" for="defaultCheck1" id="namelabel">
                                                                            <strong> نام بخش: </strong>
                                                                        </label> 
                                                                        <input class="form-control input-sm"  type="text" id="name"  name="name" placeholder="نام بخش" max="200" min="1" value="<?php echo $data['Name']; ?>" required=""
                                                                        oninvalid="this.setCustomValidity('نام بخش را وارد نمایید')" oninput="setCustomValidity('')" >
                                                                    </div>
                                                                </div>
                                                                    
                                                                <div class="row">
                                                                    <div class="col-md-12" >
                                                                        <label class="form-check-label labele" for="Sectionnumber" id="Sectionlabel">
                                                                            <strong> تعداد  : </strong>
                                                                        </label> 
                                                                        <input class="span2" id="AddSectionnumber" name="Sectionnumber" minlength="1" maxlength="9" type="text" onkeypress="return isNumber(event)" onpaste="return false;" required="" 
                                                                        oninvalid="this.setCustomValidity('تعداد را وارد نمایید')" oninput="setCustomValidity('')" placeholder="تعداد" value="<?php echo $data['Number']; ?>">    
                                                                    </div>  
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12" >
                                                                        <div id="category">
                                                                            <input type="radio" name="cat" value="0" <?php if($data['Category'] == "0") echo "checked"; ?>><strong>بیماران</strong> 
                                                                            <br>
                                                                            <input type="radio" name="cat" value="1" <?php if($data['Category'] == "1") echo "checked"; ?>><strong>پرسنل</strong> 
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
                                                    <h4 class="modal-title ModalTitle" id="exampleModalLabel"> حذف بخش</h4>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="center">
                                                        <strong>آیا شما مطئن هستید که میخواهید بخش <?php echo $data['Name'] ?> را حذف نمایید؟</strong>
                                                    </div>
                                                </div>
                                                
                                                <div class="modal-footer rtl">     
                                                    <form action="" method="post">
                                                        <button type="submit" name="remove"  class="btn btn-danger" title="حذف">حذف</button>
                                                        <button type="button" class="btn btn-info" data-dismiss="modal" title="انصراف">انصراف</button>    
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
         