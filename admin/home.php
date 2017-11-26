<?php
    require_once('function.php');
    connectdbuser();
    session_start();
    if (!is_user()) {
        redirect('index.php');
    }
    $user = $_SESSION['username'];
    $usid = mysql_fetch_array(mysql_query("SELECT id FROM mst_user WHERE username='" . $user . "'"));
    $uid = $usid[0];
    connectdb();
    $bus = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM bus_info"));
    $tickets = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM seat_details"));
    $sold = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM seat_details WHERE status='1'"));
    $pend = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM seat_details WHERE status='2'"));

    include ('header.php');
?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Bảng Điều Khiển</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-car fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $bus[0] ?></div>
                                <div>Tổng Số Xe!</div>
                            </div>
                        </div>
                    </div>
                    <a href="busview.php">
                        <div class="panel-footer">
                            <span class="pull-left">Xem Chi Tiết</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-ticket fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $tickets[0] ?></div>
                                <div>Tổng Số Ghế!</div>
                            </div>
                        </div>
                    </div>
                    <a href="busreserves.php">
                        <div class="panel-footer">
                            <span class="pull-left">Xem Chi Tiết</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-shopping-cart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $sold[0] ?></div>
                                <div>Tổng Ghế Đã Bán!</div>
                            </div>
                        </div>
                    </div>
                    <a href="busreserves.php">
                        <div class="panel-footer">
                            <span class="pull-left">Xem Chi Tiết</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-ticket fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $pend[0] ?></div>
                                <div>Vé Đang Treo!</div>
                            </div>
                        </div>
                    </div>
                    <a href="authorize.php">
                        <div class="panel-footer">
                            <span class="pull-left">Xem Chi Tiết</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <form class="bookingFrm" target="_blank" action="booking.php" method="POST">
                    <h2>CHỌN NGÀY ĐẶT VÉ</h2>
                    <div id="datepicker-multiple"></div>

                    <h3>Ngày đặt vé</h3>
                    <h3 class="selected-date"></h3>

                    <div class="row" id="id1">
                        <div class="col-md-4">
                            <h4>Tuyến:</h4>
                            <select class="form-control" id="schedule" name="schedule"></select>
                            <input type="text" id="route" name="route" hidden="">
                        </div>
                    </div>

                    <br><br>
                    <input type="text" hidden="" id="selectedDate" name="selectedDate">
                    <input type="button" value="Tiếp tục" class="btn btn-primary">
                </form>
            </div>
        </div>

            <!-- /.row -->
    </div>

<?php
 include ('footer.php');
 ?>