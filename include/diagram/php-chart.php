<!DOCTYPE html>
<html lang="fa">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>وبگو | ترسیم نمودار آماری با PHP</title>
<!-- Webgoo.ir -->
<link rel="stylesheet" href="chart/style.css">
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
//متغیر پیش فرض
@$statistical = array();

//وارد کردن فایل کلاس ترسیم نمودار
include_once('chart/chart_class.php');

//تعریف مقادیر آمار در متغیر
$statistical["شنبه"] = 20;
$statistical["یکشنبه"] = 30;
$statistical["دوشنبه"] = 60;
$statistical["سه شنبه"] = 25;
$statistical["چهارشنبه"] = 44;
$statistical["پنج شنبه"] = 17;
$statistical["جمعه"] = 66;

//نحوه فراخوانی
$mc = new Chart($statistical);
$mc->displayChart('نمودار آماری - نمایش به صورت افقی', 0, 500, 250, true, 1);

//نحوه فراخوانی
$mc = new Chart($statistical);
$mc->displayChart('نمودار آماری - نمایش به صورت عمودی', 1, 500, 250, false, 2);
?>
<hr>
- ورودی کلاس به صورت آرایه است که در هنگام فراخوانی به عنوان آرگیومنت به کلاس داده می شود.
<br><br>
- متد displayChart شش آرگیومنت دارد که به ترتیب شامل عنوان چارت، عمودی یا افقی بودن، عرض به پیکسل، ارتفاع به پیکسل،
استفاده یا عدم استفاده از رنگ های متنوع و در نهایت عدد رنگ انتخابی کاربر است.
<br><br>
- تعداد رنگ های انتخابی با توجه به تصاویر موجود در دایرکتوری image می تواند از عدد 1 تا 5 متغیر باشد.
</body>
</html>