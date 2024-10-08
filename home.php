<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Burger Hut</title>
    <link rel="stylesheet" type="text/css" href="home.css">
    <link rel="shortcut icon" href="img/iconlogo1.png">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link href="css/responsive.css" rel="stylesheet" />
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

            <?php if (isset($_SESSION['email'])): ?>
                    <li><a href="logout.php" class="log">Logout</a></li>
                <?php else: $home="home"; ?>
                    <li><a href="login.php?home=$home" class="login">Login |</a></li>
                    <li><a href="signup.php" class="log">Signup</a></li>
                <?php endif; ?>

                <?php if (isset($_SESSION['email'])): ?>
                    <li><a href="product.php">Become a Seller</a></li>
                    <li><a href="cart.php">Cart</a></li>
                <?php endif; ?>
                
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="reser.php">Reservations</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>
   


    <section class="hero">
        <div class="hero-content">
            <h1><span>Welcome to</span> Burger Hut</h1>
            <p>Experience the Taste of Perfection</p>
            <p><span>Fresh Bowrgers in Town!</span></p>
            <a href="menu.php" class="btn">Order Now</a>
        </div>
    </section>

    <section class="about dark-theme">
        <div class="about-content">
            <h2>About <span>Burger Hut</span></h2>
            <p>Experience the finest gourmet burgers in a cozy and rustic atmosphere. At Burger Hut, we are dedicated to delivering exceptional flavors that will tantalize your taste buds.</p>
            <p>Our chefs meticulously craft each burger using locally sourced ingredients and unique flavor combinations. From juicy beef patties to mouthwatering vegetarian options, there's something for everyone.</p>
            <a href="#menu" class="btn">Explore Our Menu</a>
        </div>
        <div class="about-image">
            <img src="img/about-image.jpg" alt="About Image">
        </div>
    </section>

    <section class="menu">
        <h2>Our Products</h2>
        <div class="menu-items">
            <div class="menu-item">
                <img src="img/burger1.jpg" alt="Burger 1">
                <h3>Classic Cheeseburger</h3>
                <p>A juicy beef patty topped with melted cheese, fresh lettuce, tomato, and our special sauce. Served with a side of crispy fries.</p>
            </div>
            <div class="menu-item">
                <img src="img/burger2.jpg" alt="Burger 2">
                <h3>Veggie Delight</h3>
                <p>A delicious veggie patty made from a blend of fresh vegetables and spices. Topped with avocado, sprouts, and tangy mayo. Served with a side of sweet potato fries.</p>
            </div>
            <div class="menu-item">
                <img src="img/burger3.jpg" alt="Burger 3">
                <h3>Spicy BBQ Burger</h3>
                <p>A fiery burger packed with flavor! Grilled chicken breast smothered in spicy BBQ sauce, topped with jalapenos, crispy onion rings, and chipotle mayo. Served with a side of coleslaw.</p>
            </div>
            <div class="menu-item">
                <img src="img/black bun.webp" alt="Burger 3">
                <h3>Black Bun Burger</h3>
                <p>A fiery burger packed with flavor! Grilled chicken breast smothered in spicy BBQ sauce, topped with jalapenos, crispy onion rings, and chipotle mayo. Served with a side of coleslaw.</p>
            </div>
            <div class="menu-item">
                <img src="img/tower burger.webp" alt="Burger 3">
                <h3>Tower Burger</h3>
                <p>A fiery burger packed with flavor! Grilled chicken breast smothered in spicy BBQ sauce, topped with jalapenos, crispy onion rings, and chipotle mayo. Served with a side of coleslaw.</p>
            </div>
            <div class="menu-item">
                <img src="img/blast.jpg" alt="Burger 3">
                <h3>Blasty Burger</h3>
                <p>A fiery burger packed with flavor! Grilled chicken breast smothered in spicy BBQ sauce, topped with jalapenos, crispy onion rings, and chipotle mayo. Served with a side of coleslaw.</p>
            </div>
            <div class="menu-item">
                <img src="img/fries.jpg" alt="Burger 3">
                <h3>Mayo layered Fries</h3>
                <p>A fiery burger packed with flavor! Grilled chicken breast smothered in spicy BBQ sauce, topped with jalapenos, crispy onion rings, and chipotle mayo. Served with a side of coleslaw.</p>
            </div>
            <div class="menu-item">
                <img src="img/loaded.jpg" alt="Burger 3">
                <h3>Loaded Fries</h3>
                <p>A fiery burger packed with flavor! Grilled chicken breast smothered in spicy BBQ sauce, topped with jalapenos, crispy onion rings, and chipotle mayo. Served with a side of coleslaw.</p>
            </div>
            <div class="menu-item">
                <img src="img/zinger.jpg" alt="Burger 3">
                <h3>Zinger Burger</h3>
                </h3>
                <p>A fiery burger packed with flavor! Grilled chicken breast smothered in spicy BBQ sauce, topped with jalapenos, crispy onion rings, and chipotle mayo. Served with a side of coleslaw.</p>
            </div>
        </div>
    </section>



    <section class="reservations">
        <div class="reservation-form">
            <h2>Make a Reservation</h2>
            <form>
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <input type="tel" name="phone" placeholder="Phone Number" required>
                <input type="date" name="date" required>
                <input type="time" name="time" required>
                <textarea name="message" placeholder="Additional Message" rows="5"></textarea>
                <button type="submit">Submit</button>
            </form>
        </div>
    </section>

    <section class="testimonials">
        <h2>What Our Customers Say</h2>
        <div class="testimonial">
            <img src="img/customer1.jpg" alt="Customer 1">
            <p>"The burgers at Burger Hut are simply amazing! The flavors are rich, and the ingredients are always fresh. It's my go-to place whenever I'm craving a delicious meal."</p>
            <h4>Group Project</h4>
        </div>
        <div class="testimonial">
            <img src="img/customer2.jpg" alt="Customer 2">
            <p>"Burger Hut never disappoints! The quality of their burgers and the friendly service make it a top-notch dining experience. I highly recommend it to all burger lovers!"</p>
            <h4>Group Project</h4>
        </div>
    </section>

    <section class="gallery">
        <h2>Gallery</h2>
        <div class="image-grid">
            <div class="image-item">
                <img src="img/gallery1.jpg" alt="Image 1">
            </div>
            <div class="image-item">
                <img src="img/gallery2.jpg" alt="Image 2">
            </div>
            <div class="image-item">
                <img src="img/gallery3.jpg" alt="Image 3">
            </div>
            <div class="image-item">
                <img src="img/gallery4.jpg" alt="Image 4">
            </div>
        </div>
    </section>

    <section class="contact">
        <div class="contact-container">
            <h2>Contact Us</h2>
            <div class="contact-info">
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <p>123 Main Street, Nankana, Pakistan</p>
                </div>
                <div class="info-item">
                    <i class="fas fa-phone-alt"></i>
                    <p>+923144827963</p>
                </div>
                <div class="info-item">
                    <i class="fas fa-envelope"></i>
                    <p>info@burgerhut.com</p>
                </div>
            </div>
            <form class="contact-form">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-logo">
                <img src="img/iconlogo.png" alt="Logo">
            </div>
            <nav class="footer-links">
                <a href="#">Home</a>
                <a href="#">About</a>
                <a href="#">Menu</a>
                <a href="reser.php">Reservations</a>
                <a href="#">Testimonials</a>
                <a href="#">Gallery</a>
                <a href="#">Contact</a>
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