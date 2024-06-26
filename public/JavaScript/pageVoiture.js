
var baseUrl = "https://app-ecf-garage-3d639a49eac3.herokuapp.com/";

document.addEventListener("DOMContentLoaded", function() {
  var voitureSelect = document.querySelector('select[name="voitureId"]');
  voitureSelect.addEventListener('change', function() {
    var voitureId = this.value;
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    var myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/x-www-form-urlencoded");
    myHeaders.append("X-CSRF-TOKEN", csrfToken);

    var requestOptions = {
      method: 'POST',
      headers: myHeaders,
      body: new URLSearchParams({
        csrf_token: csrfToken,
        voitureId: voitureId
      }).toString(),
      redirect: 'follow'
    };

    fetch(baseUrl + 'Voitures/modifier_supprimer_voiture', requestOptions)
      .then(response => response.text())
      .then(result => {
        var voitureData = JSON.parse(result);
        if (voitureData.error) {
          alert(voitureData.error);
        } else {
          document.querySelector('input[name="Titre"]').value = voitureData.titre;
          document.querySelector('input[name="year"]').value = voitureData.year;
          document.querySelector('input[name="carburant"]').value = voitureData.carburant;
          document.querySelector('input[name="kilometre"]').value = voitureData.kilometre;
          document.querySelector('input[name="price"]').value = voitureData.price;
          document.querySelector('input[name="identifiant"]').value = voitureData.voiture_id;
          document.querySelector('input[name="immatriculation"]').value = voitureData.immatriculation;
          document.querySelector('input[name="type"]').value = voitureData.type;
          const dateParts = voitureData.date.split('-');
          const formattedDate = dateParts[0] + '-' + dateParts[1] + '-' + dateParts[2];
          document.querySelector('input[name="date"]').value = formattedDate;
          let garantieCheckbox = document.querySelector('input[name="garantie"]');
          voitureData.garantie == 1 ? garantieCheckbox.checked = true : garantieCheckbox.checked = false;
          document.getElementById('deleteButton').setAttribute('href', baseUrl + 'Voitures/supprimerVoiture/' + voitureData.voiture_id);
          document.getElementById('image').src = baseUrl + 'public/Assets/images/'+ voitureData.image;
        }
      })
      .catch(error => console.log('error', error));
  });
});











