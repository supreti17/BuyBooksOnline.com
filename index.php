<?php
session_start();
require('php/header.php');
?> 
<div class = "body_area"> 
<!-- Main jumbotron for a primary marketing message or call to action --> 
  <div class="jumbotron"> 
    <div class="container jumbotron_area"> 
      <div class="col-sm-6 col-md-4"> 
        <img id="jumbotron_cover"/> 
      </div> 
      <div class="col-sm-6 col-md-8"> 
        <div id="jumbotron_textarea"> 
        </div> 

        <form method="post" action="cart.php"> 
          <div class="row"> 
            <div class="form-group col-md-2"> 
              <label for="quantity">Quantity:</label> 
              <input type="text" name="quantity" class="form-control" id="quantity" value="1"> 
            </div> 
          </div> 
          <div class="row"> 
            <div class="form-group"> 
              <input type="hidden" id="book_id" class="form-control" name="book_id"> 
              <input type="hidden" id="book_title" class="form-control" name="book_title"> 
              <input type="hidden" name="cart" class="form-control" value="add_item_to_cart"> 
              <input type="submit" class="btn btn-primary btn-lg" role="button" value="Add To Cart"> 
            </div> 
          </div> 
        </form> 
      </div> 
    </div> 
  </div> 

  <div class="container"> 
    <div class="row" id="demo"> 
    </div> 
  </div> 
   
</div> 

<script type="text/javascript" src="js/index.js"></script> 

<?php include 'php/footer.php'; ?>