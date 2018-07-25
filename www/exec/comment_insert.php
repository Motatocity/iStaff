<?
    // Start the session
    session_start();
    if(!isset($_SESSION["usr"]))
    {
        header("location:login.php");
    }

    include_once('condb.php');

    $kpicode = $_POST['kpicode'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $comment = $_POST['comment'];
    $fdepartmentid = $_SESSION["departmentid"];
    $user = $_SESSION["usr"];
    $arrcode = explode(",", $code);
    //$sql = "";

    if(!empty($comment) AND !empty($month) AND !empty($year) AND !empty($kpicode)) {
        $sql = "INSERT INTO kpi_cockpit.comment (kpicode, kpi_month, kpi_year, user, comment, u_date, status) VALUES ('$kpicode', '$month', '$year', '$user', '$comment', NOW(), 1);";
        $result = $conn->query($sql);
    }

    //echo $sql;

    header("location:../kpidetail.php?month=$month&code=$kpicode&year=$year");
    $conn->close();
?>
