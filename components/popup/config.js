let saltoS = document.getElementById("salto"); // puxar a variável de id 'salto'

function saltar () { 
    saltoS.classList.add("animacao");
}                                                           // adicionar ou remover css

function voltar () {
    saltoS.classList.remove("animacao"); 
}