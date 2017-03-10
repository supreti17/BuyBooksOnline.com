<?php

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

?>