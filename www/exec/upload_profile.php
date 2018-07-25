<?
    // Start the session
    session_start();
    if(!isset($_SESSION["usr"]))
    {
        header("location:login.php");
    }

    include('condb.php');
    include('func.php');

    $target_dir = "userimg/";
    $path_old = $target_dir . basename($_FILES["profile-image-upload"]["name"]);
    $target_file = $target_dir . $_SESSION["usr"] . ".jpg"; //basename($_FILES["profile-image-upload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($path_old,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["btnupload"])) {
        $check = getimagesize($_FILES["profile-image-upload"]["tmp_name"]);
        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            //echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        //echo "Sorry $imageFileType, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        //echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["profile-image-upload"]["tmp_name"], $target_file)) {
            $sql = "UPDATE kpi_cockpit.user SET image = 'exec/$target_file', u_date = NOW() WHERE usrname = '".$_SESSION["usr"]."';";
            $result = $conn->query($sql);
            header("location:../profile.php?s=0");
        } else {
            header("location:../profile.php?s=2");
        }
    }

    $conn->close();
?>
