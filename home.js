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
        title: "Six of Crows",
        author: "Leigh Bardugo",
        genre: "Fantasy / Heist",
        pages: 465,
        rating: "4.7 / 5",
        desc: "A criminal prodigy assembles an impossible heist team for an impossible job.",
        cover: "https://m.media-amazon.com/images/I/91v7vX+P9SL._AC_UF1000,1000_QL80_.jpg"
    },
    {
        title: "Fourth Wing",
        author: "Rebecca Yarros",
        genre: "Romantasy",
        pages: 528,
        rating: "4.9 / 5",
        desc: "A fragile girl enters a brutal dragon rider academy where survival is rare.",
        cover: "https://m.media-amazon.com/images/I/91KVLRSeBVL.jpg"
    },
    {
        title: "The Cruel Prince",
        author: "Holly Black",
        genre: "Fantasy",
        pages: 370,
        rating: "4.5 / 5",
        desc: "A mortal girl fights for power and survival in the cruel world of the Fae.",
        cover: "https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1574535986i/26032825.jpg"
    },
    {
        title: "The Night Circus",
        author: "Erin Morgenstern",
        genre: "Fantasy / Romance",
        pages: 400,
        rating: "4.7 / 5",
        desc: "A magical circus appears only at night, hiding a deadly competition between two magicians.",
        cover: "https://m.media-amazon.com/images/I/81KtmXSqqyL._AC_UF894,1000_QL80_.jpg"
    }
];

    const bookList = document.getElementById("book-list");
    const bookDetails = document.getElementById("book-details");

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
}

document.addEventListener("click", (e) => {
    if (!e.target.closest("#book-details") && !e.target.closest(".book")) {
        bookDetails.classList.remove("show");
    }
});

loadBooks();