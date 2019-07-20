<div class="row">
    <div class="row page-titles pagetitle title"> 
         <div class="col-lg-12">
            <div class="row">    
            <i class="fonticon fas fa-book-reader"></i>  
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
                                <i id="detailsKitchen" title="نمایش سفارش" class="fas fa-info-circle" data-toggle="modal" data-target="#ShowModal<?php echo $data['id']; ?>"></i> 
                            </td>
                        </tr>

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