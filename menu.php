
<?php
session_start();
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Our Menu - Burger Hut</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'Noto Sans', sans-serif;
        }

        body {

            background: url("img/hero-background.jpg") no-repeat;
            background-size: cover;
            position: relative;
        }



        header {
            background-color: #070e16;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;

        }

        .signup {
            margin-right: 100px;
            margin-left: 3px;
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
            padding: 10px;
            text-decoration: none;
            color: white;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #ff0000;
        }

        .search-sort-container {

            display: flex;
            align-items: center;
        }

        .search-sort-container input {
            margin-left: 0.5rem;
            width: 25%;
        }

        /* .search-sort-container select {} */

        .search-sort-container button {
            margin-left: 0.5rem;
        }

        .menu {

            padding: 2rem;
            text-align: center;
        }

        .menu h2 {
            font-size: 36px;
            margin-bottom: 40px;
            color: #ffffff;
        }

        .menu-items {

            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 2.50rem;
            transform-style: preserve-3d;
            list-style-type: none;
        }

        .menu-items:hover .menu-item:not(:hover) {
            transform: perspective(500px) rotateY(25deg) scale(0.95);

        }

        .menu-items:hover .menu-item:not(:hover)::after {
            opacity: 0.4;
        }

        .menu-item {
            position: relative;
            width: 20%;
            height: 270px;
            border-radius: 0.5rem;
            overflow: hidden;
            background-color: #333;
            transition: margin 0.5s, transform 0.5s;
        }

        .menu-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .menu-item:hover~.menu-item {
            transform: perspective(500px) rotateY(-45deg) scale(0.95);
        }

        .menu-item:hover {
            width: 20%;
            transform: perspective(500px) rotateY(0) scale(1.2);
        }

        .menu-item::after {

            content: '';
            position: absolute;
            width: inherit;
            height: inherit;
            border-radius: inherit;
            background-color: black;
            opacity: 0;
            transition: opacity 0.5s;
        }

        .menu-item .card-content {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 1rem;
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            text-align: center;
            border-radius: 0 0 0.5rem 0.5rem;
        }

        h3 {
            margin: 2px;
        }

        p {
            margin: 2px;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }

        .button-group .btn {
            padding: 0.25rem 0.5rem;
            font-size: 14px;
            background-color: #ff9800;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        .button-group .btn:hover {
            background-color: #e68900;
            transform: translateY(-2px);
        }

        .btn-add-to-cart {

            /* color: firebrick; */
            margin: 10px;
        }

        .btn-add-to-cart:hover {

            color: firebrick;
            margin: 10px;
        }

        .btn-add-to-cart-qty {
            margin: 10px;
            width: 30px;

        }

        .footer {
            background-color: #070e16;
            padding: 40px 0;
            color: #fff;
            text-align: center;
        }

        .footer-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 40px;
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
            font-size: 14px;
        }

          .success-message {
            color: green;
            font-weight: bold;
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <script>
        function confirmAction(action) {
            return confirm(`Are you sure you want to ${action} this item?`);
        }
    </script>

    <header>
        <div class="logo-container">
            <div class="logo">
                <img src="img/iconlogo.png" alt="Burger Hut Logo">
            </div>
            <h1>Burger Hut</h1>
        </div>
        <nav>
            <ul>
                <li>
                    <div class="search-sort-container">
                        <?php if (isset($_SESSION['email'])) : ?>
                            <a href="logout.php" class="signup">Logout</a>
                        <?php else : ?>
                            <a href="login.php">Login |</a>
                            <a href="signup.php" class="signup">Signup</a>
                        <?php endif; ?>
                        <a href="home.php">Home</a>
                        <div style="background-color: white; font-size: large"></div>
                        <?php if (isset($_SESSION['email'])) : ?>
                            <a href="cart.php"> <i class="fa-light fa-cart-shopping"></i> Cart</a>
                        <?php endif; ?>
                        <form method="POST">
                            <input type="text" name="psearch" placeholder="Search menu..." value="<?php echo isset($_POST['psearch']) ? htmlspecialchars($_POST['psearch']) : ''; ?>">
                            <select name="sort">
                                <option value="">Sort by</option>
                                <option value="price_asc" <?php if (isset($_POST['sort']) && $_POST['sort'] == 'price_asc') echo 'selected'; ?>>Price: Low to High</option>
                                <option value="price_desc" <?php if (isset($_POST['sort']) && $_POST['sort'] == 'price_desc') echo 'selected'; ?>>Price: High to Low</option>
                                <option value="date_asc" <?php if (isset($_POST['sort']) && $_POST['sort'] == 'date_asc') echo 'selected'; ?>>Date: Old to New</option>
                                <option value="date_desc" <?php if (isset($_POST['sort']) && $_POST['sort'] == 'date_desc') echo 'selected'; ?>>Date: New to Old</option>
                                <option value="name_asc" <?php if (isset($_POST['sort']) && $_POST['sort'] == 'name_asc') echo 'selected'; ?>>Name: A to Z</option>
                                <option value="name_desc" <?php if (isset($_POST['sort']) && $_POST['sort'] == 'name_desc') echo 'selected'; ?>>Name: Z to A</option>
                            </select>
                            <button type="submit" name="submit">Search</button>
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
    </header>

    <section class="menu">
        <h2>Our Menu</h2>

        <?php
        if (isset($_SESSION['success_message'])) {
            echo "<div class='success-message'>" . $_SESSION['success_message'] . "</div>";
            unset($_SESSION['success_message']);
        }
        ?>

        <div class="menu-items">
            <?php
            $con = mysqli_connect("localhost:3307", "root", "", "burger");

            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT * FROM fast_food";
            $search = isset($_POST['psearch']) ? mysqli_real_escape_string($con, $_POST['psearch']) : '';
            $sort = isset($_POST['sort']) ? $_POST['sort'] : '';

            if (!empty($search)) {
                $sql .= " WHERE p_name LIKE '%$search%'";
            }

            switch ($sort) {
                case 'price_asc':
                    $sql .= " ORDER BY p_price ASC";
                    break;
                case 'price_desc':
                    $sql .= " ORDER BY p_price DESC";
                    break;
                case 'date_asc':
                    $sql .= " ORDER BY p_date ASC";
                    break;
                case 'date_desc':
                    $sql .= " ORDER BY p_date DESC";
                    break;
                case 'name_asc':
                    $sql .= " ORDER BY p_name ASC";
                    break;
                case 'name_desc':
                    $sql .= " ORDER BY p_name DESC";
                    break;
            }

            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($data = mysqli_fetch_assoc($result)) {
                    echo "<li class='menu-item'>";
                    echo "<img src='{$data['p_img']}' alt='{$data['p_name']}'>";
                    echo "<div class='card-content'>";
                    echo "<h3>{$data['p_name']}</h3>";
                    echo "<p>Price: $ {$data['p_price']}</p>";
                    echo "<p>Available Quantity: {$data['p_qty']}</p>";
                    echo "<form method='POST' action='cart.php'>";
                    echo "<input type='hidden' name='product_id' value='{$data['product_id']}'>";
                    if (isset($_SESSION['email'])) {
                        $product_id = $data['product_id'];
                        $user_id = $_SESSION['user_id'];
                        $check_cart_sql = "SELECT * FROM cart WHERE p_id = '$product_id' AND user_id = '$user_id'";
                        $check_cart_result = mysqli_query($con, $check_cart_sql);
                        if (mysqli_num_rows($check_cart_result) == 0) {
                            echo "<input type='number' name='quantity' class='btn-add-to-cart-qty' min='1' max='{$data['p_qty']}' value='1' required>";
                            echo "<button type='submit' class='btn-add-to-cart' name='cart' onclick=\"return confirmAction('add')\">Add to Cart</button>";
                        } else {
                            echo "<button type='button' class='btn-add-to-cart' disabled>Added</button>";
                        }
                    } else {
                        echo "<button type='button' class='btn-add-to-cart' onclick=\"location.href='login.php?loc=add to cart';\">Add to Cart</button>";
                    }
                    echo "</form>";
                    echo "</div>";
                    echo "</li>";
                }
            } else {
                echo "<p class='no-products'>No products found.</p>";
            }

            mysqli_close($con);
            ?>
        </div>
    </section>
    <section class="menu">
        <h2>Local Seller's menu</h2>

        <?php
        if (isset($_SESSION['success_message'])) {
            echo "<div class='success-message'>" . $_SESSION['success_message'] . "</div>";
            unset($_SESSION['success_message']);
        }
        ?>

        <div class="menu-items">
            <?php
            $con = mysqli_connect("localhost:3307", "root", "", "burger");

            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT * FROM seller";
            $search = isset($_POST['psearch']) ? mysqli_real_escape_string($con, $_POST['psearch']) : '';
            $sort = isset($_POST['sort']) ? $_POST['sort'] : '';

            if (!empty($search)) {
                $sql .= " WHERE p_name LIKE '%$search%'";
            }

            switch ($sort) {
                case 'price_asc':
                    $sql .= " ORDER BY p_price ASC";
                    break;
                case 'price_desc':
                    $sql .= " ORDER BY p_price DESC";
                    break;
                case 'date_asc':
                    $sql .= " ORDER BY p_date ASC";
                    break;
                case 'date_desc':
                    $sql .= " ORDER BY p_date DESC";
                    break;
                case 'name_asc':
                    $sql .= " ORDER BY p_name ASC";
                    break;
                case 'name_desc':
                    $sql .= " ORDER BY p_name DESC";
                    break;
            }

            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($data = mysqli_fetch_assoc($result)) {
                    echo "<li class='menu-item'>";
                    echo "<img src='{$data['p_img']}' alt='{$data['p_name']}'>";
                    echo "<div class='card-content'>";
                    echo "<h3>{$data['p_name']}</h3>";
                    echo "<p>Price: $ {$data['p_price']}</p>";
                    echo "<p>Available Quantity: {$data['p_qty']}</p>";
                    echo "<form method='POST' action='cart.php'>";
                    echo "<input type='hidden' name='product_id' value='{$data['product_id']}'>";
                    if (isset($_SESSION['email'])) {
                        $product_id = $data['product_id'];
                        $user_id = $_SESSION['user_id'];
                        $check_cart_sql = "SELECT * FROM cart WHERE p_id = '$product_id' AND user_id = '$user_id'";
                        $check_cart_result = mysqli_query($con, $check_cart_sql);
                        if (mysqli_num_rows($check_cart_result) == 0) {
                            echo "<input type='number' name='quantity' class='btn-add-to-cart-qty' min='1' max='{$data['p_qty']}' value='1' required>";
                            echo "<button type='submit' class='btn-add-to-cart' name='cart' onclick=\"return confirmAction('add')\">Add to Cart</button>";
                        } else {
                            echo "<button type='button' class='btn-add-to-cart' disabled>Added</button>";
                        }
                    } else {
                        echo "<button type='button' class='btn-add-to-cart' onclick=\"location.href='login.php?loc=add to cart';\">Add to Cart</button>";
                    }
                    echo "</form>";
                    echo "</div>";
                    echo "</li>";
                }
            } else {
                echo "<p class='no-products'>No products found.</p>";
            }

            mysqli_close($con);
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
