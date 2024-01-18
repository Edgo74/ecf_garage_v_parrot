
let titre = document.querySelector("#Titre");
let description = document.querySelector("#description");


function updateButtonsState() {
    if (
        titre.value == "" ||
        description.value == "" 
    ) {
        document.querySelector("#validateButton").disabled = true;
        document.querySelector("#deleteButton").classList.add("btn-disabled");
        document.querySelector("#deleteButton").addEventListener("click", function (event) {
            event.preventDefault();
        });
    } else {
        document.querySelector("#validateButton").disabled = false;
        document.querySelector("#deleteButton").classList.remove("btn-disabled");
        document.querySelector("#deleteButton").addEventListener("click", function (event) {
            confirm('voulez-vous vraiment supprimer ce service ? ');
        });
    }
}
updateButtonsState();

// Add event listeners to update button state on input change
titre.addEventListener("input", updateButtonsState);
description.addEventListener("input", updateButtonsState);