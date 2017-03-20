<?php

function getBook($book_id, $conn) {
    $sql = "SELECT id, title, description, price, image FROM Books 
            WHERE id = '". $book_id . "'";
  $result = $conn->query($sql);
  if ($result->num_rows) {
    $row = $result->fetch_assoc();
    return $row;
  } else {
    return '';
  }
  $conn->close();
  }
  
  function updateBookQuantity($book_id, $conn){    
    $sql = "UPDATE books
            SET inventory = inventory - 1
            WHERE id = " . $book_id . "";
    
    $conn->query($sql);
    $conn->close();
  }

  function add_item_to_cart($item, $quantity) {
    $subtotal = $item["price"] * $quantity;
    $product = array(
      'book_id' => $item['id'],
      'title' => $item['title'],
      'image' => $item['image'],
      'price' => $item['price'],
      'quantity' => $quantity,
      'subtotal' => $subtotal);
    return $product;
  }

  function search_item_in_cart($item_title, $cart) {
    foreach ($cart as $item) {
      if (strcmp($item["title"], $item_title) === 0) {
       return true;
      }
    }
    return false;
  }

  function get_item_key($item_title, $cart) {
    foreach ($cart as $key=>$item) {
      if (strcmp($item["title"], $item_title) === 0) {
       return $key;
      }
    }
    return '';
  }

?>