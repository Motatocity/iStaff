<?php
header('Content-Type: text/html; charset=utf-8');
include_once('condb.php');
$result = $conn->query("SELECT code,name,formula,unit,target,target_desc,parent FROM kpi_cockpit.kpi_templete WHERE code = '".$_GET['code']."' AND status = 1;");
$outp = "";
while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
    if ($outp != "") {$outp .= ",";}
    $outp .= '{"code":"'  . $rs["code"] . '",';
    $outp .= '"name":"'   . $rs["name"]        . '",';
    $outp .= '"formula":"'   . $rs["formula"]        . '",';
    $outp .= '"unit":"'   . $rs["unit"]        . '",';
    $outp .= '"target":"'   . $rs["target"]        . '",';
    $outp .= '"target_word":"'   . $rs["target_desc"]        . '",';
    $outp .= '"parent":"'. $rs["parent"]     . '"}';
}
$outp ='{"records":['.$outp.']}';
$conn->close();
echo($outp);
?>
