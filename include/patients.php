<?php 

if(isset($_POST['edit'])){
   
    $id = $_POST['edit_id'];
    $name =  mysqli_real_escape_string($con,$_POST['Name']);
    $code = mysqli_real_escape_string($con,$_POST['Code']);
    $section = $_POST['Section'];
    
    if(is_numeric($section))
    {
        $sql = "UPDATE tbl_patients SET Name='".$name."' , Code='".$code."' , Section=".$section." WHERE id=".$id;
        $stmt = $con->prepare($sql);
        $stmt->execute();     
    }   
    
}

if(isset($_POST['remove'])){

    $id = $_POST['remove_id'];
    $sql = "Delete From tbl_patients WHERE id=".$id;
    $con->query($sql);      

}

if(isset($_POST['add'])){

      $name = mysqli_real_escape_string($con,$_POST['Name']);
      $code = mysqli_real_escape_string($con,$_POST['Code']);
      $section = $_POST['Section'];

      if(is_numeric($section))
      {
         $sql = "INSERT INTO tbl_patients (Name, Code , Section)
        VALUES ('".$name."' , '".$code."' , ".$section.")";
        $con->query($sql);
      } 
}
?>

 <div class="row">
    <div class="row page-titles pagetitle title"> 
         <div class="col-lg-10">
            <div class="row">    
            <i class="fonticon fas fa-procedures"></i>  
            <h3>بیماران</h3>
            </div>
        </div>
        
        <div class="col-lg-2">
            <button id="addButton" type="submit" class="btn btn-success" data-toggle="modal" data-target="#Add">
                <strong> افزودن بیمار جدید </strong>   
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
                    <h4 class="modal-title ModalTitle" id="exampleModalLabel"> افزودن بیمار جدید</h4>
                </div>

                <form action="" method="post">

                    <div class="Row modal-body">
                        <div id="EditBody">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-check-label labele" for="patientsName" id="namelabel">
                                        <strong> نام و نام خانوادگی: </strong>
                                    </label> 
                                    <input  type="text" id="Name"  name="Name" placeholder="نام و نام خانوادگی" max="200" min="1" value="<?php echo $data['Name']; ?>" required=""
                                    oninvalid="this.setCustomValidity('نام بخش را وارد نمایید')" oninput="setCustomValidity('')" >
                                </div>   
                            </div>          

                            <div class="row">
                                <div class="col-md-12" >
                                    <label class="form-check-label" for="defaultCheck1" id="Sectionlabel">
                                        <strong> کد بیمار : </strong>
                                    </label>
                                    <input  type="text" id="Code" name="Code" min="0" max="999999999"  value="<?php echo $data['Code ']; ?>" required=""
                                    oninvalid="this.setCustomValidity('کد بیمار را وارد نمایید')" oninput="setCustomValidity('')" placeholder="کد بیمار" > 
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12" >
                                    <label class="form-check-label" for="defaultCheck1" id="Sectionlabel">
                                        <strong> بخش : </strong>
                                    </label>

                                    <select id="category" name="Section" class="dropdown">
                                        <?php
                                            $qry=mysqli_query($con,"select * from tbl_section where Category=0");

                                            while($sections=mysqli_fetch_array($qry)){
                                            ?>
                                                <option value="<?php echo $sections["id"]; ?>"><?php echo $sections["Name"]; ?></option>
                                            <?php
                                            }
                                        ?>     
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
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">      
                            <thead>
                                <tr>
                                    <th class="center tableRow" id="RowTitle">ردیف</th>
                                    <th class="center tableRow" id="patientsNameTitle"> نام و نام خانوادگی</th>
                                    <th class="center tableRow" id="patientsCodeTitle">کد</th>
                                    <th class="center tableRow" id="patientsSectionTitle">بخش</th>
                                    <th class="center tableRow" id="PartActionitle">اقدامات</th>
                                </tr>
                            </thead>
                             <tbody>
                                <?php

                                $row=0;
                                $query=mysqli_query($con,"select * from tbl_patients ORDER BY id DESC");
                                while($data=mysqli_fetch_array($query)){ ?>
                                    <tr>
                                        <td class="center tableRow">
                                            <strong> <?php echo PersianNumber(++$row); ?></strong>
                                        </td>
                                        <td class="center tableRow">
                                            <strong> <?php echo $data['Name']; ?></strong>
                                        </td>
                                        <td class="center tableRow">
                                            <strong><?php echo PersianNumber($data['Code']); ?></strong>
                                        </td>

                                        <?php
                                        $qry=mysqli_query($con,"select Name from tbl_section where id=".$data['Section']);
                                        $section = mysqli_fetch_array($qry);
                                        ?>
                                        <td class="center tableRow">    
                                            <strong><?php echo PersianNumber($section[0]); ?></strong>
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
                                                            <h4 class="modal-title ModalTitle" id="exampleModalLabel">ویرایش مشخصات بیمار</h4>
   
                                                        </div>

                                                        <form action="" method="post">

                                                            <div class="Row modal-body">
                                                                <div id="EditBody">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label class="form-check-label labele" for="patientsName" id="namelabel">
                                                                                <strong> نام و نام خانوادگی: </strong>
                                                                            </label> 
                                                                            <input  type="text" id="Name"  name="Name" placeholder="نام و نام خانوادگی" max="200" min="1" value="<?php echo $data['Name']; ?>" required=""
                                                                            oninvalid="this.setCustomValidity('نام بخش را وارد نمایید')" oninput="setCustomValidity('')" >
                                                                        </div>   
                                                                    </div>          

                                                                    <div class="row">
                                                                        <div class="col-md-12" >
                                                                            <label class="form-check-label" for="defaultCheck1" id="Sectionlabel">
                                                                                <strong> کد بیمار : </strong>
                                                                            </label>
                                                                            <input  type="text" id="Code" name="Code" min="0" max="999999999"  value="<?php echo $data['Code']; ?>" required="" 
                                                                            oninvalid="this.setCustomValidity('کد بیمار را وارد نمایید')" oninput="setCustomValidity('')" placeholder="کد بیمار" > 
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-12" >
                                                                            <label class="form-check-label" for="defaultCheck1" id="Sectionlabel">
                                                                                <strong> بخش : </strong>
                                                                            </label>

                                                                            <select id="category" name="Section" class="dropdown">
                                                                                <?php
                                                                                    $qry=mysqli_query($con,"select * from tbl_section where Category=0");

                                                                                    while($sections=mysqli_fetch_array($qry)){
                                                                                    ?>
                                                                                        <option value="<?php echo $sections["id"]; ?>" <?php if($sections["id"]== $data["Section"]) echo "selected"; ?>><?php echo $sections["Name"]; ?></option>
                                                                                    <?php
                                                                                    }
                                                                                ?>     
                                                                            </select>
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
                                                        <h4 class="modal-title ModalTitle" id="exampleModalLabel"> حذف بخش</h4>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="center">
                                                            <strong>آیا شما مطئن هستید که میخواهید بیمار <?php echo $data['Name'] ?> را حذف نمایید؟</strong>   
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
         
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
             
        ]
    });
</script>