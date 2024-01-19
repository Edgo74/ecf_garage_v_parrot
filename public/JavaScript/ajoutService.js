
let titre = document.querySelector("#Titre");
let description = document.querySelector("#description");

function updateButtonsState() {
  if (
      titre.value == "" ||
      description.value == "" 
  ) {
      document.querySelector("#validateButton").disabled = true;
  } else {
      document.querySelector("#validateButton").disabled = false;
  }
}


updateButtonsState();
titre.addEventListener("input", updateButtonsState);
description.addEventListener("input", updateButtonsState);