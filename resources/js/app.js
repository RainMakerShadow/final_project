const toggler = document.getElementById("mega-menu-dropdown-button");
const mNav = document.getElementById("mobile__nav");
const close = document.getElementById("toggler__expanded");

toggler.addEventListener("click", () => {
    mNav.classList.remove("translate-x-full");
});

close.addEventListener("click", () => {
    mNav.classList.add("translate-x-full");
});

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

