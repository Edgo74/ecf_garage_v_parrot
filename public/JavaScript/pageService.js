
var baseUrl = "https://app-ecf-garage-3d639a49eac3.herokuapp.com/";

document.addEventListener("DOMContentLoaded", function() {
  var serviceSelect = document.querySelector('select[name="serviceId"]');
  serviceSelect.addEventListener('change', function() {
    var serviceId = this.value;
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    var myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/x-www-form-urlencoded");
    myHeaders.append("X-CSRF-TOKEN", csrfToken);

    var requestOptions = {
      method: 'POST',
      headers: myHeaders,
      body: new URLSearchParams({
        csrf_token: csrfToken,
        serviceId: serviceId
      }).toString(),
      redirect: 'follow'
    };

    fetch(baseUrl + 'Services/modifier_supprimer_service', requestOptions)
      .then(response => response.text())
      .then(result => {
        var serviceData = JSON.parse(result);
        if (serviceData.error) {
          alert(serviceData.error);
        } else {
          document.querySelector('input[name="Titre"]').value = serviceData.titre;
          document.querySelector('textarea[name="description"]').value = serviceData.description;
          document.querySelector('input[name="identifiant"]').value = serviceData.id;
          document.getElementById('deleteButton').setAttribute('href', baseUrl + 'Services/supprimerService/' + serviceData.id);
        }
      })
      .catch(error => console.log('error', error));
  });
});











