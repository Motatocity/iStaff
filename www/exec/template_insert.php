<?
    // Start the session
    session_start();
    if(!isset($_SESSION["usr"]))
    {
        header("location:login.php");
    }

    include_once('condb.php');

    $tcode = strtoupper($_POST['tcode']);
    $tname = $_POST['tname'];
    $tformula = strtoupper($_POST['tformula']);
    $tunit = $_POST['tunit'];
    $ttarget = strtoupper($_POST['ttarget']);
    $ttarget_word = $_POST['ttarget_word'];
    $tparent = $_POST['tparent'];
    $user = $_SESSION["usr"];
    $departmentid = $_POST['departmentid'];
    $isnew = $_POST['isnew'];

    if($isnew == 'true'){
        $sql = "INSERT INTO kpi_cockpit.kpi_templete (code, name, type, formula, unit, target, target_desc, parent, departmentid, user, u_date, status) VALUES ('$tcode', '$tname', NULL, '$tformula', '$tunit', '$ttarget', '$ttarget_word', '$tparent', $departmentid, '$user', NOW(), 1);";
    } else {
        $sql = "UPDATE kpi_cockpit.kpi_templete SET name = '$tname', formula = '$tformula', unit = '$tunit', target = '$ttarget', target_desc = '$ttarget_word', parent = '$tparent', user = '$user', departmentid = $departmentid, u_date = NOW() WHERE code = '".$tcode."';";
    }
    $result = $conn->query($sql);

    //echo $sql;

    header("location:../template.php?dep=".$departmentid);
    $conn->close();
?>
