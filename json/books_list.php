<?php include "../php/connection.php";

    $sql = "SELECT * FROM Books";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $books_list = array();
      while ($row = $result->fetch_assoc()) {
       // echo "id: " . $row["id"] . " - Name: " . $row["title"] . "<br />";
        $one_book = array("id"=>$row["id"],
                          "title"=>$row["title"],
                          "description"=>$row["description"],
                          "price"=>$row["price"],
                          "image"=>$row["image"]);
        $books_list[] = $one_book;
      }
      echo json_encode($books_list);
    }

    $conn->close();

  ?>