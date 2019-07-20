<?php 
 $setc=mysqli_query($con,"select * from tbl_setcurrency ");
 $cu=mysqli_fetch_array($setc); 

//تایید سفارشات
if(isset($_POST['confirm']) or isset($_POST['confirm2'])){

    $Confirm_id = $_POST['order_id'];
    $sql = "UPDATE tbl_order SET confirm_order=1 WHERE order_num=".$Confirm_id;
    $stmt = $con->prepare($sql);
    $stmt->execute(); 

    if($_POST['confirm_order'] != 0)
    {
        //کاهش موجودی غذا
        $orders=mysqli_query($con,"select * from tbl_order where order_num=".$Confirm_id);
        foreach ($orders as $order){   
        $qry=mysqli_query($con,"select supply from tbl_subcategory where id=".$order['food_id']);
        $supply = mysqli_fetch_array($qry);  
        $supply= $supply[0]-$order["unit"];
        $sql = "UPDATE tbl_subcategory SET supply=".$supply." WHERE id=".$order['food_id'];
        $stmt = $con->prepare($sql);
        $stmt->execute();   
        }
    }
}
                
//حذف سفارشات
if(isset($_POST['remove'])){

    $remove_id = $_POST['remove_id'];
    $sql = "Delete From tbl_order WHERE order_num=".$remove_id;
    $con->query($sql);
    
}

//لفو سفارشات
if(isset($_POST['reject']) or isset($_POST['reject2'])){

    $reject_id = $_POST['order_id'];
    $sql = "UPDATE tbl_order SET confirm_order=2 WHERE order_num=".$reject_id;
    $stmt = $con->prepare($sql);
    $stmt->execute();  
    
        //افزایش موجودی غذا
    $orders=mysqli_query($con,"select * from tbl_order where order_num=".$reject_id);
    foreach ($orders as $order){ 

    $qry=mysqli_query($con,"select supply from tbl_subcategory where id=".$order['food_id']);
    $supply = mysqli_fetch_array($qry);  
    $supply= $supply[0]+$order["unit"];
    $sql = "UPDATE tbl_subcategory SET supply=".$supply." WHERE id=".$order['food_id'];
    $stmt = $con->prepare($sql);
    $stmt->execute();   

    } 
}
?>

<div class="row">
    <div class="row page-titles pagetitle title"> 
         <div class="col-lg-12">
            <div class="row">    
            <i class="fonticon fas fa-print"></i>  
            <h3 > سفارشات</h3>
            </div>
        </div>
    </div> 
</div>
        
