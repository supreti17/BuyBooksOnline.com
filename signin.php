<?php
session_start();
require('php/connection.php');
require('php/functions.php');
require('php/header.php');

$action = filter_input(INPUT_POST, 'action');

$login_error = "";

switch ($action) {
    case 'sign_in_form':
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        checkUser($username, $password, $conn);
        break;
    
    case 'sign_out':
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit();
        break;
    
    case 'sign_up_form':
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        $email    = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $usertype = filter_input(INPUT_POST, 'usertype', FILTER_VALIDATE_INT);
        addUser($email, $username, $password, $usertype, $conn);
        break;
}

?> 
<div class="signin_page"> 

  <div class="container signin_page"> 

    <form class="form-signin" id="signin_form" method="post" action="<?php
      echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> "> 
      <h2 class="form-signin-heading">Sign In</h2> 
      <?php if (!empty($login_error)): ?> 
      <div class="alert alert-danger"> 
        <strong><?php echo $login_error; ?></strong> 
      </div> 
      <?php endif; ?>
      <label for="inputUsername" class="sr-only">Username</label> 
      <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus> 
      <label for="inputPassword" class="sr-only">Password</label> 
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required> 
      <button id = "sign_in_btn" class="btn btn-lg btn-primary btn-block btn-success" type="submit" name="action" value="sign_in_form">Sign in
      </button> 
      <p id="sign_up_text">Don't have an account? Sign Up here!</p> 
    </form> 

    <form class="form-signin" id="signup_form" method="post" action="<?php
      echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 
      <h2 class="form-signin-heading">Sign Up</h2> 
      <label for="inputEmail" class="sr-only">Email address</label> 
      <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus> 
      <label for="inputUsername" class="sr-only">Username</label> 
      <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Username" required> 
      <label for="inputPassword" class="sr-only">Password</label> 
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required> 
      <input type="hidden" name="usertype" value="2" /> 
      <button class="btn btn-lg btn-primary btn-block btn-success" type="submit" name="action" value="sign_up_form">Sign Up
      </button> 
      <p id="sign_in_text">Already have an account? Sign In here!</p> 
    </form> 
  </div> 
</div> 

<script type="text/javascript" src="js/signin.js" /></script> 
     
<?php include 'php/footer.php'; ?> 