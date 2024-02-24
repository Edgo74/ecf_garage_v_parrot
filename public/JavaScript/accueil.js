let showFooter = document.querySelector('#footer-show');
let footer = document.querySelector('footer');
const modal = document.getElementById('modal')
const modalCloseBtn = document.getElementById('modal-close-btn')
const consentForm = document.getElementById('consent-form')
const modalText = document.getElementById('modal-text')
const declineBtn = document.getElementById('decline-btn')
const modalChoiceBtns = document.getElementById('modal-choice-btns')
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

if(modal){
    setTimeout(function(){
        modal.style.display = 'inline'
    }, 1500)
    
    modalCloseBtn.addEventListener('click', function(){
        modal.style.display = 'none'
    }) 
    
    declineBtn.addEventListener('mouseenter', function(){
        modalChoiceBtns.classList.toggle('modal-btns-reverse')
    }) 
    declineBtn.addEventListener('touchstart', function(){
        modalChoiceBtns.classList.toggle('modal-btns-reverse')
    }) 

    modalCloseBtn.addEventListener('touchstart', function(){
        modalCloseBtn.style.color = 'red';
        modalCloseBtn.style.cursor = 'pointer';
    })
    
    consentForm.addEventListener('submit', function(e){
        e.preventDefault()
        
        const consentFormData = new FormData(consentForm)
        const fullName = consentFormData.get('fullName')
        
        modalText.innerHTML = `
        <div class="modal-inner-loading">
            <img src="public/Assets/images/loading.svg" class="loading">
            <p id="upload-text">Uploading your data to the dark web...</p>
        </div>` 
        
        setTimeout(function(){
            document.getElementById('upload-text').innerText = `
            Making the sale...`
        }, 1500)
        
        
        setTimeout(function(){
            document.getElementById('modal-inner').innerHTML = `
            <h2 class = "h2modal">Thanks <span class="modal-display-name">${fullName}</span>, you sucker! </h2>
            <p class = "modal-text-p">We just sold the rights to your eternal soul.</p>
            <div class="idiot-gif">
                <img src="public/Assets/images/pirate.gif">
            </div>
        `
        modalCloseBtn.disabled = false
        }, 3000)
      
    }) 
    
}

