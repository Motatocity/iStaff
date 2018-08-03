<?php
function thai_date($str){
	$thai_month_arr = array(
		"00"=>"",
		"01"=>"มกราคม",
		"02"=>"กุมภาพันธ์",
		"03"=>"มีนาคม",
		"04"=>"เมษายน",
		"05"=>"พฤษภาคม",
		"06"=>"มิถุนายน", 
		"07"=>"กรกฎาคม",
		"08"=>"สิงหาคม",
		"09"=>"กันยายน",
		"10"=>"ตุลาคม",
		"11"=>"พฤศจิกายน",
		"12"=>"ธันวาคม"                 
	);
	$strtime = explode("/",$str);
    $thai_date_return.= (int)$strtime[0];
    $thai_date_return.= " ".$thai_month_arr[$strtime[1]];
    $thai_date_return.= " ".($strtime[2]+543);
    return $thai_date_return;
}

function convertToDayHours($time) {
	$ans = "";
    $day = floor($time);
    $hour = (($time*8) % 8);
	
	if($day > 0){
		$ans = $ans.$day." วัน ";
	}
	if($hour > 0){
		$ans = $ans.$hour." ชั่วโมง";
	}
	if($ans != ""){
		return $ans;
	} else {
		return "0 วัน";
	}
}

	$type = "";
    $empid = $_GET['id'];
	$person = $_GET['pname'];
	if(isset($_GET['type'])){
		$type = "&type=".$_GET['type'];
	} else {
		$type = "";
	}
	$json = file_get_contents("http://192.0.0.100/passport/kwanp/dayoff_detail.php?id=".$empid.$type);
	$obj = json_decode($json,true);

?>
<link rel="stylesheet" href="http://49.231.150.237/hr/dist/css/AdminLTE.min.css">
<div class="container">
	<div class="row">
		<div class="col-xs-2">
			<h3 style="margin-bottom: 0px;"><a href="dayoff.html" class="btn btn-default btn-lg"><i class="fa fa-angle-left" aria-hidden="true"></i></a></h3>
		</div>
		<div class="col-xs-10">
			<h3 style="margin-bottom: 0px;">รายละเอียดการลางาน</h3>
			<p style="margin-top: 0px;">
				<?php 
					//$person = $row_employee['name'];
					//$empid = $row_employee['EmployeeID'];
					echo $person." (รหัสพนักงาน ".$empid.")"; 
				?>
			</p>    
		</div>
	</div>   
		<div class="box box-primary">
            <div class="box-header with-border">
				<h3 class="box-title">
					สรุปจำนวนการลางาน 
					<?php
						if(!isset($_GET['type'])){
							echo "(ทั้งหมด)";
						} elseif($_GET['type'] == 'V') {
							echo "(พักร้อน)";
						} elseif($_GET['type'] == 'SL') {
							echo "(ลาป่วย)";
						} elseif($_GET['type'] == 'PL') {
							echo "(ลากิจ)";
						} elseif($_GET['type'] == 'OT') {
							echo "(วันหยุดสะสม)";
						}
					?>
				</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
				
				<?php
					foreach($obj as $row) {
						if($row['check_login'] == 'YES'){
							
							$icobet = "fa-comment-o";
							if($row['type'] == 'V') {
								$icobet = "fa-plane";
							} elseif($row['type'] == 'SL') {
								$icobet = "fa-wheelchair";
							} elseif($row['type'] == 'PL') {
								$icobet = "fa-briefcase";
							} elseif($row['type'] == 'OT') {
								$icobet = "fa-clock-o";
							}
							
							echo "<li class=\"item\">\n";
							echo "  <div class=\"product-img\">\n";
							//echo "	<img src=\"http://49.231.150.237/hr/dist/img/default-50x50.gif\" alt=\"Product Image\">\n";
							echo "	<i class=\"fa ".$icobet." fa-3x\"></i>";
							echo "	<br><span style=\"display:block;width:50px;\" class=\"label label-warning\">".convertToDayHours($row['ndet'])." </span></a>\n";
							echo "  </div>\n";
							echo "  <div class=\"product-info\">\n"; 
							echo "	<a href=\"#\" class=\"product-title\">".thai_date($row['startdate'])." \n";
							echo "		<br>เวลา ".$row['starttime']." - ".$row['endtime']." น.\n";
							//echo "		<span class=\"label label-warning pull-right\">".convertToDayHours($row['ndet'])." </span>\n";
							echo "		<span class=\"product-description\">";
							echo "			".$row['remark'];
							echo "		</span>\n";
							echo "  </a></div>\n";
							echo "</li>\n";
						}
					}
				?>
				
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <!--a href="javascript:void(0)" class="uppercase">View All Products</a-->
            </div>
            <!-- /.box-footer -->
        </div>
</div>