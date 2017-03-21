<?php
  session_start();
  require('php/connection.php');
  require('php/functions.php');
  require('php/header.php');

  if ((empty($_SESSION["user_id"]) && empty($_SESSION["usertype_id"])) || $_SESSION["usertype_id"] !== '1') {
    header('Location: signin.php');
    exit();
  }

  $add_error = "";
  $add_success = "";

  $action = filter_input(INPUT_POST, "add_product");

  switch ($action) {

    case "add_to_db":
      $book_title = filter_input(INPUT_POST, "book_title");
      $book_description = filter_input(INPUT_POST, "book_description");
      $book_price = filter_input(INPUT_POST, "book_price");
      $book_quantity = filter_input(INPUT_POST, "book_quantity", FILTER_VALIDATE_INT);
      $book_img = "images/" . basename( $_FILES["book_img"]["name"]);

      if (empty($book_title)) {
        $add_error = "Please enter a title! <br>";
      } else if (empty($book_description)) {
        $add_error = "Please enter a short description! <br>";
      } else if (empty($book_quantity)) {
        $add_error = "Please enter a quantity! <br>";
      } else if (empty($book_price)) {
        $add_error = "Please enter a price! <br>";
      } else if (empty(basename( $_FILES["book_img"]["name"])) || empty($book_img)) {
        $add_error = "Please select an image for the book! <br>";
      } else {
        //Image Upload
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["book_img"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

        if(isset($_POST["submit"])) { // Check if image file is a actual image or fake image
          $check = getimagesize($_FILES["book_img"]["tmp_name"]);
          if($check === false) {
              $add_error = "File is an image - " . $check["mime"] . ". ";
              $uploadOk = 1;
          } else {
              $add_error = "File is not an image. ";
              $uploadOk = 0;
          }
        } else if (file_exists($target_file)) { // Check if file already exists
            $add_error = "Sorry, file already exists. ";
            $uploadOk = 0;
        } else if ($_FILES["fileToUpload"]["size"] > 500000) { // Check file size
            $add_error = "Sorry, your file is too large. ";
            $uploadOk = 0;
        } else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
          && $imageFileType != "gif" ) { // Allow certain file formats
            $add_error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed. ";
            $uploadOk = 0;
        } else if ($uploadOk == 0) { // Check if $uploadOk is set to 0 by an error
            $add_error = "Sorry, your file was not uploaded. ";
        } else if (move_uploaded_file($_FILES["book_img"]["tmp_name"], $target_file)) { // if everything is ok, upload image
                addProduct($book_title, $book_description, $book_quantity, $book_price, $book_img, $conn);
        } else {
                $add_error = "Sorry, there was an error uploading your file. ";
        }
      }
      break;

    default:
      break;

  }

  function addProduct($book_title, $book_description, $book_quantity, $book_price, $book_img, $conn) {
    $sql = "INSERT INTO Books (title, description, quantity, price, image) 
              VALUES ('".$book_title."', '".$book_description."', '".$book_quantity."', '".$book_price."', '".$book_img."')";
    if ($conn->query($sql) !== TRUE) {
      global $add_error;
      $add_error = "Error adding the book provided!";
    } else {
      global $add_success;
      $add_success = "$book_title book has been uploaded successfully!";
    }
    $conn->close();
  }

?>
  <div class="body_area">
    <div class="container">

      <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  enctype="multipart/form-data">
        <fieldset>
          <legend>Add a Book:</legend>

          <?php if (!empty($add_error)): ?> 
          <div class="alert alert-danger"> 
            <strong><?php echo $add_error; ?></strong> 
          </div>
          <?php endif; ?>

          <?php if (!empty($add_success)): ?> 
          <div class="alert alert-success"> 
            <strong><?php echo $add_success; ?></strong> 
          </div>
          <?php endif; ?>

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
                <input type="text" class="form-control"  name="book_quantity" id="book_quantity" placeholder="Book Quantity">
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
              <button type="submit" name="add_product" class="btn btn-default" value="add_to_db">Submit</button>
            </div>
          </div>
      </form>
    </div>
  </div>

  <?php include 'php/footer.php'; ?>