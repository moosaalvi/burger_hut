<?php
session_start();
$error_message = '';
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['user'];
    $email = $_POST['id'];
    $password = $_POST['pass'];
    $confirm_password = $_POST['cpass'];
    $balance=50;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Enter a valid email format.';
    } elseif (!preg_match("/^[a-zA-Z]+[a-zA-Z0-9._%+-]*@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
        $error_message = 'Email must contain alphabets and can contain numbers.';
    } elseif (strlen($email) < 11) { 
        $error_message = 'Email must be at least 11 characters long.';
    } elseif ($password !== $confirm_password) {
        $error_message = 'Passwords do not match.';
    } else {
        $con = mysqli_connect("localhost:3307", "root", "", "burger");
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql1 = "SELECT * FROM data WHERE email='$email'";
        $result = mysqli_query($con, $sql1);
        if (mysqli_num_rows($result) > 0) {
            $error_message = 'Email already exists!';
        } else {
            $sql = "INSERT INTO data (username, email, password, card_balance) VALUES ('$username', '$email', '$password','$balance')";
            $run = mysqli_query($con, $sql);

            if ($run) {
                $success_message = 'Registration successful!';
                
            } else {
                $error_message = 'Registration failed.';
            }
        }

        mysqli_close($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link rel="stylesheet" href="forum.css">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="916627364345-ri0gf9omqa6h2j2rmrojvbpmb7q2jtcd.apps.googleusercontent.com">
</head>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: ubuntu;
    }

    body {
        background-color: black;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: black url('img/iconlogo.png') no-repeat;
        background-size: 600px;
        background-position: left;
    }
    .alert {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        padding: 10px;
        z-index: 1000;
        text-align: center;
        color: white;
    }
    .alert-success {
        background-color: green;
    }
    .alert-danger {
        background-color: red;
    }

    .alvi {
        width: 420px;
        background: url('img/about-image.jpg');
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
        cursor: pointer;
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
        background-color: #fff;
        color: black    ;
        font-size: 20px;
        
        text-decoration: none;
        font-weight: bolder;
    }

    .account p a:hover {
        text-decoration: underline;
    }

    .google {
        margin-left: 33%;
    }

    .p {
        color: grey;
        margin-left: 49%;
    }

    .error-message, .success-message {
        text-align: center;
        margin-top: 10px;
        font-size: 16px;
    }

    .error-message {
        color: coral;
    }

    .success-message {
        color: green;
    }
</style>

<body>
    <div class="alvi">
        <form method="POST" action="" onsubmit="return validateForm()">
            <h1>Signup</h1>
            <div id="customAlert" class="alert" style="display:none;"></div>

            <?php if (!empty($error_message)): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <?php if (!empty($success_message)): ?>
                <div class="success-message"><?php echo $success_message; ?></div>
            <?php endif; ?>

            <div class="input">
                <input type="text" placeholder="username" name="user" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input">
                <input type="email" placeholder="email id" name="id" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input">
                <input type="password" placeholder="password" name="pass" required>
                <i class='bx bxs-lock-alt' onclick="togglePasswordVisibility(this, 'pass')"></i>
            </div>
            <div class="input">
                <input type="password" placeholder="confirm password" name="cpass" required>
                <i class='bx bxs-lock-alt' onclick="togglePasswordVisibility(this, 'cpass')"></i>
                <span id="error-message" style="color: red; font-size: 14px;"></span>
            </div><br>
            <div class="remember">
                <label>
                    <input type="checkbox">Remember me
                </label>
            </div>
            <div>
                <button type="submit" class="btn">Signup</button>
            </div>
            <div class="account">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>

            <p class="p">or</p>
            <br>

            <div class="google">
                <div class="g-signin2" data-onsuccess="onSignIn"></div>
            </div>
        </form>
    </div>


    <script>
        function validateForm() {
            var email = document.getElementsByName('id')[0].value;
            var password = document.getElementsByName('pass')[0].value;
            var confirmPassword = document.getElementsByName('cpass')[0].value;
            var errorMessage = document.getElementById('error-message');

            if (email.length < 11) {  
                errorMessage.textContent = 'Email must be at least 11 characters long!';
                return false;
            }

            if (password !== confirmPassword) {
                errorMessage.textContent = 'Passwords do not match!';
                return false;
            }
            errorMessage.textContent = '';
            return true;
        }

        function togglePasswordVisibility(icon, fieldName) {
            var inputField = document.getElementsByName(fieldName)[0];
            if (inputField.type === "password") {
                inputField.type = "text";
                icon.classList.remove('bxs-lock-alt');
                icon.classList.add('bxs-show');
            } else {
                inputField.type = "password";
                icon.classList.remove('bxs-show');
                icon.classList.add('bxs-lock-alt');
            }
        }

        function onSignIn(googleUser) {
            var profile = googleUser.getBasicProfile();
            console.log('ID: ' + profile.getId());
            console.log('Name: ' + profile.getName());
            console.log('Image URL: ' + profile.getImageUrl());
            console.log('Email: ' + profile.getEmail());
        }

        <?php if (!empty($error_message)): ?>
            document.getElementById('customAlert').innerText = '<?php echo $error_message; ?>';
            document.getElementById('customAlert').style.display = 'block';
            setTimeout(function() {
                document.getElementById('customAlert').style.display = 'none';
            }, 2000);
        <?php endif; ?>
    </script>
</body>

</html>
