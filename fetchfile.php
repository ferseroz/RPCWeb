<?php
    $file = "logs/" . $_POST['log'];
    $contents = file($file); 
    $string = implode("<br>", $contents); 
    echo $string;
    echo "<br></br>";

?>