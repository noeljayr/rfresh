<?php
// Include necessary files and start session if required
include 'admin/classes/dbh.php';
include_once 'admin/classes/events/event.php';

// Create an instance of the EventManager class
$eventManager = new EventManager();

$events = $eventManager->getEventsDescending();

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
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <nav class="navbar section"></nav>
  <script type="module" src="./js/components/navbar.js"></script>

  <div class="search"></div>
  <script type="module" src="./js/components/search.js"></script>

  <section class="main-content">
    <div class="events section flex flex-col w-full">
      <span class="flex justify-between w-full">
        <h2 class="font-bold text-lg">Upcoming Events</h2>
      </span>

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
  </section>

  <script src="js/components/navbar.js"></script>

  <!-- <div class="section"></div> -->
  <div class="footer"></div>
</body>

</html>