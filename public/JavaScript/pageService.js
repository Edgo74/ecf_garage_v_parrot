var baseUrl = "https://app-ecf-garage-3d639a49eac3.herokuapp.com/";

 document.addEventListener("DOMContentLoaded", function() {
     document.querySelector('select[name="serviceId"]').addEventListener("change", function() {
         var serviceId = this.value;
         var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
         
         fetch(baseUrl + 'Services/modifier_supprimer_service', {
             method: 'POST',
             headers: {
                 'Content-Type': 'application/json',
                 'X-CSRF-TOKEN': csrfToken
             },
             body: JSON.stringify({
                 csrf_token: csrfToken,
                 serviceId: serviceId
             })
         })
         .then(response => {
             if (!response.ok) {
                 throw new Error('Network response was not ok');
             }
             return response.json();
         })
         .then(serviceData => {
             if (serviceData.error) {
                 alert(serviceData.error);
             } else {
                 document.querySelector('input[name="Titre"]').value = serviceData.titre;
                 document.querySelector('textarea[name="description"]').value = serviceData.description;
                 document.querySelector('input[name="identifiant"]').value = serviceData.id;
                 document.getElementById('deleteButton').setAttribute('href', baseUrl + 'Services/supprimerService/' + serviceData.id);
             }
         })
         .catch(error => {
             console.error('There was a problem with the fetch operation:', error);
         });
     });
 });
 