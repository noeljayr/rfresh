<?php
  require 'includes/posts/getPost2.php';
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
      const page = "Posts";
    </script>
    <script src="../js/components/adminNav.js"></script>

    <div class="main-content relative z-10 h-full grid gap-8 pt-8">
      <div class="flex flex-col wrapper items-end mb-8 gap-4 p-4 w-full">
        <h1 class="w-full font-bold text-2xl text-center">Edit Post</h1>
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
            onclick="showImagePopup()"
            title="Insert image"
          >
            <img
              alt="Insert an image"
              loading="lazy"
              width="30"
              height="30"
              decoding="async"
              data-nimg="1"
              class="tabler-icon"
              style="color: transparent"
              src="../public/svg/tabler-icon-photo.svg"
            />
          </button>

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

    <div id="insert-image" class="image-popup p-4 gap-4">
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

      <div class="form-group flex flex-col gap-1">
        <label class="font-semibold text-sm" for=""
          >Description(Altenative Text)</label
        >
        <div class="input-group h-full gradient-border">
          <input
            name=""
            id="alt"
            placeholder="Helps optimize SE0 & visually impared users"
          />
        </div>
      </div>
      <span onclick="hidePopUp(this.parentElement)" class="cta close-btn">
        Close
      </span>
      <span onclick="insertImage()" class="cta"> Insert </span>
    </div>

   

    <div id="cover-image" class="image-popup p-4 gap-4">
      <h2 class="font-bold w-full">Choose post thumbnail</h2>
      <div class="avatar-upload">
        <div class="avatar-preview">
          <div id="imagePreview-2"></div>
        </div>
        <div class="avatar-edit">
          <input
            required
            type="file"
            id="imageUpload-2"
            name="photo"
            accept=".png, .jpg, .jpeg, .webp"
          />
          <label class="" for="imageUpload-2"></label>
        </div>
      </div>

      <div class="form-group flex flex-col gap-1">
        <label class="font-semibold text-sm" for=""
          >Description(Altenative Text)</label
        >
        <div class="input-group h-full gradient-border">
          <input
            name=""
            id="alt"
            placeholder="Helps optimize SE0 & visually impared users"
          />
        </div>
      </div>
      <span onclick="hidePopUp(this.parentElement)" class="cta close-btn">
        Continue editing
      </span>
      <span onclick="sendEvent()" class="cta"> Post </span>
    </div>
    <div class="popup-overlay"></div>
    
    <script src="../js/select-input.js"></script>

    <form  onsubmit="event.preventDefault()" id="post-form" style="display: none; visibility: hidden;" action="">
      <input hidden type="text" id="post-id">  
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
    <script defer src="../js/edit.js"></script>


    <script>
      //capture data from  the content
              function getStringAfterUnderscore(url) {
          // Find the last index of the underscore character
          const lastUnderscoreIndex = url.lastIndexOf("_");

          // Check if there's an underscore
          if (lastUnderscoreIndex !== -1) {
            // Extract the substring after the last underscore + 1 (to skip the underscore)
            return url.substring(lastUnderscoreIndex + 1);
          } else {
            return false;
          }
        }

        const currentUrl = window.location.href;


        const stringAfterUnderscore = getStringAfterUnderscore(currentUrl);

        // Function to retrieve post data by post_id using AJAX


// Function to retrieve post data by post_id using AJAX
function getPostData(post_id, callback) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'includes/posts/getPostData.php?post_id=' + post_id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var responseData = JSON.parse(xhr.responseText);
                console.log(responseData);
                // Store the retrieved data in an object
                var postData = {
                    post_id: responseData.post_id,
                    title: responseData.title,
                    content: responseData.content,
                    // Include additional properties
                    tags: responseData.tags ? responseData.tags.split(',') : [],
                    platforms: responseData.platforms,
                    category: responseData.category
                };
                // Invoke the callback function with the retrieved data
                callback(postData);
            } else {
                console.error('Error retrieving post data:', xhr.status);
                // Invoke the callback function with null to indicate an error
                callback(null);
            }
        }
    };
    xhr.send();
}


