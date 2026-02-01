<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moonlight Pages Bookstore</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>

    <div class="topnav">

    <a href="home.php" class="logo-btn">
        <ion-icon name="library-outline" class="sidebar-icon"></ion-icon>
        <span class="logo-text">
            <span class="pink">Moonlight</span><span class="black">Pages</span>
        </span>
    </a>

    <ul class="nav-categories">
    <li>
        <a href="home.php">
            <ion-icon name="home-outline"></ion-icon>
            Home
        </a>
    </li>

    <li>
        <a href="authors.php">
            <ion-icon name="star-outline"></ion-icon>
            Authors
        </a>
    </li>

    <li>
        <a href="comics.php">
            <ion-icon name="flash-outline"></ion-icon>
            Comics
        </a>
    </li>

    <li>
        <a href="faq-help.php">
            <ion-icon name="help-circle-outline"></ion-icon>
            FAQ / Help
        </a>
    </li>
</ul>
        
        <div class="top-buttons">
            <div class="notification-button" id="notif-btn">
                <ion-icon name="notifications-outline"></ion-icon>
                <div class="notif-list" id="notif-list">
                    <ul>
                        <li>New book released!</li>
                        <li>Discount on bestseller.</li>
                        <li>Buy your favorite books now!</li>
                    </ul>
                </div>
            </div>

            <div class="profile-menu">
                <ion-icon name="person-circle-outline" class="profile-icon" id="profile-btn"></ion-icon>
                <div class="profile-dropdown" id="profile-dropdown">
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <a href="logout.php">Logout</a>
                    <?php else: ?>
                        <a href="login.php">Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="hero-slider">
            <div class="slides">

        <div class="slide active" style="background-image: url('https://www.owlcrate.com/cdn/shop/files/small-Fearless-Square_164f09af-ea50-4479-b217-97b16746cebe.png?v=1757537820&width=1080');">
    <div class="slide-content">
        <h1>Fearless</h1>
        <p>The continuation of the popular Powerless series.</p>
        <button class="challenge-btn" data-book-index="2">View Book</button>
    </div>
    </div>


        <div class="slide" style="background-image: url('https://cdna.artstation.com/p/assets/images/images/050/587/674/large/aw-anqi-final-endsheet.jpg?1655211449');">
            <div class="slide-content">
                <h1>The Poppy War</h1>
                <p>A dark fantasy inspired by war, power, and survival.</p>
                <button class="challenge-btn" data-book-index="0">View Book</button>

            </div>
        </div>

        <div class="slide" style="background-image: url('https://www.hebronhawkeye.com/wp-content/uploads/2023/04/2362F5D2-0CDC-47D3-BF4B-3DDC197B60CB.jpeg');">
            <div class="slide-content">
                <h1>Once Upon a Broken Heart</h1>
                <p>A magical romantasy filled with fate and love.</p>
                <button class="challenge-btn" data-book-index="4">View Book</button>

            </div>
        </div>

    </div>

    <button class="nav prev">&#10094;</button>
    <button class="nav next">&#10095;</button>
</div>


        <div class="recommended">
            <h2>Recommended</h2>
        <div class="book-list" id="book-list">
            <?php
            require 'config/db.php';

            $query = "SELECT * FROM items WHERE page = 'home'";
            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    echo '<div class="book" data-book-id="' . $row['id'] . '">';
                    echo '<img src="' . $row['image_url'] . '" alt="' . htmlspecialchars($row['title']) . '" class="book-cover">';
                    echo '<p class="book-title">' . htmlspecialchars($row['title']) . '</p>';
                    echo '</div>';
                }
            } 
            else{
                echo "<p>Asnjë libër nuk u gjet për këtë faqe.</p>";
            }
            ?>
        </div>

        </div>

        <div class="book-details" id="book-details">
            <button class="close-btn" id="close-btn">×</button>
            <h2 id="book-title">Select a book</h2>
            <img id="book-cover" class="book-cover" src="" >
            <p><strong>Author:</strong> <span id="book-author"></span></p>
            <p><strong>Genre:</strong> <span id="book-genre"></span></p>
            <p><strong>Pages:</strong> <span id="book-pages"></span></p>
            <p><strong>Rating:</strong> <span id="book-rating"></span></p>
            <p id="book-desc"></p>
        </div>
    </div>

    
    <div id="overlay" class="overlay"></div>

    <script>
    const isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
    </script>

    <script src="home.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>