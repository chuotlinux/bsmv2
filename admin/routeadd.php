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
 ?>


    

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Thêm Mới LỊCH TRÌNH XE</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                
                <div class="col-md-10 col-md-offset-1">
				
				
	

		<?php

if($_POST)
{

$rname = $_POST["rname"];

///////////////////////-------------------->> catname ki faka??

 if(trim($rname)=="")
      {
$err1=1;
}


$error = $err1;


if ($error == 0){

$res = mysql_query("INSERT INTO bus_route SET routename='".$rname."'");
if($res){
	echo "<div class=\"alert alert-success alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	

Thêm mới lịch trình xe thành công!

</div>";

}else{
	echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	

Có lỗi xảy ra. Vui lòng thử lại.

</div>";
}
} else {
	
	
if ($err1 == 1){
echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	

Tên lịch trình không thể để trống!!!

</div>";
echo"<h1></h1>";
}	

	
}



} 
	?>
							
				
				
				
				
				
				
				
				
				
				    <form action="routeadd.php" method="post">
		
                    <div class="form-group">
					
					<label>Tên Lịch Trình</label><input class="form-control" placeholder="Tên Lịch Trình" name="rname" type="text"><br/>
				    
					</div>
					<input type="submit" class="btn btn-lg btn-success btn-block" value="THÊM MỚI">
			    	</form>
                </div>
						
						
						
						
						
				
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->


<?php
 include ('footer.php');
 ?>