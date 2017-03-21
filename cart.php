<?php
$lifetime = 60 * 60 * 24; // stores session for 1 day
session_set_cookie_params($lifetime);
session_start();
require('php/connection.php');
require('php/functions.php');

$cart_error   = "";
$cart_success = "";
$total        = 0;

if (!isset($_SESSION['cart_items'])) {
  $_SESSION['cart_items'] = array();
}

$action = filter_input(INPUT_POST, "cart");
switch ($action) {
    case "add_item_to_cart":
      $quantity   = filter_input(INPUT_POST, "quantity");
      $book_id    = filter_input(INPUT_POST, "book_id");
      $book_title = filter_input(INPUT_POST, "book_title");
      if (!empty($book_id)) {
          if (!search_item_in_cart($book_title, $_SESSION["cart_items"])) {
              $book_found               = getBook($book_id, $conn);
              $_SESSION["cart_items"][] = add_item_to_cart($book_found, $quantity);
              $cart_success             = $book_title . " book added to the cart.";
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
      $quantity       = filter_input(INPUT_POST, "book_quantity", FILTER_VALIDATE_INT);
      if (!empty($book_to_update) || !empty($quantity)) {
          $key                          = get_item_key($book_to_update, $_SESSION["cart_items"]);
          $_SESSION["cart_items"][$key] = add_item_to_cart($_SESSION["cart_items"][$key], $quantity);
      }
      break;
    
    default:
      break;
}
require('php/header.php');
?>
  <div class = "body_area">
    <div class="container">
    	<br>
    <?php if (!empty($cart_success)): ?>
    	<div class="alert alert-success">
  			<strong>Successful! <?php echo htmlspecialchars($cart_success); ?></strong>
		</div>
	<?php elseif (!empty($cart_error)): ?>
		<div class="alert alert-warning">
  			<strong><?php echo htmlspecialchars($cart_error); ?></strong>
		</div>
	<?php endif; ?>

    	<h1>
    		<span>Shopping Cart (<?php $items_count = count($_SESSION["cart_items"]);
                              echo htmlspecialchars($items_count);
                              if ($items_count <= 1) {
                                echo " item";
                              } else {
                                echo " items";
                              } ?>)</span>
    	<?php if (!isset($_SESSION["cart_items"]) || empty($_SESSION["cart_items"])): ?>
    	</h1>
    	<hr>
    		<p>No items added in the cart!</p>
    	
    	<?php else: ?>
    		<a href="checkout.php" class='btn btn-default pull-right'>Proceed to Checkout</a>
    		</h1>
    		<hr>
    		<?php foreach ($_SESSION["cart_items"] as $item) { ?>
    			<div class="row">
    			<div class="col-sm-6 col-md-2">
			    	<img src="<?php echo $item['image']; ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" width=150 height=150>
			    </div>
			    <div class="col-sm-6 col-md-8">
			    	<h3>
			    		<span><?php echo htmlspecialchars($item['title']); ?></span>
			    		<form method="POST" action="cart.php">
				    		<input type="hidden" id="book_title" class="form-control" name="book_to_remove" value="<?php echo htmlspecialchars($item['title']); ?>">
				    		<input type="hidden" name="cart" class="form-control" value="remove_item_from_cart">
				    		<input type="submit" class='btn btn-danger pull-right' value="Remove">
			    		</form>
			    	</h3>
			    	<p>Price: $<?php echo htmlspecialchars($item['price']); ?></p>
			    	<?php $total += $item['subtotal']; ?>

			    	<form method="POST" action="cart.php">
					<div class="row">
					  <div class="col-md-4">
					    <div class="input-group">
					    <span class="input-group-addon">Quantity:</span>
					      <input type="text" class="form-control" name="book_quantity" placeholder="<?php echo htmlspecialchars($item['quantity']); ?>">
					      <span class="input-group-btn">
					    		<input type="hidden" class="form-control" name="book_to_update" value="<?php echo htmlspecialchars($item['title']); ?>">
					    		<input type="hidden" name="cart" class="form-control" value="update_item_in_cart">
					    		<input type="submit" class='btn btn-default' value="Update">
					      </span>
					    </div>
					  </div>
					  </form>
					</div>
			    </div>
				</div>
				<hr>
    	<?php
    		}
    	 endif; ?>
    	 <?php if (isset($_SESSION["cart_items"]) && !empty($_SESSION["cart_items"])): ?>
    	 	<div class="row">
	    	 	<div class="col-sm-6 col-md-2">
	    	 		<h4> Subtotal: </h4>
	    	 	</div>
				<div class="col-sm-6 col-md-8">
					<h4 class="pull-right">$<?php echo htmlspecialchars($total); ?></h4>
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
    </div>
  </div>

 <?php include 'php/footer.php'; ?>