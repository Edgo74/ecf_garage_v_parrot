var baseUrl = "http://localhost/TEST/";

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