
var baseUrl ="https://lit-caverns-26875-c710f85b7145.herokuapp.com/";

$(document).ready(function() {
    $('select[name="avisId"]').change(function() {
      var avisId = $(this).val();

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
     });
  
      $.ajax({
        url: baseUrl +'Avis/valider_supprimer_avis',
        method: 'post',
        data: {
          csrf_token: $('meta[name="csrf-token"]').attr('content'),
          avisId: avisId
        },
        success: function(result) {
            var avisData = JSON.parse(result);
            if (avisData.error) {
                alert(avisData.error);
            } else {
                $('input[name="nom"]').val(avisData.nom);
                $('input[name="note"]').val(avisData.note);
                $('textarea[name="comment"]').val(avisData.commentaire);
                $('#validerButton').attr('href', baseUrl + 'Avis/validerAvis/' + avisData.id);
                $('#deleteButton').attr('href', baseUrl + 'Avis/supprimerAvis/' + avisData.id);
            }
        }
      });
    });
 });