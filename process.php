<?php
session_start();

require_once './functions.php';

$oldWallet = getWallet();
$newWallet = getNewWallet();

$hisAddress = $_SESSION['hisAddress'];
$ourAddress = $_SESSION['ourAddress'];

if (validate($hisAddress) && validate($ourAddress)){
    try {
        $amount = $oldWallet->getreceivedbyaddress($ourAddress);///5000;
//        echo $oldWallet->getreceivedbyaddress($oldAddress);
        $newWallet->sendtoaddress($hisAddress, $amount, "New coins corresponding to address $ourAddress", "New coins corresponding to address $ourAddress"); //<educoinaddress> <amount> [comment] [comment-to]
//        echo $newAddress, $amount, "New coins corresponding to address $oldAddress", "New coins corresponding to address $oldAddress"; //<educoinaddress> <amount> [comment] [comment-to]
//        $newWallet->sendtoaddress($newAddress, $amount, "New coins corresponding to address $oldAddress", "New coins corresponding to address $oldAddress"); //<educoinaddress> <amount> [comment] [comment-to]
        echo "You should receive your coins at $hisAddress soon";
    } catch (Exception $e) {
        echo "Sorry, couldn't process your claim.";
    }
    
} else {
    echo "Sorry, one of the addressess is incorrect\n";
    echo "$oldAddress \n";
    echo "$newAddress \n";
}