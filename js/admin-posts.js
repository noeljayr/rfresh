

function createPosts(posts, images){
  let sortedPostsDesc = sortByDateDesc(posts);
  displayPosts(sortedPostsDesc, images);
}

function formatDate(inputDate) {
  const date = new Date(inputDate);

  const monthNames = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];

  const year = date.getFullYear();
  const month = monthNames[date.getMonth()];
  const day = date.getDate();

  const formattedDate = `${month} ${day}, ${year}`;

  return formattedDate; 
}

function getImage(images, postID) {
  const matchingImage = images.find((image) => image.post_id === postID);
  return matchingImage ? matchingImage.images : null;
}

function sortByDateAsc(posts) {
  return posts
    .slice()
    .sort((a, b) => new Date(a.creation_date) - new Date(b.creation_date));
}

function sortByDateDesc(posts) {
  return posts
    .slice()
    .sort((a, b) => new Date(b.creation_date) - new Date(a.creation_date));
}


// let sortedPostsDesc = sortByDateDesc(posts);

function displayPosts(array, images) {
  array.forEach((post) => {
    if (post.title != "Home") {
      const postEl = document.createElement("div");
      postEl.classList = "post flex relative flex-row gap-4";
      const href =
        "view.php?" + post.title.replace(/\s/g, "-") + "_" 
        +  post.post_id
        // post.ID;
      postEl.innerHTML = `
      
            
            <img
              loading="lazy"
              src="${getImage(images, post.post_id)}"
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
  });
}



function filterData(query) {
  return posts.filter((filtered) => {
    return filtered.title.toLowerCase().includes(query.toLowerCase());
  });
}

const input = document.querySelector("input");

input.addEventListener("input", function () {
  if (input.value.length >= 2) {
    const query = this.value.trim();
    const filteredData = filterData(query);
    displayResults(filteredData, images);
  } else {
    adminPostsWrapper.innerHTML = "";
    displayPosts(posts, images);
  }
});

function displayResults(filteredData, images) {
  let sortedPostsDesc = sortByDateDesc(filteredData);
  adminPostsWrapper.innerHTML = "";
  sortedPostsDesc.forEach((filtered) => {
    const post = document.createElement("div");
    post.classList = "post flex relative flex-row gap-4";
    const href =
      "view.php?" +
      filtered.title.replace(/\s/g, "-") +
      "_" + 1
      // filtered.ID;
    post.innerHTML = `
    
          
          <img
            loading="lazy"
            src="${getImage(images, filtered.post_id)}"
            alt="${filtered.title}"
          />
          <div class="info flex overflow-hidden flex-col gap-1">
            <span title="${
              filtered.title
            }" class="title whitespace-nowrap text-ellipsis">${
      filtered.title
    }</span>
            <span class="opacity-50 text-sm">${formatDate(
              filtered.creation_date
            )}</span>
          </div>

          <div class="actions  ml-auto flex gap-4"> 
           
            <span title="Delete Post" style="background-color: #FFBFBF;" class="action flex">
            <img src="../public/svg/tabler-icon-trash.svg" alt="Delete Post" />
            </span>
          </div>
    
    `;
    adminPostsWrapper.appendChild(post);
  });
}
