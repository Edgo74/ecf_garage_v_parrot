
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
    } else {
        document.querySelector("#validateButton").disabled = false;
    }
}


updateButtonsState()
titre.addEventListener("input", updateButtonsState);
year.addEventListener("input", updateButtonsState);
carburant.addEventListener("input", updateButtonsState);
kilometre.addEventListener("input", updateButtonsState);
immatriculation.addEventListener("input", updateButtonsState);
type.addEventListener("input", updateButtonsState);
date.addEventListener("input", updateButtonsState);
price.addEventListener("input", updateButtonsState);
file.addEventListener("input", updateButtonsState);



