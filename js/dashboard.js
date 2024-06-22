const newTagBtn = document.getElementById("new-tag-btn");
const tagsContainer = document.querySelector(".filtered-tags");
const selectedTagsContainer = document.querySelector(".tags-container");
const tagsFilterInput = document.querySelector(".tags-fetch input");
const tagsFormTrigger = document.querySelector(".add-tag-btn");
const closeBtn = document.getElementById("close-tags-menu");
const postSettings = document.querySelector(".post-settings");

// let year = new Date().getFullYear();
// selectedTags.push(year.toString());

tagsFormTrigger.addEventListener("click", () => {
  postSettings.classList.add("tags-modal-active");
  tagsContainer.innerHTML = "";
  appendTags();
  checkSelectedTags();
}); 

closeBtn.addEventListener("click", () => {
  // if (e.target.classList.contains("close-btn")) {
  postSettings.classList.remove("tags-modal-active");
  const tags = selectedTagsContainer.querySelectorAll(".tag");

  tags.forEach((tag) => {
    selectedTagsContainer.removeChild(tag);
    tag = null;
  });

  appendSelectedTags();
});

function createTag(text, container) {
  const tagEl = document.createElement("span");
  tagEl.classList = "tag flex items-center justify-between";
  tagEl.innerHTML = `
  <span class="tag-title text-xs">${text}</span>
  <span class="checkbox">
  <svg
    width="24"
    height="24"
    viewBox="0 0 24 24"
    fill="none"
    xmlns="http://www.w3.org/2000/svg"
  >
    <path
      d="M5 12L10 17L20 7"
      stroke="#2e972e"
      stroke-width="2"
      stroke-linecap="round"
      stroke-linejoin="round"
    />
  </svg>
</span>
  `;
  container.appendChild(tagEl);
}

tagsContainer.addEventListener("click", (e) => {
  if (e.target.classList.contains("tag")) {
    const tag = e.target;
    tag.classList.add("checked");
  }

  if (
    e.target.classList.contains("checkbox") ||
    e.target.classList.contains("tag-title")
  ) {
    const tag = e.target.parentElement;
    tag.classList.add("checked");

    if (!selectedTags.includes(tag.textContent.trim())) {
      selectedTags.push(tag.textContent.trim());
      console.log(selectedTags);
     
    } else {
      let index = selectedTags.indexOf(tag.textContent.trim());
      selectedTags.splice(index, 1);
      console.log(selectedTags);
      checkSelectedTags();
     
    }
  }
});

function appendTags() {
  tags.forEach((tag) => {
    createTag(tag, tagsContainer);
  });
}

appendSelectedTags();

function appendSelectedTags() {
  // selectedTagsContainer.innerHTML = ""
  selectedTags.forEach((tag) => {
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

        appendSelectedTags();
      });
    });
  });
}

appendTags();

function filterData(query) {
  return tags.filter((filtered) => {
    return filtered.toLowerCase().includes(query.toLowerCase());
  });
}

function displayResults(filteredData) {
  tagsContainer.innerHTML = "";
  filteredData.forEach((filtered) => {
    createTag(filtered, tagsContainer);
  });
}

function checkSelectedTags() {
  const selected = tagsContainer.querySelectorAll(".tag");

  selected.forEach((tag) => {
    const tagTitle = tag.querySelector(".tag-title");
    if (selectedTags.includes(tagTitle.textContent.trim())) {
      tag.classList.add("checked");
    } else {
      tag.classList.remove("checked");
    }
  });
}

checkSelectedTags();

tagsFilterInput.addEventListener("input", function () {
  if (tagsFilterInput.value.length >= 2) {
    const query = this.value.trim();
    const filteredData = filterData(query);
    displayResults(filteredData);
    checkSelectedTags();
  } else if (tagsFilterInput.value.length < 1) {
    tagsContainer.innerHTML = "";
    appendTags();
    checkSelectedTags();
  }
});

newTagBtn.addEventListener("click", () => {
  if (
    tagsFilterInput.value.length > 0 &&
    !selectedTags.includes(tagsFilterInput.value.trim())
  ) {
    createNewTag();
  }
});

function createNewTag() {
  selectedTags.push(tagsFilterInput.value.trim());
  tags.push(tagsFilterInput.value.trim());
  
  console.log(selectedTags);
  checkSelectedTags();
  const filteredData = filterData(tagsFilterInput.value.trim());
  displayResults(filteredData);
  checkSelectedTags();
}

tagsFilterInput.addEventListener("keydown", (e) => {
  if (
    e.key === "Enter" &&
    tagsFilterInput.value.length > 0 &&
    !selectedTags.includes(tagsFilterInput.value.trim())
  ) {
    createNewTag();
  }
});

tagsContainer.addEventListener("click", (e) => {
  if (e.target.classList.contains("tag")) {
    const tag = e.target;
    if (!selectedTags.includes(tag.textContent.trim())) {
      selectedTags.push(tag.textContent.trim());
      console.log(selectedTags);
      checkSelectedTags();
    } else {
      let index = selectedTags.indexOf(tag.textContent.trim());
      selectedTags.splice(index, 1);
      console.log(selectedTags);
      checkSelectedTags();
    }
  }
  // console.log(e)
});

