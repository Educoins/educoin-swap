<?php

require_once './functions.php';

$newWallet = getNewWallet();

echo $newWallet->getaddressesbyaccount("Default Address")[0];
echo "<br>";
echo "balance: ",$newWallet->getbalance();
