<?php
session_start();

require_once './functions.php';

$oldWallet = getWallet();
$newWallet = getNewWallet();


$hisAddress = $_GET['hisAddress'];
$ourAddress = $oldWallet->getaddressesbyaccount("hisAddress=".$hisAddress);
$ourAddress = $ourAddress[0];

if (validate($hisAddress) && validate($ourAddress, false)){
    try {
        if ($walletpassphrase_new!="") $newWallet->walletpassphrase($walletpassphrase_new,30);
        $amount = $oldWallet->getreceivedbyaddress($ourAddress);///5000;
        $newAmount = $amount/5000;
//        echo "trying to send $newAmount to $hisAddress correspoding to the $amount coins you sent to $ourAddress";
//        echo $oldWallet->getreceivedbyaddress($oldAddress);
        $newWallet->sendtoaddress($hisAddress, $newAmount, "New coins corresponding to address $ourAddress", "New coins corresponding to address $ourAddress"); //<educoinaddress> <amount> [comment] [comment-to]
        //invalidate ouraddress
//        $oldWallet->setaccount($ourAddress, "used");
//        echo $newAddress, $amount, "New coins corresponding to address $oldAddress", "New coins corresponding to address $oldAddress"; //<educoinaddress> <amount> [comment] [comment-to]
//        $newWallet->sendtoaddress($newAddress, $amount, "New coins corresponding to address $oldAddress", "New coins corresponding to address $oldAddress"); //<educoinaddress> <amount> [comment] [comment-to]
        echo "You should receive $newAmount coins at $hisAddress soon";
    } catch (Exception $e) {
        echo "Sorry, couldn't process your claim.";
    }
    
} else {
    echo "Sorry, one of the addressess is incorrect\n";
    echo "$oldAddress \n";
    echo "$newAddress \n";
}