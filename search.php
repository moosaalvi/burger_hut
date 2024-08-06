<?php
session_start();
$con = mysqli_connect("localhost:3307", "root", "", "burger");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$search = isset($_POST['psearch']) ? $_POST['psearch'] : '';
$sort = isset($_POST['sort']) ? $_POST['sort'] : '';

$sql = "SELECT * FROM fast_food";
if (!empty($search)) {
    $sql .= " WHERE p_name LIKE '%" . mysqli_real_escape_string($con, $search) . "%'";
}
if (!empty($sort)) {
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
        default:
            break;
    }
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
            $user_id = @$_SESSION['user_id'];
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
