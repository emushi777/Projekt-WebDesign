window.onload = () => {

  const notifBtn = document.getElementById('notif-btn');
  const notifList = document.getElementById('notif-list');

  if (notifBtn && notifList) {
    notifBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      notifList.classList.toggle('show');
    });

    document.addEventListener('click', () => {
      notifList.classList.remove('show');
    });
  }

  const books = document.querySelectorAll('.book-card');
  const sidebar = document.getElementById('book-sidebar');
  const overlay = document.getElementById('overlay');
  const closeBtn = document.getElementById('close-sidebar');

  const sidebarImg = document.getElementById('sidebar-img');
  const sidebarTitle = document.getElementById('sidebar-title');
  const sidebarAuthor = document.getElementById('sidebar-author');
  const sidebarGenre = document.getElementById('sidebar-genre');
  const sidebarPages = document.getElementById('sidebar-pages');
  const sidebarRating = document.getElementById('sidebar-rating');
  const sidebarDesc = document.getElementById('sidebar-desc');

  books.forEach(book => {
    book.addEventListener('click', () => {
      sidebarImg.src = book.querySelector('img').src;
      sidebarTitle.textContent = book.querySelector('p').textContent;

sidebarAuthor.textContent = 'Author: ' + book.dataset.author;
sidebarGenre.textContent = 'Genre: ' + book.dataset.genre;
sidebarPages.textContent = 'Pages: ' + book.dataset.pages;
sidebarRating.textContent = 'Rating: ' + book.dataset.rating;
sidebarDesc.textContent = book.dataset.desc;


      sidebar.classList.add('open');
      overlay.classList.add('show');
    });
  });

  closeBtn.addEventListener('click', closeSidebar);
  overlay.addEventListener('click', closeSidebar);

  function closeSidebar() {
    sidebar.classList.remove('open');
    overlay.classList.remove('show');
  }
  const profileBtn = document.getElementById('profile-btn');
  const profileDropdown = document.getElementById('profile-dropdown');

  if(profileBtn){
      profileBtn.addEventListener('click', function(e){
          if(!isLoggedIn){
              window.location.href = 'login.php';
          } 
          else{
              e.stopPropagation();
              profileDropdown.classList.toggle('active');
          }
      });
  }

  document.addEventListener('click', function() {
      if(profileDropdown){
          profileDropdown.classList.remove('active');
      }
  });
};
