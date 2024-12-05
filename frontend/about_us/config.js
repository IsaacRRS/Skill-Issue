// Selecione os elementos
const registerButton = document.getElementById('register-button');
const registerButtonFilms = document.getElementById('register-button-films');
const registerButtonSeries = document.getElementById('register-button-series');

let sidebar = document.querySelector(".sidebar");
let fechar = document.querySelector("#botao");



fechar.addEventListener("click", () => {
    sidebar.classList.toggle("open");
    trocarIcone();
})