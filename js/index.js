// import posts from "./data.js";
// import images from "./data-images.js";



const posts = null
const images = null

function getImage(images, postID) {
  const matchingImage = images.find(image => image.post_id === postID);
  return matchingImage ? matchingImage.images : undefined;
}

