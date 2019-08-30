<?php session_start(); 
 if (empty($_SESSION['Username']))header("location: login.php");
?>

<!DOCTYPE html>
<html lang="en">
    <div class="register-page">

        <head>

            <meta charset="UTF-8">
            <title>Admin - Upload Files</title>
            <link href="css/jquery-ui.css" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
                integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
                crossorigin="anonymous">
            <link href="css/MonthPicker.min.css" rel="stylesheet" type="text/css" />
            <link rel="stylesheet" href="css/style.css">
            <script
                src="https://cdn.tiny.cloud/1/60x301opo22avxwzptdaa1j6pxrcfx8d7gxt10xpx8y6jn4o/tinymce/5/tinymce.min.js"
                referrerpolicy="origin"></script>
            <script src="js/main.js"></script>
            <script src="js/jquery.js"></script>

            <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
            <script src="https://cdn.rawgit.com/digitalBush/jquery.maskedinput/1.4.1/dist/jquery.maskedinput.min.js">
            </script>

            <script src="js/MonthPicker.min.js"></script>
            <script src="js/examples.js"></script>
        </head>

        <body>
            <form method="post" action="upload.php">

                <div class="form" action="">
                    <h2>Upload files</h2>
                    <p></p>
                    <?php
                        if (isset($_SESSION['message']) && $_SESSION['message']) {
                            printf('<b>%s</b>', $_SESSION['message']);
                            unset($_SESSION['message']);
                        }
                        $_SESSION['message']='';
                    ?>
                    <div class="form-group" style="margin-bottom: 20px;">
                        <input name="dt" id="dt" style="width: 90%;float :left;" class='Default form-control'
                            type="text" />
                    </div>
                    <div class="form-group"><textarea id="veille" name="veille"
                            placeholder="Texte de la veille"></textarea>
                    </div>
                    <div class="form-group">
                        <button onclick="val();" type="submit" name="sb">Push</button><br>
                        <input  type="reset" class=" btn btn-light" value="Reset">
            </form>
            <form action="index.php">
                <input type="submit" class="btn btn-light" value="Page d'Accueil">
            </form>
            <form action="destroy.php">
                <input type="submit" class="btn btn-danger" style="color: black;" value="Se deconnecter">
            </form>
    </div>
    </div>


    </body>
    </div>

</html>