// selectedTagsContainer.addEventListener("click", (e) => {
//   if (e.target.classList.contains("remove-tag")) {
//     selectedTags.push(e.target.textContent.trim());
//     console.log(selectedTags);
//     checkSelectedTags();
//   }
// });

/*Edit*/


const titleInput = document.getElementById("post-title");
const contentInput = document.querySelector(".editor");



function checkArrays(first, second) {
  return first
    .sort()
    .every((element, index) => element === second.sort()[index]);
}

function enableNext() {
  nextBtn.setAttribute("Disabled", false);
  nextBtn.style.opacity = "1";
}
function disableNext() {
  nextBtn.setAttribute("Disabled", true);
  nextBtn.style.opacity = "0.5";
}
/* Change*/

function checkChange(title, content, platforms, category) {
  const originalTitle = title;

  const originalContent = content;

  const originalPlaforms = platforms;
  const originalCategory = category;

  titleInput.addEventListener("input", () => {
    if (originalTitle !== titleInput.value) {
      newTitle = titleInput.value;
      enableNext();
    } else {
      disableNext();
      newTitle = null;
    }
  });

  function contentChange() {
    if (originalContent !== contentInput.innerHTML) {
      newContent = contentInput.innerHTML;
      enableNext();
    } else {
      disableNext();
      newContent = null;
    }
  }
  contentInput.addEventListener("input", () => {
    contentChange();
    console.log(originalContent);
  });
  contentInput.addEventListener("change", () => {
    contentChange();
  });

  formSelect.addEventListener("change", () => {
    if (originalCategory !== formSelect.value) {
      newCategory = formSelect.value;
      enableNext();
    } else {
      disableNext();
      newCategory = null;
    }
  });
}

const radioButtons = document.querySelectorAll('input[type="radio"]');
const plaformLinkInput = document.getElementById("platform-link");
const platFormName = document.getElementById("platform-name");
const addPlatformBtn = document.querySelector(".add-plaform-btn");
const platformContainer = document.querySelector(".platforms-container");

radioButtons.forEach((radioButton) => {
  radioButton.addEventListener("change", (event) => {
    if (event.target.checked) {
      // console.log(event.target.value);

      platFormName.value = event.target.value;
      // console.log(platFormName.value);
    }
  });
});

function addPlatform() {
  if (platFormName.value.length > 0 && plaformLinkInput.value.length > 0) {
    const platform = {
      platform_name: platFormName.value.trim(),
      link: plaformLinkInput.value.trim(),
    };

    let platformIcon = checkPlatformIcon(platform.platform_name);

    const platEl = document.createElement("span");
    // platEl.target = "_blank";
    // platEl.rel = "noopener noreferrer";
    // platEl.href = platform.link;
    platEl.className = "platform";
    platEl.id = platform.platform_name;
    platEl.innerHTML = `
        <a class="w-full flex item h-full" href="${platform.link}" target="_blank" rel="noopener noreferrer">
          <img src="../public/svg/${platformIcon}.svg" alt="${platform.platform_name} Link">
        </a>
        <span onclick="removePlatform(this.parentElement)" class="remove-platform">
          <img src="../public/svg/tabler-icon-x.svg" alt="Remove platform">
        </span>
    `;

    platformContainer.appendChild(platEl);
    selectedPlatforms.push(platform);
    postSettings.classList.remove("tags-modal-active-2");

    const removePlatBtns = platformContainer.querySelectorAll(
      ".platform .remove-platform"
    );
  }
}

function appendSelectedPlatforms() {
  selectedPlatforms.forEach((plat) => {
    const el = document.createElement("span");
    // el.target = "_blank";
    // el.rel = "noopener noreferrer";
    // el.href = plat.link;
    el.className = "platform";
    el.id = plat.name;
    let platformIcon = checkPlatformIcon(plat.name);
    el.innerHTML = `
        <a class="w-full flex item h-full" href="${plat.link}" target="_blank" rel="noopener noreferrer">
          <img src="../public/svg/${platformIcon}.svg" alt="${plat.name} Link">
        </a>
        <span onclick="removePlatform(this.parentElement)" class="remove-platform">
          <img class="remove-plat-icon" src="../public/svg/tabler-icon-x.svg" alt="Remove platform">
        </span>
    `;

    platformContainer.appendChild(el);
   
  });
}

window.addEventListener("click", (e) => {
  if (e.target.classList.contains("remove-platform")) {
    // e.target.stopPropagation()
  }
});

function removePlatform(parent) {
  const name = parent.id.trim();
  const filteredArray = selectedPlatforms.filter((obj) => obj.name !== name);

  selectedPlatforms = filteredArray;

  const appendedPlatforms = platformContainer.querySelectorAll(".platform");
  appendedPlatforms.forEach((el) => {
    platformContainer.removeChild(el);
  });

  appendSelectedPlatforms();
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

addPlatformBtn.addEventListener("click", () => {
  postSettings.classList.add("tags-modal-active-2");
});

function closePlatfroms() {
  postSettings.classList.remove("tags-modal-active-2");
}




