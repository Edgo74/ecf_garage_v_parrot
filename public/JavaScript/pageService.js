console.log("pageService.js chargé");

if (document.readyState === "complete" || document.readyState === "interactive") {
  console.log("pageService.js : DOM ready");
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
  
}


var baseUrl = "https://app-ecf-garage-3d639a49eac3.herokuapp.com/";

$(document).ready(function() {
    $('select[name="serviceId"]').change(function() {
      var serviceId = $(this).val();
      
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
     });
     
      $.ajax({
        url: baseUrl + 'Services/modifier_supprimer_service',
        method: 'post',
        data: {
          csrf_token: $('meta[name="csrf-token"]').attr('content'),
          serviceId: serviceId
        },
        success: function(result) {
            var serviceData = JSON.parse(result);
            if (serviceData.error) {
                alert(serviceData.error);
            } else {
                $('input[name="Titre"]').val(serviceData.titre);
                $('textarea[name="description"]').val(serviceData.description);
                $('input[name="identifiant"]').val(serviceData.id);
                $('#deleteButton').attr('href', baseUrl + 'Services/supprimerService/' + serviceData.id);
            }
        }
      });
    });
 });
 