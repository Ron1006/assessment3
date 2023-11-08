const mobileMenuButton = document.getElementById('mobile-menu');
const navList = document.querySelector('.nav-list');

mobileMenuButton.addEventListener('click', () => {
    if (navList.style.height === '60vh') {
        navList.style.height = '0';
    } else {
        navList.style.height = '60vh';
    }
});
