
let note = document.querySelector("#note");
let nom = document.querySelector("#nom");
let comment = document.querySelector("#comment");

function updateButtonsState() {
  if (
      titre.value == "" ||
      description.value == "" ||
      note.value == "" 
  ) {
      document.querySelector("#validateButton").disabled = true;
      document.querySelector("#validateButton").classList.add("btn-disabled");
  } else {
      document.querySelector("#validateButton").disabled = false;
      document.querySelector("#validateButton").classList.remove("btn-disabled");
  }
}


updateButtonsState();
note.addEventListener("input", updateButtonsState);
nom.addEventListener("input", updateButtonsState);
comment.addEventListener("input", updateButtonsState);