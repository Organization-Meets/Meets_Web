<?php
// components/footer.php
?>
  <!-- Menu hamburger toggle -->
  <script>
    const menuToggle = document.querySelector('.menu-toggle');
    const navbarLinks = document.querySelector('.navbar-links');
    menuToggle?.addEventListener('click', () => {
      navbarLinks.classList.toggle('active');
    });
  </script>

  <!-- Outros scripts comuns (dark mode, Vlibras…) -->
  <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
  <script>
    // Dark Mode
    const themeSwitch = document.getElementById('theme-switch');
    if (localStorage.getItem('theme') === 'dark') {
      document.body.classList.add('dark-mode');
      themeSwitch.checked = true;
    }
    themeSwitch.addEventListener('change', () => {
      document.body.classList.toggle('dark-mode', themeSwitch.checked);
      localStorage.setItem('theme', themeSwitch.checked ? 'dark' : 'light');
    });

    // Vlibras
    new window.VLibras.Widget('https://vlibras.gov.br/app');
  </script>
</body>
</html>
