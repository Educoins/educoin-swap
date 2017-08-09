<?php

require_once './functions.php';

$newWallet = getNewWallet();

var_dump($newWallet->getaddressesbyaccount("Default Address"));
