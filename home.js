    const notifBtn = document.getElementById('notif-btn');
    const notifList = document.getElementById('notif-list');

        notifBtn.addEventListener('click', (e) => {
            e.stopPropagation(); 
            notifList.classList.toggle('show'); 
        });

        document.addEventListener('click', () => {
            notifList.classList.remove('show'); 
        });

const books = [
    {
        title: "The Poppy War",
        author: "R.F. Kuang",
        genre: "Fantasy",
        pages: 544,
        rating: "4.6 / 5",
        desc: "A grimdark military fantasy inspired by Chinese history. Rin discovers her shamanic powers and is drawn into a brutal war.",
        cover: "https://m.media-amazon.com/images/I/715XKcO4qZL._AC_UF894,1000_QL80_.jpg"
    },
    {
        title: "A Thousand Splendid Suns",
        author: "Khaled Hosseini",
        genre: "Historical Fiction",
        pages: 384,
        rating: "4.7 / 5",
        desc: "The story of two Afghan women whose lives intersect amid war, oppression, and hope.",
        cover: "https://m.media-amazon.com/images/I/81xIPfJ6iUL._AC_UF1000,1000_QL80_.jpg"
    },
    {
        title: "Fearless",
        author: "Lauren Roberts",
        genre: "Romantasy",
        pages: 448,
        rating: "4.9 / 5",
        desc: "The explosive continuation of the Powerless series. As secrets rise and loyalties fracture, Paedyn and Kai face destiny, danger, and a love that threatens everything.",
        cover: "https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1730558434i/214907249.jpg"
    },
    {
        title: "Young Justice (1998)" , 
        author: "DC Comics",
        genre: "Comic / Superhero",
        pages: 32,
        rating: "4.8 / 5",
        desc: "The Young Justice team faces new threats and emotional challenges as the series reaches an intense turning point.",
        cover: "https://imgix-media.wbdndc.net/ingest/book/preview/53847b24-bff0-4d69-aa5e-535614b58fcf/fc91f061-8209-45a1-bfcf-953cbc909699/0.jpg"
    },
    {
       title: "Once Upon a Broken Heart",
        author: "Stephanie Garber",
        genre: "Romantasy",
        pages: 416,
        rating: "4.8 / 5",
        desc: "A whimsical and enchanting romantasy where Evangeline Fox strikes a dangerous deal with the Prince of Hearts, leading her into a world of magic, love, and betrayal.",
        cover: "https://m.media-amazon.com/images/I/81cNHxU3pzL._AC_UF1000,1000_QL80_.jpg"
    },
    {
        title: "The Cruel Prince",
        author: "Holly Black",
        genre: "Fantasy",
        pages: 370,
        rating: "4.5 / 5",
        desc: "A mortal girl fights for power and survival in the cruel world of the Fae.",
        cover: "https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1574535986i/26032825.jpg"
    }
];

    const bookList = document.getElementById("book-list");
    const bookDetails = document.getElementById("book-details");
    bookDetails.addEventListener("click", (e) => {
    e.stopPropagation();
});


    function loadBooks() {
        bookList.innerHTML = "";

    books.forEach((b, index) => {
        const book = document.createElement("div");
        book.className = "book";  
        book.innerHTML = `
            <img src="${b.cover}" alt="${b.title}">
            <p>${b.title}</p>
        `;
        book.onclick = () => showBook(index);
        bookList.appendChild(book);
    });
}

function showBook(i) {
    const b = books[i];

    document.getElementById("book-title").innerText = b.title;
    document.getElementById("book-author").innerText = b.author;
    document.getElementById("book-genre").innerText = b.genre;
    document.getElementById("book-pages").innerText = b.pages;
    document.getElementById("book-rating").innerText = b.rating;
    document.getElementById("book-desc").innerText = b.desc;
    document.getElementById("book-cover").src = b.cover;

    bookDetails.classList.add("show");
    document.getElementById("overlay").classList.add("show");
}

document.addEventListener("click", (e) => {
    if (!e.target.closest("#book-details") && !e.target.closest(".book")) 
        {
        bookDetails.classList.remove("show");
        document.getElementById("overlay").classList.remove("show");
    }
});

loadBooks();

const slides = document.querySelectorAll(".slide");
const nextBtn = document.querySelector(".next");
const prevBtn = document.querySelector(".prev");

let currentSlide = 0;

function showSlide(index) {
    slides.forEach(s => s.classList.remove("active"));
    slides[index].classList.add("active");
}

nextBtn.addEventListener("click", () => {
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
});

prevBtn.addEventListener("click", () => {
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    showSlide(currentSlide);
});

// auto slide (optional)
setInterval(() => {
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
}, 6000);

document.querySelectorAll(".challenge-btn[data-book-index]").forEach(btn => {
    btn.addEventListener("click", (e) => {
        e.stopPropagation(); // ✅ IMPORTANT FIX

        const index = Number(btn.dataset.bookIndex);
        showBook(index);
    });
});
