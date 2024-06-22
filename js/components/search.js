// // import posts from "../data.js";import images from "../data-images.js";

// const posts = null
// const images = null
// const search = document.querySelector(".search");

// search.innerHTML = `

// <div class="search-container-overlay"></div>
// <div class="search-container">
//   <div class="search-input gradient-border">
//     <img
//       loading="lazy"
//       src="public/svg/tabler-icon-search.svg"
//       alt="search icon"
//       class="search-icon"
//     />
//     <input type="text" placeholder="Search for anything..." />
//   </div>

//   <div class="filter-container flex flex-col">
//     <span class="text-sm opacity-50">Filter</span>
//     <div class="filters flex gap-4">
//       <span class="filter gradient-border active-filter">
//         <span class="title">All</span></span
//       >
//       <span class="filter gradient-border">
//         <span class="title">News</span></span
//       >
//       <span class="filter gradient-border">
//         <span class="title">Music</span></span
//       >
//       <span class="filter gradient-border">
//         <span class="title">Artists</span></span
//       >
//       <span class="filter gradient-border">
//         <span class="title">Videos</span></span
//       >
//       <span class="filter gradient-border">
//         <span class="title">Events</span></span
//       >
//     </div>


    
//   </div>

//   <div class="filtered-posts grid gap-4"></div>
// </div>


// `;

// const filterPosts = document.querySelector(".filtered-posts");
// function filterData(query) {
//   return posts.filter((filtered) => {
//     return filtered.post_title.toLowerCase().includes(query.toLowerCase());
//   });
// }

// // Function to display filtered results
// function displayResults(filteredData) {
//   let sortedPostsDesc = sortByDateDesc(filteredData);
//   filterPosts.innerHTML = "";
//   sortedPostsDesc.forEach((filtered) => {
//     const post = document.createElement("a");
//     post.classList = "post flex flex-row gap-4";
//     post.href = filtered.post_title + "_" + filtered.ID;
//     post.innerHTML = `
    
          
//           <img
//             loading="lazy"
//             src="${getImage(images, filtered.ID)}"
//             alt="${filtered.post_title}"
//           />
//           <div class="info flex flex-col gap-1">
//             <span title="${filtered.post_title}" class="title">${filtered.post_title}</span>
//             <span class="opacity-50 text-sm">${formatDate(
//               filtered.post_date
//             )}</span>
//           </div>
    
//     `;
//     filterPosts.appendChild(post);
//   });
// }

// const input = document.querySelector("input");

// input.addEventListener("input", function () {
//   if (input.value.length >= 2) {
//     const query = this.value.trim();
//     const filteredData = filterData(query);
//     displayResults(filteredData);
//   } else {
//     filterPosts.innerHTML = "";
//   }
// });

// function formatDate(inputDate) {
//   const date = new Date(inputDate);

//   const monthNames = [
//     "January",
//     "February",
//     "March",
//     "April",
//     "May",
//     "June",
//     "July",
//     "August",
//     "September",
//     "October",
//     "November",
//     "December",
//   ];

//   const year = date.getFullYear();
//   const month = monthNames[date.getMonth()];
//   const day = date.getDate();

//   const formattedDate = `${month} ${day}, ${year}`;

//   return formattedDate;
// }

// function getImage(images, postID) {
//   const matchingImage = images.find((image) => image.post_id === postID);
//   return matchingImage ? matchingImage.images : null;
// }

// const searchBtn = document.querySelector(".nav-search-btn");
// const overlay = document.querySelector(".search-container-overlay");
// const searchContainer = document.querySelector(".search-container");

// searchBtn.addEventListener("click", () => {
//   searchBtn.classList.toggle("nav-search-active");
//   overlay.classList.toggle("search-container-overlay-active");
//   searchContainer.classList.toggle("search-container-active");
// });


// function sortByDateAsc(posts) {
//   return posts
//     .slice()
//     .sort((a, b) => new Date(a.post_date) - new Date(b.post_date));
// }

// function sortByDateDesc(posts) {
//   return posts
//     .slice()
//     .sort((a, b) => new Date(b.post_date) - new Date(a.post_date));
// }


// let sortedPostsAsc = sortByDateAsc(posts);

// let sortedPostsDesc = sortByDateDesc(posts);