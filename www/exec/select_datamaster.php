<?php
header('Content-Type: text/html; charset=utf-8');
include_once('condb.php');
$result = $conn->query("SELECT code,type,name,unit FROM kpi_cockpit.datamaster WHERE code = '".$_GET['code']."' AND status = 1;");
$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"code":"'  . $rs["code"] . '",';
    $outp .= '"type":"'   . $rs["type"]        . '",';
    $outp .= '"name":"'   . $rs["name"]        . '",';
    $outp .= '"unit":"'. $rs["unit"]     . '"}';
}
$outp ='{"records":['.$outp.']}';
$conn->close();
echo($outp);
?>
