<?
    // Start the session
    session_start();
    if(!isset($_SESSION["usr"]))
    {
        header("location:login.php");
    }

    include_once('condb.php');

    $code = $_POST['txtname'];
    $arrkpivalue = $_POST['kpivalue'];
    $fdepartmentid = $_SESSION["departmentid"];
    $user = $_SESSION["usr"];
    $arrcode = explode(",", $code);
    if(isset($_POST['month']) && isset($_POST['year']))
    {
        $now = $_POST['year']."-".$_POST['month'] ."-01 00:00:00";
    } else {
        $now = "NOW()";
    }
    //$sql = "";

    if(!empty($arrkpivalue)) {
        for($i = 0; $i < count($arrkpivalue); $i++) {
            if($arrkpivalue[$i] != ""){
                //$sql = "INSERT INTO kpi_cockpit.data_raw (code, departmentid, u_date, value, user, status) VALUES ('$arrcode[$i]', $fdepartmentid, NOW(), '$arrkpivalue[$i]', '$user', 1);";
                $sql = "INSERT INTO kpi_cockpit.data_raw (code, departmentid, u_date, value, user, status) VALUES ('$arrcode[$i]', $fdepartmentid, '$now', '$arrkpivalue[$i]', '$user', 1);";
                $result = $conn->query($sql);
            }
        }
    }

    //echo $sql;

    header("location:../kpivalue.php");
    $conn->close();
?>
