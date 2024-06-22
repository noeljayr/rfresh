<?php
  // Include necessary files and start session if required
  include 'admin/classes/dbh.php'; 
  include 'admin/classes/post/post.php';

  // Instantiate PostManager
  $postManager = new PostManager();

  $single = $postManager->getPostsByCategoryDescending("Singles");

?>  
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Singles - Reggae Fresh</title>

    <link rel="stylesheet" href="./css/index.css" />
    <link rel="stylesheet" href="./css/posts.css" />
    <link
      rel="shortcut icon"
      href="./public/logos/favicon.png"
      type="image/x-icon"
    />

    <script defer src="./js/components/footer.js"></script>
    <script defer src="./js/menu.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body>
    <nav class="navbar section"></nav>
    <script type="module" src="./js/components/navbar.js"></script>

    <div class="search"></div>
    <script type="module" src="./js/components/search.js"></script>

    <section class="main-content">
      <div class="section">
        <span class="flex section-header">
          <h1>Singles</h1>
        </span>
        <div class="post-container">
          <a href="" class="post">
            <span class="category">Singles</span>
            <img
              src="public/images/Screenshot-2023-12-03-at-4.48 1.png"
              alt=""
            />
            <span class="overlay"
              ><span title="Title" class="title">Title</span></span
            >
          </a>
          <a href="" class="post">
            <span class="category">Singles</span>
            <img
              src="public/images/Screenshot-2023-12-03-at-4.48 1.png"
              alt=""
            />
            <span class="overlay"
              ><span title="Title" class="title">Title</span></span
            >
          </a>
          <a href="" class="post">
            <span class="category">Singles</span>
            <img
              src="public/images/Screenshot-2023-12-03-at-4.48 1.png"
              alt=""
            />
            <span class="overlay"
              ><span title="Title" class="title">Title</span></span
            >
          </a>
          <a href="" class="post">
            <span class="category">Singles</span>
            <img
              src="public/images/Screenshot-2023-12-03-at-4.48 1.png"
              alt=""
            />
            <span class="overlay"
              ><span title="Title" class="title">Title</span></span
            >
          </a>
          <a href="" class="post">
            <span class="category">Singles</span>
            <img
              src="public/images/Screenshot-2023-12-03-at-4.48 1.png"
              alt=""
            />
            <span class="overlay"
              ><span title="Title" class="title">Title</span></span
            >
          </a>
          <a href="" class="post">
            <span class="category">Singles</span>
            <img
              src="public/images/Screenshot-2023-12-03-at-4.48 1.png"
              alt=""
            />
            <span class="overlay"
              ><span title="Title" class="title">Title</span></span
            >
          </a>
        </div>
      </div>
    </section>

    <script src="js/components/navbar.js"></script>

    <!-- <div class="section"></div> -->
    <div class="footer"></div>
  </body>
</html>
