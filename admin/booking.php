<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php session_start(); ?>
<html>
    <head>
        <title>WEBSITE ĐẶT VÉ XE</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/booking.css">
    </head>
    <body>
        <script type="text/javascript">
            function numbericOnly(text) {
                if (text.match(/^\d+$/)) {
                    // your code here
                }
            }
            
            function isBooked (id) {
                $('#' + id).removeClass("available").addClass("unavailable");
            }
            
            function guestInfo (seatID, sdt) {
                $('#' + seatID + ' .down').empty();
                $('#' + seatID + ' .down').append(sdt);
            }
            
            function update() {
                $.ajax({
                    type: "POST",
                    url: "./controller/bookingCRUD.php",
                    data: {
                        method: "checking",
                        schedule: $("#schedule").val()
                    },
                    success: function(result) {
//                        console.log(result);
                        var resultObj = JSON.parse(result);
//                        console.log(resultObj);
                        for (i = 0; i < resultObj.length; i++) {
                            isBooked(resultObj[i]["seat"]);
                            guestInfo(resultObj[i]["seat"], resultObj[i]["mobile"]);
                        }
                    }
//                    window.setTimeout(update, 5000);
                });
            }

            $(document).ready(function () {
                window.setInterval(function(){
                    update();
                }, 5000);
                
                $("#sdt").keydown(function (e) {
                    // Allow: backspace, delete, tab, escape, enter and .
                    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                         // Allow: Ctrl/cmd+A
                        (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                         // Allow: Ctrl/cmd+C
                        (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
                         // Allow: Ctrl/cmd+X
                        (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
                         // Allow: home, end, left, right
                        (e.keyCode >= 35 && e.keyCode <= 39)) {
                             // let it happen, don't do anything
                             return;
                    }
                    // Ensure that it is a number and stop the keypress
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                        e.preventDefault();
                    }
                });
                
                $(".available").click(function () {
                    if ($(this).attr('class') == "available") {
                        $(this).removeClass("available").addClass("selected");
                    } else {
                        if ($(this).attr('class') == "selected") {
                            $(this).removeClass("selected").addClass("available");
                        }
                    }
                });
                
                $(".unavailable").click(function () {
                    var selectedSeat = $(this).attr("id");
                    var sdt = $("#" + selectedSeat + " .down").text();
                    $.ajax({
                        type: "POST",
                        url: "./controller/bookingCRUD.php",
                        data: {
                            method: "update",
                            schedule: $("#schedule").val(),
                            seat: selectedSeat,
                            sdt: sdt
                        },
                        success: function(result) {
                            console.log(result);
                            var resultObj = JSON.parse(result);
                            $("#name").val(resultObj[1]);
                            $("#sdt").val(resultObj[2]);
//                            $("#schedule").html(result);
                        }
                    });
                });
            });
        </script>
        
        <?php
            include (__DIR__.'./controller/bookingController.php');
            require_once(__DIR__.'/connect/DBConnect.php');    
            require_once(__DIR__.'/controller/getBusType.php');
            
            if (isset($_POST['selectedDate']) && isset($_POST['route']) && isset($_POST['schedule'])) {
                $_SESSION['selectedDate'] = $_POST['selectedDate'];
                $_SESSION['route'] = $_POST['route'];
                $_SESSION['schedule'] = $_POST['schedule'];
            }
            
            // put your code here
            echo '<h3>Ngày đặt vé: ' .$_SESSION['selectedDate']. '</h3>';
            echo '<h3>Tuyến: ' .$_SESSION['route']. ' (Mã: ' .$_SESSION['schedule']. ')</h3>';              

            $selectedDate = DateTime::createFromFormat('d/m/Y', $_SESSION['selectedDate']);
            $selectedDate = $selectedDate->format('Y-m-d');
//            $sql = "SELECT * FROM schedule WHERE StartDate = '" .$selectedDate. "' AND Id ='" .$_POST['schedule']. "'";
            $sql = "SELECT s.Id, s.RouteId, s.BusId, r.StartPoint, r.EndPoint, t.Capacity
                    FROM mst_schedule AS s
                    INNER JOIN mst_route as r
                    ON StartDate='$selectedDate' AND s.Id='" .$_SESSION['schedule']. "' AND s.RouteId = r.Id
                    INNER JOIN mst_bus as b
                    ON s.BusId = b.Id
                    INNER JOIN mst_bustype as t
                    ON b.BusTypeId = t.Id";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) == 1) {
                while($row = mysqli_fetch_assoc($result)) {
                    $down = DownFloor($row['Capacity']);
                    $up = UpFloor($row['Capacity']);
                    $sup = Sup($row['Capacity']);
                }
            }
            
            if (isset($_POST['selectedSeat']) && $_POST['selectedSeat'] != "" && isset($_POST['sdt'])) {
                $allBooked = explode(",", $_POST['selectedSeat']);
                if (isset($_POST['name'])) {
                    updateBooking($_SESSION['schedule'], $allBooked, $_POST['name'], $_POST['sdt']);
                } else {
                    updateBooking($_SESSION['schedule'], $allBooked, '', $_POST['sdt']);
                }
            } else {
                if (isset($_POST['sdt'])) {
                    if (isset($_POST['name'])) {
                        updateInfo($_POST['name'], $_POST['sdt']);
                    } else {
                        updateInfo('', $_POST['sdt']);
                    }
                }
            }
        ?>
        
        <form class="seatBooking" action="booking.php" method="POST">
            <div class="floor-down">
                <h4>Tài xế</h4>
                <h4>Cửa xe</h4>
                <h5>Tầng dưới</h5>
                <?php
                    echo $down;
                ?>
            </div>
            
            <div class="sup">
                <h5>Ghế sup</h5>
                <?php
                    echo $sup;
                ?>
            </div>

            <div class="floor-up">
                <h4>Tài xế</h4>
                <h4>Cửa xe</h4>
                <h5>Tầng trên</h5>
                <?php
                    echo $up;
                ?>
            </div>
            
            <!--<select name="selectedSeat[]" multiple="" hidden="" class="selectedSeat"></select>-->
            <div class="col-xs-4 guestInfo">
                <label>Số điện thoại </label><label style="color: red">(*)</label>
                <input class="form-control" id="sdt" name="sdt" type="text" required=""><br>
                
                <label>Họ và tên</label>
                <input class="form-control" id="name" name="name" type="text"><br>

                <label>Điểm đón</label>
                <input class="form-control" id="startPoint" name="startPoint" type="text"><br>

                <label>Đại lý</label>
                <input class="form-control" id="daily" name="daily" type="text"><br>

                <label>Hàng hóa</label>
                <input class="form-control" id="hanghoa" name="hanghoa" type="text"><br>

                <label>Thanh toán: </label>
                <input id="thanhtoan" name="thanhtoan" type="checkbox"><br>
                
                <input type="text" class="selectedSeat" name="selectedSeat" hidden="">
                
                <?php
                    echo '<input type="text" id="schedule" name="schedule" hidden="" value="' .$_SESSION['schedule']. '">';
                ?>
                <input type="button" style="float: right;" value="Submit" class="btn btn-primary">
            </div>
            
            <script type="text/javascript">
                <?php
                    checkBooked($_SESSION['schedule']);
                ?>
                $(".btn").click(function() {
                    if ($("#sdt").val().match(/^\d+$/)) {
                        var allSelected= $(".seatBooking .selected .up").map(function() {
                            return this.innerHTML;
                        }).get();
                        $(".selectedSeat").val(allSelected.join());
                        console.log($(".selectedSeat").val());
                        $(".seatBooking").submit();
                    }
                });
            </script>
            
            <?php
                mysqli_close($conn);
            ?>

        </form>
    </body>
</html>
