<?
    // Start the session
    session_start();
    if(!isset($_SESSION["usr"]))
    {
        header("location:login.php");
    }

    include_once('condb.php');

    $dcode = $_POST['code'];
    $user = $_SESSION["usr"];
    $sql = "UPDATE kpi_cockpit.datamaster SET user = '$user', u_date = NOW() , status = 0  WHERE code = '".$dcode."';";
    $result = $conn->query($sql);

    //echo $sql;

    header("location:../datamaster.php?dep=".$departmentid);
    $conn->close();
?>
