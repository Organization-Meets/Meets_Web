{{-- filepath: /workspaces/Fatec_Meets_Web/FatecMeets/resources/views/componentes/footer.blade.php --}}
  <!-- Menu hamburger toggle -->
  <script>
    const menuToggle = document.querySelector('.menu-toggle');
    const navbarLinks = document.querySelector('.navbar-links');
    menuToggle?.addEventListener('click', () => {
      navbarLinks.classList.toggle('active');
    });
  </script>
  <!-- Define o nome do controller via PHP -->
  <script>
      var controllerName = "{{ $nomeArquivo }}"; // ex: "create"
  </script>

  <!-- Carrega o web.js -->
  <script src="/js/web.js"></script>


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