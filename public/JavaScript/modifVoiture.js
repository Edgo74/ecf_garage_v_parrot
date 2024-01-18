
let titre = document.querySelector("#Titre");
let year = document.querySelector("#year");
let carburant = document.querySelector("#carburant");
let kilometre = document.querySelector("#kilometre");
let immatriculation = document.querySelector("#immatriculation");
let type = document.querySelector("#type");
let date = document.querySelector("#date");
let price = document.querySelector("#price");
let file = document.querySelector("input[type=file]");

function updateButtonsState() {
    if (
        titre.value == "" ||
        year.value == "" ||
        carburant.value == "" ||
        kilometre.value == "" ||
        immatriculation.value == "" ||
        type.value == "" ||
        date.value == "" ||
        price.value == "" ||
        file.value == ""
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
            confirm('voulez-vous vraiment supprimer cette voiture ? ');
        });
    }
}


updateButtonsState()
// Add event listeners to update button state on change change
titre.addEventListener("change", updateButtonsState);
year.addEventListener("change", updateButtonsState);
carburant.addEventListener("change", updateButtonsState);
kilometre.addEventListener("change", updateButtonsState);
immatriculation.addEventListener("change", updateButtonsState);
type.addEventListener("change",updateButtonsState);
date.addEventListener("change", updateButtonsState);
price.addEventListener("change",updateButtonsState);
file.addEventListener("change", updateButtonsState);
