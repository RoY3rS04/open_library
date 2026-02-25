const target = document.getElementById('target');
const input = document.getElementById('file');
const submitBtn = document.querySelector('.submitBtn');
const targetHeading = document.querySelector('.target__heading');

target.addEventListener("dragover", function (e) {
    e.preventDefault();
});

target.addEventListener("drop", function (e) {
    e.preventDefault();

    if(!e.dataTransfer.files[0].type.includes('pdf')) {
        return;
    }

    input.files = e.dataTransfer.files;
    input.dispatchEvent(new Event('change', {bubbles: true}));
})

input.addEventListener('change', function (e) {
    targetHeading.classList.add('hidden');
    input.classList.remove('hidden');
    submitBtn.disabled = false;
})
