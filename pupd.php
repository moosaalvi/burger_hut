<?php
$con = mysqli_connect("localhost:3307", "root", "", "burger");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM seller WHERE product_id = $id";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "Product not found.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}

if (isset($_POST['update'])) {
    $pname = $_POST['pname'];
    $pqty = $_POST['pqty'];
    $pprice = $_POST['pprice'];
    $pdtl = $_POST['pdtl'];
    
    $picname = $_FILES['pf']['name'];
    if ($picname) {
        $picfrom = $_FILES['pf']['tmp_name'];
        $picto = "img/" . $picname;
        move_uploaded_file($picfrom, $picto);
    } else {
        $picto = $product['p_img'];
    }

    $sql_update = "UPDATE seller SET p_name = '$pname', p_qty = $pqty, p_price = $pprice, p_detail = '$pdtl', p_img = '$picto' WHERE product_id = $id";

    if (mysqli_query($con, $sql_update)) {
        echo "<script>alert('Product updated successfully');</script>";
        header("Location: product.php");
        exit;
    } else {
        echo "Error updating product: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <style>
        body {
            font-family: cursive;
            
            background: url(img/gallery2.jpg) no-repeat;
            background-size: cover;
        }

        h1 {
            text-align: center;
            color: coral;
            margin-top: 90px;
        }

        .main {
            display: flex;
            justify-content: center;
            align-items: center;
            border: 4px solid coral;
            border-radius: 9px;
            height: auto;
            width: 30%;
            padding: 20px;
            margin: 40px auto;
            background-color: #fff;
        }

        .in {
            margin: 5px;
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .img-preview {
            text-align: center;
            margin-bottom: 20px;
        }

        .img-preview img {
            max-height: 150px;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            background-color: #f4f4f4;
        }
    </style>
</head>

<body>
    <h1><span>Update</span> Product</h1>
    <div class="main">
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="pname">Product name:</label><br>
            <input type="text" name="pname" id="pname" class="in" required value="<?php echo $product['p_name']; ?>"><br>
            <label for="pqty">Quantity:</label><br>
            <input type="number" name="pqty" id="pqty" class="in" required value="<?php echo $product['p_qty']; ?>"><br>
            <label for="pprice">Price:</label><br>
            <input type="number" name="pprice" id="pprice" class="in" required value="<?php echo $product['p_price']; ?>"><br>
            <label for="pdtl">Detail:</label><br>
            <textarea name="pdtl" id="pdtl" class="in" rows="4" cols="50" required><?php echo $product['p_detail']; ?></textarea><br>

            <div class="img-preview">
                <img src="<?php echo $product['p_img']; ?>" alt="Product Image">
            </div>
            <label for="pf">Change Picture:</label><br>
            <input type="file" name="pf" id="pf" class="in"><br>

            <input type="submit" name="update" value="Update" class="btn">
        </form>
    </div>
</body>

</html>
