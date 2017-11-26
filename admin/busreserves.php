<?php
require_once('function.php');
connectdbuser();
session_start();

if (!is_user()) {
	redirect('index.php');
}

?>
   
  

<?php
 $user = $_SESSION['username'];
$usid = mysql_fetch_array(mysql_query("SELECT id FROM mst_user WHERE username='".$user."'"));
 $uid = $usid[0];
 include ('header.php');
 connectdb();
 ?>
    <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Thông Tin Vé</h1>
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
                                            <th>Xe Số</th>
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

$ddaa = mysql_query("SELECT id, route, time, date, seat FROM bus_info ORDER BY id");
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
											
											<a href=\"reserveview.php?bid=$data[0]\"><button type=\"button\" class=\"btn btn-success btn-xs\">THÔNG TIN GHẾ</button></a>
											<a href=\"shaon.php?bid=$data[0]&date=$data[3]&time=$data[2]\"><button type=\"button\" class=\"btn btn-success btn-xs\">IN PHƠI</button></a>
											
											</td>
                                        </tr>
	";
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
