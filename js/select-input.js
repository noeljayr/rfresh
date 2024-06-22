const selectorTrigger = document.querySelector(".selector-trigger");
const selectedT = document.querySelector(".select .selected");
const selector = document.querySelector(".option-selector .select");
const options = document.querySelectorAll(".options span");




selectorTrigger.addEventListener("click", (e) => {
  selectorTrigger.classList.toggle("selector-trigger-active");
  selector.classList.toggle("select-active");

  e.stopPropagation();
});

selectedT.addEventListener("click", () => {
  selectorTrigger.classList.toggle("selector-trigger-active");
  selector.classList.toggle("select-active");
});

window.addEventListener("click", (e) => {
  if (
    e.target != selectorTrigger &&
    e.target != selectedT &&
    e.target != selector
  ) {
    selectorTrigger.classList.remove("selector-trigger-active");
    selector.classList.remove("select-active");
  }
});

options.forEach((o) => {
  o.addEventListener("click", () => {
    options.forEach((op) => {
      op.classList.remove("selected-option");
    });
    o.classList.add("selected-option");

    formSelect.value = o.textContent.trim();
    categoryInputForm.value = o.textContent.trim();
    var event = new Event("change");

    // Dispatch the event on the element
    formSelect.dispatchEvent(event);
    categoryInputForm.dispatchEvent(event);
    selectedT.textContent = o.textContent.trim();


    if(o.classList.contains("music-option")){
      postSettings.classList.add("post-settings-plaforms")
    }else{
      postSettings.classList.remove("post-settings-plaforms")
    }
    
  });
});

// formSelect.addEventListener("change", () => {
//   console.log(formSelect.value);
// });
