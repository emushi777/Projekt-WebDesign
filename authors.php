<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

require_once "classes/Database.php";
require_once "classes/Item.php";

$conn = Database::connect();
$itemModel = new Item($conn);
$books = $itemModel->getByPage('authors');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Authors - Moonlight Pages</title>
  <link rel="stylesheet" href="authors.css" />
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

  <main class="author-page">

    <section class="author-hero">
      <div class="author-info">
        <h1>MOST POPULAR AUTHOR OF THE MONTH</h1>
        <p>
          One of Kafka's best-known works, The Metamorphosis tells the story of salesman Gregor Samsa,
          who wakes to find himself inexplicably transformed into a huge insect and struggles to adjust
          to this condition, as does his family.
        </p>

        <a href="https://en.wikipedia.org/wiki/Franz_Kafka" target="_blank" class="hero-btn">
          Learn more
        </a>
      </div>

      <div class="author-book">
        <a href="https://en.wikipedia.org/wiki/The_Metamorphosis" target="_blank">
        <img
          src="https://m.media-amazon.com/images/I/81LBl7WSLXL._AC_UF1000,1000_QL80_.jpg"
          alt="The Metamorphosis"
        />
       </a>
      </div>
    </section>

    <section class="books-section">
      <h2>More from Kafka</h2>

      <div class="books-grid">

        <div class="book-card"
        data-author="Franz Kafka"
        data-genre="Literature"
        data-pages="255"
        data-rating="4.6 / 5"
        data-desc="A haunting novel about a man arrested and prosecuted by an inaccessible authority for an unknown crime.">
          <img
            src="https://m.media-amazon.com/images/I/51lgU23tegL._AC_UF1000,1000_QL80_.jpg"
            alt="The Trial"
          />
          <p>The Trial</p>
        </div>

        <div class="book-card"
        data-author="Franz Kafka"
        data-genre="Letters / Literature"
        data-pages="250-400"
        data-rating="4.6 / 5"
        data-desc="An intimate collection of letters revealing Kafka's emotional depth, vulnerability, and complex love for Milena Jesenská.">
          <img
            src="https://images.penguinrandomhouse.com/cover/9780805212679"
            alt="Letters To Milena"
          />
          <p>Letters To Milena</p>
        </div>

        <div class="book-card"
          data-author="Franz Kafka"
          data-genre="Literature"
          data-pages="352"
          data-rating="4.4 / 5"
          data-desc="A surreal and unfinished novel about a man's futile struggle against an incomprehensible bureaucratic system.">

          <img
            src="https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1746885413i/333538.jpg"
            alt="The Castle"
          />
          <p>The Castle</p>
        </div>

        <div class="book-card"
        data-author="Franz Kafka"
        data-genre="Literature"
        data-pages="240"
        data-rating="4.2 / 5"
       data-desc="Kafka's first novel, portraying a young immigrant's strange and often absurd experiences in an imagined America.">

          <img
            src="https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1444653451i/25842265.jpg"
            alt="Amerika"
          />
          <p>Amerika</p>
        </div>
        </div>
        <h2>Latest additions</h2>

    <div class="books-grid">
    <?php while ($book = $books->fetch_assoc()): ?>
    <div class="book-card"
      data-author="<?php echo htmlspecialchars($book['author']); ?>"
      data-genre="<?php echo htmlspecialchars($book['genre']); ?>"
      data-pages="<?php echo htmlspecialchars($book['pages']); ?>"
      data-rating="<?php echo htmlspecialchars($book['rating']); ?>"
      data-desc="<?php echo htmlspecialchars($book['description']); ?>">

      <img src="<?php echo htmlspecialchars($book['image_url']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>">
      <p><?php echo htmlspecialchars($book['title']); ?></p>
     </div>
     <?php endwhile; ?>
     </div>
     </div>


    </section>

    <section class="other-authors">
      <h2>Explore Other Authors</h2>

      <div class="authors-grid">
        <a href="https://en.wikipedia.org/wiki/George_Orwell" target="_blank" class="author-card">
          <img
            src="https://upload.wikimedia.org/wikipedia/commons/8/82/George_Orwell%2C_c._1940_%2841928180381%29.jpg"
            alt="George Orwell"
          />
          <span>George Orwell</span>
        </a>

        <a href="https://en.wikipedia.org/wiki/Albert_Camus" target="_blank" class="author-card">
          <img
            src="https://naccnaca-biographies.s3.amazonaws.com/17663/albertcamus_bioweb.jpg"
            alt="Albert Camus"
          />
          <span>Albert Camus</span>
        </a>

        <a href="https://en.wikipedia.org/wiki/Fyodor_Dostoevsky" target="_blank" class="author-card">
          <img
            src="https://geniusrevive.com/wp-content/uploads/2017/05/fyodor-dostoevsky.jpg"
            alt="Fyodor Dostoevsky"
          />
          <span>Fyodor Dostoevsky</span>
        </a>

        <a href="https://en.wikipedia.org/wiki/Virginia_Woolf" target="_blank" class="author-card">
          <img
            src="https://upload.wikimedia.org/wikipedia/commons/0/0b/George_Charles_Beresford_-_Virginia_Woolf_in_1902_-_Restoration.jpg"
            alt="Virginia Woolf"
          />
          <span>Virginia Woolf</span>
        </a>
      </div>
    </section>

  </main>

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

    <script>
    const isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
    </script>

<script src="authors.js"></script>

</body>
</html>