<?php

function validate($address){
    $address = str_replace(' ', '', $address);
//    if(strlen($address)!=34 || substr($address,0,1)!="6" ){
//        echo "notValid";die();
//    }
    require_once 'jsonRPCClient.php';
    $wallet = new jsonRPCClient('http://educoinrpc:3u7YsB33RqFQwVQoXueHnyUvCnx6SfJjVsKG2qsATRhX@127.0.0.1:33445/');
    if ($wallet->validateaddress($address)["isvalid"]==1) return true;
    else return false;
//    print_r($wallet->validateaddress($address));
}

function getWallet(){
    require_once 'jsonRPCClient.php';
    return new jsonRPCClient('http://educoinrpc:3u7YsB33RqFQwVQoXueHnyUvCnx6SfJjVsKG2qsATRhX@127.0.0.1:33445/');
}

function getNewWallet(){
    require_once 'jsonRPCClient.php';
    return new jsonRPCClient('http://educoinrpc:3u7YsB33RqFQwVQoXueHnyUvCnx6SfJjVsKG2qsATRhX@127.0.0.1:34445/');
}