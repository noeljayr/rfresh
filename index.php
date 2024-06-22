<?php
  include 'admin/classes/dbh.php'; 

  // ini_set('display_errors', 1);
  // ini_set('display_startup_errors', 1);
  // error_reporting(E_ALL);

   
  include 'admin/classes/post/post.php';
  include_once 'admin/classes/events/event.php';


  // Instantiate PostManager
  $postManager = new PostManager();

  // Retrieve all posts except those with category "news"
  $postsExceptNews = $postManager->getAllPostsExceptNews();

  // Retrieve news posts
  $newsPosts = $postManager->getNewsPosts();

  // Create an instance of the EventManager class
  $eventManager = new EventManager();

  // Call the getEventsDescending function to retrieve events
  $events = $eventManager->getEventsDescending();

  $artist = $postManager->getPostsByCategoryDescending("Artists");
  $single = $postManager->getPostsByCategoryDescending("Singles");
  $video = $postManager->getPostsByCategoryDescending("Videos");
  $riddim = $postManager->getPostsByCategoryDescending("Riddims");
?>

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

  <section class="main-content">
    <div class="latest">
      <!-- <div class="top-latest"> -->
      <!-- <div class="left"> -->
      
      <?php 

         echo  '
         <a id="hero-post" href="post.php?post_name='.$postsExceptNews[0]['post_name'].'" class="t-latest post">
         <span class="category">'.$postsExceptNews[0]['category'].'</span>
         <img loading="lazy" src="'.$postsExceptNews[0]['thumbnail_path'].'" alt="" />
         <img src="'.$postsExceptNews[0]['thumbnail_path'].'" alt="" class="image-blur" />
         <span class="overlay">
           <span class="title text-lg font-bold">'.$postsExceptNews[0]['title'].'</span>
         </span>
       </a>
         ';

      ?>
      <?php 

        //  for ( $i = 0;  $i < p0){}
      ?>
    <?php 

        for ( $i = 1;  $i < 3; $i  ++)
        {
        if  ( count($postsExceptNews) < $i+1 )
        {
          break;
        } else  {
          echo  '
          <a id="hero-post" href="post.php?post_name='.$postsExceptNews[$i]['post_name'].'" class="t-latest post">
          <span class="category">'.$postsExceptNews[$i]['category'].'</span>
          <img loading="lazy" src="'.$postsExceptNews[$i]['thumbnail_path'].'" alt="" />
          <img src="'.$postsExceptNews[$i]['thumbnail_path'].'" alt="" class="image-blur" />
          <span class="overlay">
            <span class="title text-lg font-bold">'.$postsExceptNews[$i]['title'].'</span>
          </span>
          </a>
          ';
        }
        }
      ?>

      <!-- </div> -->
      <div class="bottom-latest post-container">
   
        <?php
          echo  '
          <a href="post.php?post_name='.$postsExceptNews[3]['post_name'].'" class="b-latest post">
          <span class="category">'.$postsExceptNews[3]['category'].'</span>
          <img src="'.$postsExceptNews[3]['thumbnail_path'].'" alt="" />
          <span class="overlay"><span title="Title" class="title">'.$postsExceptNews[3]['title'].'</span></span>
        </a>
          ';
        ?>
        <?php
          echo  '
          <a href="post.php?post_name='.$postsExceptNews[4]['post_name'].'" class="b-latest post">
          <span class="category">'.$postsExceptNews[4]['category'].'</span>
          <img src="'.$postsExceptNews[4]['thumbnail_path'].'" alt="" />
          <span class="overlay"><span title="Title" class="title">'.$postsExceptNews[4]['title'].'</span></span>
        </a>
          ';
        ?>
        <?php
          echo  '
          <a href="post.php?post_name='.$postsExceptNews[5]['post_name'].'" class="b-latest post">
          <span class="category">'.$postsExceptNews[5]['category'].'</span>
          <img src="'.$postsExceptNews[5]['thumbnail_path'].'" alt="" />
          <span class="overlay"><span title="Title" class="title">'.$postsExceptNews[5]['title'].'</span></span>
        </a>
          ';
        ?>
      
      </div>

      <div class="right">
        <a href="news.html" class="font-bold text-lg flex justify-between">
          Latest News
          <span class="view-all text-bold gradient-text">View all</span>
        </a>
        <?php  
            for  ($i = 0; $i < 4;$i ++ )
            {
              echo '
              <a class="t-latest-news gap-2" href="post.php?post_name='.$newsPosts[$i]['post_name'].'">
                <img src="'.$newsPosts[$i]['thumbnail_path'].'" alt="'.$newsPosts[$i]['thumbnail_alt'].'" />
                <span title="Title" class="title font-bold">'.$newsPosts[$i]['title'].'</span>
              </a>
              ';
            }

        ?>
        
      </div>
      <!-- </div> -->
    </div>

    <div class="events section flex flex-col w-full">
      <a class="flex justify-between w-full" href="events.html">
        <h2 class="font-bold text-lg">Upcoming Events</h2>
        <span class="view-all font-bold text-sm gradient-text">View all</span>
      </a>


      <?php
            for ( $i = 0 ; $i < 2; $i ++ )
            {
              echo '
              <a href="event?event_id='.$events[$i]['event_id'].'" class="event gradient-border max-sm:flex-col max-sm:items-center">
              <div class="calendar">
                <div class="top">
                  <span class="date">February 2024</span>
      
                  <span class="circles">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                  </span>
      
                  <span class="handles">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                  </span>
                </div>
      
                <div class="bottom">24</div>
              </div>
      
              <div class="event-details flex flex-col gap-2">
                <img loading="lazy" src=".'.$events[$i]['imgPath'].'" alt="'.$events[$i]['title'].'" />
                <span class="event-titl font-bold text-sm">'.$events[$i]['title'].'</span>
              </div>
            </a>
              ';
            }
      ?>
    </div>

    <div class="section">
      <a href="artists.html" class="flex section-header">
        <h1>Artists</h1>
        <span class="view-all gradient-text">View All</span>
      </a>
      <div class="post-container">
        <?php
          for ( $i = 0; $i < 6; $i ++ )
          {
            echo '
            <a href="" class="post">
            <span class="category">Artists</span>
            <img src="'.$artist[$i]['thumbnail_path'] .'" alt="'.$artist[$i]['thumbnail_alt'] .'" />
            <span class="overlay"><span title="Title" class="title">'.$artist[$i]['title'] .'</span></span>
          </a>
            ';
          }
        ?>
        
      </div>
    </div>

    <div class="section">
      <a href="singles.html" class="flex section-header">
        <h1>Singles</h1>
        <span class="view-all gradient-text">View All</span>
      </a>
      <div class="post-container">
      <?php
          for ( $i = 0; $i < 6; $i ++ )
          {
            echo '
            <a href="" class="post">
            <span class="category">Singles</span>
            <img src="'.$single[$i]['thumbnail_path'] .'" alt="'.$single[$i]['thumbnail_alt'] .'" />
            <span class="overlay"><span title="Title" class="title">'.$single[$i]['title'] .'</span></span>
          </a>
            ';
          }
        ?>
      </div>
    </div>

    <div class="section">
      <a href="videos.html" class="flex section-header">
        <h1>Videos</h1>
        <span class="view-all gradient-text">View All</span>
      </a>
      <div class="post-container">
      <?php
          for ( $i = 0; $i < 6; $i ++ )
          {
            echo '
            <a href="" class="post">
            <span class="category">Singles</span>
            <img src="'.$video[$i]['thumbnail_path'] .'" alt="'.$video[$i]['thumbnail_alt'] .'" />
            <span class="overlay"><span title="Title" class="title">'.$video[$i]['title'] .'</span></span>
          </a>
            ';
          }
        ?>
      </div>
    </div>

    <div class="section">
      <a href="riddims.html" class="flex section-header">
        <h1>Riddims</h1>
        <span class="view-all gradient-text">View All</span>
      </a>
      <div class="post-container">
      <?php
          for ( $i = 0; $i < 6; $i ++ )
          {
            echo '
            <a href="" class="post">
            <span class="category">Singles</span>
            <img src="'.$riddim[$i]['thumbnail_path'] .'" alt="'.$riddim[$i]['thumbnail_alt'] .'" />
            <span class="overlay"><span title="Title" class="title">'.$riddim[$i]['title'] .'</span></span>
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