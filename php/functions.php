<?php

//******************Login Page Functions**********************

// Checks username and password and redirects to index page
function checkUser($username, $password, $conn) {
  $sql = "SELECT id, usertype, username, password FROM Users
      WHERE username='".$username."' AND password='".$password."' LIMIT 1";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION["username"] = $row["username"];
    $_SESSION["user_id"] = $row["id"];
    $_SESSION["usertype_id"] = $row["usertype"];
    header('Location: index.php');
    exit();
  } else {
    global $login_error;
    $login_error = "Incorrect username or password! Please try again!";
  }
  $conn->close();
}

// Adds new user to the database and calls checkUser function
function addUser($email, $username, $password, $usertype, $conn) {
  $sql = "INSERT INTO Users (usertype, username, password, email) 
            VALUES ('".$usertype."', '".$username."', '".$password."', '".$email."')";
  if ($conn->query($sql) === TRUE) {
    checkUser($username, $password, $conn);
  } else {
    global $login_error;
    $login_error = "Please input valid username, password and email!";
  }
  $conn->close();
}

//******************Cart Page Functions**********************

// Returns a book info if book id is in the database
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

  // Returns a book with its details to add in the cart
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

  // Searches for a book in the cart and returns key if found
  function search_item_in_cart($item_title, $cart) {
    foreach ($cart as $item) {
      if (strcmp($item["title"], $item_title) === 0) {
       return true;
      }
    }
    return false;
  }

  // Searches for a book in the cart and returns key if found
  function get_item_key($item_title, $cart) {
    foreach ($cart as $key=>$item) {
      if (strcmp($item["title"], $item_title) === 0) {
       return $key;
      }
    }
    return '';
  }

  //******************Checkout Page Functions******************

  // Checks for address user provided in the database
  function checkAddress($street, $city, $state, $zipcode, $conn) {
    $sql = "SELECT id FROM Address
            WHERE street='".$street."' 
            AND city='".$city."' 
            AND state='".$state."' 
            AND zipcode='".$zipcode."' 
            LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      return $row;
    } else {
      return '';
    }
    $conn->close();
  }

  // Returns user address from the database using the user id
  function getUserAddress($user_id, $conn) {
    $sql = "SELECT * FROM Address a
            INNER JOIN UserAddress ua 
            ON ua.address_id = a.id 
            WHERE ua.user_id = '". $user_id . "' 
            LIMIT 1";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    return $row;
  } else {
    return;
  }
  $conn->close();
  }

  // Adds an address to the database,
  // Calls checkAddress function to get the address id, and 
  // Calls addUserAddress function to link user id with address id
  function addAddress($street, $city, $state, $zipcode, $conn) {
    $sql = "INSERT INTO Address (street, city, state, zipcode) 
            VALUES ('".$street."', '".$city."', '".$state."', '".$zipcode."')";
    if ($conn->query($sql) === TRUE) {
      $address_id = checkAddress($street, $city, $state, $zipcode, $conn);
      addUserAddress($address_id["id"], $conn);
    }
    $conn->close();
  }

  // Links user id with address id in the database
 function addUserAddress($address_id, $conn) {
    $user_id = $_SESSION["user_id"];
    $sql = "INSERT INTO UserAddress (user_id, address_id) 
            VALUES ('".$user_id."', '".$address_id."')";
    if ($conn->query($sql) !== TRUE) {
      echo "User and Address couldn't be linked!";
    }
    $conn->close();
  }

  // Updates the quantity of books
  function updateBookQuantity($items, $conn) {
    foreach ($items as $item) {
      updateInventory($item, $conn);
    }
    $conn->close();
  }

  // Updates the quantity of a book in the database
  function updateInventory($item, $conn) {
    $book_id = $item['book_id'];
    $quantity_to_remove = $item['quantity'];
    $sql = "UPDATE Books
            SET quantity = quantity - $quantity_to_remove 
            WHERE id = $book_id";
    $conn->query($sql);
  }

   //***********************************************************

?>