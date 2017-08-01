<?php

function validate($address, $new=true){
    $address = str_replace(' ', '', $address);
    require_once 'jsonRPCClient.php';
    if ($new) $wallet = getNewWallet(); else $wallet = getWallet();
    if ($wallet->validateaddress($address)["isvalid"]==1) return true;
    else return false;
}

function getWallet(){
    include 'secret.php';
    require_once 'jsonRPCClient.php';
    return new jsonRPCClient("http://$rpcuser_old:$rpcpassword_old@127.0.0.1:33445/");
}

function getNewWallet(){
    include 'secret.php';
    require_once 'jsonRPCClient.php';
    return new jsonRPCClient("http://$rpcuser_new:$rpcpassword_new@127.0.0.1:30445/");//34445
}