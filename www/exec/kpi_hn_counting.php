<?php
    // Start the session
    session_start();
    if(!isset($_SESSION["usr"]))
    {
        header("location:login.php");
    }

    include('func.php');
    include('condb.php');

    $code = $_POST['txtcode'];
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

    if(!empty($arrcode)) {
        $ncount = count($arrcode) - 1;
        for($i = 0; $i < $ncount; $i++) {
            $sql = "SELECT code FROM kpi_cockpit.data_raw WHERE code = '$arrcode[$i]' AND u_date LIKE '$now_year-$now_month-%';";
            $result = $conn->query($sql);
            //echo $sql."<br>";
            if ($result->num_rows == 0) {
                $sql = "SELECT code,hn,u_date FROM kpi_cockpit.data_hn WHERE code = '$arrcode[$i]' AND u_date LIKE '$now_year-$now_month-%';";
                $result = $conn->query($sql);
                $hn_count = $result->num_rows;
                $sql = "INSERT INTO kpi_cockpit.data_raw (code, departmentid, u_date, value, user, status) VALUES ('".$arrcode[$i]."', '0', NOW(), '$hn_count', '$user', 1);";
                $result = $conn->query($sql);
                //echo $sql."<br>";
            } else {
                $sql = "SELECT code,hn,u_date FROM kpi_cockpit.data_hn WHERE code = '$arrcode[$i]' AND u_date LIKE '$now_year-$now_month-%';";
                $result = $conn->query($sql);
                $hn_count = $result->num_rows;
                $sql = "UPDATE kpi_cockpit.data_raw SET u_date = NOW(), value = '$hn_count', user = '$user' WHERE code = '".$arrcode[$i]."' AND departmentid = '0' AND u_date LIKE '$now_year-$now_month-%';";
                $result = $conn->query($sql);
                //echo $sql."<br>";
            }

            $sql = "SELECT code FROM kpi_cockpit.data_raw WHERE code = '".$arrcode[$i].get_dcode($fdepartmentid)."' AND departmentid = '$fdepartmentid' AND u_date LIKE '$now_year-$now_month-%';";
            $result = $conn->query($sql);
            //echo $sql."<br>";
            if ($result->num_rows == 0) {
                $sql = "SELECT code,hn,u_date FROM kpi_cockpit.data_hn WHERE code = '".$arrcode[$i]."' AND departmentid = '$fdepartmentid' AND u_date LIKE '$now_year-$now_month-%';";
                $result = $conn->query($sql);
                $hn_count = $result->num_rows;
                $sql = "INSERT INTO kpi_cockpit.data_raw (code, departmentid, u_date, value, user, status) VALUES ('".$arrcode[$i].get_dcode($fdepartmentid)."', '$fdepartmentid', NOW(), '$hn_count', '$user', 1);";
                $result = $conn->query($sql);
                //echo $sql."<br>";
            } else {
                $sql = "SELECT code,hn,u_date FROM kpi_cockpit.data_hn WHERE code = '".$arrcode[$i]."' AND departmentid = '$fdepartmentid' AND u_date LIKE '$now_year-$now_month-%';";
                $result = $conn->query($sql);
                $hn_count = $result->num_rows;
                $sql = "UPDATE kpi_cockpit.data_raw SET u_date = NOW(), value = '$hn_count', user = '$user' WHERE code = '".$arrcode[$i].get_dcode($fdepartmentid)."' AND departmentid = '$fdepartmentid' AND u_date LIKE '$now_year-$now_month-%';";
                $result = $conn->query($sql);
                //echo $sql."<br>";
            }
        }
    }

    //echo $sql;

    header("location:../kpivalue.php");
    $conn->close();
?>
