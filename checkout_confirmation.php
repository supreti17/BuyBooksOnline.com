<?php
  $lifetime = 60 * 60 * 24; // stores session for 1 day
  session_set_cookie_params($lifetime);
  session_start();
  require('php/header.php');
  require('php/connection.php');
  require('php/cart_functions.php');

  $cart_error = "";
  $cart_success = "";
  $total = 0;

  if (!isset($_SESSION['cart_items'])) {
    $_SESSION['cart_items'] = array();
  }

  $action = filter_input(INPUT_POST, "cart");
  switch ($action) {
    case "add_item_to_cart":
      $quantity = filter_input(INPUT_POST, "quantity");
      $book_id = filter_input(INPUT_POST, "book_id");
      $book_title = filter_input(INPUT_POST, "book_title");
      if (!empty($book_id)) {
        if (!search_item_in_cart($book_title, $_SESSION["cart_items"])) {
          $book_found = getBook($book_id, $conn);
          $_SESSION["cart_items"][] = add_item_to_cart($book_found, $quantity);
          $cart_success = $book_title . " book added to the cart.";
        } else {
          $cart_error = $book_title . " book is already in the cart. Please enter a quantity and click update button to order more books.";
        }
        
      }
      break;

    case "remove_item_from_cart":
       $book_to_remove = filter_input(INPUT_POST, "book_to_remove");
      if (!empty($book_to_remove)) {
        $key = get_item_key($book_to_remove, $_SESSION["cart_items"]);
        unset($_SESSION["cart_items"][$key]);
      }
      break;

    case "update_item_in_cart":
      $book_to_update = filter_input(INPUT_POST, "book_to_update");
      $quantity = filter_input(INPUT_POST, "book_quantity", FILTER_VALIDATE_INT);
      if (!empty($book_to_update) || !empty($quantity)) {
        $key = get_item_key($book_to_update, $_SESSION["cart_items"]);
        $_SESSION["cart_items"][$key] = add_item_to_cart($_SESSION["cart_items"][$key], $quantity);
      }
      break;

    default:
      break;
  }
?>
    <link href="css/jumbotron.css" rel="stylesheet">
    <link href="css/checkout.css" rel="stylesheet">

    <?php require('php/navbar.php') ?>

    <div class="container">
      <br>
    <?php if (!empty($cart_success)): ?>
      <div class="alert alert-success">
        <strong>Successful! <?php echo $cart_success; ?></strong>
    </div>
  <?php elseif (!empty($cart_error)): ?>
    <div class="alert alert-warning">
        <strong><?php echo $cart_error; ?></strong>
    </div>
  <?php endif; ?>

      <h1>Checkout Confirmation</h1>

      <div class="container">
      <h3>
        <span>Shopping Cart (<?php $items_count = count($_SESSION["cart_items"]);
                              echo $items_count;
                              if ($items_count <= 1) {
                                echo " item";
                              } else {
                                echo " items";
                              } ?>)</span>
      <?php if (!isset($_SESSION["cart_items"]) || empty($_SESSION["cart_items"])): ?>
      </h3>
      <hr>
        <p>No items added in the cart!</p>
      <?php else: ?>
        </h3>
        <hr>
        <?php foreach ($_SESSION["cart_items"] as $item) { ?>
          <div class="row">
          <div class="col-sm-6 col-md-1">
            <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>" width=100 height=100>
          </div>
          <div class="col-sm-6 col-md-10">
            <h5>
              <span><?php echo $item['title']; ?></span>
              <form method="POST" action="cart.php">
                <input type="hidden" id="book_title" class="form-control" name="book_to_remove" value="<?php echo $item['title']; ?>">
                <input type="hidden" name="cart" class="form-control" value="remove_item_from_cart">
                <input type="submit" class='btn btn-danger btn-sm pull-right' value="Remove">
              </form>
            </h5>
            <p>Price: $<?php echo $item['price']; ?></p>
            <p>Quantity: <?php echo $item['quantity']; ?></p>
            <?php $total += $item['subtotal']; ?>
          </div>
          </div>
        </div>
        <div class="container">
        <hr>
      <?php
        }
       endif; ?>
    </div>

    <div class="container">
    <h3>Address</h3>
      <p><?php echo $_SESSION["address"][0]["street"]; ?></p>
      <p><?php echo $_SESSION["address"][0]["city"] . ", " . $_SESSION["address"][0]["state"] . " " . $_SESSION["address"][0]["zipcode"]; ?></p>
    </div>

    <div class="container">
    <hr>
    <h3>Payment</h3>
      <p>Name:<?php echo $_SESSION["payment"][0]["name"]; ?></p>
      <p>Card Number: <?php echo $_SESSION["payment"][0]["number"]; ?></p>
      <p>Expiration Date: <?php echo $_SESSION["payment"][0]["exp_month"] . "/" . $_SESSION["payment"][0]["exp_year"]; ?></p>
      <p><?php echo $_SESSION["payment"][0]["cvv_number"]; ?></p>
    </div>

    <div class="container">
    <hr>
      <?php if (isset($_SESSION["cart_items"]) && !empty($_SESSION["cart_items"])): ?>
        <div class="row">
          <div class="col-sm-6 col-md-2">
            <h4> Subtotal: </h4>
          </div>
        <div class="col-sm-6 col-md-8">
          <h4 class="pull-right">$<?php echo $total; ?></h4>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6 col-md-2">
            <h4> Tax: </h4>
          </div>
        <div class="col-sm-6 col-md-8">
          <h4 class="pull-right">$<?php echo round($total * 0.096, 2); ?></h4>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6 col-md-2">
            <h4> Total: </h4>
          </div>
        <div class="col-sm-6 col-md-8">
          <h4 class="pull-right">$<?php echo $total + round($total * 0.096, 2); ?></h4>
        </div>
      </div>
    <?php endif; ?>

    <a href="thank_you.php" class='btn btn-primary btn-lg btn-block'>Place Order</a>
    </div>
    </div>

    </div>

</body>
</html>