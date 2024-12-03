let sidebar = document.querySelector(".sidebar");
let fechar = document.querySelector("#botao");

// Adicione um evento de clique ao botão register-button
registerButton.addEventListener('click', () => {
  // Altere a propriedade visibility dos botões register-button-films e register-button-series
  registerButtonFilms.style.visibility = 'visible';
  registerButtonSeries.style.visibility = 'visible';
});

fechar.addEventListener("click", () => {
    sidebar.classList.toggle("open");
    trocarIcone();
})