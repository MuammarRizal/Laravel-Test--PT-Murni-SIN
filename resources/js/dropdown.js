const button = document.getElementById("dropdownButton");
const menu = document.getElementById("dropdownMenu");

button.addEventListener("click", () => {
    menu.classList.toggle("hidden");
});

function filterData(type) {
    // Ganti dengan logic pemanggilan API/filter data kamu
    console.log("Filtering by:", type);
    menu.classList.add("hidden"); // Sembunyikan dropdown setelah memilih
}
