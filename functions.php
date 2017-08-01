<?php

function validate($address, $new=true){
    $address = str_replace(' ', '', $address);
    require_once 'jsonRPCClient.php';
    if ($new) $wallet = getNewWallet(); else $wallet = getWallet();
    if ($wallet->validateaddress($address)["isvalid"]==1) return true;
    else return false;
}

function getWallet(){
    require_once 'jsonRPCClient.php';
    return new jsonRPCClient('http://educoinrpc:3u7YsB33RqFQwVQoXueHnyUvCnx6SfJjVsKG2qsATRhX@127.0.0.1:33445/');
}

function getNewWallet(){
    require_once 'jsonRPCClient.php';
    return new jsonRPCClient('http://educoinrpc:3u7YsB33RqFQwVQoXueHnyUvCnx6SfJjVsKG2qsATRhX@127.0.0.1:30445/');//34445
}