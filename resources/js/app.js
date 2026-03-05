import './bootstrap';
import echo from "./echo.js";

const NOTIFICATION_SUCCESS = 1;
const NOTIFICATION_ERROR = 2;
const NOTIFICATION_INFORMATION = 3;

const USER_ADMIN = 'admin';
const USER_NORMAL = 'user';

const authEl = document.getElementById('user_info');
const authId = authEl.dataset.userId;
const authRole = authEl.dataset.userRole;

const nav = document.querySelector('.nav-container');
const collapseNavBtn =document.querySelector('.nav-btn');

const notificationsContainer = document.getElementById('notifications');
const notificationCloseBtns = getCloseNotificationBtns();
const navTitles = document.querySelectorAll('.nav-title');

collapseNavBtn.addEventListener('click', (e) => {
   nav.classList.toggle('md:w-60');
   nav.children[0].classList.toggle('md:items-start');
   navTitles.forEach((nav) => nav.classList.toggle('md:block'));
});

registerClickOnCloseNotificationBtns(notificationCloseBtns);

// REFACTOR Notifications
echo.private(`users.${authId}`)
    .listen('BookCreated', (e) => {
        echo.private(`books.${e.book_id}`)
            .listen('BookMetadataExtracted', (e) => {
                notificationsContainer.innerHTML = '';

                notificationsContainer.innerHTML = generateNotification(
                    e.type, e.id, e.title, e.msg, e.action_url, e.action_desc
                );

                registerClickOnCloseNotificationBtns(
                    getCloseNotificationBtns()
                );
            })
    })
    .listen('BookMetadataExtractionFailed', (e) => {
        notificationsContainer.innerHTML = '';

        notificationsContainer.innerHTML = generateNotification(
            e.type, e.id, e.title, e?.msg, e?.action_url, e?.action_desc
        );

        registerClickOnCloseNotificationBtns(
            getCloseNotificationBtns()
        );
    })
    .listen('BookProposalResult', (e) => {
        notificationsContainer.innerHTML = '';

        notificationsContainer.innerHTML = generateNotification(
            e.type, e.id, e.title, e?.msg, e?.action_url, e?.action_desc
        );

        registerClickOnCloseNotificationBtns(
            getCloseNotificationBtns()
        );
    });

if (authRole === USER_ADMIN) {
    echo.private('users.admins.proposals')
        .listen('NewBookProposal', (e) => {
            notificationsContainer.innerHTML = '';

            notificationsContainer.innerHTML = generateNotification(
                e.type, e.id, e.title, e?.msg, e?.action_url, e?.action_desc
            );

            registerClickOnCloseNotificationBtns(
                getCloseNotificationBtns()
            );
        })
}

function getCloseNotificationBtns() {
    return document.querySelectorAll('.close-notification');
}

function registerClickOnCloseNotificationBtns(btns) {
    btns.forEach((el) => {
        el.addEventListener('click', (e) => {
            const parent = document.querySelector(`[data-uuid="${e.currentTarget.dataset.uuid}"]`);

            parent.remove();
        })
    });
}

function generateNotification(type, uuid, title, msg = null, action_url = null, action_desc = null) {

    let styles = '';
    let icon = '';
    switch (type) {
        case NOTIFICATION_SUCCESS:
            styles = 'bg-green-200 border-green-800 text-green-800';
            icon = `
                 <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
</svg>
         `;
            break;
        case NOTIFICATION_ERROR:
            styles = 'bg-red-200 border-red-800 text-red-800';
            icon = `
            <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
</svg>
`;
            break;
        case NOTIFICATION_INFORMATION:
            styles = 'bg-blue-200 border-blue-800 text-blue-800';
            icon = `
            <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
</svg>`;
            break;
    }

return `<div data-uuid="${uuid}" class="w-full p-3 flex flex-col gap-y-3 border-2 ${styles}">
            <div class="flex items-center justify-between gap-x-5">
                <div class="flex items-center gap-x-1">
                    ${icon}
                    <p class="font-medium text-md">${title}</p>
                </div>
                <button data-uuid="${uuid}" class="cursor-pointer close-notification">
                    <svg class="size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
                <div class="space-y-2">
                    ${msg ? `<p class="text-xs text-current">${msg}</p>` : ''}
                    ${action_url ?
    `<a class="p-2 border-2 border-current self-start" href="${action_url}">${action_desc}</a>`: ''}
                </div>
       </div>`;
}

