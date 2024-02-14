
var baseUrl = "https://app-ecf-garage-3d639a49eac3.herokuapp.com/";


document.addEventListener("DOMContentLoaded",function(){
    filter_data();
    function filter_data() {
        document.querySelector('.filter_data').innerHTML = '<div id="loading"></div>';
       let action = 'filtre_voiture';
       let minimum_price = document.querySelector('#minimum_price').value;
       let maximum_price = document.querySelector('#maximum_price').value;
       let minimum_kilometre = document.querySelector('#minimum_kilometre').value;
       let maximum_kilometre = document.querySelector('#maximum_kilometre').value;
       let minimum_year = document.querySelector('#minimum_year').value;
       let maximum_year = document.querySelector('#maximum_year').value;

       let formData = new FormData();
        formData.append('csrf_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        formData.append('action', action);
        formData.append('minimum_price', minimum_price);
        formData.append('maximum_price', maximum_price);
        formData.append('minimum_kilometre', minimum_kilometre);
        formData.append('maximum_kilometre', maximum_kilometre);
        formData.append('minimum_year', minimum_year);
        formData.append('maximum_year', maximum_year);

        fetch(baseUrl + "Voitures/filtre_voiture", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log(data)
            document.querySelector('.filter_data').innerHTML = data;
        })
        .catch(error => {
            console.error('Une erreur est survenue');
        });
    }

    let minPrice = document.getElementById('minimum_price');
    let maxPrice = document.getElementById('maximum_price');
    let minKilometre = document.getElementById('minimum_kilometre');
    let maxKilometre = document.getElementById('maximum_kilometre');
    let minYear= document.getElementById('minimum_year');
    let maxYear = document.getElementById('maximum_year');

    minPrice.addEventListener('input', filter_data);
    maxPrice.addEventListener('input', filter_data);
    minKilometre.addEventListener('input', filter_data);
    maxKilometre.addEventListener('input', filter_data);
    minYear.addEventListener('input', filter_data);
    maxYear.addEventListener('input', filter_data);
    
});














