<?php

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
    return '';
  }
  $conn->close();
  }

  function addAddress($street, $city, $state, $zipcode, $conn) {
    $sql = "INSERT INTO Address (street, city, state, zipcode) 
            VALUES ('".$street."', '".$city."', '".$state."', '".$zipcode."')";
    if ($conn->query($sql) === TRUE) {
      echo "Address added!";
    $address_id = checkAddress($street, $city, $state, $zipcode, $conn);
    addUserAddress($address_id["id"], $conn);
    }
    $conn->close();
  }

 function addUserAddress($address_id, $conn) {
    $user_id = $_SESSION["user_id"];
    $sql = "INSERT INTO UserAddress (user_id, address_id) 
            VALUES ('".$user_id."', '".$address_id."')";
    if ($conn->query($sql) === TRUE) {
      
    } else {
      echo "User and Address couldn't be linked!";
    }
    $conn->close();
  }

?>