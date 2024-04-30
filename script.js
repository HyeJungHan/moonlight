const header = document.querySelector('header');

if (header) {
    function fixedNavbar() {
        header.classList.toggle('scrolled', window.pageYOffset > 0)
    }
    fixedNavbar();
    window.addEventListener('scroll', fixedNavbar);
}
else {
    console.error('Header element not found');
}

const menu = document.querySelector('#menu-btn');
const userBtn = document.querySelector('#user-btn');

if (menu) {
    menu.addEventListener('click', function() {
        const nav = document.querySelector('.navbar');
        if (nav) {
            nav.classList.toggle('active');    
        }
        else {
            console.error('Navbar element not found');
        }
    });
}
else {
    console.error('Menu button element not found');
}

if (userBtn) {
    userBtn.addEventListener('click', function() {
        const userBox = document.querySelector('.user_box');
        if (userBox) {
            userBox.classList.toggle('active');
        }
        else {
            console.error('User box element not found');
        }
    });
}
else {
    console.error('User button element not found');
}
