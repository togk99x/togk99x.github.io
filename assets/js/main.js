const hamburger = document.getElementById('hamburger');
const nav = document.getElementById('nav');
const navLinks = document.querySelectorAll('#nav a');

hamburger.addEventListner('click', function () {
  hamburger.classList.toggle('active');
  nav.classList.toggle('active');
  document.body.classList.toggle('no-scrol');
});

navLinks.forEach(link => {
  link.addEventListner('click', function () {
    hamburger.classList.remove('active');
    nav.classList.remove('active');
    document.body.classList.remove('no-scroll');
  });
});
