<?php
  // Include necessary files and start session if required
  include 'admin/classes/dbh.php'; 
  include 'admin/classes/post/post.php';

  // Instantiate PostManager
  $postManager = new PostManager();

  $artist = $postManager->getPostsByCategoryDescending("Artists");

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Artists - Reggae Fresh</title>

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
          <h1>Artists</h1>
        </span>
        <div class="post-container">
        <?php
          for ( $i = 0; $i < count($artist); $i ++ )
          {
            echo '
          <a href="" class="post">
            <span class="category">Artists</span>
            <img
            src="'.$artist[$i]['thumbnail_path'] .'" alt="'.$artist[$i]['thumbnail_alt'] .'"
            />
            <span class="overlay"
              ><span title="Title" class="title">'.$artist[$i]['title'] .'</span></span
            >
          </a>
            ';
          }
        ?>
          
        </div>
      </div>
    </section>

    <script src="js/components/navbar.js"></script>

    <!-- <div class="section"></div> -->
    <div class="footer"></div>
  </body>
</html>
