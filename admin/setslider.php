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
 connectdb();
$bus = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM bus_info")); 



$tickets = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM seat_details")); 
$sold = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM seat_details WHERE status='1'")); 
$pend = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM seat_details WHERE status='2'")); 
 
 
 
 include ('header.php');
 ?>



    <div class="pageheader">
      <h2><i class="fa fa-cog"></i> Quản Lý Hình Ảnh Quảng Cáo</h2>
    </div>

    
    <div class="contentpanel">
      <div class="panel panel-default">

        <div class="panel-body">
		
		   
<?php

if($_POST)
{

$title = $_POST["title"];
$btext = $_POST["btext"];



// IMAGE UPLOAD //////////////////////////////////////////////////////////
	$folder = "../img/slider/";
	$extention = strrchr($_FILES['bgimg']['name'], ".");
	$new_name = time();
	$bgimg = $new_name.'.jpg';
	$uploaddir = $folder . $bgimg;
	move_uploaded_file($_FILES['bgimg']['tmp_name'], $uploaddir);
//////////////////////////////////////////////////////////////////////////


$res = mysql_query("INSERT INTO sliders SET img='".$bgimg."'");

if($res){
	echo "<div class=\"alert alert-success alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	

Thêm hình thành công!!!

</div>";
}else{
	echo "<div class=\"alert alert-danger alert-dismissable\">
<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>	

Có lỗi xảy ra. Vui lòng thử lại 

</div>";
}
}

?>	
		
		
		
				
		<form name="" id="" action="" method="post" enctype="multipart/form-data" >
	            <div class="form-group">
              <label class="col-sm-3 control-label"></label>
              <div class="col-sm-6"><input name="title" value="" class="form-control" type="hidden" placeholder="http://"></div>
            </div>
			
              <div class="form-group">
              <label class="col-sm-3 control-label">Hình ảnh</label>
              <div class="col-sm-6"><input name="bgimg" type="file" id="bgimg" /></div>
            </div>
			  
		
		  
				<div class="col-sm-6 col-sm-offset-3"><br/>
				  <button class="btn btn-primary btn-block">TẢI LÊN</button><br/><br/>
				</div>
			
			 
			 
          </form>
		  
		  
		  <div class="clearfix"></div>
		  
			
		  
		  
		  				<?php

$ddaa = mysql_query("SELECT id, img FROM sliders ORDER BY id");
    echo mysql_error();
    while ($data = mysql_fetch_array($ddaa))
    {									
 echo "
 
              <label class=\"col-sm-3 control-label\"></label>
 <div class=\"col-sm-8\">
 <img src=\"../img/slider/$data[1]\" alt=\"IMG\"  height=\"100\" width=\"400\">
 <a class=\"btn btn-danger btn-lg\" href=\"delslider.php?id=$data[0]\">XOÁ</a><br/><br/><br/>
 </div>
 	";
	}
?>
				
	 </div>
	
	
		  
                  
      

      
    </div><!-- contentpanel -->
    
  </div><!-- mainpanel -->

  
</section>


<?php
 include ('include/footer.php');
 ?>


<script src="js/bootstrap-timepicker.min.js"></script>


<script src="js/wysihtml5-0.3.0.min.js"></script>
<script src="js/bootstrap-wysihtml5.js"></script>
<script src="js/ckeditor/ckeditor.js"></script>
<script src="js/ckeditor/adapters/jquery.js"></script>



<script>
jQuery(document).ready(function(){
    
    "use strict";
    
  // HTML5 WYSIWYG Editor
  jQuery('#wysiwyg').wysihtml5({color: true,html:true});
  
  // CKEditor
  jQuery('#ckeditor').ckeditor();
  
  jQuery('#inlineedit1, #inlineedit2').ckeditor();
  
  // Uncomment the following code to test the "Timeout Loading Method".
  // CKEDITOR.loadFullCoreTimeout = 5;

  window.onload = function() {
  // Listen to the double click event.
  if ( window.addEventListener )
	document.body.addEventListener( 'dblclick', onDoubleClick, false );
  else if ( window.attachEvent )
	document.body.attachEvent( 'ondblclick', onDoubleClick );
  };

  function onDoubleClick( ev ) {
	// Get the element which fired the event. This is not necessarily the
	// element to which the event has been attached.
	var element = ev.target || ev.srcElement;

	// Find out the div that holds this element.
	var name;

	do {
		element = element.parentNode;
	}
	while ( element && ( name = element.nodeName.toLowerCase() ) &&
		( name != 'div' || element.className.indexOf( 'editable' ) == -1 ) && name != 'body' );

	if ( name == 'div' && element.className.indexOf( 'editable' ) != -1 )
		replaceDiv( element );
	}

	var editor;

	function replaceDiv( div ) {
		if ( editor )
			editor.destroy();
		editor = CKEDITOR.replace( div );
	}

	 jQuery('#timepicker').timepicker({defaultTIme: false});
  jQuery('#timepicker2').timepicker({showMeridian: false});
  jQuery('#timepicker3').timepicker({minuteStep: 15});

	
	
});



</script>
</body>
</html>



