<?php
ob_start();
  session_start();
  require('php/header.php');

  if (empty($_SESSION["user_id"])) {
    header('Location: signin.php');
    exit();
  }else if(filter_input(INPUT_POST, 'form_valid')){
    header('Location: checkout_confirmation.php');
    exit();      
  }
  
  $book_id = filter_input(INPUT_POST,"book_id");
  
  if(!empty($book_id)) {
      $_SESSION["book_id"] = $book_id;
  }
  
  
  $street_address = filter_input(INPUT_POST, "street_address");
  $city_address = filter_input(INPUT_POST, "city_address");
  $state_address = filter_input(INPUT_POST, "state_address");
  $zip_code_address = filter_input(INPUT_POST, "zip_code_address");
  $remember_address = filter_input(INPUT_POST, "remember_address");

  echo filter_input(INPUT_POST, "card_name");
  $card_name = filter_input(INPUT_POST, "card_name");
  $card_number = filter_input(INPUT_POST, "card_number");
  $card_exp_month = filter_input(INPUT_POST, "card_exp_month");
  $card_exp_year = filter_input(INPUT_POST, "card_exp_year");
  $card_cvv_number = filter_input(INPUT_POST, "card_cvv_number");
  $card_last_four = substr(filter_input(INPUT_POST, "card_number"), -4); 

  if ($remember_address === "YES") {
    addAddress($street_address, $city_address, $state_address, $zip_code_address, $conn);
  } else {
    $_SESSION["street"] = $street_address;
    $_SESSION["city"] = $city_address;
    $_SESSION["state"] = $state_address;
    $_SESSION["zipcode"] = $zip_code_address;
  }

  echo $card_name, $card_number, $card_last_four,$card_exp_month,$card_exp_year,$card_cvv_number;
  
  if (!empty($card_name) && !empty($card_number) && !empty($card_exp_month) && !empty($card_exp_year) && !empty($card_cvv_number)) {
    $_SESSION["card_name"] = $card_name;
    $_SESSION["card_number"] = $card_number;
    $_SESSION["card_last_four"] = $card_last_four;
    $_SESSION["card_exp_month"] = $card_exp_month;
    $_SESSION["card_exp_year"] = $card_exp_year;
    $_SESSION["card_cvv_number"] = $card_cvv_number;
  }

?>

    <div class="container">

      <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

        <fieldset>
        <legend>Address:</legend>
        <?php
          $address_row = getUserAddress($_SESSION["user_id"], $conn);
        ?>
        
        <div class="form-group row">
          <div class="col-md-6">
            <input type="text" class="form-control" id="address" name="street_address" placeholder="Address" value="<?php if($address_row){echo $address_row["street"];} ?>">
          </div>
        </div>

        <div class="form-group row">
          <div class="col-md-2">
            <input type="text" class="form-control" name="city_address" id="city" placeholder="City" value="<?php if($address_row){echo $address_row["city"];} ?>">
          </div>
          <div class="col-md-2">
            <input type="text" class="form-control" name="state_address" id="state" placeholder="State" value="<?php if($address_row){echo $address_row["state"];} ?>">
          </div>
          <div class="col-md-2">
            <input type="text" class="form-control" name="zip_code_address" id="zipcode" placeholder="Zip Code" value="<?php if($address_row){echo $address_row["zipcode"];} ?>">
          </div>
        </div>

        <div class="form-group"> 
          <div class="col-md-10">
            <div class="checkbox">
              <label><input type="checkbox" name="remember_address" value="YES">Remember this address</label>
            </div>
          </div>
        </div>
        </fieldset>

          <fieldset>
           <legend>Payment Info:</legend>
          <div class="form-group row">
            <div class="col-md-6">
                <input type="text" class="form-control" name="card_name" id="card_name" placeholder="Card Holder's Name">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-md-6">
                <input type="text" class="form-control"  name="card_number" id="card_number" placeholder="Debit/Credit Card Number">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-md-2">
              <input type="text" class="form-control"  name="card_exp_month" id="expiration_month" placeholder="Expiration Month">
            </div>
             <div class="col-md-2">
              <input type="text" class="form-control"  name="card_exp_year" id="expiration_year" placeholder="Expiration Year">
            </div>
            <div class="col-md-2">
              <input type="text" class="form-control"  name="card_cvv_number" id="cvv_number" placeholder="Security Code">
              <input type="hidden" name="form_valid" value="valid">
            </div>
          </div>
          </fieldset>

        <div class="form-group"> 
            <div class="col-sm-10">
              <button type="submit" class="btn btn-default">Submit</button>
            </div>
          </div>
      </form>
    </div>

</body>
</html>