<?php
  session_start();
  require('php/header.php');
  require('php/connection.php');
  require('php/checkout_functions.php');

  if (empty($_SESSION["user_id"]) || empty($_SESSION["username"])) {
    header('Location: signin.php');
    exit();
  }

  $address_error = "";
  $card_error = "";

  if (!isset($_SESSION['address'])) {
    $_SESSION['address'] = array();
  } else if (!isset($_SESSION['payment'])) {
    $_SESSION['payment'] = array();
  }

  $action = filter_input(INPUT_POST, "checkout_info");

  switch($action) {

    case "check_info":
      // Get inputed address information
      $street_address = filter_input(INPUT_POST, "street_address");
      $city_address = filter_input(INPUT_POST, "city_address");
      $state_address = filter_input(INPUT_POST, "state_address");
      $zip_code_address = filter_input(INPUT_POST, "zip_code_address", FILTER_VALIDATE_INT);
      $remember_address = filter_input(INPUT_POST, "remember_address");

      // Get inputed card information
      $card_name = filter_input(INPUT_POST, "card_name");
      $card_number = filter_input(INPUT_POST, "card_number", FILTER_VALIDATE_INT);
      $card_exp_month = filter_input(INPUT_POST, "card_exp_month", FILTER_VALIDATE_INT);
      $card_exp_year = filter_input(INPUT_POST, "card_exp_year", FILTER_VALIDATE_INT);
      $card_cvv_number = filter_input(INPUT_POST, "card_cvv_number", FILTER_VALIDATE_INT);
      if (!empty($card_number)) {
        $card_last_four = substr(filter_input(INPUT_POST, "card_number"), -4);
      }

      // Check if any of address form input is empty
      $address_is_valid = !empty($street_address) && !empty($city_address) 
                          && !empty($state_address) && !empty($zip_code_address);

      // Check if any of card info form input is empty
      $card_is_valid = !empty($card_name) && !empty($card_number) && !empty($card_exp_month) 
                       && !empty($card_exp_year) && !empty($card_cvv_number);

      // If inputed address is not valid
      if (!$address_is_valid) {
        $address_error = "Please input a valid address!";
      // If inputed card info is not valid
      } else if (!$card_is_valid) {
        $card_error = "Please input a valid card information!";
      // If both are valid
      } else {
        if ($remember_address === "YES") {
          // Remember user address
          addAddress($street_address, $city_address, $state_address, $zip_code_address, $conn);
          $address_row = getUserAddress($_SESSION["user_id"], $conn);
          if (!empty($address_row)) {
             $_SESSION["address"][] = $address_row;
           }
        } else {

          // Temporarily store address information
          $_SESSION["address"][] = array(
              'street' => $street_address,
              'city' => $city_address,
              'state' => $state_address,
              'zipcode' => $zip_code_address
              );

          // Temporarily store card information
          $_SESSION["payment"][] = array(
              'name' => $card_name,
              'number' => $card_number,
              'exp_month' => $card_exp_month,
              'exp_year' => $card_exp_year,
              'cvv_number' => $card_cvv_number);
          // Direct to the checkout confirmation page
          header('Location: checkout_confirmation.php');
          exit();
      }
    }
      break;
  }

  $address_row = getUserAddress($_SESSION["user_id"], $conn);

?>
    <link href="css/jumbotron.css" rel="stylesheet">
    <link href="css/checkout.css" rel="stylesheet">

    <?php require('php/navbar.php') ?>

    <div class="container">

      <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

        <fieldset>
        <legend>Address:</legend>
        <?php if (!empty($address_error)): ?>
          <div class="alert alert-danger">
            <strong><?php echo $address_error; ?></strong>
          </div>
        <?php endif; ?>

        <div class="form-group row">
          <div class="col-md-6">
            <input type="text" class="form-control" id="address" name="street_address" placeholder="Address" value="<?php echo $address_row["street"]; ?>">
          </div>
        </div>

        <div class="form-group row">
          <div class="col-md-2">
            <input type="text" class="form-control" name="city_address" id="city" placeholder="City" value="<?php echo $address_row["city"]; ?>">
          </div>
          <div class="col-md-2">
            <input type="text" class="form-control" name="state_address" id="state" placeholder="State" value="<?php echo $address_row["state"]; ?>">
          </div>
          <div class="col-md-2">
            <input type="text" class="form-control" name="zip_code_address" id="zipcode" placeholder="Zip Code" value="<?php echo $address_row["zipcode"]; ?>">
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
           <?php if (!empty($card_error)): ?>
            <div class="alert alert-danger">
              <strong><?php echo $card_error; ?></strong>
            </div>
          <?php endif; ?>
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
              <input type="password" class="form-control"  name="card_cvv_number" id="cvv_number" placeholder="Security Code">
            </div>
          </div>
          </fieldset>

        <div class="form-group"> 
            <div class="col-sm-10">
              <button type="submit" name="checkout_info" class="btn btn-default" value="check_info">Submit</button>
            </div>
          </div>
      </form>
    </div>

</body>
</html>