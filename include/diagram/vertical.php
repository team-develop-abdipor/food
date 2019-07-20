
<?php


//متغیر پیش فرض
@$statistical = array();

//وارد کردن فایل کلاس ترسیم نمودار
include_once('chart/chart_class.php');

//وارد کردن فایل اطلاعات اتصال و تنظیمات پایگاه داده
include_once('config/chart_config.php');

//اتصال با دیتابیس
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if(!$conn) {
    echo "Error!: " . mysqli_connect_errno() . ' - ' . mysqli_connect_error();
    exit;
} else {
    //سازگاری با حروف فارسی
    $sql = "SET NAMES 'utf8'";
    $query = mysqli_query($conn, $sql);

    //دریافت مقادیر از دیتابیس
    $sql = "SELECT * FROM tbl_section";
    $result = mysqli_query($conn, $sql);

    if(!$result) {
        echo "Selecting From Table $tbl_name: Error! " . mysqli_error($conn);
    } else {
        if(mysqli_num_rows($result) > 0) {

            $now = new DateTime();
            $date=$now->format('Y-m-d'); 
            $year=  date('Y', strtotime($date));
            $month=  date('m',strtotime($date));

            while($row = mysqli_fetch_assoc($result)) {


                $query=mysqli_query($con,"select sum(total) from tbl_order where section=".$row['id']." and Year(datetime) = '$year' and Month(datetime) = '$month'");
                $sum = mysqli_fetch_array($query);  
 
                $statistical[$row['Name']] = $sum[0];
            }

            //نحوه فراخوانی
          /*  $mc = new Chart($statistical);
            $mc->displayChart('', 0, 500,237, true, 1);*/

            //نحوه فراخوانی
             $mc = new Chart($statistical);
              $mc->displayChart('', 1, 300, 250, false, 0);
        } else {
            echo "نتیجه ای یافت نشد!";
        }
    }
}

//پایان اتصال
mysqli_close($conn);
?>
