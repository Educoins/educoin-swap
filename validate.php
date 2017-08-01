<?php

require_once './functions.php';
if(isset($_GET['address'])){
    $address=$_GET['address'];
    if (validate($address)){
        echo 'Valid';
    } else {
        echo 'notValid';
    }
}

