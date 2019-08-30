<?php
    require_once 'config.php';
    session_start();
    $uploadFileDir = './uploaded_files/';
    $message = '';
    $code=$_POST['veille'];
    $dt=$_POST['dt'];
    $udt=explode("/",$dt);
    $unixTime=intval($udt[0])+((intval($udt[1])-2014)*12);
    $months = ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre","Octobre", "Novembre", "Decembre"];
    $ext = '.php';
    $date=$months[intval($udt[0])-1]." ".intval($udt[1]);
    $fileName = $date.$ext;
    $dest_path = $uploadFileDir.$fileName;
    $file = fopen($dest_path, "w");
    if (fwrite($file, $code)) {
        $findif = "SELECT * FROM html_data WHERE unixTime = '$unixTime';";
        $kayn = mysqli_query($link, $findif);
        $exists =false;
        while ($row = mysqli_fetch_array($kayn)) $exists =true;
        $sql = "INSERT INTO html_data (fileName,date,unixTime) VALUES ('$fileName','$date','$unixTime');";
        if (!$exists){
            if (mysqli_query($link, $sql)) {
                $message = "New record created successfully";
            } else {
                $message = "Error: ".$sql.
                "<br>".mysqli_error($link);
            }
            $message .= '<br>File is successfully uploaded.';
            $message .= '<br>Record of '.$date.' added to database';
        } else $message = '<font color="red">File already in our database.</font><br>File successfully updated.';
        
    } else {
        $message .= 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
    }
    fclose($file);
    $_SESSION['message'] = $message;
    header("Location: push.php");
?>