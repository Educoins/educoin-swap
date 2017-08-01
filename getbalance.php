<?php

require_once 'jsonRPCClient.php';
$wallet = new jsonRPCClient('http://educoinrpc:3u7YsB33RqFQwVQoXueHnyUvCnx6SfJjVsKG2qsATRhX@127.0.0.1:33445/');

$address = $_GET['address'];


echo $wallet->getreceivedbyaddress($address);