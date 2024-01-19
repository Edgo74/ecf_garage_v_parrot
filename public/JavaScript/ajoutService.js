
let titre = document.querySelector("#Titre");
let description = document.querySelector("#description");

function updateButtonsState() {
  if (
      titre.value == "" ||
      description.value == "" 
  ) {
      document.querySelector("#validateButton").disabled = true;
      document.querySelector("#validateButton").classList.add("btn-disabled");
  } else {
      document.querySelector("#validateButton").disabled = false;
      document.querySelector("#validateButton").classList.remove("btn-disabled");
  }
}


updateButtonsState();
titre.addEventListener("input", updateButtonsState);
description.addEventListener("input", updateButtonsState);