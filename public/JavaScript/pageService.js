var baseUrl = "https://app-ecf-garage-3d639a49eac3.herokuapp.com/";

 document.addEventListener("DOMContentLoaded", function() {
     document.querySelector('select[name="serviceId"]').addEventListener("change", function() {
         var serviceId = this.value;
         var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
         
         fetch(baseUrl + 'Services/modifier_supprimer_service', {
             method: 'POST',
             headers: {
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
 



//  $(document).ready(function() {
//   $('select[name="serviceId"]').change(function() {
//     var serviceId = $(this).val();
    
//     $.ajaxSetup({
//       headers: {
//           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//       }
//    });
   
//     $.ajax({
//       url: baseUrl + 'Services/modifier_supprimer_service',
//       method: 'post',
//       data: {
//         csrf_token: $('meta[name="csrf-token"]').attr('content'),
//         serviceId: serviceId
//       },
//       success: function(result) {
//           var serviceData = JSON.parse(result);
//           if (serviceData.error) {
//               alert(serviceData.error);
//           } else {
//               $('input[name="Titre"]').val(serviceData.titre);
//               $('textarea[name="description"]').val(serviceData.description);
//               $('input[name="identifiant"]').val(serviceData.id);
//               $('#deleteButton').attr('href', baseUrl + 'Services/supprimerService/' + serviceData.id);
//           }
//       }
//     });
//   });
// });