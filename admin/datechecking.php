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
        
        <div>
            <div class="row">
                <form class="bookingFrm col-lg-12 col-md-6" target="_blank" action="booking.php" method="POST">
                    <h1 class="page-header">Chọn Ngày Đặt Vé</h1>
                    <div id="datepicker-multiple"></div>

                    <div class="row" id="id1">
                        <div class="col-md-4">
                            <h3>Tuyến:</h3>
                            <select class="form-control" id="schedule" name="schedule" style="width:200px></select>
                            <input type="text" id="route" name="route" hidden="">
                        </div>
                    </div>

                    <br><br>
                    <input type="text" hidden="" id="selectedDate" name="selectedDate"><br><br>
                    <input type="button" value="TIẾP TỤC" class="btn btn-lg btn-success btn-block" style="width:200px">
                </form>
            </div>
        </div>

            <!-- /.row -->
    </div>

<?php
 include ('footer.php');
 ?>