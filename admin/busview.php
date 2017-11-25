<?php
require_once('function.php');
connectdb();
session_start();

if (!is_user()) {
	redirect('index.php');
}

?>
   
  

<?php
 $user = $_SESSION['username'];
$usid = mysql_fetch_array(mysql_query("SELECT id FROM users WHERE username='".$user."'"));
 $uid = $usid[0];
 include ('header.php');



$bid = $_GET["bid"];
$act = $_GET["act"];
mysql_query("UPDATE bus_info SET stat='".$act."' WHERE id='".$bid."'");



 ?>
    <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Xem/Sửa THÔNG TIN XE</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			
			
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">

                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Số Xe</th>
                                            <th>Tuyến</th>
                                            <th>Ngày</th>
                                            <th>Giờ</th>
                                            <th>Tổng Ghế</th>
                                            <th>Ghế Đã Bán</th>
                                            <th>Ghế Còn Trống</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                     <tbody>
<?php

$ddaa = mysql_query("SELECT id, route, time, date, seat, stat FROM bus_info WHERE exp='1' ORDER BY id");
    echo mysql_error();
    while ($data = mysql_fetch_array($ddaa))
    {
$sold = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM seat_details WHERE busid='".$data[0]."' AND status='1'"));
$available = $data[4]-$sold[0];
$rname = mysql_fetch_array(mysql_query("SELECT routename FROM bus_route WHERE id='".$data[1]."'"));
		
 echo "                                 <tr>
                                            <td>$data[0]</td>
                                            <td>$rname[0]</td>
                                            <td>$data[3]</td>
                                            <td>$data[2]</td>
                                            <td>$data[4]</td>
                                            <td>$sold[0]</td>
                                            <td>$available</td>
                                   
                                            
											<td>
<a href=\"busedit.php?bid=$data[0]\"><button type=\"button\" class=\"btn btn-warning btn-xs\">THAY ĐỔI</button></a>
<a href=\"seatview.php?bid=$data[0]\"><button type=\"button\" class=\"btn btn-info btn-xs\">GHẾ</button></a>
";

if($data[5]==1){
echo "<a href=\"busview.php?bid=$data[0]&amp;act=0\"><button type=\"button\" class=\"btn btn-danger btn-xs\">TURN OFF</button></a>";
}else{
echo "<a href=\"busview.php?bid=$data[0]&amp;act=1\"><button type=\"button\" class=\"btn btn-success btn-xs\">TURN ON</button></a>";
}
echo "</td></tr>";

}
?>
										
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            

        </div>
        <!-- /#page-wrapper -->

   <?php
 include ('footer.php');
 ?>
