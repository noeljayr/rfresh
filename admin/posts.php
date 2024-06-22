
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
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.6.7/css/perfect-scrollbar.min.css" />

  <link rel="shortcut icon" href="../public/logos/favicon.png" type="image/x-icon" />

  <script src="https://cdn.tailwindcss.com"></script>
  <script src="../js/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.6.7/js/min/perfect-scrollbar.jquery.min.js"></script>
  <!-- <script defer src="../js/editor.js"></script>
    <script defer src="../js/select-input.js"></script>
    <script defer src="../js/dashboard.js"></script> -->
  <script defer src="../js/admin-posts.js"></script>
</head>

<body class="p-8 py-20 pb-0 grid">
  <img class="fixed background-blob top-0 z-0 opacity-10 self-center" src="../public//svg/background-blob.svg" alt="Reggae flag" />
  <div class="fixed top-8 z-20 admin-nav items-center justify-between flex gap-4"></div>
  <script>
    const page = "Posts";
  </script>
  <script src="../js/components/adminNav.js"></script>

  <div class="main-content relative z-10 h-full grid gap-8 pt-8">
    <div class="admin-posts-wrapper flex flex-col gap-4 w-full">
      <a class="add-post-btn" href="dashboard.php">
        <img src="../public/svg/tabler-icon-plus.svg" alt="" />
      </a>
      <div class="search-container">
        <div class="search-input gradient-border">
          <img loading="lazy" src="../public/svg/tabler-icon-search.svg" alt="search icon" class="search-icon" />
          <input type="text" placeholder="Search for anything..." />
        </div>

        <div class="filter-container flex flex-col">
          <span class="text-sm opacity-50">Filter</span>
          <div class="filters flex gap-4">
            <span class="filter gradient-border active-filter">
              <span class="title">All</span></span>
            <span class="filter gradient-border">
              <span class="title">News</span></span>
            <span class="filter gradient-border">
              <span class="title">Albums</span></span>
              <span class="filter gradient-border">
              <span class="title">Singles</span></span>
              <span class="filter gradient-border">
              <span class="title">Mixtapes</span></span>
            <span class="filter gradient-border">
              <span class="title">Artists</span></span>
            <span class="filter gradient-border">
              <span class="title">Videos</span></span>
            <span class="filter gradient-border">
              <span class="title">Events</span></span>
          </div>
        </div>

        <div class="admin-posts-container px-4 grid gap-4"></div>
      </div>

      <form onsubmit="event.preventDefault()" id="delete-post" action="" class="popup-form grid p-4 gap-4 danger-form">
      <p class="w-full"><span class="admin-name font-bold"></span>Are you sure you want to delete the post?</p>
      <input required hidden id="post-id" name="post-id" type="text">
      <span onclick="hidePopUp(this.parentElement)" class="cta close-btn">
        Cancel
      </span>
      <button onclick="deletePostBtn()"  style="background: red;" class="cta diactivate">Yes, Delete</button> 
    </form>

    <div class="popup-overlay"></div>

    </div>
  </div>
  <script>
    var posts = <?php echo $postJSON; ?>;
    var images =  processData2(posts); 

    



    const deletePostPopup = document.getElementById("delete-post")
    const deletePostId = document.getElementById("post-id")
    const popupOverlay = document.querySelector(".popup-overlay ")
    function deletePostAction(id){
      deletePostId.value = id
      showPopUp(deletePostPopup)
    }

    function deletePostBtn(){ 
      deletePost(deletePostId.value) 
    }
function showPopUp(popup) {
  popupOverlay.style.visibility = "visible";
  popupOverlay.style.opacity = "0.25";
  popup.style.visibility = "visible";
  popup.style.opacity = "1";
}

function hidePopUp(parent) {
  parent.style.visibility = "hidden";
  parent.style.opacity = "0";
  popupOverlay.style.visibility = "hidden";
  popupOverlay.style.opacity = "0";
}

  popupOverlay.addEventListener("click", ()=>{
    hidePopUp(deletePostPopup)
  })
    function handlePostsData(postData) {
      let posts; // Define posts globally
      posts = postData; // Assign the retrieved data to the global variable posts
      // Now you can use the posts variable here
      const imageData = processData2(posts);
      const postsData = processData1(posts);

      // console.log(imageData)
      createPosts(posts, imageData)
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
    getPosts(handlePostsData);
    // Function to process the retrieved post data
    function processData1(data) {
      // Array to store posts
      var posts = [];

      // Loop through each item in the response data
      data.forEach(function(item) {
        // Create a post object
        var post = {
          post_id: item.post_id,
          title: item.title,
          content: item.content,
          category: item.category,
          user_id: item.user_id,
          creation_date: item.creation_date, // Include creation date
          tags: item.tags ? item.tags.split(',') : [], // Check if tags property exists
          platforms: [],
        };

        // Add platforms to the post object
        post.platforms.push({
          platform_name: item.platform_name,
          link: item.link
        });

        // Add post object to the posts array
        posts.push(post);
      });

      // Assign posts data to the global variable
      postsData = posts;

      return postsData;
    }

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




    function deletePost(post_id) {
      console.log( post_id + " ia the post id");
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'includes/posts/deletePost.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    if (response === 'success') {
                        // Post deleted successfully
                        console.log('Post deleted successfully');
                        location.reload();
                    } else {
                        // Error occurred while deleting post
                        console.error('Error deleting post:', response);
                    }
                } else {
                    // Error occurred in the request
                    console.error('Error in request:', xhr.status);
                }
            }
        };
        xhr.send('post_id=' + post_id);
    }


    
const adminPostsWrapper = document.querySelector(".admin-posts-container");

  
    const filters = document.querySelectorAll(".filter")
    filters.forEach((f)=>{
      f.addEventListener("click", ()=>{
        filters.forEach((filt)=>{
          filt.classList.remove("active-filter")

        })
        f.classList.add("active-filter")
        const filterQuery = f.textContent.trim()
          console.log(filterQuery)
          if(filterQuery != "All"){
            adminPostsWrapper.innerHTML = ""
          posts.forEach(post=>{
            if(post.category == filterQuery){
                  const postEl = document.createElement("div");
                  postEl.classList = "post flex relative flex-row gap-4";
                  const href =
                    "view.php?" + post.title.replace(/\s/g, "-") + "_" 
                    +  post.post_id
                    // post.ID;
                  postEl.innerHTML = `
                  
                        
                        <img
                          loading="lazy"
                          src="${post.thumbnail_path}"
                          alt="${post.title}"
                        />
                        <a href=${href} class="info flex flex-col w-full overflow-hidden gap-1">
                          <span title="${
                            post.title
                          }" class="title whitespace-nowrap text-ellipsis">${
                    post.title
                  }</span>
                          <span class="opacity-50 text-sm">${formatDate(
                            post.creation_date
                          )}</span>
                        </a>

                        <div class="actions ml-auto flex gap-4"> 
                            
                        <span  onclick="deletePostAction(${post.post_id})" title="Delete Post" style="background-color: #FFBFBF;" class="action cursor-pointer flex">
                        <img src="../public/svg/tabler-icon-trash.svg" alt="Delete Post" />
                        </span>
                      </div>
                  
                  `;
                  adminPostsWrapper.appendChild(postEl);
            } 
          })
          }else{
              adminPostsWrapper.innerHTML = ""
              displayPosts(posts, images);
            }
      })
    })
  </script>
</body>

</html>