
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
 