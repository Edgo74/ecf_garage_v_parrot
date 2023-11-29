
var btn = document.getElementById('Voirplus');
var services = document.querySelectorAll('.d-none');
var allServicesVisible = false;

btn.addEventListener('click', function() {
  if (!allServicesVisible) {
      services.forEach(function(service) {
          service.classList.remove('d-none');
      });
      btn.textContent = 'Voir moins';
      allServicesVisible = true;
  } else {
      services.forEach(function(service) {
          service.classList.add('d-none');
      });
      btn.textContent = 'Voir plus';
      allServicesVisible = false;
  }
});

