const container = document.querySelector(".admin-container");

admins.forEach((ad) => {
  const adminContainer = document.createElement("div");
  adminContainer.className = "admin w-full overflow-hidden grid p-4 gap-4";
  adminContainer.id = ad.ID;

  const profileSpan = document.createElement("span");
  profileSpan.className = "profile flex items-center justify-center";
  const profileImage = document.createElement("img");
  profileImage.src = "../public/svg/tabler-icon-user.svg";
  profileImage.alt = ad.name;
  profileSpan.appendChild(profileImage);

  const infoSpan = document.createElement("span");
  infoSpan.className = "info grid gap-4";
  const nameSpan = document.createElement("span");
  nameSpan.className = "name font-bold";
  nameSpan.textContent = ad.name;
  const emailSpan = document.createElement("span");
  emailSpan.className = "email";
  emailSpan.textContent = ad.email;
  const statusInfoSpan = document.createElement("span");
  statusInfoSpan.className = "status-info";
  const statusSpan = document.createElement("span");
  statusSpan.className = ad.active
    ? "status px-2 py-1 admin-active font-bold"
    : "status px-2 py-1 admin-diactived font-bold";
  statusSpan.textContent = ad.active ? "Active" : "Deactived";
  statusInfoSpan.appendChild(statusSpan);
  const postsSpan = document.createElement("span");
  postsSpan.className = "posts opacity-50 max-sm:hidden";
  postsSpan.textContent = ad.posts + " Posts";
  infoSpan.appendChild(nameSpan);
  infoSpan.appendChild(emailSpan);
  infoSpan.appendChild(statusInfoSpan);
  infoSpan.appendChild(postsSpan);

  const actionSpan = document.createElement("span");
  actionSpan.className = "action";
  const actionSpanText = document.createElement("span");
  actionSpanText.className = ad.active
    ? "deactivate deactivate-admin text-xs cta"
    : "activate activate-admin text-xs cta";
  actionSpanText.textContent = ad.active ? "Deactivate" : "Activate";
  actionSpan.appendChild(actionSpanText);

  adminContainer.appendChild(profileSpan);
  adminContainer.appendChild(infoSpan);
  adminContainer.appendChild(actionSpan);

  container.appendChild(adminContainer);
});

const popupOverlay = document.querySelector(".popup-overlay");
const disableFormPopup = document.getElementById("diactivate-admin");
const activatePopup = document.getElementById("activate-admin");
const diactivateName = disableFormPopup.querySelector(".admin-name");
const activateName = activatePopup.querySelector(".admin-name");
const adminIdInput = document.getElementById("admin-id");
const activeAdminIdInput = document.getElementById("admin-activate-id");

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

window.addEventListener("click", (e) => {
  if (e.target.classList.contains("deactivate-admin")) {
    showPopUp(disableFormPopup);
    adminIdInput.value = e.target.parentElement.parentElement.id;
    const name =
      e.target.parentElement.parentElement.querySelector(".name").textContent;
    diactivateName.textContent = name;
  }
  if(e.target.classList.contains("activate-admin")){
    showPopUp(activatePopup);
    activeAdminIdInput.value = e.target.parentElement.parentElement.id;
    const name =
      e.target.parentElement.parentElement.querySelector(".name").textContent;
      activateName.textContent = name;
  }
});

const addAdminBtn = document.querySelector(".add-admin-btn");
const addAdminForm = document.querySelector(".add-admin-form");

addAdminBtn.addEventListener("click", () => {
  showPopUp(addAdminForm);
});

popupOverlay.addEventListener("click", () => {
  hidePopUp(addAdminForm);
  hidePopUp(disableFormPopup);
  hidePopUp(activatePopup);
});

window.addEventListener("keydown", (e) => {
  if (e.key == "Escape") {
    hidePopUp(addAdminForm);
    hidePopUp(disableFormPopup);
    hidePopUp(activatePopup);
  }
});
