<?php

include './getAddress.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Educoin Swap</title>
        <meta name="keywords" content="educoin, swap" />
        <meta name="description" content="Educoin swap system" />        
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet"> 
        <script
            src="https://code.jquery.com/jquery-3.2.1.js"
            integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
        crossorigin="anonymous"></script>
        <script>
            $(document).ready(function(){
                $("#claim").click(function(){
                    $("#result").load("process.php?hisAddress="+$("#hisAddress").text());
                    $("#claim,#address,#claimwarning,#claimexplain").hide();
                    $("#morecoin").show();
                    $("h1").html("Yay! Coins coming your way.")
                    clearInterval(interval);
                })
            })
        </script>

    </head>
    <body>
        <div class="container"> 
            <br>
            <div id="hisAddress"><?=$hisAddress?></div>
            <?php if ($result=="norpc") { ?>
                <div id=error> Connection to blockchain failed. We've been notified and we will look into it. </div>
            <?php } else if ($result=="notValid") {?>
                <div id="error">Sorry invalid address. Check your spelling</div>
            <?php } else if ($result=="ok") { ?>
            <div id="sendto">
                <h1>Send your old educoins to this address</h1>
                <div id="address">
                    <?=$ourAddress?>
                </div>
                <div class=explain id="claimexplain">The 0 below will change to the amount you send to this address. When the transaction is confirmed you will be able to claim your new educoins.
                If you don't want to wait, either bookmark this page or just come back later and give the same address.
                </div>
            </div>
            
            <div id="received">  
                <?=$received=$oldWallet->getreceivedbyaddress($ourAddress);?>
            </div>
            <div class=explain id=claimwarning style="<?=$received==0?"display:none":""?>"><strong>Once you click <em>claim</em> do not send more coins to this address. It will be invalidated.</strong></div>
            <button class="button" id="claim" style="<?=$received==0?"display:none":""?>" >claim</button>
            <div id="result"></div>
            <a class="button" id="morecoin" style="display: none" href="index.php">Swap more coins</a>
            <script>
                interval = setInterval(function () {
                    $("#received").load('getbalance.php?address=' + $.trim($("#address").text()), function (data) {
                        if (data > 0){
                            $('#claim,#claimwarning').show();
                            
                            //clearInterval(interval);
                            //we don't clear the interval in case the user wants to send more coins to the same address
                        }
                    });
                }, 3000)
                if ($("#received").text()==="0") $('#claim').hide();
            </script>
            <?php } else if ($result == 'firstTime') {?>

            <form id="youraddress" method="GET" action="index.php">
                <h1>Paste new educoin address here.</h1>       
                <div class=explain> We will send your new educoins to this address. Make sure you get this from the 2017 (green) wallet.</div>       
                <div class=explain> <?=floor(getNewWallet()->getbalance())?> new educoins available. If you'd like to swap more than <?=5000*floor(getNewWallet()->getbalance())?> old coins, please <a href="https://educoins.io/#contact">contact us.</a></div>       
                <input type="text" class="wallet" name="hisAddress"></input><br>
                <button class="button">submit</button>
            </form>
        </div>
        <?php } else { ?>
        <div id="error">Unknown error</div>
        <?php } ?>
    </body>
</html>