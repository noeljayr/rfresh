const menuBtn = document.querySelector(".mobile-menu");
const menuList = document.querySelector(".menu-list");


menuBtn.addEventListener("click", () => {
    menuList.classList.toggle("menu-active")
    menuBtn.classList.toggle("mobile-menu-active");
})

document.addEventListener("click", function (event) {
  if (event.target !== menuBtn && event.target !== menuList) {
   menuList.classList.remove("menu-active");
     menuBtn.classList.remove("mobile-menu-active");
  }
});


menuBtn.addEventListener("click", () => {
  event.stopPropagation();
});


menuList.addEventListener("click", () => {
  event.stopPropagation();
});


