<?php
include ('busaddition.php');

if ($user != "admin") {
    redirect('signout.php');
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="images/favicon.png" type="image/png">

        <title>HỆ THỐNG QUẢN LÝ VÉ</title>

        <link href="css/style.default.css" rel="stylesheet"> 


        <link rel="stylesheet" href="css/bootstrap-timepicker.min.css" />
        <link rel="stylesheet" href="css/jquery.tagsinput.css" />
        <link rel="stylesheet" href="css/colorpicker.css" />
        <link rel="stylesheet" href="css/dropzone.css" />
        
<!--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/blitzer/jquery-ui.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/blitzer/theme.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>



        <!-- Preloader -->
        <div id="preloader">
            <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
        </div>

        <section>

            <div class="leftpanel">

                <div class="logopanel">
                    <h1><span>[</span>BUS TICKET<span>]</span></h1>
                </div><!-- logopanel -->

                <div class="leftpanelinner">

                    <!-- This is only visible to small devices -->
                    <div class="visible-xs hidden-sm hidden-md hidden-lg">

                        <h5 class="sidebartitle actitle">Account</h5>
                        <ul class="nav nav-pills nav-stacked nav-bracket mb30">
                            <li><a href="changepass.php"><i class="fa fa-cog"></i> <span>Account Settings</span></a></li>
                            <li><a href="signout.php"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
                        </ul>
                    </div>

                    <h5 class="sidebartitle">Điều Hướng</h5>
                    <ul class="nav nav-pills nav-stacked nav-bracket">




                        <li><a href="home.php"><i class="fa fa-home"></i> <span>Bảng Điều Khiển</span></a></li>
						<li><a href="datechecking.php"><i class="fa fa-ticket fa-fw"></i>Đặt Vé</span></a></li>

                        <li class=""><a href="#"><i class="fa fa-table fa-fw"></i><span>Quản Lý Tuyến Xe</span></a>

                            <ul style="display: inline;" class="children">
                                <li><a href="routeadd.php"><i class="fa fa-caret-right"></i>Thêm Tuyến Xe</a></li>
                                <li><a href="routeview.php"><i class="fa fa-caret-right"></i>Sửa Tuyến Xe</a></li>

                            </ul>
                        </li>

                        <li class=""><a href="#"><i class="fa fa-bar-chart-o fa-fw"></i><span>Quản Lý Lịch Trình Xe</span></a>

                            <ul style="display: inline;" class="children">

                                <li><a href="busadd.php"><i class="fa fa-caret-right"></i>Thêm Lịch Trình Xe</a></li>
                                <li><a href="busview.php"><i class="fa fa-caret-right"></i>Sửa Lịch Trình Xe</a></li>
                                <li><a href="bussch.php"><i class="fa fa-caret-right"></i>Xoá Lịch Trình Xe</a></li>
                            </ul>
                        </li>

                        <li><a href="busreserves.php"><i class="fa fa-edit fa-fw"></i>Thông Tin Vé Xe</a></li>


                        <li><a href="authorize.php"><i class="fa fa-ticket fa-fw"></i>Vé Đang Treo</span></a></li>
						
                        <!--
                        
                                        <li> <button class="btn btn-block btn-info">Website Management</button> </li>		
                                          
                        
                        
                        
                                        <li class="nav-parent"><a href="#"><i class="fa fa-cog"></i> <span>Thiết Lập</span></a>
                                  <ul class="children">
                                    <li><a href="setgeneral.php"><i class="fa fa-caret-right"></i> Thiết Lập Tổng Quát</a></li>
                                    <li><a href="setlogo.php"><i class="fa fa-caret-right"></i> Logo</a></li>
                                    <li><a href="setslider.php"><i class="fa fa-caret-right"></i> Hình Quảng Cáo</a></li>
                        
                                  </ul>
                                </li>
                                        
                            
                                <li class="nav-parent"><a href="#"><i class="fa fa-th-list"></i> <span>MENU Manager</span></a>
                                  <ul class="children">
                                    <li><a href="menuadd.php"><i class="fa fa-caret-right"></i>Add MENU</a></li>
                                    <li><a href="menuview.php"><i class="fa fa-caret-right"></i>View/Edit MENU</a></li>
                                  </ul>
                                </li>
                        
                        -->


                    </ul>



                </div><!-- leftpanelinner -->
            </div><!-- leftpanel -->

            <div class="mainpanel">

                <div class="headerbar">

                    <a class="menutoggle"><i class="fa fa-bars"></i></a>


                    <div class="header-right">
                        <ul class="headermenu">
                            <li>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">

                                        <?php
                                        echo "<img src=\"profile-photo/$uid.jpg\" alt=\"\" />";
                                        echo " $user";
                                        ?>
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                                        <li><a href="changepass.php"><i class="fa fa-cog"></i> <span>Thiết Lập Tài Khoản</span></a></li>
                                        <li><a href="signout.php"><i class="fa fa-sign-out"></i> <span>Đăng Xuất</span></a></li>
                                    </ul>
                                </div>
                            </li>

                        </ul>
                    </div><!-- header-right -->

                </div><!-- headerbar -->


                <div class="contentpanel">
