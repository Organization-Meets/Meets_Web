// script.js - JavaScript para funcionalidades do site
// Implementação do menu mobile e outras funcionalidades

/**
 * Função para alternar a visibilidade do menu mobile
 * Esta função é chamada quando o usuário clica no ícone do menu hambúrguer
 */
document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.querySelector('.menu-toggle');
    const navbarLinks = document.querySelector('.navbar-links');

    if (menuToggle && navbarLinks) {
        menuToggle.addEventListener('click', () => {
            navbarLinks.classList.toggle('active');
        });
    }
});



document.addEventListener('DOMContentLoaded', function() {
    // Seleciona o botão de menu e o container de links
    const menuToggle = document.querySelector('.menu-toggle');
    const navbarLinks = document.querySelector('.navbar-links');
    
    // Adiciona evento de clique ao botão de menu
    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            // Alterna a classe 'active' para mostrar/esconder o menu
            navbarLinks.classList.toggle('active');
        });
    }
    
    // Marca o item de menu atual como ativo
    const currentPage = window.location.pathname;
    const navItems = document.querySelectorAll('.navbar-item');
    
    navItems.forEach(item => {
        const href = item.getAttribute('href');
        if (href && currentPage.includes(href.split('/').pop())) {
            item.classList.add('active');
        }
    });
});

/**
 * Função para validar formulários
 * @param {HTMLFormElement} form - O formulário a ser validado
 * @returns {boolean} - Retorna true se o formulário for válido
 */
function validateForm(form) {
    let isValid = true;
    const inputs = form.querySelectorAll('input[required], textarea[required]');
    
    inputs.forEach(input => {
        if (!input.value.trim()) {
            isValid = false;
            // Adiciona classe de erro ao input
            input.classList.add('error');
            // Remove a classe de erro quando o usuário começar a digitar
            input.addEventListener('input', function() {
                this.classList.remove('error');
            });
        }
    });
    
    return isValid;
}

// Adiciona estilos CSS para inputs com erro
if (!document.getElementById('error-styles')) {
    const style = document.createElement('style');
    style.id = 'error-styles';
    style.textContent = `
        input.error, textarea.error {
            border-color: var(--btn-color) !important;
            background-color: rgba(255, 107, 107, 0.05);
        }
    `;
    document.head.appendChild(style);
}
