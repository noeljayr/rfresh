const navbar = document.querySelector(".navbar");

navbar.innerHTML = `
<div class="top">
        <a href="http://" target="_blank" rel="noopener noreferrer">
          <img
            loading="lazy"
            src="./public/svg/tabler-icon-brand-facebook.svg"
            alt=""
          />
        </a>
        <a href="http://" target="_blank" rel="noopener noreferrer">
          <img
            loading="lazy"
            src="./public/svg/tabler-icon-brand-x.svg"
            alt=""
          />
        </a>
        <a href="http://" target="_blank" rel="noopener noreferrer">
          <img
            loading="lazy"
            src="./public/svg/tabler-icon-brand-instagram.svg"
            alt=""
          />
        </a>
      </div>

      <div class="bottom">
        <span onclick="toggleActiveMenu(this)" class="mobile-menu">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
        </span>
        <a href="./" class="logo">
          <img loading="lazy" src="./public/logos/logo.png" alt="" />
        </a>
        <span class="links">
          <a class="navlink" href="./">Home</a>

          <a class="navlink" href="./news.php">News</a>
          <span class="navlink">
            Music
            <svg
              width="25"
              height="24"
              viewBox="0 0 25 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M6.2002 9L12.2002 15L18.2002 9"
                stroke="#0D0808"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
          </span>
          <a class="navlink" href="artists.php">Artists</a>
          <a class="navlink" href="videos.php">Videos</a>
          <a class="navlink" href="events.php">Events</a>
          <a class="navlink" href="contact.php">Contact</a>
        </span>

        <span class="navlink nav-search-btn">
          <img loading="lazy" src="././public/svg/tabler-icon-search.svg" />
          <img loading="lazy" src="././public/svg/tabler-icon-x.svg" />
        </span>

        <span class="menu-list">
          <a href="./">Home</a>

          <a href="./news.php">News</a>
          <span>
            Music
            <svg
              width="25"
              height="24"
              viewBox="0 0 25 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M6.2002 9L12.2002 15L18.2002 9"
                stroke="#0D0808"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
          </span>
          <a href="artists.php">Artists</a>
          <a href="videos.php">Videos</a>
          <a href="events.php">Events</a>
          <a href="contact.php">Contact</a>
        </span>
      </div>

`;

var overlay = document.createElement("div")
 overlay.classList.add("menu-overlay")
document.querySelector("body").appendChild(overlay)

function toggleActiveMenu(btn){
  overlay.classList.add("menu-overlay-active")
  document.querySelector(".menu-list").classList.toggle("menu-active")
  btn.classList.toggle("mobile-menu-active");
}


overlay.addEventListener("click", ()=>{
  overlay.classList.remove("menu-overlay-active")
  document.querySelector(".menu-list").classList.remove("menu-active")
  document.querySelector(".mobile-menu").classList.remove("mobile-menu-active");
})