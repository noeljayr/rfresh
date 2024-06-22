<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Reggae Fresh - Admin</title>

    <link rel="stylesheet" href="../css/index.css" />
    <link rel="stylesheet" href="../css/admin.css" />
    <link rel="stylesheet" href="../css/events.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.6.7/css/perfect-scrollbar.min.css"
    />

    <link
      rel="shortcut icon"
      href="../public/logos/favicon.png"
      type="image/x-icon"
    />

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../js/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.6.7/js/min/perfect-scrollbar.jquery.min.js"></script>
    <!-- <script defer src="../js/editor.js"></script>
    <script defer src="../js/select-input.js"></script>
    <script defer src="../js/events.js"></script> -->
    <!-- <script type="module" src="../js/admin-posts.js"></script> -->
    <script defer src="../js/events.js"></script>
  </head>
  <body class="p-8 py-20 pb-0 grid">
    <img
      class="fixed background-blob top-0 z-0 opacity-10 self-center"
      src="../public//svg/background-blob.svg"
      alt="Reggae flag"
    />
    <div
      class="fixed top-8 z-20 admin-nav items-center justify-between flex gap-4"
    ></div>
    <script>
      const page = "Events";
    </script>
    <script src="../js/components/adminNav.js"></script>

    <div class="main-content relative z-10 h-full grid gap-8 pt-8">
      <div class="admin-posts-wrapper flex flex-col gap-4 w-full">
        <a class="add-post-btn" href="new-event.php">
          <img src="../public/svg/tabler-icon-plus.svg" alt="" />
        </a>
        <div class="search-container">
          <div class="search-input gradient-border">
            <img
              loading="lazy"
              src="../public/svg/tabler-icon-search.svg"
              alt="search icon"
              class="search-icon"
            />
            <input type="text" placeholder="Search for anything..." />
          </div>

          <div class="admin-posts-container grid gap-4">
            <div class="events section flex flex-col w-full"></div>
          </div>
        </div>
      </div>
    </div>

    <script src="includes/event/getEvents.php"></script>
    <script>

        // Map over the eventData array to transform each event object
        const events = dataEvents.map(event => {
          // Extract relevant information and format date
          const id = event.event_id;
          const title = event.title;
          const date = event.event_date;
          const poster = event.imgPath ? event.imgPath.split('/').pop() : '';
          const description = event.description ? event.description : 'No description available';

          // Return an object with the transformed data
          return { id, title, date, poster, description };
        });

        console.log(events);


    </script>
    <script>
      // Function to handle the retrieved events data
        function handleEventsData(eventsData) {
            // Process the returned data or perform any actions here
            console.log(eventsData);  
        }

        // Function to retrieve events data
        function getEvents(callback) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'includes/event/getEvents.php', true); 
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    var responseData = JSON.parse(xhr.responseText);
                    callback(responseData);
                }
            };
            xhr.send();
        } 

        // Call the function to retrieve events data and pass the callback function
        getEvents(handleEventsData);

    </script>
  </body>
</html>
