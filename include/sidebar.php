<div id="wrapper">
    <nav id="sidebar" role="navigation" class="navbar-default navbar-static-side">
        <div class="sidebar-collapse menu-scroll">
            <ul id="side-menu" class="nav">
                <li class="user-panel">
                    <div class="thumb">
                        <img src="uploads/profile/<?php echo$_SESSION['image']; ?>" alt="" class="img-circle"/>
                    </div>
                    <div class="info">
                        <p style="font-size: 10px;font-family: 'Adobe Gothic Std B'"><?php echo $_SESSION['uname']; ?></p>
                       <ul class="list-inline list-unstyled">

                            <li><a href="include/logout.php" data-hover="tooltip" title="Logout"><i
                                        class="fa fa-sign-out"></i></a></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </li>
                <li>
                    <a href="dashboard"><i class="fa fa-home fa-fw">
                            <div class="icon-bg bg-orange"></div>
                        </i><span class="menu-title"><?php echo _("Home"); ?></span><span class="fa arrow"></span></a>
                </li>
                <li><a href="category"><i class="fa fa-list fa-fw">
                        <div class="icon-bg bg-orange"></div>
                        </i><span class="menu-title"><?php echo _("Category"); ?></span><span class="fa arrow"></span>
                 </a>
                </li>
                <li>
                    <a href="stores"><i class="fa fa-empire fa-fw">
                            <div class="icon-bg bg-pink"></div>
                        </i><span class="menu-title"><?php echo _("Stores"); ?></span><span class="fa arrow"></span>
                    </a>
                </li>
                <li>
                    <a href="news"><i class="fa fa-hacker-news fa-fw">
                            <div class="icon-bg bg-pink"></div>
                        </i><span class="menu-title"><?php echo _("News"); ?></span><span class="fa arrow"></span>
                    </a>
                </li>
                <li>
                    <a href="review"><i class="fa fa-comment fa-fw">
                            <div class="icon-bg bg-green"></div>
                        </i><span class="menu-title"><?php echo _("Users Rate & Reviews"); ?></span><span class="fa arrow"></span>
                    </a>
                </li>
               <!-- <li>
                    <a href="user_ratting"><i class="fa fa-star fa-fw">
                            <div class="icon-bg bg-green"></div>
                        </i><span class="menu-title"> <?php /*echo _("Users Ratting"); */?></span><span class="fa arrow"></span>
                    </a>

                </li>-->
                <li>
                    <a href="adminaccess"><i class="fa fa-adn fa-fw">
                            <div class="icon-bg bg-green"></div>
                        </i><span class="menu-title"><?php echo _("Admin Access"); ?></span><span class="fa arrow"></span>
                    </a>

                </li>
                <li>
                    <a href="mobileusers"><i class="fa fa-users fa-fw">
                            <div class="icon-bg bg-green"></div>
                        </i><span class="menu-title"><?php echo _("Users"); ?></span><span class="fa arrow"></span>
                    </a>

                </li>
                <li>
                    <a href="admin_theme"><i class="fa fa-undo fa-fw">
                            <div class="icon-bg bg-green"></div>
                        </i><span class="menu-title"><?php echo _("Admin Theme"); ?></span><span class="fa arrow"></span>
                    </a>

                </li>
                <li>
                    <a href="webservice"><i class="fa fa-scissors fa-fw">
                            <div class="icon-bg bg-green"></div>
                        </i><span class="menu-title"><?php echo _("Web Service"); ?></span><span class="fa arrow"></span>
                    </a>

                </li>
                <li>
                    <a href="setlanguage"><i class="fa fa-language fa-fw">
                            <div class="icon-bg bg-green"></div>
                        </i><span class="menu-title"><?php echo _("Set Language"); ?></span><span class="fa arrow"></span>
                    </a>

                </li>
        </div>
    </nav>