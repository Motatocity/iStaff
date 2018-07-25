<?php
$host = "192.0.0.7";
$user = "motatocity";
$pass = "18122534";
$db   = "hr";
$ryhid = $_GET['id'];
header("content-type:text/html;charset=UTF-8");
$conn = mysql_connect($host,$user,$pass) or die("ข้อความเมื่อติดต่อไม่ได้");
$select_db = mysql_select_db($db,$conn) or dir("ข้อความเมื่อเลือกฐานข้อมูลไม่ได้");
mysql_query("SET NAMES UTF8");
 
$str_sql = "SELECT EmployeeID,CONCAT(name,' ',surename) AS 'name' FROM hr.employee WHERE EmployeeID = '$ryhid';";
$rs_employee = mysql_query($str_sql,$conn);
$num_rows = mysql_num_rows($rs_employee);
$row_employee = mysql_fetch_array($rs_employee);

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
    $thai_date_return.= $strtime[0];
    $thai_date_return.= " ".$thai_month_arr[$strtime[1]];
    $thai_date_return.= " ".($strtime[2]+543);
    return $thai_date_return;
}

    $empid = $_GET['id'];
	$json = file_get_contents("http://192.0.0.100/passport/kwanp/dayoff.php?id=".$empid);
	$obj = json_decode($json,true);

?>
<link rel="stylesheet" href="http://49.231.150.237/hr/dist/css/AdminLTE.min.css">
<div class="container">
  <h2><a href="index.html" class="btn btn-default btn-sm"><i class="fa fa-angle-left" aria-hidden="true"></i></a> สรุปจำนวนการลางาน</h2>
  <p>
	<?php 
		$person = $row_employee['name'];
		$empid = $row_employee['EmployeeID'];
		echo $person." (รหัสพนักงาน ".$empid.")"; 
	?>
  </p>     
<!--div class="table-responsive">  
  <table class="table table-bordered table-striped">
    <thead>
      <tr class="active">
		<th style="width: 10%;"> <strong><center>ลาวันที่</center></strong></th>
		<th style="width: 11%;"> <strong><center>ถึงวันที่</center></strong></th>
		<th style="width: 20%;"> <strong><center>ประเภท</center></strong></th>
		<th style="width: 55%;"> <strong><center>เหตุผล</center></strong></th>
		<th style="width: 4%;">	<strong><center>จำนวนวันลา</center></strong></th>
      </tr>
    </thead>
    <tbody>
      <?php 
		$i = 1;
		$sum = 0;
		$str_sql = "SELECT * FROM leaveform WHERE EmployeeID = '$ryhid';";
		$rs_employee = mysql_query($str_sql,$conn);
		$num_rows = mysql_num_rows($rs_employee);
		while($row_employee = mysql_fetch_array($rs_employee)) { 
	?>
     
		<tr>
			<td align="center"><?php echo $row_employee['DayLeave']; ?></td>
			<td align="center"><?php echo $row_employee['todate']; ?></td>
			<td ><?php echo $row_employee['LeaveType']; ?></td>
			<td><?php echo $row_employee['Causes']; ?></td>
			<td align="center"><?php echo $row_employee['Amount']; ?></td>
			<?php 
				$i++; 
				//$sum = $sum + ($row_employee['hour']);
			?>			
		</tr>
     
	<?php } ?>
    </tbody>
  </table><br>
 </div-->
 
<?php 
#--------------Query Total DayLeave--------------#
$result=mysql_query("SELECT SUM(Amount) as total from leaveform WHERE EmployeeID = '".$ryhid."' ");
$data=mysql_fetch_assoc($result);

#--------------Query Total Personal-Leave--------------#
$result2=mysql_query("SELECT SUM(Amount) as total2 from leaveform WHERE EmployeeID = '".$ryhid."' AND LeaveType = 'ลากิจ' ");
$data2=mysql_fetch_assoc($result2);
if($data2['total2']==""){$data2['total2']=0;  }

