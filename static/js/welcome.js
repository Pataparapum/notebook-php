const navbar = document.querySelector(".navbar");
const welcome = document.querySelector(".welcome");
const navbarToggle = document.querySelector("#navbarNav");

console.log(navbar);
console.log(welcome);
console.log(navbarToggle);

const resizeBakgroundImg = () => {
  const height = window.innerHeight - navbar.clientHeight;
  welcome.style.height = `${height}px`;
};


navbarToggle.ontransitionEnd = resizeBakgroundImg();
navbarToggle.ontransitionStart = resizeBakgroundImg();
window.onresize = resizeBakgroundImg();
window.onload = resizeBakgroundImg();

