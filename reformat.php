<?php
function refor($filename)
{
    $handle = fopen($filename, "r");
    $tst = fread($handle, filesize($filename));
    $str="</style>";
    $te=preg_split($str,$tst);
    echo substr(end($te),1);
}

?>
