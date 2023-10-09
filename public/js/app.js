// HEADER VARIABLES

const hamburger = document.querySelector('#hamburger');
const upper = document.querySelector('.upper');
const middle = document.querySelector('.middle');
const lower = document.querySelector('.lower');
const navigationMenu = document.querySelector('.navigation-menu');

// HEADER FUNCTIONS

function displayMenu() {
    upper.classList.toggle('upper-active');
    middle.classList.toggle('middle-active');
    lower.classList.toggle('lower-active');
    navigationMenu.classList.toggle('navigation-menu-active')
}

// CODE

hamburger.onclick = () => displayMenu();