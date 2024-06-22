<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Singles - Reggae Fresh</title>

    <link rel="stylesheet" href="./css/index.css" />
    <link rel="stylesheet" href="./css/posts.css" />
    <link rel="stylesheet" href="./css/events.css" />
    <link
      rel="shortcut icon"
      href="./public/logos/favicon.png"
      type="image/x-icon"
    />

    <script defer src="./js/components/footer.js"></script>
    <script defer src="./js/menu.js"></script>
    <script src="https://cdn.tailwindcss.com"></script> 
  </head>
  <body class="flex flex-col">
    <nav class="navbar section"></nav>
    <script type="module" src="./js/components/navbar.js"></script>

    <div class="search"></div>
    <script type="module" src="./js/components/search.js"></script>

    <section class="main-content grid h-full">
      <div class="event-container grid h-full gap-8">
        <div id="1" class="event-wrapper grid gap-8 p-6">
          <div class="event-poster flex flex-col gap-2">
            <img src="../public/images/event-1.png" alt="" />
          </div>

          <div class="event-details flex flex-col gap-4">
            <span class="font-bold text-2xl event-info">Event title</span>

            <div class="event-date event-info">
              <span class="font-semibold">Date: </span
              ><span class="font-medium relative date">
                <span>24 May 2024</span>
              </span>
            </div>

            <p class="event-description p-4 flex-grow event-info">
              A short description of the event, includes location and most
              relevant information.
            </p>

            <!-- <div class="event-links flex flex-col gap-2">
              <a
                href="http://"
                target="_blank"
                class="cta event-link font-medium event-info"
              >
                Link 1
                
              </a>
              
            </div> -->
          </div>
        </div>
      </div>
    </section>

    <script src="js/components/navbar.js"></script>

    <!-- <div class="section"></div> -->
    <div class="footer"></div>
  </body>
</html>