// Usage: Call the getPostData function with the extracted post_id
if (stringAfterUnderscore !== false) {
    // Call getPostData and pass a callback function to handle the retrieved data
    getPostData(stringAfterUnderscore, function(postData) {
        if (postData !== null) {
            // console.log(postData); 
            fetchPosts(postData)
        } else {
            console.error('Error: Failed to retrieve post data');
        }
    });
} else {
    console.error('Error: No post ID found in URL');
}




      const idInput = document.getElementById("post-id")
      idInput.value = stringAfterUnderscore;
      const contentInputEditor =  document.getElementById("editor")
      const contentInputForm = document.getElementById("form-content")
      const formSelect = document.getElementById("select");

      const categoryInputEditor = document.getElementById("select")
      const categoryInputForm = document.getElementById("form-category")

      const titleInputEditor =  document.getElementById("post-title")
      const titleInputForm = document.getElementById("form-title")
      
      const thumbnailImageForm  = document.getElementById("post-thumbail")
      const thumbnailImageEditor =  document.getElementById("imageUpload-2")

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
      

  function convertImages() {
    const postImages = document.querySelectorAll(".editor img");
    let base64Src = [];

    postImages.forEach((img) => {
        // Extract base64 source from image
        base64Src.push(img.src);
    });

    // Send base64 images to the server
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'includes/posts/upload.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Process response from the server
            var imageNames = JSON.parse(xhr.responseText);
            console.log(imageNames);
            // Replace base64 content with image names
            let index = 0
            postImages.forEach((img) => {
      
                
                  img.src =  "/reggaefresh/public/images/"+ imageNames[index]
                  index = index + 1
                
            });
            sendThumbnail(thumbnailImageForm.value);
        }
    };
    xhr.send(JSON.stringify(base64Src));
}
   

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
function sendEvent(){
  convertImages();
  
}
function payLoad(thumb) {
    var thumbnaill = {
        path: thumb,
        alternative: "potot sdhsd" // Adjust this value as needed
    };

    console.log("thumbnaill:");
    console.log(thumbnaill);
    
    var formData = {
        title: titleInputForm.value,
        content: contentInputEditor.innerHTML,
        thumbnail: thumbnaill,
        category: categoryInputForm.value,
        tags: selectedTags,
        platforms: selectedPlatforms,
        postId: parseInt(idInput.value)
    };

    console.log("formData:");
    console.log(formData);

   
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'includes/posts/updatepost.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Process response from the server
            var response = xhr.responseText;
            // Do something with the response, e.g., display a success message
            console.log(response);
            // location.reload();
        }
    };
    xhr.send(JSON.stringify(formData));
}

var newPlatforms = []
var newTags = []
// Call the sendThumbnail function before sending the form data
// console.log(thumbnailImageForm.value);
// sendThumbnail(thumbnailImageForm.value);

    </script>
      <script>


    const posts = <?php echo $postJSON; ?>;
    console.log("try posts1 \n"+  processData2(posts))
    

  



    function handlePostsData(postData) { 
      let posts; 
      posts = postData; // Assign the retrieved data to the global variable posts
      
      const postsData = processData1(posts);

      
    }

    function getPosts(callback) {
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'includes/posts/getposts.php', true);
      xhr.setRequestHeader('Content-Type', 'application/json');
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          var responseData = JSON.parse(xhr.responseText);
          callback(responseData); // Call the callback function with the retrieved data
        }
      };
      xhr.send();
    }

    // Call the function to retrieve posts data and pass the callback function


    // Function to process the retrieved thumbnail data
    // Function to process the retrieved thumbnail data
    function processData2(data) {
      // Object to store thumbnail data
      var images = [];

      // Loop through each item in the response data
      var images = [];

      // Loop through each item in the response data
      data.forEach(function(item) {
        // Check if thumbnail path exists and add it to the images array as an object
        if (item.thumbnail_path) {
          images.push({
            post_id: item.post_id,
            images: item.thumbnail_path
          });
        }
      });
      // Assign images data to the global variable
      imagesData = images;

      return imagesData;
    }

  </script>
  </body>
</html>
