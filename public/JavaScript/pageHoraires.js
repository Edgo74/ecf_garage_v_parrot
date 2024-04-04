var baseUrl = "https://app-ecf-garage-3d639a49eac3.herokuapp.com/";
let select = document.querySelector('select[name="statut"]');


document.addEventListener("DOMContentLoaded", function() {
  var jourSelect = document.querySelector('select[name="jours"]');
  jourSelect.addEventListener('change', function() {
    var jourId = this.value;
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    var myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/x-www-form-urlencoded");
    myHeaders.append("X-CSRF-TOKEN", csrfToken);

    var requestOptions = {
      method: 'POST',
      headers: myHeaders,
      body: new URLSearchParams({
        csrf_token: csrfToken,
        jourId: jourId
      }).toString(),
      redirect: 'follow'
    };

    fetch(baseUrl + 'Horaires/modifierLesHoraires', requestOptions)
      .then(response => response.text())
      .then(result => {
        var jourData = JSON.parse(result);
        if (jourData.error) {
          alert(jourData.error);
        } else {

            select.querySelectorAll('option').forEach(option => {
                if (option.value === jourData.est_ouvert) {
                    option.setAttribute('selected', 'selected');
                } else {
                    option.removeAttribute('selected');
                }
            })
          document.querySelector("input[name='horaire_id']").value = jourData.horaire_id;
          document.querySelector('input[name="debutAM"]').value = jourData.debut_heures_AM;
          document.querySelector('input[name="finAM"]').value =  jourData.fin_heures_AM;
          document.querySelector('input[name="debutPM"]').value = jourData.debut_heures_PM;
          document.querySelector('input[name="finPM"]').value = jourData.fin_heures_PM;
        }
      })
      .catch(error => console.log('error', error));
  });
});

select.addEventListener("change", function() {
    var selectedOptionIndex = this.selectedIndex; // Index of the selected option
    var options = this.options; // All options in the select element
    
    // Loop through options and remove the selected attribute from all options
    for (var i = 0; i < options.length; i++) {
      options[i].removeAttribute("selected");
    }
    
    // Set the selected attribute on the selected option
    options[selectedOptionIndex].setAttribute("selected", "selected");
  });
  