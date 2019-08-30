<!DOCTYPE html>
<html lang="en">
    <div class="register-page">

        <head>
            <meta charset="UTF-8">
            <title>Veille</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
                integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
                crossorigin="anonymous">
            <link rel="stylesheet" href="css/style.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
            <link href="https://fonts.googleapis.com/css?family=Merriweather:400,900,900i" rel="stylesheet">
            <style>
                img {
                    display: none;
                }
            </style>
        </head>

        <body>
            <a id="button"></a>
            <div class="hea"></div>

            <div class="form nim" style="text-decoration : none;">
                <h2>Le mensuel des énergies renouvelables</h2>
                <p></p>
                <?php session_start(); 
                    if (!empty($_SESSION['Username'])){
                        echo '<form action="push.php">
                        <input type="submit" class="btn btn-primary" style="color: black;" value="Ajouter une veille">
                    </form>';
                    }
                ?>
                <div class="accordion" id="accordionExample">
                    <?php
                    require_once 'config.php';
                    $sql2 = "SELECT * FROM html_data ORDER BY unixTime DESC;";
                    $result = mysqli_query($link, $sql2);
                    while ($row = mysqli_fetch_array($result)) {
                        echo  '<div class="card"> <div class="card-header" id="' . $row['id'] . '"> <h2 class="mb-0"> <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#c' . $row['id'] . '" aria-expanded="false" aria-controls="c' . $row['id'] . '">';
                        echo $row['date'];
                        echo '</button> </h2> </div> <div id="c' . $row['id'] . '" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample"> <div class="card-body">';
                        $path = 'uploaded_files/';
                        $path .= $row['fileName'];
                        $handle = fopen($path, "r");
                        $page = fread($handle, filesize($path));
                        echo $page;
                        fclose($handle);
                        echo '</div> </div> </div>';
                    }
                    ?>
                </div>
            </div>
            <div id="cred"></div>
            <script src="https://code.jquery.com/jquery-3.4.1.js"
                integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
                integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
                crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
                integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
                crossorigin="anonymous"></script>
            <script>
                console.log("Created by Anas HAFSI for Cluster Solaire.\n2019. all rights Reserved.");
                var btn = $('#button');
                $(window).scroll(function () {
                    if ($(window).scrollTop() > 300) {
                        btn.addClass('show');
                    } else {
                        btn.removeClass('show');
                    }
                });
                btn.on('click', function (e) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: 0
                    }, '300');
                });
                document.addEventListener("DOMContentLoaded", function (event) {
                    document.querySelectorAll('img').forEach(function (img) {
                        img.onerror = function () {
                            this.style.display = 'none';
                        };
                    })
                });
            </script>

        </body>
    </div>

</html>