$("#bold").on("click", function () {
  document.execCommand("bold", false, null);
});

$("#italic").on("click", function () {
  document.execCommand("italic", false, null);
});

$("#underline").on("click", function () {
  document.execCommand("underline", false, null);
});

$("#align-left").on("click", function () {
  document.execCommand("justifyLeft", false, null);
});

$("#align-center").on("click", function () {
  document.execCommand("justifyCenter", false, null);
});

$("#align-right").on("click", function () {
  document.execCommand("justifyRight", false, null);
});

$("#list-ul").on("click", function () {
  document.execCommand("insertUnorderedList", false, null);
});

$("#list-ol").on("click", function () {
  document.execCommand("insertOrderedList", false, null);
});

$("#fonts").on("change", function () {
  var font = $(this).val();
  document.execCommand("fontName", false, font);
});

const editor = document.querySelector(".editor");

editor.addEventListener("keydown", (e) => {
  if (e.ctrlKey && e.key === "b") {
    e.preventDefault(); // Prevent the browser's default behavior
    document.execCommand("bold", false, null);
  }

  if (e.ctrlKey && e.key === "i") {
    e.preventDefault(); // Prevent the browser's default behavior
    document.execCommand("italic", false, null);
  }
  if (e.ctrlKey && e.key === "u") {
    e.preventDefault(); // Prevent the browser's default behavior
    document.execCommand("underline", false, null);
  }
  if (e.ctrlKey && e.key === "l") {
    e.preventDefault(); // Prevent the browser's default behavior
    document.execCommand("justifyLeft", false, null);
  }
  if (e.ctrlKey && e.key === "e") {
    e.preventDefault(); // Prevent the browser's default behavior
    document.execCommand("justifyCenter", false, null);
  }
  if (e.ctrlKey && e.key === "r") {
    e.preventDefault(); // Prevent the browser's default behavior
    document.execCommand("justifyRight", false, null);
  }
});

window.addEventListener("keydown", (e) => {
  if (e.ctrlKey && e.key === "s") {
    e.preventDefault();
    popupOverlay.style.visibility = "visible";
    popupOverlay.style.opacity = "0.25";
    showPopUp(postImagePopup);
  }
  if (e.key == "Escape") {
    hidePopUp(embeddedPopup);
    hidePopUp(imagePopup);
    hidePopUp(linkPopup);
    hidePopUp(postImagePopup);
  }
});

const contentIput = document.getElementById("form-content");

editor.addEventListener("input", () => {
  contentIput.value = editor.innerHTML;
});

editor.addEventListener("change", () => {
  contentIput.value = editor.innerHTML;
  console.log(contentIput.value);
});

function showLinkPopup() {
  var selectedText = window.getSelection().toString().trim();
  if (selectedText !== "") {
    var selection = window.getSelection().getRangeAt(0).getBoundingClientRect();
    var divRect = editor.getBoundingClientRect();

    saveSelection();

    showPopUp(linkPopup);
  }
}

const popupOverlay = document.querySelector(".popup-overlay");

function showEmbedPopup() {
  popupOverlay.style.visibility = "visible";
  popupOverlay.style.opacity = "0.25";
  showPopUp(embeddedPopup);
}

popupOverlay.addEventListener("click", () => {
  hidePopUp(embeddedPopup);
  hidePopUp(imagePopup);
  hidePopUp(linkPopup);
  hidePopUp(postImagePopup);
});

function showPopUp(popup) {
  popupOverlay.style.visibility = "visible";
  popupOverlay.style.opacity = "0.25";
  popup.style.visibility = "visible";
  popup.style.opacity = "1";
}

const linkTool = document.getElementById("link");
const linkPopup = document.getElementById("link-popup");
const embeddedPopup = document.getElementById("embedded-popup");
const urlInput = document.getElementById("url");
const postImagePopup = document.getElementById("cover-image");

// linkTool.addEventListener("click", showLinkPopup);

let savedSelection;

function saveSelection() {
  if (window.getSelection) {
    let sel = window.getSelection();
    if (sel.getRangeAt && sel.rangeCount) {
      savedSelection = sel.getRangeAt(0);
    }
  } else if (document.selection && document.selection.createRange) {
    savedSelection = document.selection.createRange();
  }
}

nextBtn.addEventListener("click", () => {
  popupOverlay.style.visibility = "visible";
  popupOverlay.style.opacity = "0.25";
  showPopUp(postImagePopup);
});

function restoreSelection() {
  if (savedSelection) {
    if (window.getSelection) {
      let sel = window.getSelection();
      sel.removeAllRanges();
      sel.addRange(savedSelection);
    } else if (document.selection && savedSelection.select) {
      savedSelection.select();
    }
  }
}

linkPopup.addEventListener("keydown", (e) => {
  if (e.key === "Enter") {
    createLink();
  }
});

const urlPattern =
  /^(http(s)?:\/\/)?(www\.)?[a-zA-Z0-9-]+\.[a-zA-Z]{2,}(\.[a-zA-Z]{2,})?(\S*)$/;
const urlPattern2 =
  /^(www\.)?[a-zA-Z0-9-]+\.[a-zA-Z]{2,}(\.[a-zA-Z]{2,})?(\S*)$/;

