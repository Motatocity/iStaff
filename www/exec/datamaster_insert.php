<?
    // Start the session
    session_start();
    if(!isset($_SESSION["usr"]))
    {
        header("location:login.php");
    }

    include_once('condb.php');

    $dcode = $_POST['dcode'];
    $dtype = $_POST['dtype'];
    $dname = $_POST['dname'];
    $dunit = $_POST['dunit'];
    $user = $_SESSION["usr"];
    $departmentid = $_POST['departmentid'];
    $isnew = $_POST['isnew'];

    if($isnew == 'true'){
        $sql = "INSERT INTO kpi_cockpit.datamaster (code, type, name, unit, user, departmentid, u_date, status) VALUES ('$dcode', '$dtype', '$dname', '$dunit', '$user', $departmentid, NOW(), 1);";
    } else {
        $sql = "UPDATE kpi_cockpit.datamaster SET type = '$dtype', name = '$dname', unit = '$dunit', user = '$user', departmentid = $departmentid, u_date = NOW() WHERE code = '".$dcode."';";
    }
    $result = $conn->query($sql);

    //echo $sql;

    header("location:../datamaster.php?dep=".$departmentid);
    $conn->close();
?>
