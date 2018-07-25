<?
    // Start the session
    session_start();
    if(!isset($_SESSION["usr"]))
    {
        header("location:login.php");
    }

    include('condb.php');

    $inputUsername = $_POST['inputUsername'];
    $txtoldpasswd = $_POST['txtoldpasswd'];
    $txtnewpasswd = $_POST['txtnewpasswd'];
    $txtrenewpasswd = $_POST["txtrenewpasswd"];
    $user = $_SESSION["usr"];
    //$sql = "";

    $sql = "SELECT usrname FROM kpi_cockpit.user WHERE usrname = '$user' AND passwd = SHA1('$txtoldpasswd');";
    $result = $conn->query($sql);
    //echo $sql."<br>".$txtnewpasswd."<br>".$txtrenewpasswd."<br>";

    if ($result->num_rows > 0 && $txtnewpasswd == $txtrenewpasswd) {
        $sql = "UPDATE kpi_cockpit.user SET passwd = SHA1('$txtnewpasswd'), u_date = NOW() WHERE usrname = '$user';";
        $result = $conn->query($sql);
        header("location:../profile.php?s=0");
    } else {
        header("location:../profile.php?s=1");
    }

    $conn->close();
?>