function createLink() {
  const url = urlInput.value;
  if (urlPattern.test(url)) {
    let aTag = document.createElement("a");
    aTag.setAttribute("target", "_blank");
    aTag.setAttribute("rel", "noopener noreferrer");
    aTag.href = url;
    aTag.textContent = savedSelection.toString();
    savedSelection.deleteContents();
    savedSelection.insertNode(aTag);
    hidePopUp(linkPopup);
  }
}

const embeddedInput = document.getElementById("embedded-input");

function hidePopUp(parent) {
  parent.style.visibility = "hidden";
  parent.style.opacity = "0";
  popupOverlay.style.visibility = "hidden";
  popupOverlay.style.opacity = "0";
}

function appendIframeToDiv() {
  const iframeCode = embeddedInput.value;
  const div = document.createElement("div");
  div.innerHTML = "<br/>" + iframeCode + "<br/>";
  editor.appendChild(div);
  hidePopUp(embeddedPopup);
}

const imageUpload = document.getElementById("imageUpload");
const altText = document.getElementById("alt");
const imagePopup = document.getElementById("insert-image");

function showImagePopup() {
  popupOverlay.style.visibility = "visible";
  popupOverlay.style.opacity = "0.25";
  imagePopup.style.visibility = "visible";
  imagePopup.style.opacity = "1";
  file = false;
  preveSelect.value;
  $("#imagePreview").css("background-image", "url(" + "" + ")");
}

let file = false;
function insertImage() {
  file = imageUpload.files[0];
  if (file && altText.value.length > 0 && !preveSelect.value) {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function () {
      const div = document.createElement("div");
      div.innerHTML = `
        <br/>
        <img src= "${reader.result}" alt="${altText.value}">
        <br/>
        `;

      file = false;
      var event = new Event("change");

      editor.dispatchEvent(event);
      editor.appendChild(div);
      hidePopUp(imagePopup);
    };
  } else if (preveSelect.value.length > 0) {
    const div = document.createElement("div");
    div.innerHTML = `
        <br/>
        <img src= "${preveSelect.value}" alt="${altText.value}">
        <br/>
        `;

    preveSelect.value = null;

    var event = new Event("change");

    editor.dispatchEvent(event);
    editor.appendChild(div);
    hidePopUp(imagePopup);
  }
}

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $("#imagePreview").css(
        "background-image",
        "url(" + e.target.result + ")"
      );
      $("#imagePreview").hide();
      $("#imagePreview").fadeIn(650);
    };
    preveSelect.value = "";
    reader.readAsDataURL(input.files[0]);
  }
}
$("#imageUpload").change(function () {
  preveSelect.value = "";
  readURL(this);
});



const preveSelect = document.getElementById("prev-select");
preveSelect.value = false;

function selectPreviusImage(img) {
  const toDataURL = (url) =>
    fetch(url)
      .then((response) => response.blob())
      .then(
        (blob) =>
          new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onloadend = () => resolve(reader.result);
            reader.onerror = reject;
            reader.readAsDataURL(blob);
          })
      );

  // Usage:
  let data = null;
  toDataURL(img).then((dataUrl) => {
    data = dataUrl;
    preveSelect.value = data;
    $("#imagePreview").css("background-image", "url(" + data + ")");
    $("#imagePreview").hide();
    $("#imagePreview").fadeIn(650);
  });
}



const prevImageContainer = document.querySelector(".images-wrapper");

previousUsedImages.forEach((img) => {
  const imgDiv = document.createElement("div");
  imgDiv.classList = "prev-img";
  imgDiv.innerHTML = `
    <img loading="lazy" onclick="selectPreviusImage(this.src);" class="image" src="../public/images/${img.path}">
  `;
  prevImageContainer.appendChild(imgDiv);
});

const imageSearch = document.getElementById("image-search");

function filterData(query) {
  return previousUsedImages.filter((filtered) => {
    return filtered.alt.toLowerCase().includes(query.toLowerCase());
  });
}

function displayResults(filteredData) {
  tagsContainer.innerHTML = "";
  filteredData.forEach((filtered) => {
    const imgDiv = document.createElement("div");
    imgDiv.classList = "prev-img";
    imgDiv.innerHTML = `
    <img loading="lazy" onclick="selectPreviusImage(this.src);" class="image" src="../public/images/${filtered.path}">
  `;
    prevImageContainer.appendChild(imgDiv);
  });
}

imageSearch.addEventListener("input", function () {
  if (imageSearch.value.length >= 2) {
    prevImageContainer.innerHTML = "";
    const query = this.value.trim();
    const filteredData = filterData(query);
    displayResults(filteredData);
  } else if (tagsFilterInput.value.length < 1) {
    prevImageContainer.innerHTML = "";
    previousUsedImages.forEach((img) => {
      const imgDiv = document.createElement("div");
      imgDiv.classList = "prev-img";
      imgDiv.innerHTML = `
        <img loading="lazy" onclick="selectPreviusImage(this.src);" class="image" src="../public/images/${img.path}">
      `;
      prevImageContainer.appendChild(imgDiv);
    });
  }
});
