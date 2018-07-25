<?
	// server should keep session data for AT LEAST 1 hour
	ini_set('session.gc_maxlifetime', 86400);

	// each client should remember their session id for EXACTLY 1 hour
	session_set_cookie_params(86400);

    // Start the session
    session_start();
    include_once('condb.php');

    $user = $_POST['user'];
    $pwd = $_POST['pwd'];

    $sql = "SELECT usrname,display,type,position,d.name AS 'department',d.id AS 'departmentid' FROM kpi_cockpit.user u JOIN kpi_cockpit.department d ON u.departmentid = d.id WHERE usrname = '".$user."' AND passwd = SHA1('".$pwd."') ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION["usr"] = $row["usrname"];
        $_SESSION["display"] = $row["display"];
        $_SESSION["position"] = $row["position"];
        $_SESSION["department"] = $row["department"];
        $_SESSION["departmentid"] = $row["departmentid"];
        $_SESSION["type"] = $row["type"];
        header("location:../index.php");
    } else {
        header("location:../login.php");
    }
    $conn->close();
?>
