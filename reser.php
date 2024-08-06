<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reservation</title>
</head>
<body>
    <style>
        .reservations {
  background-color: #1f1f1f;
  padding: 80px 0;
  text-align: center;
}

.reservation-form {
  max-width: 500px;
  margin: 0 auto;
  background-color: #333;
  padding: 40px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}

.reservation-form h2 {
  color: #fff;
  font-size: 28px;
  margin-bottom: 20px;
}

.reservation-form form input,
.reservation-form form textarea {
  display: block;
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border-radius: 5px;
  border: none;
}

.reservation-form form button {
  display: inline-block;
  background-color: #ff0000;
  color: #fff;
  padding: 10px 20px;
  border-radius: 5px;
  text-decoration: none;
  font-weight: bold;
  transition: background-color 0.3s ease;
}

.reservation-form form button:hover {
  background-color: #e60000;
}

    </style>
    
<section class="reservations">
        <div class="reservation-form">
            <h2>Make a Reservation</h2>
            <form method="POST">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <input type="tel" name="phone" placeholder="Phone Number" required>
                <input type="date" name="date" required>
                <input type="time" name="time" required>
                <textarea name="message" placeholder="Additional Message" rows="5"></textarea>
                <button type="submit" name="submit">Submit</button>
            </form>
        </div>
    </section>

</body>
</html>
<?php
$con=mysqli_connect("localhost:3307","root","","burger");
if(!$con){
    die("connection failed");
}

if(isset($_POST['submit'])){
    $name=@$_POST['name'];
    $email=@$_POST['email'];
    $phone=@$_POST['phone'];
    $date=@$_POST['date'];
    $time=@$_POST['time'];
    $message=@$_POST['message'];
    $sql="INSERT INTO reserve (`name`, `email`, `phone_number`, `date`, `time`, `message`) VALUES('$name', '$email', '$phone', '$date', '$time', '$message' )";
    $query=mysqli_query($con,$sql);
}
?>