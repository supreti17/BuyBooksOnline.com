<?php
  ob_start();
  session_start();
  require('php/header.php');

  if (empty($_SESSION["user_id"])) {
    header('Location: signin.php');
    exit();
  }
?>

        <div class="container">
            <h1>Thank You For Your Purchase</h1>

             <div>
                <?php
                  $book_row = getBook($_SESSION["book_id"], $conn);
                ?>
                <h3><?php if($book_row){echo $book_row["title"];}?></h3>
                <p>$<?php if($book_row){echo $book_row["price"];}?></p>
                <div class="checkout_conf_book">
                    <img alt="Picture of <?php if($book_row){echo $book_row["title"];}?>" src="<?php if($book_row){echo $book_row["image"];}?>">
                    <p><?php if($book_row){echo $book_row["description"];}?></p>
                </div>
                </div>     

                <div class="address_thanks">
                <h3>Shipped to:</h3>
                <?php
                  $address_row = getUserAddress($_SESSION["user_id"], $conn);
                ?>


                    <uL>
                        <li>Name: <?php if($address_row){echo $address_row["card_name"];}else{echo $_SESSION["card_name"];} ?></li>                
                        <li>Address: <?php if($address_row){echo $address_row["street"] . ", ", $address_row["city"] . ", ",$address_row["state"] . " ",$address_row["zipcode"];}else{echo $_SESSION["street"] . ", ",$_SESSION["city"] . ", ",$_SESSION["state"] . " ",$_SESSION["zipcode"];} ?></li>
                    </uL>
                </div> 

                <div class="payment_thanks">
                    <h3>Payment Info:</h3>
                    <ul>
                        <li>Name:<?php if(empty($card_name)){echo "No Card Name";}else{echo $card_name;} ?></li>
                        <li>Card: ####-####-####-<?php if(empty($card_last_four)){echo "No Card Number";}else{echo "xxxx-xxxx-xxxx-" . $card_last_four;} ?></li>
                    </ul>
                </div>

        </div> 



    </body>
</html>

