<?php
      
        // آمار نمودار خطی قیمت فروش غذا در ده سال متوالی    
        $query=mysqli_query($con,"select sum(total) from tbl_order where (confirm_order=2)  and  (datetime BETWEEN '2019/3/21' and '2020/3/19')"); 
        $sum1398 = mysqli_fetch_array($query); 

        $query=mysqli_query($con,"select sum(total) from tbl_order where (confirm_order=2)  and  (datetime BETWEEN '2020/3/20' and '2021/3/19')"); 
        $sum1399 = mysqli_fetch_array($query); 

        $query=mysqli_query($con,"select sum(total) from tbl_order where (confirm_order=2)  and  (datetime BETWEEN '2021/3/20' and '2022/3/19')"); 
        $sum1400 = mysqli_fetch_array($query); 

        $query=mysqli_query($con,"select sum(total) from tbl_order where (confirm_order=2)  and  (datetime BETWEEN '2022/3/20' and '2023/3/19')"); 
        $sum1400 = mysqli_fetch_array($query); 

        $query=mysqli_query($con,"select sum(total) from tbl_order where (confirm_order=2)  and  (datetime BETWEEN '2023/3/20' and '2024/3/19')"); 
        $sum1401 = mysqli_fetch_array($query); 

        $query=mysqli_query($con,"select sum(total) from tbl_order where (confirm_order=2)  and  (datetime BETWEEN '2024/3/20' and '2025/3/19')"); 
        $sum1402 = mysqli_fetch_array($query);
        
        $query=mysqli_query($con,"select sum(total) from tbl_order where (confirm_order=2)  and  (datetime BETWEEN '2025/3/20' and '2026/3/19')"); 
        $sum1403 = mysqli_fetch_array($query); 

        $query=mysqli_query($con,"select sum(total) from tbl_order where (confirm_order=2)  and  (datetime BETWEEN '2026/3/20' and '2027/3/19')"); 
        $sum1404 = mysqli_fetch_array($query); 

        $query=mysqli_query($con,"select sum(total) from tbl_order where (confirm_order=2)  and  (datetime BETWEEN '2027/3/20' and '2028/3/19')"); 
        $sum1405 = mysqli_fetch_array($query);
        
        $query=mysqli_query($con,"select sum(total) from tbl_order where (confirm_order=2)  and  (datetime BETWEEN '2028/3/20' and '2029/3/19')"); 
        $sum1406 = mysqli_fetch_array($query);

        $query=mysqli_query($con,"select sum(total) from tbl_order where (confirm_order=2)  and  (datetime BETWEEN '2029/3/20' and '2030/3/19')"); 
        $sum1407 = mysqli_fetch_array($query);

        $query=mysqli_query($con,"select sum(total) from tbl_order where (confirm_order=2)  and  (datetime BETWEEN '2030/3/20' and '2031/3/19')"); 
        $sum1408 = mysqli_fetch_array($query);

        $query=mysqli_query($con,"select sum(total) from tbl_order where (confirm_order=2)  and  (datetime BETWEEN '2031/3/20' and '2032/3/19')"); 
        $sum1409 = mysqli_fetch_array($query);

        $query=mysqli_query($con,"select sum(total) from tbl_order where (confirm_order=2)  and  (datetime BETWEEN '2032/3/20' and '2033/3/19')"); 
        $sum1410 = mysqli_fetch_array($query);

      //آمار نمودار دایره ای
        $query=mysqli_query($con,"select food_id, count(food_id) from tbl_order group by food_id ORDER BY count(food_id)DESC limit 5"); 
 
        
        $foodname1="";
        $foodname2="";
        $foodname3="";
        $foodname4="";
        $foodname5="";

        $foodcount1=0;
        $foodcount2=0;
        $foodcount3=0;
        $foodcount4=0;
        $foodcount5=0;

        $i=1;
       while($food = mysqli_fetch_array($query))
        {
         
          $Foodquery=mysqli_query($con,"select name from tbl_subcategory where id=".$food['food_id']);
          $Foodname = mysqli_fetch_array($Foodquery);
          
       
          if($i == 1)
          {
            $foodname1= $Foodname[0];
            $foodcount1 = $food["count(food_id)"];
          
        
          }
          else if($i == 2)
          {
            $foodname2= $Foodname[0];
            $foodcount2 = $food["count(food_id)"];
          }
          else if($i == 3)
          {
            $foodname3= $Foodname[0];
            $foodcount3 = $food["count(food_id)"];
          }
          else if($i == 4)
          {
            $foodname4= $Foodname[0];
            $foodcount4 = $food["count(food_id)"];
          }
          else if($i == 5)
          {
            $foodname5= $Foodname[0];
            $foodcount5 = $food["count(food_id)"];
          }
        
          $i++;
        }

        $a="کوبیده";
   ?>

 <div class="row">
    <div class="row page-titles pagetitle title">     
        <i class="fonticon fas fa-chart-pie"></i>
        <h3 >آمار</h3>
      </div>
    </div>
  <div class="row">
      <div id="Staticbody">

      <div class="row">
          <!-- column -->
          <div class="col-lg-12">
              <div class="card">
                  <div class="card-body">
                      <h4 class="card-title StaticTitle">نمودار خطی مصرف غذاها در سالهای مختلف</h4>
                    
                      <div class="row">
                        
                        <div id="line">

                          <script type="text/javascript">

                            var sum1398 = <?php if($sum1398[0]!=null) echo $sum1398[0]; else echo "0" ?>;
                            var sum1399 = <?php if($sum1399[0]!=null) echo $sum1399[0]; else echo "0" ?>;
                            var sum1400 = <?php if($sum1400[0]!=null) echo $sum1400[0]; else echo "0" ?>;
                            var sum1401 = <?php if($sum1401[0]!=null) echo $sum1401[0]; else echo "0" ?>;
                            var sum1402 = <?php if($sum1402[0]!=null) echo $sum1402[0]; else echo "0" ?>;
                            var sum1403 = <?php if($sum1403[0]!=null) echo $sum1403[0]; else echo "0" ?>;
                            var sum1404 = <?php if($sum1404[0]!=null) echo $sum1404[0]; else echo "0" ?>;
                            var sum1405 = <?php if($sum1405[0]!=null) echo $sum1405[0]; else echo "0" ?>;
                            var sum1406 = <?php if($sum1406[0]!=null) echo $sum1406[0]; else echo "0" ?>;
                            var sum1407 = <?php if($sum1407[0]!=null) echo $sum1407[0]; else echo "0" ?>;
                            var sum1408 = <?php if($sum1408[0]!=null) echo $sum1408[0]; else echo "0" ?>;
                            var sum1409 = <?php if($sum1409[0]!=null) echo $sum1409[0]; else echo "0" ?>;
                            var sum1410 = <?php if($sum1410[0]!=null) echo $sum1410[0]; else echo "0" ?>;

                            new Morris.Line({
                              element: 'line',
                              data: [
                                { y: '1398', a: sum1398 },
                                { y: '1399', a: sum1399 },
                                { y: '1400', a: sum1400 },
                                { y: '1401', a: sum1401 },
                                { y: '1402', a: sum1402 },
                                { y: '1403', a: sum1403 },
                                { y: '1404', a: sum1404 },
                                { y: '1405', a: sum1405 },
                                { y: '1406', a: sum1406 },
                                { y: '1407', a: sum1407 },
                                { y: '1408', a: sum1408 },
                                { y: '1409', a: sum1409 },
                                { y: '1410', a: sum1410 },
                              ],
                              xkey: 'y',
                              ykeys: ['a'],
                              labels: ['مبلغ(تومان)']
                            });
                          </script>
                        </div>
                      </div>
                      
                  </div>
              </div>
          </div>
      </div>

      <div class="row">
          <!-- column -->
          <div class="col-lg-4">
              <div class="card">
                  <div class="card-body">
                      <h4 class="card-title StaticTitle">نمودار دایره بیشترین سفارش غذا</h4>
                      <div id="circle">
                          <script type="text/javascript">

                          

                              var foodname1 = <?php echo json_encode($foodname1); ?>;
                              var foodname2 = <?php echo json_encode($foodname2); ?>;
                              var foodname3 = <?php echo json_encode($foodname3); ?>;
                              var foodname4 = <?php echo json_encode($foodname4); ?>;
                              var foodname5 = <?php echo json_encode($foodname5); ?>;
                          

                              var foodcount1 = <?php if($foodcount1!=null) echo $foodcount1; else echo "0"; ?>;
                              var foodcount2 = <?php if($foodcount2!=null) echo $foodcount2; else echo "0"; ?>;
                              var foodcount3 = <?php if($foodcount3!=null) echo $foodcount3; else echo "0"; ?>;
                              var foodcount4 = <?php if($foodcount4!=null) echo $foodcount4; else echo "0"; ?>;
                              var foodcount5 = <?php if($foodcount5!=null) echo $foodcount5; else echo "0"; ?>;

                              new Morris.Donut({
                                element: 'circle',
                                data: [
                                  { label: foodname1, value: foodcount1},
                                  { label: foodname2, value: foodcount2 },
                                  { label: foodname3, value: foodcount3 },
                                  { label: foodname4, value: foodcount4 },
                                  { label: foodname5, value: foodcount5 }
                            
                                ]
                              });
                          </script>
                      </div>
                      
                  </div>
              </div>
          </div>
                      
          <!-- column -->
          <div class="col-lg-8">
              <div class="card">
                  <div class="card-body">
                      <h4 class="card-title StaticTitle">نمودار میله ای فروض قضاها</h4>
                      <div id="horizantal">
                            <?php include('include/diagram/horizantal.php'); ?>
                        </div>
                      
                  </div>
              </div>
          </div>
      </div>   
    </div>
                                
  </div>