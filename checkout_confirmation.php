<?php
ob_start();
  session_start();
  require('php/header.php');

  if (empty($_SESSION["user_id"])) {
    header('Location: signin.php');
    exit();
  }else if(filter_input(INPUT_POST, 'form_purchase')){
    updateBook($_SESSION["book_id"], $conn);
    header('Location: thank_you.php');
    exit();      
  }

  if(!empty($_SESSION["card_name"])){
      $card_name = $_SESSION["card_name"]; 
      echo 'card name not empty block';
  }else{     
      $card_name = "No Card Name Given";
  }
    
  if(!empty($_SESSION["card_number"])){
      $card_last_four = substr($_SESSION["card_number"], -4);

  }else{
          $card_last_four = "No Card Number Given";

  }
?>

<div class="container">
    <h1>Confirm Your Purchase:</h1>
 <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

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
     
        <fieldset>
        <legend>Address:</legend>
        <?php
          $address_row = getUserAddress($_SESSION["user_id"], $conn);
        ?>
        
        <div class="form-group row">
          <div class="col-md-6">
            <input type="text" class="form-control" id="address" name="street_address" placeholder="Address" value="<?php if($address_row){echo $address_row["street"];}else{echo $_SESSION["street"];} ?>">
          </div>
            
        </div> 

        <div class="form-group row">
          <div class="col-md-2">
            <input type="text" class="form-control" name="city_address" id="city" placeholder="City" value="<?php if($address_row){echo $address_row["city"];}else{echo $_SESSION["city"];}  ?>">
          </div>
          <div class="col-md-2">
            <input type="text" class="form-control" name="state_address" id="state" placeholder="State" value="<?php if($address_row){echo $address_row["state"];}else{echo $_SESSION["state"];}  ?>">
          </div>
          <div class="col-md-2">
            <input type="text" class="form-control" name="zip_code_address" id="zipcode" placeholder="Zip Code" value="<?php if($address_row){echo $address_row["zipcode"];}else{echo $_SESSION["zipcode"];}  ?>">
          </div>
        </div>

        </fieldset>

          <fieldset>
           <legend>Payment Info:</legend>
          <div class="form-group row">
            <div class="col-md-6">
                <input type="text" class="form-control" name="card_name" id="card_name" placeholder="<?php if(empty($card_name)){echo "No Card Name";}else{echo $card_name;} ?>">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-md-6">
                <input type="text" class="form-control"  name="card_number" id="card_number" placeholder="<?php if(empty($card_last_four)){echo "No Card Number";}else{echo "xxxx-xxxx-xxxx-" . $card_last_four;} ?>">
            </div>
          </div>
              <input type="hidden" name="form_purchase" value="purchase">
          </fieldset>

        <div class="form-group"> 
            <div class="col-sm-10">
              <button type="submit" class="btn btn-default">Buy</button>
            </div>
          </div>
      </form>
</div>


</body>
</html>