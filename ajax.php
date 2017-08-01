<?php
//if(isset($_POST['wallet'])){
//    $address=$_POST['wallet'];
//    $address = str_replace(' ', '', $address);
//    if(strlen($address)!=34 || substr($address,0,1)!="D" ){
//        echo "notValid";die();
//    }
//    $con = mysqli_connect('localhost', 'root', '11011101','mike');
//    if (!$con) {
//        die('Could not connect: ' . mysql_error());
//    }
//    $res=mysqli_query($con,"SELECT * FROM wallets where address='$address'");
//    $row = mysqli_fetch_assoc($res);
//    if (!$row)
//    {
//        mysqli_query($con,"INSERT INTO wallets (address) VALUES ('$address')");
//        $row['id']=mysqli_insert_id($con);
//    }
//    mysqli_close($con);
//    echo $row['id'];
//}



?>