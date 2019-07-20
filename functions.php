<?php
  error_reporting(0);
//تبدیل تاریخ شمسی به میلادی
function jtg($jalali){

    $jalali=explode("/",$jalali);
    $year= $jalali[0];
    $mount= $jalali[1];
    $day= $jalali[2];
    $g_date_string=jalali_to_gregorian($year,$mount,$day,'/'); //خروجی رشته
    return $g_date_string; 
}

function jalali_to_gregorian($jy,$jm,$jd,$mod=''){
   
    if($jy>979){
    $gy=1600;
    $jy-=979;
    }else{
    $gy=621;
    }
    $days=(365*$jy) +(((int)($jy/33))*8) +((int)((($jy%33)+3)/4)) +78 +$jd +(($jm<7)?($jm-1)*31:(($jm-7)*30)+186);
    $gy+=400*((int)($days/146097));
    $days%=146097;
    if($days > 36524){
    $gy+=100*((int)(--$days/36524));
    $days%=36524;
    if($days >= 365)$days++;
    }
    $gy+=4*((int)($days/1461));
    $days%=1461;
    if($days > 365){
    $gy+=(int)(($days-1)/365);
    $days=($days-1)%365;
    }
    $gd=$days+1;
    foreach(array(0,31,(($gy%4==0 and $gy%100!=0) or ($gy%400==0))?29:28 ,31,30,31,30,31,31,30,31,30,31) as $gm=>$v){
    if($gd<=$v)break;
    $gd-=$v;
    }
    return($mod=='')?array($gy,$gm,$gd):$gy.$mod.$gm.$mod.$gd; 
}


 //تبدیل میلادی  به شمسی
function gtj($gregorian){

    $gregorian=explode("-",$gregorian);
    $year= $gregorian[0];
    $mount= $gregorian[1];
    $day= $gregorian[2];
    $j_date_array=gregorian_to_jalali($year,$mount,$day,"/"); //خروجی آرایه
    return $j_date_array; 
}

function gregorian_to_jalali($gy,$gm,$gd,$mod=''){
    $g_d_m=array(0,31,59,90,120,151,181,212,243,273,304,334);
    if($gy>1600){
     $jy=979;
     $gy-=1600;
    }else{
     $jy=0;
     $gy-=621;
    }
    $gy2=($gm>2)?($gy+1):$gy;
    $days=(365*$gy) +((int)(($gy2+3)/4)) -((int)(($gy2+99)/100)) +((int)(($gy2+399)/400)) -80 +$gd +$g_d_m[$gm-1];
    $jy+=33*((int)($days/12053)); 
    $days%=12053;
    $jy+=4*((int)($days/1461));
    $days%=1461;
    if($days > 365){
     $jy+=(int)(($days-1)/365);
     $days=($days-1)%365;
    }
    $jm=($days < 186)?1+(int)($days/31):7+(int)(($days-186)/30);
    $jd=1+(($days < 186)?($days%31):(($days-186)%30));
    return($mod=='')?array($jy,$jm,$jd):$jy.$mod.$jm.$mod.$jd;
}

//تبدیل اعداد فارسی به اعداد انگلیسی
function EnglishNumber($persianNumber)
{

    for ($i=0; $i <= strlen($persianNumber); $i++)
    {
        $persianNumber = str_replace("۰", "0", $persianNumber);
        $persianNumber = str_replace("۱", "1", $persianNumber);
        $persianNumber = str_replace("۲", "2", $persianNumber);
        $persianNumber = str_replace("۳", "3", $persianNumber);
        $persianNumber = str_replace("۴", "4", $persianNumber);
        $persianNumber = str_replace("۵", "5", $persianNumber);
            $persianNumber = str_replace("۶", "6", $persianNumber);
        $persianNumber = str_replace("۷", "7", $persianNumber);
        $persianNumber = str_replace("۸", "8", $persianNumber);
        $persianNumber = str_replace("۹", "9", $persianNumber);
    }
    return $persianNumber;
}
 
   
//تبدیل اعداد انگلیسی به عداد فارسی
function PersianNumber($EnglishNumber)
{
    for ($j=0; $j <= strlen($EnglishNumber); $j++)
    {
        $EnglishNumber = str_replace("0", "۰", $EnglishNumber);
        $EnglishNumber = str_replace("1", "۱", $EnglishNumber);
        $EnglishNumber = str_replace("2", "۲", $EnglishNumber);
        $EnglishNumber = str_replace("3", "۳", $EnglishNumber);
        $EnglishNumber = str_replace("4", "۴", $EnglishNumber);
        $EnglishNumber = str_replace("5", "۵", $EnglishNumber);
            $EnglishNumber = str_replace("6", "۶", $EnglishNumber);
        $EnglishNumber = str_replace("7", "۷", $EnglishNumber);
        $EnglishNumber = str_replace("8", "۸", $EnglishNumber);
        $EnglishNumber = str_replace("9", "۹", $EnglishNumber);
    }
    return $EnglishNumber;
}
 

//آپلود تصویر
function Upload($field_name = '', $target_folder = '', $file_name = '', $thumb = FALSE, $thumb_folder = '', $thumb_width = '', $thumb_height = ''){
    $target_path = $target_folder;
    $thumb_path = $thumb_folder;
    $filename_err = explode(".",$_FILES[$field_name]['name']);
    $filename_err_count = count($filename_err);
    $file_ext = $filename_err[$filename_err_count-1];
    $r1 = chr(rand(ord('a'), ord('z')));
    $r2 = chr(rand(ord('a'), ord('z')));
    $r3 = chr(rand(ord('a'), ord('z')));
    $id=$r1.$r2.$r3;
    $fileName = $id.$_FILES[$field_name]['name'];
    $upload_image = $target_path.basename($fileName);
    if(move_uploaded_file($_FILES[$field_name]['tmp_name'],$upload_image)) {
        if($thumb == TRUE) {
            $thumbnail = $thumb_path.$fileName;
            list($width,$height) = getimagesize($upload_image);
            $thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
            switch($file_ext){
                case 'jpg':
                    $source = imagecreatefromjpeg($upload_image);
                    break;
                case 'jpeg':
                    $source = imagecreatefromjpeg($upload_image);
                    break;
                case 'png':
                    $source = imagecreatefrompng($upload_image);
                    break;
                case 'gif':
                    $source = imagecreatefromgif($upload_image);
                    break;
                default:
                    $source = imagecreatefromjpeg($upload_image);
            }
            imagecopyresized($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
            switch($file_ext){
                case 'jpg' || 'jpeg':
                    imagejpeg($thumb_create,$thumbnail,100);
                    break;
                case 'png':
                    imagepng($thumb_create,$thumbnail,100);
                    break;
                case 'gif':
                    imagegif($thumb_create,$thumbnail,100);
                    break;
                default:
                    imagejpeg($thumb_create,$thumbnail,100);
            }
        } return $fileName;
    } else { return false; }
}
    

//بررسی اینکه آیا فایل وجود دارد یا خیر
function isset_file($name) {
    return (isset($_FILES[$name]) && $_FILES[$name]['error'] != UPLOAD_ERR_NO_FILE);
}
   

   


