
 
<div class="row">
    <div class="row page-titles pagetitle title"> 
         <div class="col-lg-10">
            <div class="row">    
            <i class="fonticon fas fa-server"></i>  
            <h3 >وب سرویس ها</h3>
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
                            <th class="center tableRow">آدرس جیسون</th>
                            <th class="center tableRow">توضیحات</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        $row=0;
                        $query1=mysqli_query($con,"select * from tbl_webservice ORDER BY id DESC");
                        while($data=mysqli_fetch_array($query1)){ ?>
                            <tr>
                                <td class="center tableRow"> 
                                    <?php echo PersianNumber(++$row); ?>
                                </td>
                                
                                <td  class="center tableRow"  style="text-align: left !important;direction: ltr !important;">
                                    <a href="<?php echo $data['url']; ?>"> <?php echo $data['url']; ?></a>
                                </td>

                               <td  class="center tableRow" style="text-align: right !important;direction: rtl !important;padding-right: 50px !important;">
                                    <?php echo $data['desc']; ?>
                                </td>

                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    </div>
               </div>
        </div> 
     </div> 
    </div><!-- end container -->
</div> <!-- end row -->

   