<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #ffafbd, #ffc3a0);
            background: url("img/hero-background.jpg");
            background-position: cover;
        }

        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 50%;
            max-width: 600px;
        }

        .container h1 {
            font-size: 2.5em;
            margin: 0;
            color: #27ae60;
        }

        .container h3 {
            font-size: 1.5em;
            margin-top: 10px;
            color: #34495e;
        }

        .heart {
            color: #e74c3c;
        }

        .container::before {
            content: "✔";
            font-size: 3em;
            color: #27ae60;
            margin-bottom: 20px;
        }

        .btn {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 1em;
            color: #fff;
            background-color: #27ae60;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #2ecc71;
        }

    </style>
</head>
<body>

<div class="container">
    <h1>Payment Successful</h1>
    <h3>Thank you for ordering <span class="heart">❤️</span></h3>
    <a href="menu.php" class="btn">wanna again?</a>
</div>

</body>
</html>
