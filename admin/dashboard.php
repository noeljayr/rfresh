<?php
$host = 'localhost';
$dbname = 'reggaefr_dev2024';
$username = 'root';
$password = '';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM thumbnail"; // Replace with your specific query to fetch desired data from the thumbnail table
$result = $conn->query($sql);

$thumbnails = array();

if ($result->num_rows > 0) {
  // Loop through each row in the result set and add data to the thumbnails array
  while($row = $result->fetch_assoc()) {
    $thumbnails[] = $row; // Add the associative array containing thumbnail data to the thumbnails array
  }
}

$conn->close();

// Encode the thumbnails array as JSON and return it
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Reggae Fresh - Admin</title>

    <link rel="stylesheet" href="../css/index.css" />
    <link rel="stylesheet" href="../css/admin.css" />
    <link rel="stylesheet" href="../css/posts.css" />

    <link
      rel="shortcut icon"
      href="../public/logos/favicon.png"
      type="image/x-icon"
    />

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../js/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.6.7/js/min/perfect-scrollbar.jquery.min.js"></script>
    <script defer src="../js/editor.js"></script>
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
      const page = "Home";
    </script>
    <script src="../js/components/adminNav.js"></script>

    <div class="main-content relative z-10 h-full grid gap-8 pt-8">
      <div class="flex flex-col wrapper items-end mb-8 gap-4 p-4 w-full">
        <div class="tool-bar items-center grid justify-center gap-4 p-4 w-full">
          <!-- <span
            title="Insert Image or Link"
            class="tool p-2 flex items-center justify-center"
            ><img
              alt="Insert Image or Link"
              loading="lazy"
              width="30"
              height="30"
              decoding="async"
              data-nimg="1"
              class="tabler-icon"
              style="color: transparent"
              src="../public/svg/tabler-icon-plus.svg"
            />
          </span> -->

          

          <button
            class="tool p-2 flex items-center justify-center"
            onclick="showLinkPopup()"
            title="Insert a link"
          >
            <img
              alt="Inser a link"
              loading="lazy"
              width="30"
              height="30"
              decoding="async"
              data-nimg="1"
              class="tabler-icon"
              style="color: transparent"
              src="../public/svg/tabler-icon-link-plus.svg"
            />
          </button>

          <button
            class="tool p-2 flex items-center justify-center"
            onclick="showEmbedPopup()"
            title="Embed a link"
          >
            <img
              alt="Embed a link"
              loading="lazy"
              width="30"
              height="30"
              decoding="async"
              data-nimg="1"
              class="tabler-icon"
              style="color: transparent"
              src="../public/svg/tabler-icon-link-code.svg"
            />
          </button>

          <button
            class="tool p-2 flex items-center justify-center"
            id="bold"
            title="Make selected text bold (Ctrl+B)"
          >
            <img
              alt="Make selected text bold"
              loading="lazy"
              width="30"
              height="30"
              decoding="async"
              data-nimg="1"
              class="font-style"
              style="color: transparent"
              src="../public/svg/B.svg"
            />
          </button>
          <button
            class="tool p-2 flex items-center justify-center"
            id="italic"
            title="Make selected text italic (Ctrl+I)"
          >
            <img
              alt="Make selected text italic"
              loading="lazy"
              width="30"
              height="30"
              decoding="async"
              data-nimg="1"
              class="font-style"
              style="color: transparent"
              src="../public/svg/I.svg"
            />
          </button>
          <button
            class="tool p-2 flex items-center justify-center"
            id="underline"
            title="Underline the selected text (Ctrl+U)"
          >
            <img
              alt="Underline the selected text"
              loading="lazy"
              width="30"
              height="30"
              decoding="async"
              data-nimg="1"
              class="font-style"
              style="color: transparent"
              src="../public/svg/U.svg"
            />
          </button>

          <button
            class="tool p-2 flex items-center justify-center"
            id="align-left"
            title="Align left"
          >
            <img
              alt="Align left"
              loading="lazy"
              width="30"
              height="30"
              decoding="async"
              data-nimg="1"
              class="tabler-icon"
              style="color: transparent"
              src="../public/svg/tabler-icon-align-left.svg"
            />
          </button>
          <button
            class="tool p-2 flex items-center justify-center"
            id="align-center"
            title="Align center (Ctrl+E)"
          >
            <img
              alt="Align center (Ctrl+E)"
              loading="lazy"
              width="30"
              height="30"
              decoding="async"
              data-nimg="1"
              class="tabler-icon"
              style="color: transparent"
              src="../public/svg/tabler-icon-align-center.svg"
            />
          </button>
          <button
            class="tool p-2 flex items-center justify-center"
            id="align-right"
            title="Align right"
          >
            <img
              alt="Align right"
              loading="lazy"
              width="30"
              height="30"
              decoding="async"
              data-nimg="1"
              class="tabler-icon"
              style="color: transparent"
              src="../public/svg/tabler-icon-align-right.svg"
            />
          </button>

          <button
            class="tool p-2 flex items-center justify-center"
            id="list-ol"
            title="Ordered List"
          >
            <img
              alt="Add a numbered list"
              loading="lazy"
              width="30"
              height="30"
              decoding="async"
              data-nimg="1"
              class="tabler-icon"
              style="color: transparent"
              src="../public/svg/tabler-icon-list-numbers.svg"
            />
          </button>
        </div>
        <div action="" class="create-post w-full h-full">
          <div class="input-group">
            <span class="gradient-border">
              <input
                id="post-title"
                type="text"
                placeholder="What's the title of your post?"
              />
            </span>
          </div>
          <div id="editor" class="editor p-2" contenteditable="true">
            <br />
          </div>

          <div class="post-settings relative grid gap-4 p-4">
            <span id="close-tags-menu" class="close-btn">
              <img
                src="../public/svg/tabler-icon-plus.svg"
                alt="close tags menus"
              />
            </span>

            <div class="tags-fetch grid p-4 py-6 gap-4 absolute w-full h-full">
              <div class="input-group gradient-border">
                <input type="text" />
                <span id="new-tag-btn" class="add"
                  ><img src="../public/svg/tabler-icon-plus.svg" alt=""
                /></span>
              </div>

              <div class="filtered-tags flex flex-col gap-2"></div>
            </div>

            <div
              class="platforms-selection flex flex-col p-4 py-4 gap-2 absolute w-full h-full"
            >
              <h2 class="font-bold">Select a platform</h2>

              <div class="platform-options gap-2">
                <span class="stream-option">
                  <input
                    type="radio"
                    value="Spotify"
                    name="field"
                    id="spotify"
                  />
                  <label for="spotify">
                    <svg class="check" viewBox="0 0 40 40">
                      <defs>
                        <linearGradient
                          id="gradient"
                          x1="0"
                          y1="0"
                          x2="0"
                          y2="100%"
                        >
                          <stop offset="0%" stop-color="#ff8a00"></stop>
                          <stop offset="100%" stop-color="#da1b60"></stop>
                        </linearGradient>
                      </defs>
                      <circle id="border" r="18px" cx="20px" cy="20px"></circle>

                      <circle id="dot" r="7px" cx="20px" cy="20px"></circle>
                    </svg>
                    <span class="platform-name">Spotify</span>
                  </label>
                </span>

                <span class="stream-option">
                  <input
                    type="radio"
                    value="Apple Music"
                    name="field"
                    id="apple-music"
                  />
                  <label for="apple-music">
                    <svg class="check" viewBox="0 0 40 40">
                      <defs>
                        <linearGradient
                          id="gradient"
                          x1="0"
                          y1="0"
                          x2="0"
                          y2="100%"
                        >
                          <stop offset="0%" stop-color="#ff8a00"></stop>
                          <stop offset="100%" stop-color="#da1b60"></stop>
                        </linearGradient>
                      </defs>
                      <circle id="border" r="18px" cx="20px" cy="20px"></circle>
                      <circle id="dot" r="7px" cx="20px" cy="20px"></circle>
                    </svg>
                    <span class="platform-name">Apple Music</span>
                  </label>
                </span>

                <span class="stream-option">
                  <input
                    type="radio"
                    value="YouTube"
                    name="field"
                    id="youtube"
                  />
                  <label for="youtube">
                    <svg class="check" viewBox="0 0 40 40">
                      <defs>
                        <linearGradient
                          id="gradient"
                          x1="0"
                          y1="0"
                          x2="0"
                          y2="100%"
                        >
                          <stop offset="0%" stop-color="#ff8a00"></stop>
                          <stop offset="100%" stop-color="#da1b60"></stop>
                        </linearGradient>
                      </defs>
                      <circle id="border" r="18px" cx="20px" cy="20px"></circle>
                      <circle id="dot" r="7px" cx="20px" cy="20px"></circle>
                    </svg>
                    <span class="platform-name">YouTube</span>
                  </label>
                </span>

                <span class="stream-option">
                  <input
                    type="radio"
                    value="YouTube Music"
                    name="field"
                    id="youtube-music"
                  />
                  <label for="youtube-music">
                    <svg class="check" viewBox="0 0 40 40">
                      <defs>
                        <linearGradient
                          id="gradient"
                          x1="0"
                          y1="0"
                          x2="0"
                          y2="100%"
                        >
                          <stop offset="0%" stop-color="#ff8a00"></stop>
                          <stop offset="100%" stop-color="#da1b60"></stop>
                        </linearGradient>
                      </defs>
                      <circle id="border" r="18px" cx="20px" cy="20px"></circle>
                      <circle id="dot" r="7px" cx="20px" cy="20px"></circle>
                    </svg>
                    <span class="platform-name">YouTube Music</span>
                  </label>
                </span>

                <span class="stream-option">
                  <input type="radio" value="Tidal" name="field" id="tidal" />
                  <label for="tidal">
                    <svg class="check" viewBox="0 0 40 40">
                      <defs>
                        <linearGradient
                          id="gradient"
                          x1="0"
                          y1="0"
                          x2="0"
                          y2="100%"
                        >
                          <stop offset="0%" stop-color="#ff8a00"></stop>
                          <stop offset="100%" stop-color="#da1b60"></stop>
                        </linearGradient>
                      </defs>
                      <circle id="border" r="18px" cx="20px" cy="20px"></circle>
                      <circle id="dot" r="7px" cx="20px" cy="20px"></circle>
                    </svg>
                    <span class="platform-name">Tidal</span>
                  </label>
                </span>

                <span class="stream-option">
                  <input
                    type="radio"
                    value="Amazon Music"
                    name="field"
                    id="amazon-music"
                  />
                  <label for="amazon-music">
                    <svg class="check" viewBox="0 0 40 40">
                      <defs>
                        <linearGradient
                          id="gradient"
                          x1="0"
                          y1="0"
                          x2="0"
                          y2="100%"
                        >
                          <stop offset="0%" stop-color="#ff8a00"></stop>
                          <stop offset="100%" stop-color="#da1b60"></stop>
                        </linearGradient>
                      </defs>
                      <circle id="border" r="18px" cx="20px" cy="20px"></circle>
                      <circle id="dot" r="7px" cx="20px" cy="20px"></circle>
                    </svg>
                    <span class="platform-name">Amazon Music</span>
                  </label>
                </span>

                <span class="stream-option">
                  <input type="radio" value="Deezer" name="field" id="deezer" />
                  <label for="deezer">
                    <svg class="check" viewBox="0 0 40 40">
                      <defs>
                        <linearGradient
                          id="gradient"
                          x1="0"
                          y1="0"
                          x2="0"
                          y2="100%"
                        >
                          <stop offset="0%" stop-color="#ff8a00"></stop>
                          <stop offset="100%" stop-color="#da1b60"></stop>
                        </linearGradient>
                      </defs>
                      <circle id="border" r="18px" cx="20px" cy="20px"></circle>
                      <circle id="dot" r="7px" cx="20px" cy="20px"></circle>
                    </svg>
                    <span class="platform-name">Deezer</span>
                  </label>
                </span>

                <span class="stream-option">
                  <input
                    type="radio"
                    value="AudioMack"
                    name="field"
                    id="audiomack"
                  />
                  <label for="audiomack">
                    <svg class="check" viewBox="0 0 40 40">
                      <defs>
                        <linearGradient
                          id="gradient"
                          x1="0"
                          y1="0"
                          x2="0"
                          y2="100%"
                        >
                          <stop offset="0%" stop-color="#ff8a00"></stop>
                          <stop offset="100%" stop-color="#da1b60"></stop>
                        </linearGradient>
                      </defs>
                      <circle id="border" r="18px" cx="20px" cy="20px"></circle>
                      <circle id="dot" r="7px" cx="20px" cy="20px"></circle>
                    </svg>
                    <span class="platform-name">AudioMack</span>
                  </label>
                </span>
              </div>

              <div class="input-group gradient-border">
                <textarea
                  name="platform-link"
                  placeholder="Patse your link here"
                  id="platform-link"
                  cols="30"
                  rows="10"
                ></textarea>
                <input hidden id="platform-name" type="text" />
              </div>

              <div class="flex flex-row gap-4">
                <div
                  style="background: var(--white); color: var(--black)"
                  class="cta"
                  onclick="closePlatfroms()"
                >
                  Cancel
                </div>
                <div onclick="addPlatform()" class="cta">Add</div>
              </div>
            </div>

            <h2 class="font-bold text-sm">Post Settings</h2>
            <div class="input-group w-full">
              <span class="option-selector">
                <span class="select">
                  <span class="selected">Select Category</span>
                  <span class="options">
                    <span>News</span>
                    <span class="music-option">Singles</span>
                    <span class="music-option">Albums</span>
                    <span class="music-option">Mixtapes</span>
                    <span>Artists</span>
                    <span class="music-option">Videos</span>
                  </span>
                </span>

                <input
                  required=""
                  hidden=""
                  id="select"
                  name="category"
                  type="text"
                />
                <span class="selector-trigger">
                  <img
                    src="../public/svg/tabler-icon-chevron-down.svg"
                    alt=""
                  />
                </span>
              </span>
            </div>

            <span class="platforms p-2 grid gap-2">
              <h2 class="text-xs font-bold">Streaming Plaforms</h2>

              <span class="platforms-container flex gap-2 flex-wrap">
                <span class="add-plaform-btn new-setting">
                  <img src="../public/svg/tabler-icon-plus.svg" alt="" />
                </span>
              </span>
            </span>

            <span class="tags p-2 grid gap-2">
              <h2 class="text-xs font-bold">Tags</h2>

              <span class="tags-container flex gap-2 flex-wrap">
                <span class="add-tag-btn new-setting">
                  <img src="../public/svg/tabler-icon-plus.svg" alt="" />
                </span>
              </span>
            </span>
            <button id="next-btn" class="cta">Next</button>
          </div>
        </div>
      </div>
    </div>

    <div id="embedded-popup" class="link-popup embedded p-2 gap-2">
      <div class="input-group gradient-border">
        <textarea
          name=""
          id="embedded-input"
          cols="30"
          placeholder="Embedded link"
          rows="10"
        ></textarea>
      </div>
      <span onclick="hidePopUp(this.parentElement)" class="cta close-btn"
        >Close</span
      >
      <span onclick="appendIframeToDiv()" class="cta create-link"> Embed </span>
    </div>

    <div id="link-popup" class="link-popup p-2 gap-2">
      <div class="input-group gradient-border">
        <input id="url" type="url" placeholder="enter link here" />
      </div>
      <span onclick="hidePopUp(this.parentElement)" class="cta close-btn"
        >Close</span
      >
      <span onclick="createLink()" class="cta create-link"> Create </span>
    </div>

  
   

    <div id="cover-image" class="image-popup p-4 gap-4">
      <input id="prev-select" hidden type="text" />
      <div class="image-view">
        <h2 class="font-bold w-full">Choose post image</h2>
        <div class="avatar-upload">
          <div class="avatar-preview">
            <div id="imagePreview"></div>
          </div>
          <div class="avatar-edit">
            <input
              required
              type="file"
              id="imageUpload"
              name="photo"
              accept=".png, .jpg, .jpeg, .webp"
            />
            <label class="" for="imageUpload"></label>
          </div>
        </div>

        <div class="form-group flex flex-col gap-1 mb-4">
          <label class="font-semibold text-sm" for=""
            >Description(Altenative Text)</label
          >
          <div class="input-group h-full gradient-border">
            <input name="" id="alt" placeholder="For SE0 & Accessibility" />
          </div>
        </div>
        <div class="flex flex-col gap-4 max-sm:flex-row">
          <span
            onclick="hidePopUp(this.parentElement.parentElement.parentElement)"
            class="cta close-btn"
          >
            Continue Editing
          </span>
          <span onclick="buttonTest()" class="cta"> Post </span>
        </div>
      </div>

      <div class="previous-images">
        <div class="input-group gradient-border">
          <img
            loading="lazy"
            src="../public/svg/tabler-icon-search.svg"
            alt="search icon"
            class="search-icon"
          />
          <input
            type="text"
            id="image-search"
            placeholder="Search for images..."
          />
        </div>
        <div class="images-wrapper"></div>
      </div>
    </div>
    <div class="popup-overlay"></div>

    <script src="../js/new-data.js"></script>
    <script src="../js/select-input.js"></script>


    <form  onsubmit="event.preventDefault()" id="post-form" style="display: none; visibility: hidden;" action="">
      <input name="title" id="form-title" hidden type="text" />
      <textarea name="content" id="form-content" cols="30" rows="10"></textarea>
      <input name="category" id="form-category" type="text" />
      <input  id="post-thumbail" name="post-thumbnail" type="text">
      <button id="submit-form" type="submit"></button>
    </form>

    <script>
      const tags = ["Reggea", "Vybz Katel", "Music"];
      let selectedTags = [];
      let selectedPlatforms = [];
      const nextBtn = document.getElementById("next-btn");
    </script>
    <script src="../js/dashboard.js"></script>

    <script>
      
      
      const previousUsedImages = <?php echo json_encode($thumbnails);  ?>

      console.log(previousUsedImages[0])

    </script>

    <script>
      //capture data from  the content

      const contentInputEditor =  document.getElementById("editor")
      const contentInputForm = document.getElementById("form-content")
      const formSelect = document.getElementById("select");

      const categoryInputEditor = document.getElementById("select")
      const categoryInputForm = document.getElementById("form-category")

      const titleInputEditor =  document.getElementById("post-title")
      const titleInputForm = document.getElementById("form-title")
      
      const thumbnailImageForm  = document.getElementById("post-thumbail")
      const thumbnailImageEditor =  document.getElementById("imageUpload")

      contentInputEditor.addEventListener("change", ()=>{
        contentInputForm.value = contentInputEditor.innerHTML
      })

      contentInputEditor.addEventListener("input", ()=>{
        contentInputForm.value = contentInputEditor.innerHTML
      })

      titleInputEditor.addEventListener("input", ()=>{
        titleInputForm.value = titleInputEditor.value
      })

      titleInputEditor.addEventListener("change", ()=>{
        titleInputForm.value = titleInputEditor.value
      })

      contentInputEditor.addEventListener("change", ()=>{
        contentInputForm.value = contentInputEditor.innerHTML
      })

      categoryInputEditor.addEventListener("change", ()=>{
        categoryInputForm.value = categoryInputEditor.innerHTML
      })


     

      const submitForm = document.getElementById("submit-form")
      



