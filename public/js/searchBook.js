const search = document.getElementById("search");
const items = document.querySelectorAll(".book-container .book-item");

search.addEventListener('input', (e) => searchData(e.target.value));

function searchData(searchBook) {
    let found = false;

    items.forEach((item) => {
        if(item.innerText.toLowerCase().includes(searchBook.toLowerCase())) {
            item.classList.remove('d-none');
            found = true;
        } else {
            item.classList.add('d-none');
        }
    });

    const message = document.getElementById("message");
    message.textContent = found ? '' : 'Buku tidak ditemukan';
}