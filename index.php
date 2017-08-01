<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Educoin Swap</title>
        <meta name="keywords" content="dogecoin,αγορα dogecoin,mining,bitcoin" />
        <meta name="description" content="Στειλτε sms για να αποκτησετε dogecoins." />        
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" type="text/css" href="style.css">
        <script
            src="https://code.jquery.com/jquery-3.2.1.js"
            integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
        crossorigin="anonymous"></script>
        </script>
        <script>
            $(document).ready(function () {
                $("#youraddress").submit(function (e) {
                    e.preventDefault();
                    if ($(".wallet").val() != "") {
                        $.get('getAddress.php', {address: $(".wallet").val()},
                            function (data) {
                                if (data === 'notValid') {
                                    $('#result').html('This wallet address is wrong.');
                                    setTimeout(function () {
                                        $("#result").html('');
                                    }, 5000);
                                } else {
                                    $("#address").html(data);
                                    $("#youraddress").hide();
                                    $("#sendto").show();

                                    interval = setInterval(function () {
                                        $("#received").load('getbalance.php?address=' + $.trim($("#address").text()), function (data) {
                                            if (data > 0){
                                                $('#claim').show();
                                                clearInterval(interval);
                                            }
                                        });
                                    }, 3000)
                                }
                            }
                        );
                    }
                });
            $("#claim").click(function(){
                $("#result").load("process.php");
                $("#claim").hide();
            })
            
            });
        </script>
    </head>
    <body>
        <div class="container"> 

            <br>
            
            <?php ?>
            <div id="sendto">
                Send your old educoins to this address
                <div id="address">
                    <?php
                    ?>
                </div>
                The 0 below will change to the amount you send to this address. When the transaction is confirmed you will be able to claim your new educoins.
                Keep the browser open until the balance changes, otherwise <strong> your coins will be lost </strong>
                
                <div class='explain'>This will be fixed at a later time and there will be no need to keep the browser open.</div>
            </div>
            
            <div id="received">  
                <?php

                ?>
            </div>
            <button class="button" id="claim">claim</button>

            <form id="youraddress">
                Paste an educoin address here.<br>       
                <div class=explain> This is where you would paste a new_educoin address here if this goes live. I don't have the new wallet now so
                    this will just send you your original educoins back instead of swapping with new coins. However please don't send much, coins might be lost due to bugs</div>       
                <input type="text" class="wallet"></input><br>
                <button class="button">submit</button>
            </form>
            <div id=result> </div>
        </div>

    </body>
</html>