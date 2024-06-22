<?php 
  require 'includes/user/loadUser.php';

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Reggae Fresh - Admin</title>

    <link rel="stylesheet" href="../css/index.css" />
    <link rel="stylesheet" href="../css/admin.css" />
    <link rel="stylesheet" href="../css/settings.css" />
    <link rel="stylesheet" href="../css/adminstrators.css" />
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
    -->
    <script defer src="../js/admins.js"></script> 
  </head>
  <body class="p-8 py-20 pb-0 grid">
    <img
      class="fixed background-blob top-0 z-0 opacity-10 self-center"
      src="../public//svg/background-blob.svg"
      alt="Reggae flag"
    />
    <div
      class="fixed top-8 z-20 admin-nav items-center justify-between flex gap-4">
    </div>
    <script>
      const page = "Adminstrators";
    </script>
    <script src="../js/components/adminNav.js"></script>

    <div class="main-content relative z-10 h-full grid gap-8 pt-8">
      <div class="admin-control-panel flex flex-col gap-8">
        <span class="add-admin-btn flex items-center justify-center"
          ><img
            alt="Add Admin"
            loading="lazy"
            width="200"
            height="200"
            decoding="async"
            data-nimg="1"
            style="color: transparent"
            src="../public/svg/tabler-icon-user-plus.svg"
        /></span>
        <div class="admin-container flex flex-col gap-4"></div>
      </div>
    </div>

    <div class="popup-overlay"></div>

    <form onsubmit="event.preventDefault()" id="diactivate-admin" action="" class="popup-form grid p-4 gap-4 danger-form">
      <p class="w-full"><span class="admin-name font-bold"></span> Won't be able to login again if diactivated </p>
      <input required hidden id="admin-id" name="admin-id" type="text">
      <span onclick="hidePopUp(this.parentElement)" class="cta close-btn">
        Cancel
      </span>
      <button onclick="deactivateUser()" class="cta diactivate">Yes, Diactivate </button> 
    </form>

    <form onsubmit="event.preventDefault()" id="activate-admin" action="" class="popup-form grid p-4 gap-4 danger-form">
      <p class="w-full">Activate <span class="admin-name font-bold"></span>?</p>
      <input required hidden id="admin-activate-id" name="admin-id" type="text">
      <span onclick="hidePopUp(this.parentElement)" class="cta close-btn">
        Cancel
      </span>
      <button onclick="activateUser()" class="cta">Yes, Activate </button>
    </form>

    <form onsubmit="event.preventDefault()" id="createUser" class="add-admin-form p-4 gap-4" action="">
      <h2 class="font-bold text-lg w-full text-center">New Admin</h2>
      <div class="input-group gap-2">
        <label htmlfor="">First Name</label>
        <span class="relative gradient-border h-full w-full">
          <input class="gradient-border" name="fName" type="text" placeholder="John" required>
        </span>
      </div>

     <!-- <div class="input-group gap-2">
        <label htmlfor="">Last Name</label>
        <span class="relative gradient-border h-full w-full">
          <input class="gradient-border" name="lName" type="text" placeholder="Doe" required>
        </span>
      </div> -->

      <div class="input-group gap-2">
        <label htmlfor="">Email</label>
        <span class="relative gradient-border h-full w-full">
          <input class="gradient-border" name="email" type="email" placeholder="example@gmail.com" required>
        </span>
      </div>

      <div class="input-group gap-2">
        <label htmlfor="">Phone</label>
        <span class="relative gradient-border h-full w-full">
          <input class="gradient-border" name="phone" type="text" placeholder="08888888" required>
        </span>
      </div>

      <div class="cta-container flex w-full gap-4">
        <button onclick="hidePopUp(this.parentElement.parentElement)" type="reset" class="cta close-btn">Discard</button>
        <button onclick="saveUser()"  class="cta">Save</button>
      </div>
    </form>

    <script>
      // const admins = [
      //   {
      //     ID: 1,
      //     name: "Lee",
      //     email: "example@gmail.com",
      //     active: true,
      //     posts: 200,
      //   },
      //   {
      //     ID: 2,
      //     name: "Developer",
      //     email: "developer@gmail.com",
      //     active: false,
      //     posts: 0,
      //   },
      // ];
              var admins = <?php echo $adminsJSON; ?>;

     </script>

    <script>
    function saveUser() {
        var form = document.getElementById('createUser');
        var formData = new FormData(form);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'includes/user/createUser.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var response = xhr.responseText;
                if (response === 'done') {
                    
                    // Optionally, reset the form
                    form.reset();
                    location.reload();
                } else {
                    console.log(response);
                }
            }
        };
        xhr.send(formData);
    }
    // Function to deactivate a user
    function deactivateUser() {
        let userId = document.getElementById("admin-id").value
        var xhr = new XMLHttpRequest();
        var formData = new FormData();
        formData.append('items', JSON.stringify({ userid: userId, status: 'Active' })); 
        xhr.open('POST', 'includes/user/block.php', true); 
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var response = xhr.responseText;
                // Process the response here
                if (response === 'done') {
                    console.log('User deactivated successfully');
                    location.reload();
                } else {
                    console.log('Failed to deactivate user');
                }
            }
        };
        xhr.send(formData);
    }
    function activateUser() {
        let userId = document.getElementById("admin-activate-id").value
        var xhr = new XMLHttpRequest();
        var formData = new FormData();
        formData.append('items', JSON.stringify({ userid: userId, status: 'blocked' })); 
        xhr.open('POST', 'includes/user/block.php', true); 
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var response = xhr.responseText;
                // Process the response here
                if (response === 'done') {
                    console.log('User deactivated successfully');
                    location.reload();
                } else {
                    console.log('Failed to deactivate user');
                }
            }
        };
        xhr.send(formData);
    }

    // Call the function to deactivate a user
    // deactivateUser(userId); // Pass the userId as an argument

    </script>
  </body>
</html>
