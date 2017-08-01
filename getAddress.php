<?php
session_start();
require_once './functions.php';
$wallet = getWallet();

if(isset($_GET['address'])){
    $address=$_GET['address'];
    if (validate($address)){
        try{
//            echo $newaddress = $wallet->getaccountaddress("");
//            print_r($wallet->getaddressesbyaccount(""));
//            6Jpr3q6xzim6HG5GWCYjpMjima9BfBbCVm
            $_SESSION['hisAddress'] = $address;
            echo $newaddress = $wallet->getnewaddress("hisAddress=".$address);
            $_SESSION['ourAddress'] = $newaddress;
            
        } catch (Exception $e) {
            ?>
            <div id=error> Connection to blockchain failed. We've been notified and we will look into it. </div>
            <?php
            //TODO send mail.
        }
        

    } else {
        echo 'notValid';
    }
}