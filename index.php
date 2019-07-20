<?php session_start();
 include("application/config.php");
 $query=mysqli_query($con,"select AppName,LogoUrl from tbl_setting");
 $resulte=mysqli_fetch_array($query);
  ?>
<!DOCTYPE html>
<html >
<head>


    <meta charset="UTF-8">
    <title><?php echo $resulte[0] ?></title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="The Grant Restaurant Admin Panel used for add food category ,update ,delete and add offers ,add menu setting up all restaurant mobile app">
    <meta name="author" content="">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel="icon" href="<?php echo "uploads/".$resulte[1]; ?>" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="css/style.css">
    
</head>
<body>
<div class="form-box">
    <div class="head">سامانه ثبت سفارش غذا</div>
    <form  id="login-form" method="post">
        <div id="error" style="color: red;"></div>
        <div class="form-group">
            <label class="label-control">
                <span class="label-text">نام کاربری</span>
            </label>
            <input type="text" name="uname" class="form-control" minlength="5" maxlength="40" value="<?php if(isset($_COOKIE["username"])) { echo $_COOKIE["username"]; } ?>"
            required="" oninvalid="this.setCustomValidity('لطفا نام کاربری را بین 5 تا 40 کارکتر وارد نمایید.')" oninput="setCustomValidity('')" />
        </div>
        <div class="form-group">
            <label class="label-control">
                <span class="label-text">رمز عبور</span>
            </label>
            <input type="password" name="pass" class="form-control" minlength="5" maxlength="40" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>"
            required="" oninvalid="this.setCustomValidity('لطفا رمز عبور را بین 5 تا 40 کارکتر وارد نمایید.')" oninput="setCustomValidity('')" />
        </div>
       
        <div class="checkbox" id="remember">
            <label><input type="checkbox" name="remember" value="">مرا به خاطر بسپار</label>
        </div>

        <input type="submit" value="ورود" name="Login" class="btn" />
    </form>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript">
    $(window).load(function(){
        $('.form-group input').on('focus blur', function (e) {
            $(this).parents('.form-group').toggleClass('active', (e.type === 'focus' || this.value.length > 0));
        }).trigger('blur');
    });
</script>

    <?php
   
    if(isset($_POST['Login'])){
        $uname=$_POST['uname'];
        $pass= md5($_POST['pass']);
        if(isset($uname) && isset($pass)){
            $query=mysqli_query($con,"select * from tbl_users WHERE username='$uname' && pass='$pass' ");
            $res=mysqli_fetch_array($query);
            if($res)
            {
                if(isset($_POST['remember']))
                {
                    $hour = time() + 3600 * 24 * 30;
                    setcookie('username', $uname, $hour);
                    setcookie('password', $pass, $hour);
                }

                $_SESSION['user_id']=$res['id'];
                ?>
                <script> window.location='dashboard.php'; </script>
                <?php
            }
            else
            {
              
                ?>
                <div id="incorent">
                    <strong >.نام کاربری و یا رمز عبور اشتباه می باشد</strong>
                <div>
                <?php
            }
        }
    }
    ?>
</div>


</body>
</html>