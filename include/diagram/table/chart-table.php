<!DOCTYPE html>
<html lang="fa">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>وبگو | ساخت جدول و ورود نمونه اطلاعات در MySQL</title>
<!-- Webgoo.ir -->
<style>
body {
font-family: Tahoma, Geneva, sans-serif;
font-size: 12px;
direction: rtl;
}
</style>
</head>
<body>
<?php
//وارد کردن فایل اطلاعات اتصال و تنظیمات پایگاه داده
include_once('../config/chart_config.php');

//اتصال با دیتابیس
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if(!$conn) {
    echo "Error!: " . mysqli_connect_errno() . ' - ' . mysqli_connect_error();
    exit;
} else {
    echo "PHP & MySQL Connection: Ok!<br>";

    //سازگاری با حروف فارسی
    $sql = "SET NAMES 'utf8'";
    $query = mysqli_query($conn, $sql);

    //ساخت جدول و ستون ها
    $sql = "CREATE TABLE $tbl_name(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    day VARCHAR(255),
    stat INT(11) UNSIGNED DEFAULT 0) 
    ENGINE=MyISAM DEFAULT CHARACTER SET=utf8 COLLATE=utf8_persian_ci";
    $query = mysqli_query($conn, $sql);
    if(!$query) {
        echo "Creating Table $tbl_name: Error! " . mysqli_error($conn);
    } else {
        echo "Creating Table $tbl_name: OK!<br>";

        //ذخیره نمونه اطلاعات در جدول
        $sql = "INSERT INTO $tbl_name(`day`, `stat`) VALUES('شنبه', '12')";
        $query = mysqli_query($conn, $sql);

        $sql = "INSERT INTO $tbl_name(`day`, `stat`) VALUES('یکشنبه', '45')";
        $query = mysqli_query($conn, $sql);

        $sql = "INSERT INTO $tbl_name(`day`, `stat`) VALUES('دوشنبه', '143')";
        $query = mysqli_query($conn, $sql);

        $sql = "INSERT INTO $tbl_name(`day`, `stat`) VALUES('سه شنبه', '121')";
        $query = mysqli_query($conn, $sql);

        $sql = "INSERT INTO $tbl_name(`day`, `stat`) VALUES('چهارشنبه', '66')";
        $query = mysqli_query($conn, $sql);

        $sql = "INSERT INTO $tbl_name(`day`, `stat`) VALUES('پنجشنبه', '112')";
        $query = mysqli_query($conn, $sql);

        $sql = "INSERT INTO $tbl_name(`day`, `stat`) VALUES('جمعه', '34')";
        $query = mysqli_query($conn, $sql);

        if(!$query) {
            echo "Inserting Into Table $tbl_name: Error! " . mysqli_error($conn);
        } else {
            echo "Inserting Into Table $tbl_name: OK!";
        }
    }
}

//پایان اتصال
mysqli_close($conn);
?>
<hr>
- قبل از فراخوانی و اجرای این فایل ابتدا باید یک دیتابیس با نام دلخواه در برنامه phpMyAdmin ساخته باشیم.
<br><br>
- اطلاعات اتصال و تنظیمات پایگاه داده در فایل chart_config.php در دایرکتوری config قرار دارد.
<br><br>
- در قسمت تنظیمات اتصال به پایگاه داده در لوکال هاست معمولا می توانیم از نام کاربری root بدون کلمه عبور استفاده کنیم.
<br><br>
- عنوان دیتابیس، جدول، ستون ها و نمونه مقادیر کاملا فرضی هستند و صرفا جهت تست و بررسی نحوه ترسیم نمودار در PHP و MySQL
درج شده اند.
</body>
</html>