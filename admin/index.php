<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ReggaeFresh - Admin</title>

    <link rel="stylesheet" href="../css/index.css" />
    <link rel="stylesheet" href="../css/admin.css" />
    <link rel="stylesheet" href="../css/animations.css">
    <script src="../js/jquery.js"></script>
    <link
      rel="shortcut icon"
      href="../public/logos/favicon.png"
      type="image/x-icon"
    />

  </head>
  <body>
    <div
      class="content"
      style="
        display: flex;
        padding-left: 2rem;
        align-items: center;
        justify-content: center;
        height: 100vh;
      "
    >
      <div id="login-form" class="form-wrapper">
        <form
          id="loginForm"
          action=""
          method="POST"
          class="contact-form form"
        >
          <img class="logo" src="../public/logos/logo.png" alt="" />
          <div class="input-group">
            <label for="">Email</label>
            <input
              required
              placeholder="example@gmail.com"
              type="email"
              name="email"
            />
          </div>
          <div class="input-group">
            <label for="">Password</label>
            <input required type="password" name="password" />
          </div>

          <span id="msg"></span>
          <button type="submit" class="cta">Sign in</button>
        </form>
      </div>
    </div>
  </body>
  <script>
         document.addEventListener("DOMContentLoaded", function () {
        const registrationForm = document.getElementById("loginForm");
        const messageDiv = document.getElementById("msg");

        registrationForm.addEventListener("submit", function(e) {
            e.preventDefault();

            // Create a FormData object to handle form data, including the file upload
            const formData = new FormData();
            // const formData = new FormData(registrationForm);
            var email = $("input[name=email]").val();
            var password = $("input[name=password]").val();


            formData.append("email",email);
            formData.append("password",password);

            // Create an XMLHttpRequest object
            const xhr = new XMLHttpRequest();

            // Define the URL to the PHP script that handles user registration
            const url = "includes/user/login.php"; // Replace with your PHP script URL

            // Configure the XMLHttpRequest
            xhr.open("POST", url, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        // Registration was successful
                        

                        // Clear the form
                        registrationForm.reset();
                        console.log(xhr.responseText);
                        if (xhr.responseText == 'success') {
                            messageDiv.innerHTML = '<div class="gradient-text" style="">Login successful!</div>';
                            window.location.href = "dashboard.php" ;
                        } else if (xhr.responseText == 'invalid') {
                            messageDiv.innerHTML = '<div style="color: #ff3300;">Invalid Credentials!</div>';
                        } else if (xhr.responseText == 'failed') {
                            messageDiv.innerHTML = '<div style="color: #ff3300;">Login failed!</div>';
                        }
                    } else {
                        // Registration failed
                        messageDiv.innerHTML = "Login error. Please try again.";
                    }
                }
            };

            // Send the FormData object containing the form data to the server
            xhr.send(formData);
        });
        });
    </script>
</html>
