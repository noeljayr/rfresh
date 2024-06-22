<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Reggae Fresh - Admin</title>

    <link rel="stylesheet" href="../css/index.css" />
    <link rel="stylesheet" href="../css/admin.css" />
    <link rel="stylesheet" href="../css/settings.css" />
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
    <script defer src="../js/dashboard.js"></script> -->
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
      const page = "Settings";
    </script>
    <script src="../js/components/adminNav.js"></script>

    <div class="main-content relative z-10 h-full grid gap-8 pt-8">
      <div class="settings-wrapper grid gap-8">
        <form class="settings-form p-4 gap-4" action="">
          <div class="input-group gap-2">
            <label htmlFor="">First Name</label>
            <span class="relative gradient-border h-full w-full">
              <input class="gradient-border" type="text" placeholder="John" />
            </span>
          </div>
    
          <div class="input-group gap-2">
            <label htmlFor="">Last Name</label>
            <span class="relative gradient-border h-full w-full">
              <input class="gradient-border" type="text" placeholder="Doe" />
            </span>
          </div>
    
          <div class="input-group gap-2">
            <label htmlFor="">Email</label>
            <span class="relative gradient-border h-full w-full">
              <input
                class="gradient-border"
                type="email"
                placeholder="developer@gmail.com"
              />
            </span>
          </div>
    
          <div class="input-group gap-2">
            <label htmlFor="">Phone</label>
            <span class="relative gradient-border h-full w-full">
              <input
                class="gradient-border"
                type="text"
                placeholder="08888888"
              />
            </span>
          </div>
    
          <button class="cta disabled">Save Changes</button>
        </form>
        <div class="settings-actions flex flex-col gap-4 p-4">
          <a class="change-password cta" href="./password.php"
            >Change Password</a
          ><a class="logout cta" href="includes/user/logout.php">Logout</a>
        </div>
      </div>
    </div>
  </body>
</html>
