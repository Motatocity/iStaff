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
        $now_month = $_POST['month'];
        $now_year = $_POST['year'];
    } else {
        $now_month = date("m");
        $now_year = date("Y");
    }
    //$now_month = date("m");
    //$now_year = date("Y");
    //$sql = "";

    if(!empty($arrkpivalue)) {
        for($i = 0; $i < count($arrkpivalue); $i++) {
            if($arrkpivalue[$i] != ""){
                //$sql = "UPDATE kpi_cockpit.data_raw SET u_date = NOW(), value = '$arrkpivalue[$i]', user = '$user' WHERE code = '$arrcode[$i]' AND u_date LIKE '$now_year-$now_month-%' AND departmentid = $fdepartmentid;";
                $sql = "UPDATE kpi_cockpit.data_raw SET value = '$arrkpivalue[$i]', user = '$user' WHERE code = '$arrcode[$i]' AND u_date LIKE '$now_year-$now_month-%' AND departmentid = $fdepartmentid;";
                $result = $conn->query($sql);
            }
        }
    }

    //echo $sql;

    header("location:../kpivalue.php");
    $conn->close();
?>