function sendThumbnail(thumb) {

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'includes/posts/convert_thumbnail.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                // Replace base64 thumbnail with file path
                thumb = response;
                console.log(thumb);
                // After replacing the thumbnail, call the main function to send form data
                payLoad(thumb.filePath);
            } else {
                console.error('Thumbnail conversion failed');
            }
        }
    };
    xhr.send(JSON.stringify({ thumb: thumb }));
}

function payLoad(thumb) {
    var thumbnaill = {
        path: thumb,
        alternative: "potot sdhsd" // Adjust this value as needed
    };
    console.log("thumbnaill");
    console.log(thumbnaill); 
    var formData = {
        title: document.getElementById('form-title').value,
        content: document.querySelector('.editor').innerHTML,
        thumbnail: thumbnaill,
        category: formSelect.value,
        tags: selectedTags,
        platforms: selectedPlatforms
    };
    console.log(formData);

    // Send form data via AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'includes/posts/createpost.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Process response from the server
            var response = xhr.responseText;
            // Do something with the response, e.g., display a success message
            console.log(response);
            location.reload();
        }
    };
    xhr.send(JSON.stringify(formData));
}

// Call the sendThumbnail function before sending the form data
// console.log(thumbnailImageForm.value);
// sendThumbnail(thumbnailImageForm.value);

    </script>


    <script>
      function buttonTest(){
        alert("clicked")
      }
    </script>
  </body>
</html>
