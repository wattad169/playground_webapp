<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head><title>Store Finder Admin | Login</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="Thu, 19 Nov 1900 08:52:00 GMT">
    <link rel="shortcut icon" href="uploads/storelogo.png">
    <!--Loading bootstrap css-->
    <link type="text/css"
          href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,800italic,400,700,800">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <link type="text/css" rel="stylesheet" href="vendors/jquery-ui-1.10.3.custom/css/ui-lightness/jquery-ui-1.10.3.custom.html">
    <link type="text/css" rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="vendors/bootstrap/css/bootstrap.min.css">
    <!--Loading style vendors-->
    <link type="text/css" rel="stylesheet" href="vendors/animate.css/animate.css">
    <link type="text/css" rel="stylesheet" href="vendors/iCheck/skins/all.css">
    <!--Loading style-->
    <link type="text/css" rel="stylesheet" href="css/themes/style1/pink-blue.css" class="default-style">
    <link type="text/css" rel="stylesheet" href="css/themes/style1/pink-blue.css" id="theme-change"
          class="style-change color-change">
    <link type="text/css" rel="stylesheet" href="css/style-responsive.css">
    <link rel="shortcut icon" href="images/favicon.html">
</head>
<body id="signin-page" style="height: 500px;">
<div class="page-form">
    <form  method="post" class="form-validate-signin">
        <div class="header-content"><h1>Store Finder Admin</h1></div>
        <div class="body-content">
            <!--
            <p>Log in with a Store Admin</p>
            -->
            <!--<div class="row mbm text-center">
                <div class="col-md-4"><a href="#" class="btn btn-sm btn-twitter btn-block"><i
                            class="fa fa-twitter fa-fw"></i>Twitter</a></div>
                <div class="col-md-4"><a href="#" class="btn btn-sm btn-facebook btn-block"><i
                            class="fa fa-facebook fa-fw"></i>Facebook</a></div>
                <div class="col-md-4"><a href="#" class="btn btn-sm btn-google-plus btn-block"><i
                            class="fa fa-google-plus fa-fw"></i>Google +</a></div>
            </div>-->
            <div id="msg" style="color: green;"></div>
            <div id="error" style="color: red;"></div>
            <div class="form-group">
                <div class="input-icon right"><i class="fa fa-user"></i>
                    <input type="text" placeholder="Username" name="username" class="form-control required email">
                </div>
            </div>
            <div class="form-group">
                <div class="input-icon right"><i class="fa fa-key"></i>
                    <input type="password" placeholder="Password" name="password" class="form-control required password" >
                </div>
            </div>
            <div class="form-group pull-right">
                <button type="submit" name="login" class="btn btn-success">Log In
                    &nbsp;<i class="fa fa-chevron-circle-right"></i></button>
            </div>
            <div class="clearfix"></div>
    </form>
    <?php if(isset($_POST['login'])){
            $uname=$_POST['username'];
            $pass=$_POST['password'];
            $query=mysqli_query($con,"select * from tbl_storefinder_authentication WHERE is_deleted=0 && username='$uname' && password='$pass'");
            $auth=mysqli_fetch_array($query);
            if($auth){
                if($auth['deny_access'] == 0) {
                    $_SESSION['uname'] = $auth['username'];
                    $_SESSION['image'] = $auth['image'];
                    $_SESSION['admin_id']=$auth['authentication_id'];
                    $_SESSION['demo']=$auth['admin_right'];
                    ?>
                    <script>
                        document.getElementById("msg").innerHTML = "! Login Successfully !!! ";
                        window.location = 'dashboard';
                    </script><?php
                }
                else{
                    ?><script>
                        document.getElementById("error").innerHTML="! Access denied !!! ";
                    </script><?php
                }
            }
            else{
                ?><script>
                    document.getElementById("error").innerHTML="! Invalid Username And Passwords !!! ";
                </script><?php
            }

        }
    ?>
</div>
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js"></script>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<script src="vendors/iCheck/icheck.min.js"></script>
<script src="vendors/iCheck/custom.min.js"></script>
<script src="vendors/jquery-validate/jquery.validate.min.js"></script>
<script src="js/form-validation.js"></script>
<script>
    $('input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_minimal-grey',
        increaseArea: '20%'
    });
    $('input[type="radio"]').iCheck({
        radioClass: 'iradio_minimal-grey',
        increaseArea: '20%'
    });
</script>
</body>
</html>



