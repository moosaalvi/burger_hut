<?php
$conn = mysqli_connect("localhost:3307", "root", "", "burger");
 
if (isset($_GET['id'])) {
    $id = $_GET['id'];

   
    $query= "DELETE FROM `seller` WHERE product_id = $id";
   $run=mysqli_query($conn,$query);
    if ($run) {
        header("Location: product.php");
        exit();
    } else {
        echo "Error deleting data: " . $conn->error;
    }
}

?>