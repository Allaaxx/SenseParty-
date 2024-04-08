document.addEventListener('DOMContentLoaded', function() {
    const menuIcon = document.querySelector('.menu-icon');
    const closeIcon = document.querySelector('.close-icon');

    menuIcon.addEventListener('click', function() {
        menuIcon.classList.remove('show');
        closeIcon.classList.add('show');
    });

    closeIcon.addEventListener('click', function() {
        closeIcon.classList.remove('show');
        menuIcon.classList.add('show');
    });
});
