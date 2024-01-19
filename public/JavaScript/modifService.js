
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
              confirm('voulez-vous vraiment supprimer ce service ? ');
          });
      }
  }


  updateButtonsState();
  document.querySelector("#select").addEventListener("change", ()=>{
    document.querySelector("#validateButton").disabled = false;
    document.querySelector("#deleteButton").classList.remove("btn-disabled");
    document.querySelector("#deleteButton").addEventListener("click", function (event) {
        confirm('voulez-vous vraiment supprimer ce service ? ');
    });
});