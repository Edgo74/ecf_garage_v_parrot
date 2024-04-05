document.getElementById('voir-plus-moins').addEventListener('click', function() {
    let voirPlusMoins = document.getElementById('voir-plus-moins');
    let servicesRestants = document.querySelectorAll('.hidden-service');
    servicesRestants.forEach(function(service) {
        service.classList.toggle('hidden');
    });
    console.log('Current text content:', voirPlusMoins.textContent);
    if (voirPlusMoins.textContent.trim() === "Voir plus") {
        voirPlusMoins.textContent = "Voir moins";
    } else if (voirPlusMoins.textContent.trim() === "Voir moins") {
        voirPlusMoins.textContent = "Voir plus";
    }
});

AOS.init({
    delay: 200,
    duration: 1500,
    once: false,
    mirror: false
});

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) {
        slideIndex = 1
    }
    if (n < 1) {
        slideIndex = slides.length
    }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
}