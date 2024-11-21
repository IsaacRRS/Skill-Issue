const lista = document.querySelectorAll('.lista');

function ativado (){
    lista.forEach((item) =>
    item.classList.remove('ativa'));
    this.classList.add('ativa');
}

lista.forEach((item) => 
item.addEventListener('click', ativado));