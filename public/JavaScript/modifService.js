
    let titre = document.querySelector("#Titre");
    let description = document.querySelector("#description");
    let select = document.querySelector("#select");

    function updateButtonsState() {
      if (
          titre.value == "" ||
          description.value == "" 
      ) {
          document.querySelector("#validateButton").disabled = true;
          document.querySelector("#deleteButton").classList.add("btn-disabled");
          document.querySelector("#deleteButton").addEventListener("click", function (event) {
              event.preventDefault();
          });
      } else {
          document.querySelector("#validateButton").disabled = false;
          document.querySelector("#deleteButton").classList.remove("btn-disabled");
          document.querySelector("#deleteButton").addEventListener("click", function (event) {
              
            event.preventDefault();

            let confirmation = confirm('Voulez-vous vraiment supprimer ce service ? ');
            
            if (confirmation) {
                window.location.href = document.getElementById("deleteButton").getAttribute("href");
            }
          });
      }
  }


  updateButtonsState();
  document.querySelector("#select").addEventListener("change", ()=>{
    document.querySelector("#validateButton").disabled = false;
    document.querySelector("#deleteButton").classList.remove("btn-disabled");
    document.querySelector("#deleteButton").addEventListener("click", function (event) {

        event.preventDefault();

        let confirmation = confirm('Voulez-vous vraiment supprimer ce service ? ');
        
        if (confirmation) {
            window.location.href = document.getElementById("deleteButton").getAttribute("href");
        }
    });
});