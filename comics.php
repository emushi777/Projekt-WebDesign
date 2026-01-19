<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Comics - Moonlight Pages</title>
  <link rel="stylesheet" href="comics.css">
</head>
<body>

<div class="topnav">
  <a href="home.html" class="logo-btn">
    <ion-icon name="library-outline"></ion-icon>
    <span class="logo-text">
      <span class="pink">Moonlight</span><span class="black">Pages</span>
    </span>
  </a>

  <ul class="nav-categories">
    <li><a href="home.html"><ion-icon name="home-outline"></ion-icon> Home</a></li>
    <li><a href="authors.html"><ion-icon name="star-outline"></ion-icon> Authors</a></li>
    <li><a href="comics.html"><ion-icon name="flash-outline"></ion-icon> Comics</a></li>
    <li><a href="faq-help.html"><ion-icon name="help-circle-outline"></ion-icon> FAQ / Help</a></li>
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

    <a href="login.html">
      <ion-icon name="person-circle-outline"></ion-icon>
    </a>
  </div>
</div>

<section class="hero">
  <div class="hero-content">
    <h1>Adventure The Comic World</h1>
    <p>Log your comic reads from us so you know what to read next!</p>
    <a 
  href="https://leagueofcomicgeeks.com/" 
  target="_blank" 
  class="hero-btn"
>
  Log your reads
</a>
  </div>
</section>

<section class="books-section">
  <div class="books-container">
    <h2>Featured</h2>

    <div class="books-grid">
    <div class="book-card"
     data-author="Juni Ba"
     data-genre="Superhero"
     data-pages="176"
     data-rating="4.7 / 5"
     data-desc="A heartfelt story about Damian and his journey to become better.">

     <img src="https://static.dc.com/2024-04/TBW_Cv1_00111_DIGITAL.jpg">
     <p>The Boy Wonder</p>
     </div>

      
      <div class="book-card"
        data-author="Joe Kelly"
        data-genre="Superhero"
        data-pages="320"
        data-rating="4.5 / 5"
        data-desc="A chaotic and hilarious crossover featuring Spider-Man and Deadpool.">
        <img src="https://cdn.marvel.com/u/prod/marvel/i/mg/b/60/5ccb3b3bb0921/clean.jpg">
        <p>Spider-Man/Deadpool #50</p>
      </div>

      <div class="book-card"
      data-author="Geoff Johns"
      data-genre="Superhero"
      data-pages="144"
      data-rating="4.6 / 5"
      data-desc="What if there was no Speed Force or Flash family? What would Wally do?">
        <img src="https://jonboymeyers.com/cdn/shop/files/Absolute_Flash_low_res_trade.jpg?v=1741712686">
        <p>Absolute Flash #1 Trade Edition</p>
      </div>

      <div class="book-card"
      data-author="Peter David"
      data-genre="Superhero"
      data-pages="192"
      data-rating="4.4 / 5"
      data-desc="A superhero story following the next generation of popular DC heroes. Starting off with Kon el, Tim Drake and Bart allen!">
        <img src="https://m.media-amazon.com/images/I/91NPYVv68sL._UF1000,1000_QL80_.jpg">
        <p>Young Justice (1998)</p>
      </div>

      <div class="book-card"
      data-author="Judd Winick"
      data-genre="Superhero"
      data-pages="160"
      data-rating="4.5 / 5"
      data-desc="An Green Lantern story exploring power, responsibility, and identity.">
        <img src="https://m.media-amazon.com/images/I/91ovVr2RYfL._AC_UF1000,1000_QL80_.jpg">
        <p>Green Lantern: The Power of Ion</p>
      </div>

      <div class="book-card"
      data-author="Patrick Gleason"
      data-genre="Superhero"
      data-pages="144"
      data-rating="4.6 / 5"
      data-desc="An emotional story focusing on Damian Wayne as Robin and his growth.">
        <img src="https://static.dc.com/dc/files/default_images/robin_sob_1_5b24403f0dbe70.64286619.jpg">
        <p>Robin : Son of Batman Vol.1</p>
      </div>
    </div>
  </div>
</section>

<script src="comics.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>


<div id="book-sidebar" class="book-sidebar">
  <span class="close-btn" id="close-sidebar">&times;</span>

  <img id="sidebar-img" src="" alt="Book cover">
  <h2 id="sidebar-title"></h2>
  <p id="sidebar-author"></p>
  <p id="sidebar-genre"></p>
  <p id="sidebar-pages"></p>
  <p id="sidebar-rating"></p>
  <p id="sidebar-desc"></p>
</div>

<div id="overlay" class="overlay"></div>

</body>
</html>
