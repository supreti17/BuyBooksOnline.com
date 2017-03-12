<?php
  require('php/connection.php');
  require('php/functions.php');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Buy Books Online</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

  </head>

  <body>
    <header>  
        <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.php">Buy A Book!</a>
            </div>
            <?php if ($_SESSION["usertype_id"] === '1'): ?>
            <ul class="nav navbar-nav">
              <li>
                <a href="add_product.php">Add Product</a>
              </li>
            </ul>
          <?php endif; ?>
            <div id="navbar" class="navbar-collapse collapse">
              <form class="navbar-form navbar-right" method="post" action="signin.php">
              <?php if (!$_SESSION["username"]): ?>
                <button type="submit" class="btn btn-success" name="action" value="sign_in">Sign in</button>
                </form>
              <?php else: ?>
                <button type="submit" class="btn btn-success" name="action" value="sign_out">Sign Out</button>
                </form>
                <span class="navbar-text navbar-right"><?php echo $_SESSION["username"]; ?></span>
              <?php endif; ?>
            </div>
          </div>
        </nav>
    </header>