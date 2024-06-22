




function fetchPosts(post){
    if (stringAfterUnderscore) {
    let newTitle = null;
    let newContent = null;
    let newCategory = null;
    let newTags = null;

      
        titleInput.value = post.title;
        contentInput.innerHTML = post.content;
        formSelect.value = post.category;
        var event = new Event("change");
  
        // Dispatch the event on the element
        formSelect.dispatchEvent(event);
        options.forEach((o) => {
          if (o.textContent == post.category) {
            o.classList.add("selected-option");
            formSelect.value = o.textContent.trim();
          var event = new Event("change");
          formSelect.dispatchEvent(event);
          titleInput.dispatchEvent(event);

          categoryInputForm.value = o.textContent.trim();
          categoryInputForm.dispatchEvent(event);
          } else {
            o.classList.remove("selected-option");
          }
  
          

          console.log(post.category)
        });
        selectedT.textContent = post.category;
        const postTags = post.tags;
        selectedTags = postTags;



  
        // disableNext();
        appendSelectedTagsEdit(selectedTags);
  
        // checkChange(
        //   post.title,
        //   post.content,
        //   post.tags,
        //   post.platforms,
        //   post.category
        // );

        selectedPlatforms = post.platforms;
        selectedTags = post.tags;

        console.log((selectedTags))

        if(post.platforms.length > 0){
          document.querySelector(".post-settings").classList.add("post-settings-plaforms")
          appendSelectedPlatformsEdit(post.platforms)
        }
  
        function changeInSelectedTags() {
          const originalTags = post.tags;
  
          if (!checkArrays(originalTags, selectedTags)) {
            enableNext();
          } else {
            // disableNext();
            console.log("old: " + originalTags);
            newTags = null;
          }
        }
      
    
  }
}


function appendSelectedTagsEdit(dataTags) {
  // selectedTagsContainer.innerHTML = ""
  dataTags.forEach((tag) => {
    const tagEl = document.createElement("span");
    tagEl.classList = "tag";
    // tagEl.textContent = tag;
    tagEl.innerHTML = `
            <span class="remove-tag">
              <img alt="close button" src="../public/svg/tabler-icon-plus.svg" />
            </span>
            <span class="tag-title text-xs">${tag}</span>
          `;
    selectedTagsContainer.appendChild(tagEl);

    const removeTagBtns =
      selectedTagsContainer.querySelectorAll(".tag .remove-tag");

    removeTagBtns.forEach((btn) => {
      btn.addEventListener("click", () => {
        // console.log(btn.parentElement);
        const parent = btn.parentElement;
        const tag = parent.querySelector(".tag-title").textContent;
        const filteredArray = selectedTags.filter((element) => element !== tag);

        selectedTags = filteredArray;

       

        const appendedTags = selectedTagsContainer.querySelectorAll(".tag");
        appendedTags.forEach((tag) => {
          selectedTagsContainer.removeChild(tag);
        });

        appendSelectedTagsEdit(selectedTags);
      });
    });
  });
}



function appendSelectedPlatformsEdit(dataPlatforms) {
  dataPlatforms.forEach((plat) => {
    const el = document.createElement("span");
    // el.target = "_blank";
    // el.rel = "noopener noreferrer";
    // el.href = plat.link;
    el.className = "platform";
    el.id = plat.platform_name;
    let platformIcon = checkPlatformIcon(plat.platform_name);
    el.innerHTML = `
        <a class="w-full flex item h-full" href="${plat.link}" target="_blank" rel="noopener noreferrer">
          <img src="../public/svg/${platformIcon}.svg" alt="${plat.platform_name} Link">
        </a>
        <span onclick="removePlatform(this.parentElement)" class="remove-platform">
          <img class="remove-plat-icon" src="../public/svg/tabler-icon-x.svg" alt="Remove platform">
        </span>
    `;

    platformContainer.appendChild(el);
   
  });
}


function checkPlatformIcon(name) {
  let platformIcon = null;
  switch (name) {
    case "Spotify":
      platformIcon = "spotify";
      break;
    case "Apple Music":
      platformIcon = "apple-music";
      break;

    case "YouTube":
      platformIcon = "youtube";
      break;
    case "YouTube Music":
      platformIcon = "youtube-music";
      break;
    case "Tidal":
      platformIcon = "tidal";
      break;
    case "Amazon Music":
      platformIcon = "amazon-music";
      break;
    case "Deezer":
      platformIcon = "deezer";
      break;
    case "AudioMack":
      platformIcon = "audiomack";
      break;
  }
  return platformIcon;
}