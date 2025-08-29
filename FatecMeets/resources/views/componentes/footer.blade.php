  <!-- Menu hamburger toggle -->
   <footer class="usuario-footer" style="margin-top: 50px;">
        <div class="social">
            <a href="#"><img src="imagens/instagram.png" alt="Instagram"></a>
            <a href="#"><img src="imagens/whatsapp.png" alt="WhatsApp"></a>
            <a href="#"><img src="imagens/linkedin.png" alt="LinkedIn"></a>
        </div>
        <div class="links">
            <a href="#">Política de Privacidade</a> |
            <a href="#">Contato</a> |
            <a href="#">Termos de uso</a>
        </div>
        <p>&copy; <?php echo date('Y'); ?> - Fatec Meets LTDA - Todos os direitos reservados.</p>
    </footer>
  <script src="/js/emailValido.js"></script>
  <script src="/js/senhaSegura.js"></script>
  <script src="/js/confirmarSenha.js"></script>
  <script src="/js/overlayComponentes.js"></script>
  <script src="/js/controllers/componentes/navbarController.js"></script>
  <script src="/js/controllers/componentes/loginController.js"></script>
  <script src="/js/controllers/create/usuarioController.js"></script>
  <script src="/js/controllers/edit/usuarioController.js"></script>
  <script>
    const menuToggle = document.querySelector('.menu-toggle');
    const navbarLinks = document.querySelector('.navbar-links');
    menuToggle?.addEventListener('click', () => {
      navbarLinks.classList.toggle('active');
    });
  </script>
  <!-- Define o nome do controller via PHP -->


  <!-- Outros scripts comuns (dark mode, Vlibras…) -->
  <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
  <script>
    // Dark Mode
    const themeSwitch = document.getElementById('theme-switch');
    if (themeSwitch && localStorage.getItem('theme') === 'dark') {
      document.body.classList.add('dark-mode');
      themeSwitch.checked = true;
    }
    if (themeSwitch) {
      themeSwitch.addEventListener('change', () => {
        document.body.classList.toggle('dark-mode', themeSwitch.checked);
        localStorage.setItem('theme', themeSwitch.checked ? 'dark' : 'light');
      });
    }

    // Vlibras
    if (window.VLibras) {
      new window.VLibras.Widget('https://vlibras.gov.br/app');
    }
  </script>
</body>
</html>