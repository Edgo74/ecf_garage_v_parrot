let showFooter = document.querySelector('#footer-show');
let footer = document.querySelector('footer');
const services = document.querySelectorAll('.titre-service');

showFooter.addEventListener('click', function() {
    footer.classList.toggle('d-block');
    if(footer.classList.contains('d-block')) {
        showFooter.innerHTML = `<p id="footer-show" class="text-center"><i class="fas fa-arrow-up"></i>Cacher les horaires</p>`
    }else{
        showFooter.innerHTML = `<p id="footer-show" class="text-center"><i class="fas fa-arrow-down"></i>Afficher les horaires</p>`
    }
});

services.forEach(service => {
    const unService = service.nextElementSibling;
    
    service.addEventListener("click", function(){
        unService.classList.toggle('d-block');
    });

});


