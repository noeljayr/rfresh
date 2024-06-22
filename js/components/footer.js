const footer = document.querySelector(".footer");
const pPolicy = document.querySelector(".p-policy-credit");
let currentYear = new Date().getFullYear();

if (footer) {
  footer.innerHTML = `
     <div class="info">
        <div class="logo">
          <img src="public/logos/logo-white.png" alt="">
        </div>
      </div>

      <div class="extra">
        © ${currentYear}  Reggae Fresh
        <span>|</span>
        <a href="privacy-policy.php">Privacy Policy</a>
      </div>

      <div class="footer-section contact-links">
        <a href="http://" target="_blank" rel="noopener noreferrer">
          <img src="public/svg/tabler-icon-brand-facebook.svg" alt="" />
        </a>
        <a href="http://" target="_blank" rel="noopener noreferrer">
          <img src="public/svg/tabler-icon-brand-x.svg" alt="" />
        </a>
        <a href="http://" target="_blank" rel="noopener noreferrer">
          <img src="public/svg/tabler-icon-brand-instagram.svg" alt="" />
        </a>
        <a href="http://" target="_blank" rel="noopener noreferrer">
          <img src="public/svg/tabler-icon-brand-youtube.svg" alt="" />
        </a>
      </div>
`;
}
