<?php
    define('DB_SERVER', 'sql304.epizy.com');
    define('DB_USERNAME', 'epiz_24400110');
    define('DB_PASSWORD', 'vCn3UlFqaQi7');
    define('DB_NAME', 'epiz_24400110_veille');
    
    /* Attempt to connect to MySQL database */
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
?>