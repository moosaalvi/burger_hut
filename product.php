<?php
session_start();
ob_start();
$user_id = @$_SESSION['user_id'];
if ($user_id == "") {
    $pro = "product";
    header("location: login.php?pro=$pro");
    exit();
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Data</title>
    <style>
        body {
            font-family: cursive;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background: url("img/gallery2.jpg") no-repeat;
            background-size: cover;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #aaa;
        }

        span {
            color: coral;
        }

        .main {
            display: flex;
            justify-content: center;
            align-items: center;
            border: 4px solid coral;
            border-radius: 9px;
            height: auto;
            width: 40%;
            padding: 20px;
            margin: 40px auto;
            background-color: #fff;
        }

        .in {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn {
            background-color: coral;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn:hover {
            background-color: darkorange;
            transform: scale(1.05);
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: whitesmoke;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: coral;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        .actions a {
            text-decoration: none;
            color: white;
            background-color: coral;
            padding: 5px 10px;
            border-radius: 4px;
            margin: 0 5px;
            display: inline-block;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .actions a:hover {
            background-color: darkorange;
            transform: scale(1.05);
        }

        h1 li a {
            width: 40px;
            height: 40px;
            margin-left: 70%;

            display: inline-block;

            text-decoration: none;
            color: white;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        li a:hover {
            color: #ff0000;
        }


        header {
  background-color: #070e16;
  padding: 20px;
  
  display: flex;
  align-items: center;
  justify-content: space-between;
  /* position: fixed; */
  width: 100%;

}
.login{
  margin: 150px;
}
.log{
  /* display: flex; */
  margin-left: -600px;
}
.logo-container {
  display: flex;
  align-items: center;
}

.logo img {
  height: 60px;
  margin-left: 50px;
}

.logo-container h1 {
  display: flex;
  flex-direction: row;
  font-size: 24px;
  color: rgb(228, 227, 219);
  font-weight: bold;
  margin-left: 15px;
  text-transform: uppercase;
  letter-spacing: 2px;
}

nav ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

nav ul li {
  display: inline-block;
  margin-right: 15px;
}

nav ul li a {
    
  padding: 90px;
  text-decoration: none;
  color: white;
  font-weight: bold;
  transition: color 0.3s ease;
}

nav ul li a:hover {
  color: #ff0000;
}
    </style>
    <script>
        function confirmAction(message) {
            return confirm(message);
        }
    </script>
</head>

<body>
<header style=>
        <div class="logo-container">
            <div class="logo">
                <img src="img/iconlogo.png" alt="Burger Hut Logo">
            </div>
            <h1>
                Burger Hut
            </h1>
        </div>
        <nav>
            <ul>

            <?php if (isset($_SESSION['email'])) :$log="logout"; ?>
            <li><a href="logout.php?seller_logout=$log" class="log">Logout</a></li>
        
               
                <?php endif; ?>

            
                
                <li><a href="home.php">Home</a></li>
                
        </nav>
    </header>

    <h1><span>Add Your</span> Products Here
        
    </h1>

    <div class="main">
        <form action="product.php" method="POST" enctype="multipart/form-data">
            <label for="pname">Product name:</label><br>
            <input type="text" name="pname" id="pname" class="in" required><br>
            <label for="pqty">Quantity:</label><br>
            <input type="number" name="pqty" id="pqty" class="in" required><br>
            <label for="pp">Price:</label><br>
            <input type="number" name="pprice" id="pp" class="in" required><br>
            <label for="pdtl">Detail:</label><br>
            <textarea name="pdtl" id="pdtl" class="in" rows="4" cols="50" required></textarea><br>

            <label for="pf">File:</label><br>
            <input type="file" name="pf" id="pf" class="in" required><br>

            <input type="submit" class="btn" name="btn" value="Submit">
        </form>
    </div>

    <hr>

    <?php
    $con = mysqli_connect("localhost:3307", "root", "", "burger");

    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST['btn'])) {
        $pname = $_POST['pname'];
        $pqty = $_POST['pqty'];
        $pprice = $_POST['pprice'];
        $pdtl = $_POST['pdtl'];

        $picname = $_FILES['pf']['name'];
        $picfrom = $_FILES['pf']['tmp_name'];
        $picto = "img/" . $picname;
        if (move_uploaded_file($picfrom, $picto)) {
            if (!empty($pname) && !empty($pqty) && !empty($pprice) && !empty($pdtl) && !empty($picname)) {
                $query = "INSERT INTO seller(`user_id`,`p_name`, `p_qty`, `p_price`, `p_detail`, `p_img`) VALUES ('$user_id','$pname', '$pqty', '$pprice', '$pdtl', '$picto')";
                $run = mysqli_query($con, $query);
                if ($run) {
                    header("Location: product.php");
                } else {
                    echo "<script type='text/javascript'>alert('Error: Unable to insert data');</script>";
                }
            } else {
                echo "<script type='text/javascript'>alert('Please fill all the inputs');</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Error: Unable to upload file');</script>";
        }
    }

    $sql = "SELECT * FROM seller where user_id='$user_id'";
    $result = mysqli_query($con, $sql);
    ?>

    <table>
        <tr>
            <th>Product Name</th>
            <th>Product Quantity</th>
            <th>Product Price</th>
            <th>Product Detail</th>
            <th>Product Image</th>
            <th>Actions</th>
        </tr>
        <?php
        while ($data = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
                <td><?php echo $data['p_name'] ?></td>
                <td><?php echo $data['p_qty'] ?></td>
                <td><?php echo $data['p_price'] ?></td>
                <td><?php echo $data['p_detail'] ?></td>
                <td><img src='<?php echo $data['p_img'] ?>' alt='Product Image' style='height:6rem'></td>
                <td class="actions">
                    <a href='pupd.php?id=<?php echo $data['product_id'] ?>' onclick="return confirmAction('Are you sure you want to update this item?')">Update</a>
                    <a href='pdel.php?id=<?php echo $data['product_id'] ?>' onclick="return confirmAction('Are you sure you want to delete this item?')">Delete</a>
                </td>
            </tr>
        <?php
        }
        mysqli_close($con);
        ob_end_flush();
        ?>
    </table>

</body>

</html>