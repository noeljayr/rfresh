

<!DOCTYPE html>
<html lang="en">



<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home - Reggae Fresh</title>

  <link rel="stylesheet" href="./css/index.css" />
  <link rel="stylesheet" href="./css/posts.css" />
  <link rel="stylesheet" href="./css/events.css">
  <link rel="shortcut icon" href="./public/logos/favicon.png" type="image/x-icon" />

  <script defer src="./js/components/footer.js"></script>
  <script defer src="./js/menu.js"></script>
  <script defer type="module" src="./js/index.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
 
  <nav class="navbar section"></nav>
  <script type="module" src="./js/components/navbar.js"></script>

  <div class="search"></div>
  <script type="module" src="./js/components/search.js"></script>

  <section class="main-content contact-page">
   <h1 class="font-bold text-2xl">Contact us</h1>
    <div class="flex">
      <div class="contact-links flex gap-8">
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
    </div>


    <div class="contact-form">
      
      <div class="input-group">
        <label for="">Email</label>
        <span class="gradient-border">
          <input type="email" placeholder="example@gmail.com">
        </span>
      </div>

      <div class="input-group">
        <label for="">Subject</label>
        <span class="gradient-border">
          <input type="text" placeholder="Your full name">
        </span>
      </div>

      <div class="input-group">
        <label for="">Message</label>
        <span class="gradient-border">
          <textarea placeholder="Your message" name="" id="" cols="30" rows="10"></textarea>
        </span>
      </div>

      <div class="cta mt-4 w-full">Send</div>
    </div>

   
  </section>

  <script src="js/components/navbar.js"></script>

  <!-- <div class="section"></div> -->
  <div class="footer"></div>
</body>

</html>