<?php
// define variables and set to empty values
$login_error = $usernameErr = $passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $action = filter_input(INPUT_POST, "submit");

    switch($action) {

        case "Logout":
            setcookie("username", "", time()-3600);
            unset($_COOKIE["username"]);
            header('Location: index.php');
            die();
            break;

        case "Login":
            $servername = "localhost";
            $sql_username = "icoolsho_supreti";
            $sql_password = "AD320";
            $sql_dbname = "icoolsho_supreti";

            // Create connection
            $conn = new mysqli($servername, $sql_username, $sql_password, $sql_dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (empty($_POST["username"])) {
                $usernameErr = "username is required";
            } else if (empty($_POST["password"])) {
                $passwordErr = "Password is required";
            } else {
                $password = $_POST["password"];
                $username = $_POST["username"];
                checkUser($username, $password, $conn);
            }
            break;
    }
}

function checkUser($username, $password, $conn) {
  $sql = "SELECT id, username, password FROM Users
      WHERE username='".$username."' AND password='".$password."' LIMIT 1";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    setcookie("username", $row["username"], time() + 3600);
    if (isset($_POST["remember"])) {
        setcookie("remember_my_username", $row["username"], time() + 31536000);
        setcookie("remember_my_password", $row["password"], time() + 31536000);
    } else {
        if (isset($_COOKIE["remember_my_username"]) && isset($_COOKIE["remember_my_password"])) {
            setcookie("remember_my_username", "", time()-3600);
            setcookie("remember_my_password", "", time()-3600);
            unset($_COOKIE["remember_my_username"]);
            unset($_COOKIE["remember_my_password"]);
        }
    }
    header("Location: index.php");
    die();
  } else {
    global $login_error;
    $login_error = "Incorrect username or password! Please try again!";
  }
  $conn->close();
}

?>

<!DOCTYPE HTML>
<html>
<head>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>

<?php if (isset($_COOKIE["username"]) && !empty($_COOKIE["username"])): ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <p><?php echo "Welcome " .  $_COOKIE["username"]; ?>
        <span><input type="submit" name="submit" value="Logout"></p>
    </form>
    <?php include 'main.php'; ?>
<?php else: ?>
    <h2>Login:</h2>
    <p><span class="error">* required field.</span></p>
    <?php if (!empty($login_error)): ?>
        <p><span class="error"><?php echo $login_error; ?></span></p>
    <?php endif; ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Username: <input type="text" name="username" placeholder="Username" value="<?php echo $_COOKIE['remember_my_username']; ?>" >
        <span class="error">* <?php echo $usernameErr;?></span>
        <br><br>
        Password: <input type="password" name="password" placeholder="password" value="<?php echo $_COOKIE['remember_my_password']; ?>">
        <span class="error">* <?php echo $passwordErr;?></span>
        <br><br>
        Remember Me 
        <?php if (isset($_COOKIE["remember_my_username"]) && isset($_COOKIE["remember_my_password"])): ?>
            <input type="checkbox" name="remember" checked= "checked">
        <?php else: ?>
            <input type="checkbox" name="remember">
        <?php endif; ?>
        <br><br>
        <input type="submit" name="submit" value="Login">
    </form>
<?php endif; ?>

</body>
</html>