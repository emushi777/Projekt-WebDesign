<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ / Help - Moonlight Pages</title>
    <link rel="stylesheet" href="faq.css">
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
        <a href="Comics.php">
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

            <div class="profile-button">
                <a href="login.php">
                    <ion-icon name="person-circle-outline"></ion-icon>
                </a>
            </div>
        </div>
    </div>

    <div class="faq-container">
        <h1 class="faq-title"><span class="pink">FAQ</span> / Help</h1>

    <div class="faq-box">
        <h2>How do I find a book to read?</h2>
        <p>You can browse through the Recommended section on the homepage or use the Authors page to find books by your favorite authors.</p>
    </div>

    <div class="faq-box">
        <h2>How do I join the reading challenge?</h2>
        <p>At the moment, we don't have a reading challenge. Stay tuned for future updates!</p>
    </div>

    <div class="faq-box">
        <h2>Why aren't my book details showing?</h2>
        <p>Make sure you have selected a book from the Recommended section. The sidebar will open on the right.</p>
    </div>

    <div class="faq-box">
        <h2>How do I go to my profile?</h2>
        <p>Click on the profile icon at the top right of the page to access login or profile settings.</p>
    </div>


    <div class="faq-box">
        <h2>Where can I see the authors?</h2>
        <p>You can visit the Authors page through the top navigation menu to explore books by your favorite authors.</p>
    </div>

    <div class="faq-box">
        <h2>Need more help?</h2>
        <p>Feel free to contact us at support@moonlightpages.com.</p>
    </div>
    
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="faq.js"></script>
    
</body>
</html>