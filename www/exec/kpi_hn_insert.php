<?
    // Start the session
    session_start();
    if(!isset($_SESSION["usr"]))
    {
        header("location:login.php");
    }

    include_once('condb.php');

    $hn = $_POST['hn'];
    $code = $_POST['code'];
    $fdepartmentid = $_SESSION["departmentid"];
    $user = $_SESSION["usr"];
    $now_month = date("m");
    $now_year = date("Y");
    //$sql = "";

    if(!empty($hn)) {
        $sql = "SELECT code,hn,departmentid FROM kpi_cockpit.data_hn WHERE code = '$code' AND hn = '$hn' AND u_date LIKE '$now_year-$now_month-%';";
        $result = $conn->query($sql);
        if ($result->num_rows == 0) {
            $sql = "INSERT INTO kpi_cockpit.data_hn (code, departmentid, u_date, hn, user, status) VALUES ('$code', $fdepartmentid, NOW(), '$hn', '$user', 1);";
            $result = $conn->query($sql);
        } else {
            echo $hn;
        }
    }

    //echo $sql;

    //header("location:../kpivalue.php");
    $conn->close();
?>
