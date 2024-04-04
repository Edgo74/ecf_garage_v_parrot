let cross = document.querySelector("#cross");

if (cross) {
    cross.addEventListener("click", function () {
        document.querySelector("#alert-container").style.display = "none";
    })
}
