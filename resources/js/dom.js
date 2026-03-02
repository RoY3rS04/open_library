const notificationCloseBtns = document.querySelectorAll('.close-notification');

notificationCloseBtns.forEach((el) => {
    el.addEventListener('click', (e) => {
        const parent = document.querySelector(`[data-uuid="${e.target.dataset.uuid}"]`);

        parent.remove();
    })
})
