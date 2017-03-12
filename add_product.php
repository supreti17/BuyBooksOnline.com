<?php
ob_start();
  session_start();
  require('php/header.php');
  require('php/connection.php');
  require('php/checkout_functions.php');

  if (empty($_SESSION["user_id"]) || $_SESSION["usertype_id"] !== '1') {
    header('Location: signin.php');
    exit();
  }

  //Image Upload
  $target_dir = "images/";
  $target_file = $target_dir . basename($_FILES["book_img"]["name"]);
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["book_img"]["tmp_name"]);
    if($check === false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
  }

  // Check if file already exists
  if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
      if (move_uploaded_file($_FILES["book_img"]["tmp_name"], $target_file)) {
          echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
      } else {
          echo "Sorry, there was an error uploading your file.";
      }
  }

  $book_title = filter_input(INPUT_POST, "book_title");
  $book_description = filter_input(INPUT_POST, "book_description");
  $book_price = filter_input(INPUT_POST, "book_price");
  $book_img = "images/" . basename( $_FILES["book_img"]["name"]);
  if (!empty($book_title) && !empty($book_description) && !empty($book_price) && !empty($book_img)) {
    addProduct($book_title, $book_description, $book_price, $book_img, $conn);
  }


  function addProduct($book_title, $book_description, $book_price, $book_img, $conn) {
  $sql = "INSERT INTO Books (title, description, price, image) 
            VALUES ('".$book_title."', '".$book_description."', '".$book_price."', '".$book_img."')";
  if ($conn->query($sql) !== TRUE) {
    global $login_error;
    $login_error = "Error adding a product!";
  }
  $conn->close();
}

?>
    <link href="css/jumbotron.css" rel="stylesheet">
    <link href="css/checkout.css" rel="stylesheet">

    <?php require('php/navbar.php') ?>

    <div class="container">

      <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  enctype="multipart/form-data">

        <fieldset>
          <legend>Add a Product:</legend>
        
          <div class="form-group row">
            <div class="col-md-6">
              <input type="text" class="form-control" id="book_title" name="book_title" placeholder="Book Title">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-md-6">
                <input type="text" class="form-control" name="book_description" id="book_description" placeholder="Book Description">
            </div>
          </div>

          <div class="form-group row">
            <div class="col-md-6">
                <input type="text" class="form-control"  name="book_price" id="book_price" placeholder="Book Price">
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-6">
                <input type="file" class="form-control"  name="book_img" id="book_img">
            </div>
          </div>

        </fieldset>

        <div class="form-group"> 
            <div class="col-sm-10">
              <button type="submit" name="submit" class="btn btn-default">Submit</button>
            </div>
          </div>
      </form>
    </div>

</body>
</html>