import './bootstrap';
import echo from "./echo.js";

const authEl = document.getElementById('user_id');
const authId = authEl.dataset.userId;

echo.private(`users.${authId}`)
    .listen('BookCreated', (e) => {
        echo.private(`books.${e.book_id}`)
            .listen('BookMetadataExtracted', (e) => {
                console.log(e);
            })
    });