#--------------Query Total Sick-Leave--------------#
$result3=mysql_query("SELECT SUM(Amount) as total3 from leaveform WHERE EmployeeID = '".$ryhid."' AND LeaveType = 'ลาป่วย' ");
$data3=mysql_fetch_assoc($result3);
if($data3['total3']==""){$data3['total3']=0;  }


#--------------Query Total Vacation-Leave--------------#
$result4=mysql_query("SELECT SUM(Amount) as total4 from leaveform WHERE EmployeeID = '".$ryhid."' AND LeaveType = 'ลาพักร้อน' ");
$data4=mysql_fetch_assoc($result4);
if($data4['total4']=="") {$data4['total4']=0; }

#--------------Query Personal-remain--------------#
$result5=mysql_query("SELECT SUM(PL_remain-".$data2['total2'].") as total5 from employee WHERE EmployeeID = '".$ryhid."' ");
$data5=mysql_fetch_assoc($result5);


#--------------Query Sick-Remain--------------#
$result6=mysql_query("SELECT SUM(SL_remain-".$data3['total3'].") as total6 from employee WHERE EmployeeID = '".$ryhid."' ");
$data6=mysql_fetch_assoc($result6);


#--------------Query Vacation-Remain--------------#
$result7=mysql_query("SELECT SUM(VL_remain-".$data4['total4'].") as total7 from employee WHERE EmployeeID = '".$ryhid."' ");
$data7=mysql_fetch_assoc($result7);

?>
			<div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><h3><?php if($data['total']==""){echo "ลางานทั้งหมด :&nbsp;" ,"-", "&nbsp;วัน"; }else{echo  "ลารวมทั้งหมด :&nbsp;" ,$data['total'], "&nbsp;วัน";}?></h3></div>
                                    
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
				
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-briefcase fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <h3 style="margin-top: 5px;"><?php if($data2['total2']==""){$data2['total2']=0; echo "ลากิจ :&nbsp;" ,"-", "&nbsp;วัน"; }else{echo  "ลากิจรวม :&nbsp;" ,$data2['total2'], "&nbsp;วัน";}?></h3>
                                    <div><?php if($data5['total5']==""){echo "ลากิจคงเหลือ :&nbsp;" ,"-", "&nbsp;วัน"; }else{echo  "ลากิจคงเหลือ :&nbsp;" ,$data5['total5'], "&nbsp;วัน";}?></div>
                                </div>
                            </div>
                        </div>
                     
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-wheelchair fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <h3 style="margin-top: 5px;"><?php if($data3['total3']==""){$data3['total3']=0; echo "ลาป่วย :&nbsp;" ,"-", "&nbsp;วัน"; }else{echo  "ลาป่วยรวม :&nbsp;" ,$data3['total3'], "&nbsp;วัน";}?></h3>
                                    <div><?php if($data6['total6']==""){echo "ลาป่วยคงเหลือ :&nbsp;" ,"-", "&nbsp;วัน"; }else{echo  "ลาป่วยคงเหลือ :&nbsp;" ,$data6['total6'], "&nbsp;วัน";}?></div>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-plane fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <h3 style="margin-top: 5px;"><?php if($data4['total4']=="") {$data4['total4']=0; echo "ลาพักร้อน :&nbsp;" ,"-", "&nbsp;วัน";} else{echo  "ลาพักร้อนรวม :&nbsp;" ,$data4['total4'], "&nbsp;วัน";}?></h3>
                                    <div><?php if($data7['total7']==""){echo "ลาพักร้อนคงเหลือ :&nbsp;" ,"-", "&nbsp;วัน"; }else{echo  "ลาพักร้อนคงเหลือ :&nbsp;" ,$data7['total7'], "&nbsp;วัน";}?></div>
                                </div>
                            </div>
                        </div>
                      
                    </div>
                </div>
            </div>
</div>