<div class="row">
    <div id="body">
        <div class="col-12">               
            <div class="table-responsive m-t-40">
                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="center tableRow"><strong>ردیف<strong></th>
                            <th class="center tableRow"><strong>شماره سفارش<strong></th>
                            <th class="center tableRow"><strong>نام<strong></th>
                            <th class="center tableRow" ><strong>بخش<strong></th>
                            <th class="center tableRow"><strong>توضیحات<strong></th>
                            <th class="center tableRow"><strong>تاریخ سفارش<strong></th>
                            <th class="center tableRow"><strong> وضعیت<strong></th>
                            <th class="center tableRow"><strong>اقدامات<strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $row=0;
                        $query1=mysqli_query($con,"select * from tbl_order GROUP BY order_num ORDER BY order_num DESC");
                        while($data=mysqli_fetch_array($query1)){ ?>
                        <tr class="odd gradeX">
                            
                            <td class="center tableRow">
                                <strong><?php echo PersianNumber(++$row); ?></strong>
                            </td>

                            <td class="center tableRow">
                                <strong><?php echo PersianNumber($data['order_num']); ?></strong>
                            </td>

                            <td class="center tableRow">
                                <strong><?php echo $data['name']; ?></strong>
                            </td>
                            
                            

                            <td class="center tableRow">

                                <?php
                        
                                    $query=mysqli_query($con,"select Name from tbl_section where id=".$data['section']);
                                    $section = mysqli_fetch_array($query);             
                                ?>
                                <strong><?php echo $section[0]; ?></strong>
                            </td>

                            <td class="center tableRow">
                                <strong><?php echo $data['comment']; ?></strong>
                            </td>
                            
                        
                            <td class="center tableRow">
                                <strong><?php echo PersianNumber(gtj($data['datetime'])); ?></strong>
                            </td >

                            <td class="center tableRow">
                                <strong>
                                    <?php  
                                        if($data['confirm_order'] == 0)
                                        {
                                            echo '<span class="label label-info">در انتظار تایید</span>';
                                        } 
                                        else if($data['confirm_order'] == 1)
                                        {
                                            echo '<span class="label label-success">تایید شده</span>';
                                        }
                                        else if($data['confirm_order'] == 2)
                                        {
                                            echo '<span class="label label-warning">رد شده</span>';
                                        }
                                    ?>
                                </strong>
                            </td >
                            
                            <td class="center tableRow">

                                <i id="details" title="نمایش سفارش" class="fas fa-info-circle" data-toggle="modal" data-target="#ShowModal<?php echo $data['id']; ?>"></i> 

                                <?php 
                                if($data['confirm_order']==0)
                                {
                                ?>
                                    <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#ConfirmModal<?php echo $data['id']; ?>">
                                        <strong> &nbsp تائید &nbsp </strong>   
                                    </button>

                                    <button type="submit" class="btn btn-warning" data-toggle="modal" data-target="#RejectModal<?php echo $data['id']; ?>">
                                        <strong> &nbsp&nbsp لغو &nbsp </strong>   
                                    </button>
                                <?php 
                                }
                                else  if($data['confirm_order']==1)
                                {
                                ?>
                                    <button type="submit" class="btn btn-warning" data-toggle="modal" data-target="#RejectModal<?php echo $data['id']; ?>">
                                        <strong> &nbsp&nbsp لغو &nbsp </strong>   
                                    </button>
                                <?php
                                }                                   
                                    else  if($data['confirm_order']==2)
                                {
                                ?>
                                    <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#ConfirmModal<?php echo $data['id']; ?>">
                                        <strong> &nbsp تائید &nbsp </strong>   
                                    </button>

                                    <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#RemoveModal<?php echo $data['id']; ?>">
                                        <strong> &nbsp حذف &nbsp </strong> 
                                    </button>

                                <?php
                                }                                   
                                ?>
                                
                            </td>

                        </tr>

                    
                        <!--Reject Modal -->
                        <div class="row">
                            <div   class="modal fade" mame="RejectModal" id="RejectModal<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title ModalTitle" id="exampleModalLabel"> لغو سفارش</h4>
                                            
                                        
                                    </div>
                                    <div class="modal-body">
                                        <div class="center">
                                            <strong>آیا شما مطمئن هستید که میخواهید سفارش شماره <?php echo " ".Persiannumber($data['order_num'])." "?>را لغو نمایید؟</strong>
                                        </div>

                                    </div>
                                    
                                    <div class="modal-footer rtl">                                        
                                        <form action="" method="post">
                                            <button type="submit" name="reject"  class="btn btn-warning">لغو</button>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">انصراف</button>
                                            <input type="hidden" name="order_id" value="<?php echo $data['order_num']; ?>">
                                        </form>
                                    </div>
                                    
                                    </div>
                                </div>
                            </div> 
                        </div> 

                        <!--Remove Modal -->
                        <div class="row">
                            <div   class="modal fade" mame="RemoveModal" id="RemoveModal<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document"  >
                                    <div class="modal-content"  >
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                            <h4 class="modal-title ModalTitle" id="exampleModalLabel"> حذف سفارش</h4>
                                        
                                        
                                    </div>
                                    <div class="modal-body">
                                        <div class="center">
                                            <strong>آیا شما مطمئن هستید که میخواهید سفارش شماره <?php echo " ".Persiannumber($data['order_num'])." "?>را حذف نمایید؟</strong>
                                        </div>

                                    </div>
                                    
                                    <div class="modal-footer rtl">
                                    
                                        <form action="" method="post">
                                            <button type="submit" name="remove"  class="btn btn-danger">حذف</button>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">انصراف</button>
                                            <input type="hidden" name="remove_id" value="<?php echo $data['order_num']; ?>">
                                        </form>
        
                                    </div>
                                    
                                </div>
                            </div>  
                        </div> 

                        <!--Confirm Modal -->
                        <div class="row">  
                            <div   class="modal fade" mame="ConfirmModal" id="ConfirmModal<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document"  >
                                    <div class="modal-content"  >
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title ModalTitle" id="exampleModalLabel"> تائید سفارش</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="center">
                                            <strong>آیا شما مطمئن هستید که میخواهید سفارش شماره <?php echo " ".Persiannumber($data['order_num'])." "?>را تایید نمایید؟</strong>
                                        </div>

                                    </div>
                                    
                                    <div class="modal-footer rtl">
                                        <form action="" method="post"> 
                                            <button type="submit" name="confirm"  class="btn btn-success">تائید</button>
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">انصراف</button>
                                            <input type="hidden" name="order_id" value="<?php echo $data['order_num']; ?>">
                                            <input type="hidden" name="confirm_order" value="<?php echo $data['confirm_order']; ?>">
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <!--Show Modal -->
                        <div class="row">  
                            <div   class="modal fade" mame="ShowModal" id="ShowModal<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: scroll;">
                                <div class="modal-dialog" role="document"  >           
                                    <div class="modal-content" >
                                    
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span  aria-hidden="true">&times;</span> 
                                        </button>
                                        <h4 class="modal-title ModalTitle" id="exampleModalLabel"> جزئیات سفارش</h4>                                
                                    </div>
                                    
                                    <div class="modal-body">
                                        
                                        <div style="float:right;text-align: right;font: 12px tahoma;min-width:95%;padding:20px;">
                                        
                                        <?php
                                            $query=mysqli_query($con,"select Name from tbl_section where id=".$data['section']);
                                            $section = mysqli_fetch_array($query);             
                                        ?>

                                        <strong>شماره سفارش : <?php echo PersianNumber($data['order_num']); ?> </strong>
                                        <br><br>                                                      
                                        <strong>نام : <?php echo $data['name']; ?> </strong>
                                        <br> <br>
                                        <strong>شماره تماس : <?php echo PersianNumber($data['phone']); ?> </strong>
                                        <br> <br>
                                        <strong> بخش : <?php echo $section[0]; ?> </strong>
                                        <br><br>
                                        <strong> رده شغلی : <?php echo $data['job']; ?> </strong>
                                        <br><br>
                                        <strong> تاریخ سفارش : <?php echo PersianNumber(gtj($data['datetime'])); ?> </strong>
                                        <br><br>
                                        <strong> وضعیت : </strong>
                                        <strong style="color:red;"> 
                                            <?php 
                                                if($data['confirm_order'] == 0)
                                                {
                                                    echo '<span class="label label-info">در انتظار تایید</span>';
                                                } 
                                                else if($data['confirm_order'] == 1)
                                                {
                                                    echo '<span class="label label-success">تایید شده</span>';
                                                }
                                                else if($data['confirm_order'] == 2)
                                                {
                                                    echo '<span class="label label-warning">رد شده</span>';
                                                }
                                            ?> 
                                        </strong>
                                        <br><br>
                                        <strong>  توضیحات : <?php echo $data['comment']; ?> </strong>

        
                                        <div style="float:right;min-width:98%;margin:10px 0px;padding:5px;">

                                        <div style="border:1px green solid; min-width:100%; height: 30px;background:green;color:#fff;">
                                            <div style="float:right; min-width:40px;margin:3px 0px;text-align: center;">
                                                <strong>  ردیف </strong>
                                            </div>    

                                            <div style="float:right;min-width:160px;margin:3px 0px;text-align: center;">
                                                <strong>  نام غذا </strong>
                                            </div>  

                                            <div style="float:right;min-width:40px;margin:3px 0px;text-align: center;">
                                                <strong>  تعداد  </strong>
                                            </div>  

                                            <div style="float:right;min-width:70px;margin:3px 0px;text-align: center;">
                                                <strong> قیمت واحد </strong>
                                            </div>  

                                            <div style="float:right; min-width:70px;margin:3px 0px;text-align: center;">
                                                <strong>  قیمت کل </strong>
                                            </div>  
                                        </div>

                                        
                                        <?php 
                                        
                                        $sum=0;
                                        $row =0;
                                        $orders=mysqli_query($con,"select * from tbl_order where order_num='".$data['order_num']."' ORDER BY id DESC ");
                                        foreach ($orders as $order){ 

                                            $Foodquery=mysqli_query($con,"select name from tbl_subcategory where id=".$order['food_id']);
                                            $Foodname = mysqli_fetch_array($Foodquery);

                                        ?>
                                                
                                            <div style="border-bottom:1px green solid;border-left:1px green solid;border-right:1px green solid; width:100%; height: 30px;">
                                                <div style="float:right;min-width:40px;margin:3px 0px;text-align: center;">
                                                    <strong> <?php echo PersianNumber(++$row); ?>  </strong>
                                                </div>  
                                            
                                                <div style="float:right;min-width:160px;margin:3px 0px;text-align: center;">
                                                    <strong>  <?php echo $Foodname[0]; ?>  </strong>
                                                </div>  

                                                <div style="float:right;min-width:40px;margin:3px 0px;text-align: center;">
                                                    <strong> <?php echo PersianNumber($order['unit']); ?>  </strong>
                                                </div>  

                                                <div style="float:right;min-width:70px;margin:3px 0px;text-align: center;">
                                                    <strong> <?php echo PersianNumber($order['price']); ?>  </strong>
                                                </div>  

                                                <div style="float:right;min-width:70px;margin:3px 0px;text-align: center;">
                                                    <strong> <?php echo PersianNumber($order['total']); ?>  </strong>
                                                </div>  

                                            </div>

                                        <?php                   
                                            $sum +=$order['total'];
                                            }
                                        ?>
                                        


                                        <div style="float:left;width:95%;margin:15px;text-align: center; padding:10px; direction: rtl;background:red;color:#fff;border-radius:10px;">
                                            <strong>  مبلغ کل فاکتور:  <?php echo " ".PersianNumber($sum)." "; ?>  تومان  </strong>
                                        </div>  

                                        </div>
                                    </div>

                                    <div class="modal-footer rtl">
                    
                                    
                                        <form action="" method="post">
                                            
                                            <?php
                                            if($data['confirm_order']==0)
                                            {
                                            ?>
                                                <button type="submit" class="btn btn-success" name="confirm2">
                                                    <strong> &nbsp تائید &nbsp </strong>   
                                                </button>
                                            
                                                <button type="submit" class="btn btn-warning" name="reject2">
                                                    <strong> &nbsp&nbsp لغو &nbsp </strong>   
                                                </button>
                                            <?php
                                            }
                                            else  if($data['confirm_order']==1)
                                            {
                                            ?>  
                                                <button type="submit" class="btn btn-warning" name="reject2">
                                                    <strong> &nbsp&nbsp لغو &nbsp </strong>   
                                                </button>
                                            <?php
                                            }
                                            else  if($data['confirm_order']==2)
                                            {
                                            ?>  
                                                    <button type="submit" class="btn btn-success" name="confirm2">
                                                    <strong> &nbsp تائید &nbsp </strong>   
                                                    </button>
                                            <?php
                                            }
                                            ?>
                                            <input type="hidden" name="order_id" value="<?php echo $data['order_num']; ?>">
                                        </form>

                                        <button type="button" class="btn btn-primary" data-dismiss="modal" title="بستن">بستن</button>

                                    </div>
        
                                </div>
                            </div>
                        </div>

                    <?php    
                        }
                    ?>          
                    </tbody>

                </table>
            </div>
        </div>
    </div>                               
  </div>
 
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