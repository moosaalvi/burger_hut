<?php

session_start();




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = @$_POST['email'];
    $password = @$_POST['password'];

    $con = mysqli_connect("localhost:3307", "root", "", "burger");

 
    $email = mysqli_real_escape_string($con, $email);
    $password = mysqli_real_escape_string($con, $password);

    $sql = "SELECT * FROM data WHERE email='$email' AND password='$password'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);

        
        $_SESSION['email'] = $email;
        $_SESSION['user_id'] = $data['user_id'];
        if($_GET['user']){
            header('location:menu.php');

        }
        elseif($_GET['loc']){
            header('location:menu.php');

        
        }
        elseif($_GET['pro']){
            header('location:product.php');

        }
        elseif($_GET['admin']){
            header('location:admin.php');

        }
        elseif($_GET['cart_']){
            header('location:cart.php');

        }
        else{

            header('location:home.php');
        }


     

        exit();
    } else {
        echo "<script type='text/javascript'>alert('Invalid username or password');</script>";
    }

    mysqli_close($con);
}

// }
// else{
//     echo "pakistan";
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="forum.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: ubuntu;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: url('img/hero-background1.jpg') no-repeat;
        background-size: cover;
        background-position: center;
    }

    .alvi {
        width: 420px;
        background: transparent;
        border: 2px solid rgba(255, 255, 255, .2);
        backdrop-filter: blur(20px);
        box-shadow: 0 0 10px rgba(255, 255, 255, .2);
        color: #fff;
        border-radius: 10px;
        padding: 30px 40px;
    }

    .alvi h1 {
        font-size: 36px;
        text-align: center;
    }

    .alvi .input {
        position: relative;
        width: 100%;
        height: 50px;
        margin: 30px 0;
    }

    .input input {
        width: 100%;
        height: 100%;
        background: transparent;
        border: none;
        outline: none;
        border: 2px solid rgba(255, 255, 255, .2);
        border-radius: 40px;
        font-size: 16px;
        color: #fff;
        padding: 20px 45px 20px 20px;
    }

    .input input::placeholder {
        color: #fff;
    }

    .input i {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20px;
    }

    .alvi .remember {
        display: flex;
        justify-content: space-between;
        font-size: 14.5px;
        margin: -15px 0 15px;
    }

    .remember label input {
        accent-color: #fff;
        margin-right: 3px;
    }

    .remember a {
        color: #fff;
        text-decoration: none;
    }

    .remember a:hover {
        text-decoration: underline;
    }

    .alvi .btn {
        width: 50%;
        margin-left: 75px;
        height: 35px;
        background: #fff;
        border: none;
        outline: none;
        border-radius: 40px;
        box-shadow: 0 0 10px rgba(0, 0, 0, .1);
        cursor: pointer;
        font-size: 16px;
        color: #333;
        font-weight: 600;
        margin-top: 10%;
    }

    .alvi .account {
        font-size: 14.5px;
        text-align: center;
        margin: 20px 0 15px;
    }

    .account p a {
        color: #fff;
        text-decoration: none;
        font-weight: 600;
    }

    .account p a:hover {
        text-decoration: underline;
    }
</style>

<body>
    <div class="alvi">
        <form method="POST">
            <h1>Login</h1>

            <div class="input">
                <input type="email" placeholder="email" name="email" required>
                <i class='bx bxs-user'></i>
            </div>

            <div class="input">
                <input type="password" placeholder="password" name="password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="remember">
                <label>
                    <input type="checkbox">Remember me
                </label>
                <a href="#">Forgot password?</a>
            </div>
            <div>
                <button type="submit" class="btn">Login</button>
            </div>
            <div class="account">
                <p>Don't have an account? <a href="signup.php">Register</a></p>
            </div>
        </form>
    </div>
</body>

</html>