window.addEventListener("DOMContentLoaded", () => {
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
})

updateButtonsState();

// Add event listeners to update button state on input change
titre.addEventListener("input", updateButtonsState);
year.addEventListener("input", updateButtonsState);
carburant.addEventListener("input", updateButtonsState);
kilometre.addEventListener("input", updateButtonsState);
immatriculation.addEventListener("input", updateButtonsState);
type.addEventListener("input", updateButtonsState);
date.addEventListener("input", updateButtonsState);
price.addEventListener("input", updateButtonsState);
file.addEventListener("input", updateButtonsState);



var baseUrl = "https://app-ecf-garage-3d639a49eac3.herokuapp.com/";

$(document).ready(function() {
  $('select[name="voitureId"]').change(function() {
    var voitureId = $(this).val();


    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
   });

    $.ajax({
      url: baseUrl + 'Voitures/modifier_supprimer_voiture',
      method: 'post',
      data: {
        csrf_token: $('meta[name="csrf-token"]').attr('content'),
        voitureId: voitureId
      },
      success: function(result) {
          var voitureData = JSON.parse(result);
          if (voitureData.error) {
              alert(voitureData.error);
          } else {
              $('input[name="Titre"]').val(voitureData.titre);
              $('input[name="year"]').val(voitureData.year);
              $('input[name="carburant"]').val(voitureData.carburant);
              $('input[name="kilometre"]').val(voitureData.kilometre);
              $('input[name="price"]').val(voitureData.price);
              $('input[name="identifiant"]').val(voitureData.id);
              $('input[name="immatriculation"]').val(voitureData.immatriculation);
              $('input[name="type"]').val(voitureData.type);
              $('input[name="date"]').val(voitureData.date);
              $('#deleteButton').attr('href', baseUrl + 'Voitures/supprimerVoiture/' + voitureData.id);
              $('#image').attr('src', baseUrl + 'public/Assets/images/' + voitureData.image);
          }
      }
    });
  });
});




