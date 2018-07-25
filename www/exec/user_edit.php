<?
    // Start the session
    session_start();
    if(!isset($_SESSION["usr"]))
    {
        header("location:login.php");
    }

    include('condb.php');
    include('func.php');

    $inputUsername = $_POST['inputUsername'];
    $inputDisplay = $_POST['inputDisplay'];
    $department = $_POST['department'];
    $fdepartmentid = $_SESSION["departmentid"];
    $user = $_SESSION["usr"];
    //$sql = "";

    if(!empty($inputDisplay)) {
        if(!empty($department)) {
            $sql = "UPDATE kpi_cockpit.user SET display = '$inputDisplay', departmentid = '$department', u_date = NOW() WHERE usrname = '$inputUsername';";
            $_SESSION["departmentid"] = $department;
            $_SESSION["department"] = get_department_name($department);
        } else {
            $sql = "UPDATE kpi_cockpit.user SET display = '$inputDisplay', u_date = NOW() WHERE usrname = '$inputUsername';";
        }
        $result = $conn->query($sql);
    }

    //echo $sql;

    header("location:../profile.php?s=0");
    $conn->close();
?>
