<?php
$conn = mysqli_connect("localhost:3307", "root", "", "burger");
 
if (isset($_GET['id'])) {
    $id = $_GET['id'];

   
    $query= "DELETE FROM `fast_food` WHERE product_id = $id";
   $run=mysqli_query($conn,$query);
    if ($run) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Error deleting data: " . $conn->error;
    }
}

?>