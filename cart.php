<?php
session_start();
ob_start();
$user_id = @$_SESSION['user_id'];


if (empty($user_id)) {
    $cart_ = "login";
    header("location:login.php?cart_=$cart_");
    exit();
}

$con = mysqli_connect("localhost:3307", "root", "", "burger");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$msg = ''; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        $sql = "SELECT * FROM fast_food  WHERE product_id = '$product_id'";
        
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);
            $pname = $data['p_name'];
            $pprice = $data['p_price'];
            $img = $data['p_img'];
            $total = $pprice * $quantity;

            $check_sql = "SELECT * FROM cart WHERE p_id = '$product_id' AND user_id = '$user_id' AND locked=0";
            $check_result = mysqli_query($con, $check_sql);

            if (mysqli_num_rows($check_result) > 0) {
                $current_item = mysqli_fetch_assoc($check_result);
                $new_quantity = $current_item['pqty'] + $quantity;
                $update_sql = "UPDATE cart SET pqty = '$new_quantity' WHERE p_id = '$product_id' AND user_id = '$user_id'";
                mysqli_query($con, $update_sql);
            } else {
                $insert_sql = "INSERT INTO cart (`p_id`, `user_id`, `pname`, `pprice`, `pqty`, `img`, `p_date`, `locked`, `total_bill`) VALUES ('$product_id', '$user_id', '$pname', '$pprice', '$quantity', '$img', NOW(), 0,'$total')";

                if (mysqli_query($con, $insert_sql)) {
                    $_SESSION['success_message'] = "Product added to cart successfully!";
                } else {
                    $_SESSION['error_message'] = "Failed to add product to cart.";
                }
            }

            $new_qty = $data['p_qty'] - $quantity;
            $update_qty_sql = "UPDATE fast_food SET p_qty = '$new_qty' WHERE product_id = '$product_id'";
            mysqli_query($con, $update_qty_sql);
            header('Location: menu.php');
            exit();
        }
    }



    // for seller's product
    if (isset($_POST['product_id'])) {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        $sql = "SELECT * FROM seller  WHERE product_id = '$product_id'";
        
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);
            $pname = $data['p_name'];
            $pprice = $data['p_price'];
            $img = $data['p_img'];
            $total = $pprice * $quantity;

            $check_sql = "SELECT * FROM cart WHERE p_id = '$product_id' AND user_id = '$user_id' AND locked=0";
            $check_result = mysqli_query($con, $check_sql);

            if (mysqli_num_rows($check_result) > 0) {
                $current_item = mysqli_fetch_assoc($check_result);
                $new_quantity = $current_item['pqty'] + $quantity;
                $update_sql = "UPDATE cart SET pqty = '$new_quantity' WHERE p_id = '$product_id' AND user_id = '$user_id'";
                mysqli_query($con, $update_sql);
            } else {
                $insert_sql = "INSERT INTO cart (`p_id`, `user_id`, `pname`, `pprice`, `pqty`, `img`, `p_date`, `locked`, `total_bill`) VALUES ('$product_id', '$user_id', '$pname', '$pprice', '$quantity', '$img', NOW(), 0,'$total')";

                if (mysqli_query($con, $insert_sql)) {
                    $_SESSION['success_message'] = "Product added to cart successfully!";
                } else {
                    $_SESSION['error_message'] = "Failed to add product to cart.";
                }
            }

            $new_qty = $data['p_qty'] - $quantity;
            $update_qty_sql = "UPDATE fast_food SET p_qty = '$new_qty' WHERE product_id = '$product_id'";
            mysqli_query($con, $update_qty_sql);
            header('Location: menu.php');
            exit();
        }
    }

    if (isset($_POST['remove_id'])) {
        $remove_id = $_POST['remove_id'];
        $cart_sql = "SELECT * FROM cart WHERE `p_id` = '$remove_id' AND `user_id` = '$user_id'";
        $cart_result = mysqli_query($con, $cart_sql);

        if (mysqli_num_rows($cart_result) > 0) {
            $item = mysqli_fetch_assoc($cart_result);
            $quantity_to_return = $item['pqty'];

            $delete_sql = "DELETE FROM cart WHERE `p_id` = '$remove_id' AND `user_id` = '$user_id' AND `locked` = 0";
            mysqli_query($con, $delete_sql);

            $update_qty_sql = "UPDATE fast_food SET `p_qty` = `p_qty` + '$quantity_to_return' WHERE `product_id` = '$remove_id'";
            mysqli_query($con, $update_qty_sql);
        }
    }


    if (isset($_POST['remove_all'])) {
        $cart_sql = "SELECT * FROM cart WHERE `user_id` = '$user_id'";
        $cart_result = mysqli_query($con, $cart_sql);

        $cart_locked = false;
        while ($item = mysqli_fetch_assoc($cart_result)) {
            if ($item['locked'] == 1) {
                $cart_locked = true;
                break;
            }
        }

        if ($cart_locked) {
            $_SESSION['error_message'] = "Cart is locked! Unlock it first to remove all items.";
        } else {
            $cart_result = mysqli_query($con, $cart_sql); 
            while ($item = mysqli_fetch_assoc($cart_result)) {
                $quantity_to_return = $item['pqty'];
                $remove_id = $item['p_id'];

                $delete_sql = "DELETE FROM cart WHERE `p_id` = '$remove_id' AND `user_id` = '$user_id' AND `locked` = 0";
                mysqli_query($con, $delete_sql);

                $update_qty_sql = "UPDATE fast_food SET `p_qty` = `p_qty` + '$quantity_to_return' WHERE `product_id` = '$remove_id'";
                mysqli_query($con, $update_qty_sql);
            }

            $_SESSION['success_message'] = "All products removed from cart.";
        }
        header('Location: cart.php');
        exit();
    }



    if (isset($_POST['update'])) {
        $update_lock_sql = "UPDATE cart SET `locked` = 1 WHERE `user_id` = '$user_id'";
        mysqli_query($con, $update_lock_sql);

        $_SESSION['success_message'] = "Cart updated!";
        header('Location: cart.php');
        exit();
    }

    if (isset($_POST['unlock'])) {
        $un_lock_sql = "UPDATE cart SET `locked` = 0 WHERE `user_id` = '$user_id'";
        mysqli_query($con, $un_lock_sql);

        $_SESSION['success_message'] = "Cart unlocked!";
        header('Location: cart.php');
        exit();
    }

    if (isset($_POST['update_qty'])) {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $update_qty_sql = "UPDATE cart SET pqty = '$quantity' WHERE p_id = '$product_id' AND user_id = '$user_id'";
        mysqli_query($con, $update_qty_sql);
        header('Location: cart.php');
        exit();
    }

    if (isset($_POST['checkout'])) {
        $sql = "SELECT * FROM cart WHERE user_id = '$user_id'";
        $result = mysqli_query($con, $sql);
        $cart_locked = true;

        while ($item = mysqli_fetch_assoc($result)) {
            if ($item['locked'] != 1) {
                $cart_locked = false;
                break;

                $total += $item['pprice'] * $item['pqty'];
            }
        }

        if (!$cart_locked) {
            $_SESSION['total_bill'] = $total;
            $msg = "Cart not updated! Kindly update it first before checkout!";
        } else {
            $_SESSION['success_message'] = "Cart updated! Redirecting to payment.";
            header("Location: payment.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Burger Hut</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: url("img/hero-background.jpg") no-repeat center center fixed;
            background-size: cover;
            color: #fff;
        }

        header {
            background-color: #070e16;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        img {
            height: 50px;
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
            display: flex;
            list-style: none;
        }

        nav ul li a {
            padding: 10px;
            text-decoration: none;
            color: white;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #ff0000;
        }

        .cart-container {
            padding: 2rem;
            text-align: center;
        }

        .cart-container h2 {
            font-size: 36px;
            margin-bottom: 40px;
        }

        .cart-items {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 80%;
            padding: 1rem;
            background: rgba(51, 51, 51, 0.8);
            border-radius: 0.5rem;
        }

        .cart-item img {
            height: 100px;
            border-radius: 0.5rem;
        }

        .item-details {
            flex: 2;
            margin-left: 1rem;
        }

        .item-details h3 {
            font-size: 24px;
        }

        .item-details p {
            font-size: 16px;
            margin: 0.5rem 0;
        }

        .item-controls {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .item-controls input[type="number"] {
            width: 60px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 5px;
            background: #fff;
            color: #000;
        }

        .item-controls .btn {
            padding: 0.5rem 1rem;
            font-size: 14px;
            background-color: #ff9800;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            color: #fff;
        }

        .item-controls .btn:hover {
            background-color: #e68900;
            transform: translateY(-2px);
        }

        .total {
            margin-top: 2rem;
            font-size: 24px;
        }

        .checkout-btn {

            margin-top: 1rem;
            padding: 10px;
            font-size: 18px;
            background-color: #ff9800;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        .checkout-btn:hover {
            background-color: #e68900;
            transform: translateY(-2px);
        }

        .footer {
            background-color: #070e16;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            width: 100%;
            bottom: 0;
        }

        .footer-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
        }

        .footer-logo img {
            max-width: 150px;
        }

        .footer-links a {
            color: #fff;
            margin: 0 10px;
            text-decoration: none;
        }

        .footer-social a {
            color: #fff;
            margin: 0 5px;
            text-decoration: none;
        }

        .footer-text {
            margin-top: 10px;
        }

        .no-products {
            font-size: 24px;
        }

        .success-message {
            /* background: #e68900; */
            /* width: 20px; */

            color: yellow;
            font-size: larger;
            font-weight: bold;
            margin: 10px 0;
        }

        .error-message {
            /* background: #e68900; */
            color: red;
            font-size: larger;
            font-weight: bold;
            margin: 10px 0;
        }
    </style>
    <script>
        function confirmAction(message) {
            return confirm(message);
        }
    </script>
</head>

<body>
    <header>
        <div class="logo-container">
            <div class="logo">
                <img src="img/iconlogo.png" alt="Logo">
            </div>
            <h1>Burger Hut</h1>
        </div>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="menu.php">Menu</a></li>
            </ul>
        </nav>
    </header>

    <section class="cart-container">
        <h2>Your Cart</h2>
        <?php
        if ($msg) {
            echo "<div class='error-message'>$msg</div>";
        }
        if (isset($_SESSION['success_message'])) {
            echo "<div class='success-message'>" . $_SESSION['success_message'] . "</div>";
            unset($_SESSION['success_message']);
        }
        if (isset($_SESSION['error_message'])) {
            echo "<div class='error-message'>" . $_SESSION['error_message'] . "</div>";
            unset($_SESSION['error_message']);
        }
        ?>
        <div class="cart-items">
            <?php
            $sql = "SELECT * FROM cart WHERE user_id = '$user_id'";
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) > 0) {
                $total = 0;
                while ($item = mysqli_fetch_assoc($result)) {
                    echo "<div class='cart-item'>";
                    echo "<img src='{$item['img']}' alt='{$item['pname']}'>";
                    echo "<div class='item-details'>";
                    echo "<h3>{$item['pname']}</h3>";
                    echo "<p>Price: $ {$item['pprice']}</p>";
                    echo "<p>Quantity: {$item['pqty']}</p>";
                    echo "</div>";

                    if (!$item['locked']) {
                        echo "<div class='item-controls'>";
                        echo "<form method='POST' action='cart.php' onsubmit='return confirmAction(\"Are you sure you want to remove this item?\")'>";
                        echo "<input type='hidden' name='remove_id' value='{$item['p_id']}'>";
                        echo "<button type='submit' class='btn remove-btn'>Remove</button>";
                        echo "</form>";
                        echo "</div>";
                    }
                    echo "</div>";
                    $total += $item['pprice'] * $item['pqty'];
                    $_SESSION['total_bill'] = @$total;          
                }
                echo "<div class='total'>Total: $ " . number_format($total, 2) . "</div>";
                echo "<form method='POST' action='cart.php'>";
                echo "<input type='hidden' name='user_id' value='$user_id'>";
                echo "<button type='submit' name='update' class='checkout-btn' onclick=\"return confirmAction('Are you sure you want to update the cart?')\">Update cart</button>";
                $sql = "SELECT * FROM cart WHERE user_id = '$user_id'";
                $result = mysqli_query($con, $sql);
                $item=mysqli_fetch_assoc($result);
                if(!$item['locked']){

                    echo "<button type='submit' name='remove_all' class='checkout-btn' onclick=\"return confirmAction('Are you sure you want to remove all items from the cart?')\">Remove All</button>";
                }
                $sql = "SELECT * FROM cart WHERE user_id = '$user_id'";
                $result = mysqli_query($con, $sql);
                $data = mysqli_fetch_assoc($result);
                if ($data['locked'] == 1) {
                    echo "<button type='submit' name='unlock' class='checkout-btn' onclick=\"return confirmAction('Are you sure you want to unlock the cart?')\">Unlock cart</button>";
                }
                echo "</form>";
                echo "<form method='POST' action='cart.php'>";
                echo "<input type='hidden' name='user_id' value='$user_id'>";
                echo "<button type='submit' name='checkout' class='checkout-btn' onclick=\"return confirmAction('Are you sure you want to proceed to checkout?')\">Checkout</button>";
                echo "</form>";
            } else {
                echo "<p>Your cart is empty.</p>";
            }
            ?>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-logo">
                <img src="img/iconlogo.png" alt="Logo">
            </div>
            <nav class="footer-links">
                <a href="home.php">Home</a>
                <a href="index.php#about">About</a>
                <a href="menu.php">Menu</a>
                <a href="reser.php">Reservations</a>
                <a href="index.php#testimonials">Testimonials</a>
                <a href="index.php#gallery">Gallery</a>
                <a href="index.php#contact">Contact</a>
            </nav>
            <div class="footer-social">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        <p class="footer-text">&copy; 2024 Burger Hut. All rights reserved.</p>
    </footer>
</body>

</html>
<?php
ob_flush()
?>