<?php
require_once 'jsonRPCClient.php';
$dogecoin = new jsonRPCClient('http://koutantosoffice:76saGfacNjWqsg3kqxUqnPjsjpX8pTYuwfgkvdLXYKgY@127.0.0.1:8358/');
  //set true if you want to use script for billing reports
  //first you need to enable them in your account
  $billing_reports_enabled = false;

  // check that the request comes from Fortumo server
  if(!in_array($_SERVER['REMOTE_ADDR'],
      array('81.20.151.38', '81.20.148.122', '79.125.125.1', '209.20.83.207'))) {
    header("HTTP/1.0 403 Forbidden");
    die("Error: Unknown IP");
  }

  // check the signature
  $secret = 'd069db8bf4b1e40188978f8b73ec77d5'; // insert your secret between ''
  if(empty($secret) || !check_signature($_GET, $secret)) {
    header("HTTP/1.0 404 Not Found");
    die("Error: Invalid signature");
  }


  $price = $_GET['price'];
  //1 euro == 162
  $per1euro=162;

  $amount=$price*$per1euro;



    $sender = $_GET['sender'];
    $message=$id = $_GET['message'];
    $message_id = $_GET['message_id'];

    $con = mysqli_connect('localhost', 'suchfastdoge', '6agZ1Jg0','mike');
    if (!$con) {
        die('There was a problem. error code 2');
    }

    $res=mysqli_query($con,"SELECT address FROM wallets where id='$id'");
    $row = mysqli_fetch_assoc($res);
    $address=$row["address"];
    $dogecoin->sendtoaddress($address,$amount);
    
    mysqli_query($con,"INSERT INTO users (phone, money, walletAddress,message_id) VALUES ('$sender', '$price','$message','$message_id')");
    mysqli_close($con);

    $reply = "such money very doge.Thank you.";
  

  // print out the reply
  echo($reply);
 
 //customize this according to your needs
  if($billing_reports_enabled 
    && preg_match("/Failed/i", $_GET['status']) 
    && preg_match("/MT/i", $_GET['billing_type'])) {
   // find message by $_GET['message_id'] and suspend it
  }


  function check_signature($params_array, $secret) {
    ksort($params_array);

    $str = '';
    foreach ($params_array as $k=>$v) {
      if($k != 'sig') {
        $str .= "$k=$v";
      }
    }
    $str .= $secret;
    $signature = md5($str);

    return ($params_array['sig'] == $signature);
  }
?>