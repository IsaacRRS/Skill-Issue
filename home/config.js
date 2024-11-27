// TAparecer botão - clique

const viewAllProductsLink = document.querySelector('.register-button');
        const buttonsContainer = document.querySelector('.buttons-container');
      
        viewAllProductsLink.addEventListener('click', () => {
          buttonsContainer.classList.toggle('active');
        });