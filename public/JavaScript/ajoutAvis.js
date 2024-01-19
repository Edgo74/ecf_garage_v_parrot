
let note = document.querySelector("#note");
let nom = document.querySelector("#nom");
let comment = document.querySelector("#comment");

function updateButtonsState() {
  if (
      note.value == "" ||
      nom.value == "" ||
      comment.value == "" 
  ) {
      document.querySelector("#validateButton").disabled = true;
  } else {
      document.querySelector("#validateButton").disabled = false;
  }
}


updateButtonsState();
note.addEventListener("input", updateButtonsState);
nom.addEventListener("input", updateButtonsState);
comment.addEventListener("input", updateButtonsState);