<?php
  session_start();
  require('php/header.php');
?>

<link href="css/jumbotron.css" rel="stylesheet">
<link href="css/index.css" rel="stylesheet">

<?php require('php/navbar.php'); ?>
<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
  <div class="container jumbotron_area">
    <div class="col-sm-6 col-md-4">
      <img id="jumbotron_cover"/>
    </div>
    <div class="col-sm-6 col-md-8">
    <div id="jumbotron_textarea">
    </div>
    <p>
      <div class="dropdown">
      Quantity:
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      1
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item">2</a>
        <a class="dropdown-item">3</a>
        <a class="dropdown-item">4</a>
      </div>
      </div>

    </p>
    <p><a class="btn btn-primary btn-lg" href="checkout.php" role="button">Buy Now</a></p>
    </div>
  </div>
</div>

<div class="container">

  <div class="row" id="demo">
  </div>

  <hr>

  <footer>
    <p>&copy; 2016 Company, Inc.</p>
  </footer>
</div> <!-- /container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/index.js" /></script>
</body>
</html>
