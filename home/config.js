// Selecione os elementos
const registerButton = document.getElementById('register-button');
const registerButtonFilms = document.getElementById('register-button-films');
const registerButtonSeries = document.getElementById('register-button-series');

// Adicione um evento de clique ao botão register-button
registerButton.addEventListener('click', () => {
  // Altere a propriedade visibility dos botões register-button-films e register-button-series
  registerButtonFilms.style.visibility = 'visible';
  registerButtonSeries.style.visibility = 'visible';
});