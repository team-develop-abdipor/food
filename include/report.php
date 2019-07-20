<?php

  $Since= gtj(date("Y-m-d"));
  $Until= gtj(date("Y-m-d"));
  $blReport =false;

  if(isset($_POST['Report'])){

    $Since =$_POST['Since'];
    $Until =$_POST['Until'];

    $blReport =true;
  }

?>

<div class="row">
    <div class="row page-titles pagetitle title"> 
         <div class="col-lg-11">  
             <div class="row">
                <i class="fonticon fas fa-book-reader"></i>  
                <h3 > گزارش گیری</h3>
            </div>
        </div>
        <div class="row col-lg-1">
            <div class="loader"><div>
       </div>
       
    </div> 
</div>
    
</div> 
</div>


<div class="row">

    <div id="body">

         <button id="Culanderbtn" type="submit" class="btn btn-success"  data-toggle="collapse" data-target="#calunder">
                <strong>تقویم شمسی</strong>   
                <i class="fa fa-calendar-alt"></i>
            </button>
     
        <div class="row">
             
           <div id="calunder" class="collapse">
                <form action="" method="post">
                     
                    <div id="Content" class="col-md-12">
                        <div class="row">
                            <div class="col-md-3" ></div> 

                            <div class="col-md-1"> 
                                <label class="form-check-label labele" for="Since" id="Sincelabel">
                                    <strong>  ازتاریخ: </strong>
                                </label>
                            </div>  

                            <div class="col-md-2"> 
                                <input id="Since" name="Since" type="text" placeholder="روز / ماه / سال" class="DateInput"  value="<?php echo $Since; ?>" readonly > 
                            </div>  
                            <div class="col-md-1">
                                 <label class="form-check-label labele" for="Until" id="Untillabel">
                                    <strong> تا تاریخ: </strong>
                                </label>  
                            </div>

                            <div class="col-md-2">
                                 <input id="Until" name="Until" type="text" placeholder="روز / ماه / سال" class="DateInput"  value="<?php echo $Until; ?>" readonly >
                            </div>   

                            <div class="col-md-1" ></div> 

                            <div class="col-md-2" >
                                <button type="submit" class="btn btn-danger"  name="Report" id="Report">
                                    <strong> گزارش </strong>   
                                    <i class="fa fa-search-plus"></i>
                                </button>   
                            </div> 


                        </div>
                    </div>  
                </form>  
            </div> 
        </div> 

        <div class="col-12">               
            <div class="table-responsive m-t-40">
                <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="center tableRow">
                                <strong> شماره سفارش</strong>
                                </th>
                                <th class="center tableRow">
                                    <strong>غذا</strong>
                                </th>

                                <th class="center tableRow">
                                    <strong>تعداد</strong>
                                </th>
                                <th class="center tableRow">
                                    <strong> قیمت واحد</strong>
                                </th>
                                <th class="center tableRow">
                                    <strong> قیمت کل</strong>
                                </th>
                                <th class="center tableRow">
                                    <strong> نام</strong>
                                </th>
                                <th class="center tableRow">
                                    <strong> بخش</strong>
                                </th>
                                <th class="center tableRow">
                                    <strong>توضیحات</strong>
                                    </th>
                                <th class="center tableRow">  
                                    <strong>تاریخ سفارش</strong>
                            </th>
                                
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                //گزارش گیری از سفارشات بر اساس یک بازه تاریخ مشخص
                                $TotalPrice=0;
                                if($blReport){

                                if(!empty($_POST['Since']) && !empty($_POST['Until'])){

                                    $Since = jtg($_POST['Since']);
                                    $Until = jtg($_POST['Until']);
                                
                                    $query=mysqli_query($con,"select * from tbl_order where datetime BETWEEN '".$Since."' AND '".$Until."' ORDER BY id DESC");

                                    while ($row = mysqli_fetch_array($query)) 
                                    {
                                        $Foodquery=mysqli_query($con,"select name from tbl_subcategory where id=".$row['food_id']);
                                        $Foodname = mysqli_fetch_array($Foodquery);

                                        $qry=mysqli_query($con,"select Name from tbl_section where id=".$row['section']);
                                        $section = mysqli_fetch_array($qry);          
                                        

                                    ?>
                                        <tr>
                                            <td class="center tableRow"><strong><?php echo PersianNumber($row['order_num']); ?></strong></td>
                                            <td class="center tableRow"><strong><?php echo $Foodname[0]; ?></strong></td>
                                            <td class="center tableRow"><strong><?php echo PersianNumber($row['unit']); ?></strong></td>
                                            <td class="center tableRow"><strong><?php echo PersianNumber($row['price']); ?></strong></td>
                                            <td class="center tableRow"><strong><?php echo PersianNumber($row['total']); ?></strong></td>
                                            <td class="center tableRow"><strong><strong> <?php echo $row['name']; ?></strong></td>
                                            <td class="center tableRow"><strong><?php echo $section[0] ?></td>
                                            <td class="center tableRow"><strong><?php echo $row['comment']; ?></strong></td>
                                            <td class="center tableRow"><strong><?php echo PersianNumber(gtj($row['datetime'])); ?></strong></td>
                                        
                                        </tr>
                                    <?php

                                        $TotalPrice += $row['total'];
                                    }
                                }
                            }
                            ?>
                            
                        </tbody>
                    </table>
                    
                 </div>
                <?php if($TotalPrice > 0){?>
                        <div class="SumTotal center">
                            <strong><?php echo "قیمت کل سفارشات: ".PersianNumber($TotalPrice)." تومان " ; ?> </strong>
                        </div>
                    
                <?php     
                } 
                ?> 
            </div>
    </div> <!-- /.row -->
</div><!-- /.container -->

<script>
Calendar.setup({
    inputField: 'Since',
    button: 'Since',
    ifFormat: '%Y/%m/%d',
    dateType: 'jalali'
});
</script>

<script>
Calendar.setup({
    inputField: 'Until',
    button: 'Until',
    ifFormat: '%Y/%m/%d',
    dateType: 'jalali'
});
 
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
            'copy', 'csv', 'excel', 'print'
        ]
    });

</script>