

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <?php
session_start();
$user_id = @$_SESSION['user_id'];
$bill = @$_SESSION['total_bill'];
if ($user_id == "") {
    header("location: login.php");
    exit();
}
ob_start();

function validateCVV($cvv) {
    return preg_match('/^[0-9]{3,4}$/', $cvv);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
            border: none;
            text-transform: capitalize;
            transition: all .2s linear;
        }
        body {
        background-color: black;
        font-family: 'Poppins', sans-serif;
        }
        .container {
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 25px;
            min-height: 100vh;
        }
        .container form {
            background: transparent;
            border: 2px solid rgba(255, 255, 255, .2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(255, 255, 255, .2);
            padding: 20px;
            width: 700px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, .1);
        }
        .container form .row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        .container form .row .col {
            flex: 1 1 250px;
        }
        .container form .row .col .title {
            font-size: 20px;
            color: #fff;
            padding-bottom: 5px;
            text-transform: uppercase;
        }
        .container form .row .col .inputBox {
            margin: 15px 0;
        }
        .container form .row .col .inputBox span {
            margin-bottom: 10px;
            display: block;
        }
        .container form .row .col .inputBox input {
            width: 100%;
            border: 1px solid #ccc;
            padding: 10px 15px;
            font-size: 15px;
            text-transform: none;
        }
        .container form .row .col .inputBox input:focus {
            border: 1px solid #000;
        }
        .container form .row .col .flex {
            display: flex;
            gap: 15px;
        }
        .container form .row .col .flex .inputBox {
            margin-top: 5px;
        }
        .container form .row .col .inputBox img {
            height: 34px;
            margin-top: 5px;
            filter: drop-shadow(0 0 1px #000);
        }
        .container form .submit-btn {
            width: 100%;
            padding: 12px;
            font-size: 17px;
            background: #27ae60;
            color: #fff;
            margin-top: 5px;
            cursor: pointer;
        }
        .container form .submit-btn:hover {
            background: #2ecc71;
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
    </style>
</head>

<body>
<script>
        function confirmAction(message) {
            return confirm(message);
        }
    </script>
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
                <li><a href="cart.php">Cart</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">

    <form action="" method="POST" >

<div class="row">

  

    <div class="col">

        <h3 class="title">payment</h3>

        <div class="inputBox">
            <span>cards accepted :</span>
            <img src="img/card_img.png" alt="">
        </div>
        <div class="inputBox">
            <span>email :</span>
            <input type="email" name="email" placeholder="moosa@gmail.com" required>
        </div>
        <div class="inputBox">
            <span>name on card :</span>
            <input type="text" name="cardname" placeholder="moosa" required>
        </div>
        <div class="inputBox">
            <span>credit card number :</span>
            <input type="number" name="cardno" placeholder="1111"  required>
        </div>
        <div class="inputBox">
            <span>exp date :</span>
            <input type="date" name="expdate" required>
        </div>

        <div class="flex">

            <div class="inputBox">
                <span>CVV :</span>
                <input type="number" name="cvv" placeholder="123" required>
            </div>
        </div>

    </div>

</div>
<?php
echo "<p>Your total bill to payout: $ " . number_format($bill, 2) . "</p>";
?>

<input type="submit" name="submit" value="proceed to checkout" class="submit-btn" onclick="return confirmAction('Are you sure you want to proceed to checkout?')">

</form>

        <?php
        $con = mysqli_connect("localhost:3307", "root", "", "burger");

        if (isset($_POST['submit'])) {
            $email = @$_POST['email'];
            $cardname = @$_POST['cardname'];
            $cardno = @$_POST['cardno'];
            $expdate = @$_POST['expdate'];
            $cvv = @$_POST['cvv'];

           
            if (!validateCVV($cvv)) {
                echo "<script>alert('Invalid CVV. Please enter a valid CVV.');</script>";
            } else {
                
                $details_query = "SELECT * FROM payment WHERE email = '$email' AND cardname = '$cardname' AND cardno = '$cardno' AND expdate = '$expdate' AND cvv = '$cvv'";
                $details_result = mysqli_query($con, $details_query);
                
                if (mysqli_num_rows($details_result) == 0) {
                    echo "<script>alert('Incorrect bank details. Please check and try again.');</script>";
                } 
                else {
                  
                    $row = mysqli_fetch_assoc($details_result);
                    $balance = $row['balance'];

                    if ($balance < $bill) {
                        echo "<script>alert('Insufficient balance. Your available balance is $balance');</script>";
                    } else {
                       
                        $new_balance = $balance - $bill;
                        $update_balance = "UPDATE payment SET balance = '$new_balance' WHERE email = '$email'";
                        mysqli_query($con, $update_balance);

                       
                        $delete_sql = "DELETE FROM cart WHERE user_id = '$user_id' AND locked = 1";
                        mysqli_query($con, $delete_sql);

                        header("location:thankyou.php");
                        exit();
                    }
                }
            }
        }

        ob_end_flush();
        mysqli_close($con);
        ?>

    </div>

    <script>
        function validateCardNumber(cardNumber) {
            const regex = /^[0-9]{16}$/;
            return regex.test(cardNumber);
        }

        function validateCVV(cvv) {
            const regex = /^[0-9]{3,4}$/;
            return regex.test(cvv);
        }

        function validateForm() {
            const cardNumber = document.querySelector('input[name="cardno"]').value;
            const cvv = document.querySelector('input[name="cvv"]').value;

            if (!validateCardNumber(cardNumber)) {
                alert("Invalid card number. Please enter a 16-digit card number.");
                return false;
            }

            if (!validateCVV(cvv)) {
                alert("Invalid CVV. Please enter a 3 or 4 digit CVV.");
                return false;
            }

            return true;
        }
    </script>

</body>

</html>
