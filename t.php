<?php
                    require_once 'config.php';
                    $sql2 = "SELECT * FROM html_data WHERE unixTime = '67';";
                    $result = mysqli_query($link, $sql2);
                    while ($row = mysqli_fetch_array($result)) {
                        echo 'exists';
                    }
                    ?>