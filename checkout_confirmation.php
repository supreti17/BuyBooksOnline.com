<?php
  session_start();
  require('php/header.php');
  require('php/connection.php');
  require('php/checkout_functions.php');

  if (empty($_SESSION["user_id"])) {
    header('Location: signin.php');
    exit();
  }

?>

<link href="css/jumbotron.css" rel="stylesheet">
<link href="css/checkout.css" rel="stylesheet">

<?php require('php/navbar.php'); ?>

<div class="container">

      <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      	<fieldset>
        	<legend>Address:</legend>
        	<p>
      	</fieldset>
      </form>
</div>


</body>
</html>