<div id="header-topbar-option-demo" class="page-header-topbar">
    <nav id="topbar" role="navigation" style="margin-bottom: 0; z-index: 2;"
         class="navbar navbar-default navbar-static-top">
        <div class="navbar-header">
            <button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle"><span
                    class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span
                    class="icon-bar"></span><span class="icon-bar"></span></button>
            <a id="logo" href="dashboard" class="navbar-brand"><span class="fa fa-rocket"></span><span
                    class="logo-text"><?php echo _("Store Finder");?></span><span style="display: none" class="logo-text-icon"><?php _("Admin"); ?></span></a>
        </div>
        <div class="topbar-main">
            <a id="menu-toggle" href="#" class="hidden-xs"><i class="fa fa-bars"></i></a>
            <?php
            include'application/config.php';
            $rat=mysqli_query($con,"select * from tbl_storefinder_reviews WHERE notify=1");
            $rat1=mysqli_query($con,"select * from tbl_storefinder_reviews WHERE notify=1");
            $numratting=mysqli_num_rows($rat1);
            ?>
            <ul class="nav navbar navbar-top-links navbar-right mbn">
                <li class="dropdown"><a data-hover="dropdown" onclick="rattingnotify()" class="dropdown-toggle"><i
                            class="fa fa-star fa-fw"></i><span class="badge badge-green"><?php echo $numratting; ?></span></a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li><p><?php echo _("You have"); ?> <?php echo $numratting; ?> <?php echo _("New Ratting"); ?></p></li>
                        <li>
                            <div class="dropdown-slimscroll">
                                <ul>
                                    <?php
                                    while($ratting=mysqli_fetch_array($rat)) {
                                        $sname=mysqli_query($con,"select * from tbl_storefinder_stores WHERE store_id='".$ratting['store_id']."' ");
                                        $s=mysqli_fetch_array($sname);
                                        $storename=$s['store_name'];
                                        $uname=mysqli_query($con,"select * from tbl_storefinder_users WHERE user_id='".$ratting['user_id']."' ");
                                        $u=mysqli_fetch_array($uname);
                                        $username=$u['username'];
                                        ?>
                                        <li>
                                            <a href="review">
                                            <span class="label ">
                                                <?php
                                                if($ratting['ratting'] == 1){
                                                  ?>
                                                    <i class="fa fa-star" style="color: orangered;"></i>
                                                    <i class="fa fa-star" style="color: black;"></i>
                                                    <i class="fa fa-star" style="color: black;"></i>
                                                    <i class="fa fa-star" style="color: black;"></i>
                                                    <i class="fa fa-star" style="color: black;"></i>
                                                  <?php
                                                }
                                                elseif($ratting['ratting'] == 2){
                                                  ?>
                                                    <i class="fa fa-star" style="color: orangered;"></i>
                                                    <i class="fa fa-star" style="color: orangered;"></i>
                                                    <i class="fa fa-star" style="color: black;"></i>
                                                    <i class="fa fa-star" style="color: black;"></i>
                                                    <i class="fa fa-star" style="color: black;"></i>
                                                  <?php
                                                }
                                                elseif($ratting['ratting'] == 3){
                                                    ?>
                                                    <i class="fa fa-star" style="color: orangered;"></i>
                                                    <i class="fa fa-star" style="color: orangered;"></i>
                                                    <i class="fa fa-star" style="color: orangered;"></i>
                                                    <i class="fa fa-star" style="color: black;"></i>
                                                    <i class="fa fa-star" style="color: black;"></i>
                                                    <?php
                                                }
                                                elseif($ratting['ratting'] == 4){
                                                    ?>
                                                    <i class="fa fa-star" style="color: orangered;"></i>
                                                    <i class="fa fa-star" style="color: orangered;"></i>
                                                    <i class="fa fa-star" style="color: orangered;"></i>
                                                    <i class="fa fa-star" style="color: orangered;"></i>
                                                    <i class="fa fa-star" style="color: black;"></i>
                                                    <?php
                                                }
                                                else {
                                                    ?>
                                                    <i class="fa fa-star" style="color: orangered;"></i>
                                                    <i class="fa fa-star" style="color: orangered;"></i>
                                                    <i class="fa fa-star" style="color: orangered;"></i>
                                                    <i class="fa fa-star" style="color: orangered;"></i>
                                                    <i class="fa fa-star" style="color: orangered;"></i>
                                                    <?php
                                                }
                                                ?>
                                            </span>
                                                <font color="black"><?php echo $storename; ?></font>
                                                <span class="pull-right text-muted small" style="color: orangered;"><?php echo $username; ?></span>
                                            </a>
                                        </li>
                                        <?php
                                    }?>

                                </ul>
                            </div>
                        </li>
                        <li class="last"><a href="review" class="text-right"><?php _("See All Ratting"); ?></a></li>
                    </ul>
                </li>
                <?php
                $rev=mysqli_query($con,"select * from tbl_storefinder_reviews WHERE notify=1");
                $rev1=mysqli_query($con,"select * from tbl_storefinder_reviews WHERE notify=1");
                $reviewnum=mysqli_num_rows($rev1);
                ?>
                <li class="dropdown"><a data-hover="dropdown" href="#" onclick="reviewnotify()" class="dropdown-toggle"><i
                            class="fa fa-comments fa-fw"></i><span class="badge badge-green"><?php echo $reviewnum; ?></span></a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li><p><?php echo _("You Have"); ?><?php echo $reviewnum; ?> <?php echo _("New Review"); ?></p></li>
                        <li>
                            <div class="dropdown-slimscroll">
                                <ul>
                                    <?php
                                    while($showreview=mysqli_fetch_array($rev)) {
                                        $sname=mysqli_query($con,"select * from tbl_storefinder_stores WHERE store_id='".$showreview['store_id']."' ");
                                        $s=mysqli_fetch_array($sname);
                                        $storename=$s['store_name'];
                                        $uname=mysqli_query($con,"select * from tbl_storefinder_users WHERE user_id='".$showreview['user_id']."' ");
                                        $u=mysqli_fetch_array($uname);
                                        $username=$u['username'];
                                        $a= substr($username, 0, 1);
                                        $lat=strtoupper($a);
                                        ?>
                                        <li>
                                            <a href="review">
                                                <div style="width: 220px;">
                                                    <div style="
                                                height: 40px;
                                                width:40px ;
                                                background-color: orangered;
                                                border-radius:20px ;
                                                color: white;
                                                border: 2px solid orangered ;
                                                text-align: center;
                                                font-size: 22px;
                                                "><?php echo $lat; ?>
                                                    </div>
                                                    <div style="margin-left: 50px;margin-top: -45px;">
                                                        <span class="name" style="color: black;"><b><?php echo $username; ?></b></span><br>
                                                        <span class="tag"
                                                              style="color: black;font-size: 10px;">For: <font
                                                                color="#ff4500" size="1"> <?php echo $storename; ?></font></span><br>
                                                        <span class="desc"><?php echo $showreview['review']; ?></span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                    ?>

                                </ul>
                            </div>
                        </li>
                        <li class="last"><a href="review"><?php echo _("See All Review"); ?></a></li>
                    </ul>
                </li>
                <?php
                $user=mysqli_query($con,"select * from tbl_storefinder_users WHERE notify=1");
                $user1=mysqli_query($con,"select * from tbl_storefinder_users WHERE notify=1");
                $usernum=mysqli_num_rows($user1);
                ?>
                <li class="dropdown"><a  data-hover="dropdown" href="#" onclick="usernotify()" class="dropdown-toggle"><i
                            class="fa fa-users fa-fw"></i><span class="badge badge-orange"><?php echo $usernum; ?></span></a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li><p><?php echo _("You have"); ?> <?php echo $usernum; ?> <?php echo _("New Mobile Users"); ?></p></li>
                        <li>
                            <div class="dropdown-slimscroll">
                                <ul>
                                    <?php
                                    while($userlist=mysqli_fetch_array($user)){
                                    ?>
                                    <li>
                                        <a href="mobileusers">
                                            <span class="avatar">
                                                <?php
                                                if($userlist['facebook_id'] != ""){
                                                    if($userlist['photo_url'] == ""){
                                                        ?>
                                                        <img src="uploads/user.png" alt="" class="img-responsive img-circle"/>
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                        <img src="<?php echo $userlist['photo_url']; ?>" alt="" class="img-responsive img-circle"/>
                                                        <?php
                                                    }
                                                }
                                                elseif($userlist['google_id'] != ""){
                                                    if($userlist['photo_url'] == ""){
                                                        ?>
                                                        <img src="uploads/user.png" alt="" class="img-responsive img-circle"/>
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                        <img src="<?php echo $userlist['photo_url']; ?>" alt="" class="img-responsive img-circle"/>
                                                        <?php
                                                    }
                                                }
                                                else{
                                                    if($userlist['photo_url'] == ""){
                                                        ?>
                                                        <img src="uploads/user.png" alt="" class="img-responsive img-circle"/>
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                        <img src="uploads/mobileuser/full/<?php echo $userlist['photo_url']; ?>" alt="" class="img-responsive img-circle"/>
                                                        <?php
                                                    }
                                                }

                                                ?>

                                            </span>
                                            <span class="info">
                                                <span class="name"><?php echo $userlist['username']; ?></span>
                                                <span class="desc" style="font-size:10px; ">Email : <font color="#ff4500" size="1">
                                                        <?php
                                                        if($userlist['facebook_id'] != ""){
                                                            echo $userlist['facebook_id'];
                                                        }
                                                        elseif($userlist['google_id'] != ""){
                                                            echo $userlist['google_id'];
                                                        }
                                                        else{
                                                            echo $userlist['email'];
                                                        }
                                                        ?>
                                                    </font></span>
                                            </span>
                                        </a>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </li>
                        <li class="last">
                            <a href="mobileusers"><?php echo _("See all Users"); ?></a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown topbar-user">
                    <a data-hover="dropdown"  class="dropdown-toggle">
                        <img src="uploads/profile/<?php echo$_SESSION['image']; ?>" alt="" class="img-responsive img-circle"/>
                        &nbsp;<span class="hidden-xs"><?php echo $_SESSION['uname']; ?></span>
                        &nbsp;<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-user pull-right">

                      <li><a href="changepassword"><i class="fa fa-lock"></i>Change Password</a></li>
                        <li><a href="include/logout.php"><i class="fa fa-key"></i><?php echo _("Log Out"); ?></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>
<script>
    function rattingnotify()
    {
            var data = 1;
            $.ajax({
                type: "POST",
                url: 'ajax/notify.php',
                data: "rat=" + data,
                success: function(fooddata)
                {

                }
            });
    }
    function reviewnotify(){
        var data = 1;
        $.ajax({
            type: "POST",
            url: 'ajax/notify.php',
            data: "rev=" + data,
            success: function(fooddata)
            {
            }
        });
    }
    function usernotify(){
        var data = 1;
        $.ajax({
            type: "POST",
            url: 'ajax/notify.php',
            data: "user=" + data,
            success: function(fooddata)
            {
            }
        });
    }
</script>