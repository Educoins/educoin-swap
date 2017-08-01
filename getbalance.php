<?php
require_once './functions.php';

$wallet = getWallet();
$address = $_GET['address'];

echo $wallet->getreceivedbyaddress($address);