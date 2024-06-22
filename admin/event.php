<?php
// Include the necessary files
include 'classes/dbh.php';
include 'classes/events/event.php';

// Create an instance of the Event class
$eventManager = new EventManager();

// Check if the event_id parameter is set
if (isset($_GET['eventid'])) {
    // Retrieve event data by event_id
    $eventId = $_GET['eventid'];
    $eventData = $eventManager->getEventById($eventId);

} 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>Reggae Fresh - Admin</title>

  <link rel="stylesheet" href="../css/index.css" />
  <link rel="stylesheet" href="../css/admin.css" />
  <link rel="stylesheet" href="../css/events.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.6.7/css/perfect-scrollbar.min.css" />

  <link rel="shortcut icon" href="../public/logos/favicon.png" type="image/x-icon" />

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="../js/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.6.7/js/min/perfect-scrollbar.jquery.min.js"></script>
  <!-- <script defer src="../js/editor.js"></script>
    <script defer src="../js/select-input.js"></script>
    <script defer src="../js/events.js"></script> -->
  <!-- <script type="module" src="../js/admin-posts.js"></script> -->
  <!-- <script defer src="../js/events.js"></script>  -->
  <script defer src="../js/event.js"></script>
</head>

<body class="p-8 py-20 pb-0 grid">
  <?php print_r($eventData);
  ?>
  <img class="fixed background-blob top-0 z-0 opacity-10 self-center" src="../public//svg/background-blob.svg" alt="Reggae flag" />
  <div class="fixed top-8 z-20 admin-nav items-center justify-between flex gap-4"></div>

  <style>
    .avatar-upload .avatar-edit input+label:after {
      content: "Change image";
    }

    .avatar-upload .avatar-edit input+label:before {
      content: "Change image";
    }
  </style>
  <script>
    const page = "Events";
  </script>
  <script src="../js/components/adminNav.js"></script>

  <div class="main-content admin-event relative z-10 h-full grid gap-8 pb-8 pt-8">
    <form enctype="multipart/form-data" class="event-container flex flex-col gap-8" method="post" action="includes/event/updateevents.php">
      <input id="event_id" value="<?php echo $eventData['event_id']; ?>" name="event_id" hidden type="text">
      <div id="1" class="event-wrapper grid gap-8 p-6">
        <div class="event-poster flex flex-col gap-2">
          <div class="event-poster flex flex-col gap-2">
            <div class="avatar-upload">
              <div class="avatar-preview">
                <div style="background-image: url(..<?php echo $eventData['imgPath']; ?>)" id="imagePreview-2"></div>
              </div>
              <div class="avatar-edit">
                <input  type="file" id="imageUpload-2" name="image" accept=".png, .jpg, .jpeg, .webp" />
                <label class="" for="imageUpload-2"></label>
              </div>
            </div>
          </div>
        </div>

        <div class="event-details flex flex-col gap-4"> 
          <input class="font-bold text-2xl event-info" type="text" name="title" value="<?php echo $eventData['title']; ?>" />

          <div class="event-date event-info">
            <span class="font-semibold">Date: </span><span class="font-medium relative date">
              <input id="date-trigger" readonly class="cursor-pointer" name="event_date" value="<?php echo $eventData['event_date']; ?>" type="tex" />
              <div id="picker" class="date-picker">
                <div class="calendar-input" id="calendar">
                  <div class="header ignore">
                    <button class="prevMonth">
                      <img style="transform: rotate(90deg)" src="../public/svg/tabler-icon-chevron-down.svg" alt="" />
                    </button>
                    <h2 class="monthYear"></h2>
                    <button class="nextMonth">
                      <img style="transform: rotate(270deg)" src="../public/svg/tabler-icon-chevron-down.svg" alt="" />
                    </button>
                  </div>
                  <table>
                    <caption></caption>
                    <thead class="ignore">
                      <tr>
                        <th scope="col">Sun</th>
                        <th scope="col">Mon</th>
                        <th scope="col">Tue</th>
                        <th scope="col">Wed</th>
                        <th scope="col">Thu</th>
                        <th scope="col">Fri</th>
                        <th scope="col">Sat</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>
                </div>
              </div>
            </span>
          </div>

          <p contenteditable="true" class="event-description p-4 flex-grow event-info">
          <?php echo $eventData['description']; ?>

            <input hidden id="event-description" name="description" type="text" value="<?php echo $eventData['description']; ?>" />
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
      <div class="btn-container gap-8 p-4 grid">
        <div class="cta delete">Delete Event</div>
        <button type="submit" class="cta">Update</button>
      </div>
    </form>
  </div> 

  <script>
    function readtwo(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $("#imagePreview-2").css(
            "background-image",
            "url(" + e.target.result + ")"
          );
          $("#imagePreview-2").hide();
          $("#imagePreview-2").fadeIn(650);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
    $("#imageUpload-2").change(function() {
      readtwo(this);
    });
  </script>

</body>

</html>