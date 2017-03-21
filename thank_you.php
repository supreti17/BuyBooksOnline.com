<?php
session_start();
require('php/connection.php');
require('php/functions.php');

if (empty($_SESSION["cart_items"]) || empty($_SESSION["address"]) || empty($_SESSION["payment"])) {
    header('Location: index.php');
    exit();
} else {
    updateBookQuantity($_SESSION["cart_items"], $conn);
    $_SESSION["address"]    = array();
    $_SESSION["payment"]    = array();
    $_SESSION["cart_items"] = array();
}

require('php/header.php');
?> 

<div class = "body_area"> 
  <div class="container"> 
    <br><br> 
      <div class="jumbotron"> 
        <div class="container"> 
          <h1>Thank You!</h1> 
          <p>Your order has been placed. 
          Your order has been received. You'll receive an email corfirmation shortly.</p> 
        </div>  
      </div> 
  </div> 
</div> 

<?php include 'php/footer.php'; ?> 