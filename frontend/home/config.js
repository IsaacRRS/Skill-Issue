let sidebar = document.querySelector(".sidebar");
let fechar = document.querySelector("#botao");

fechar.addEventListener("click", () => {
    sidebar.classList.toggle("open");
    trocarIcone();
})