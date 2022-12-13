let menu = document.querySelector('#menu-btn');
let user = document.querySelector('#user-btn');
let navbar = document.querySelector('.header .nav');
let header = document.querySelector('.header');
let accountBox = document.querySelector('.header .account-box');

menu.onclick = () => {
   menu.classList.toggle('fa-times');
   navbar.classList.toggle('active');
   accountBox.classList.remove('active');
}

user.onclick = () => {
   accountBox.classList.toggle('active');
   navbar.classList.remove('active');
}

window.onscroll = () => {
   menu.classList.remove('fa-times');
   navbar.classList.remove('active');
   accountBox.classList.remove('active');

   if (window.scrollY > 0) {
      header.classList.add('active');
   } else {
      header.classList.remove('active');
   }
}