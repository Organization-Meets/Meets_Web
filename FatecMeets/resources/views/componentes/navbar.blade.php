{{-- filepath: resources/views/componentes/navbar.blade.php --}}
<link rel="stylesheet" href="/css/navbar.css">

<nav class="navbar">
  <div class="navbar-container">
    <a href="/" class="navbar-logo">Fatec Meet</a>

    <div class="menu-toggle">
      <i class="fas fa-bars"></i>
    </div>

    <div class="navbar-links">
      <a href="/inicio/" class="navbar-item">Página inicial</a>
      <a href="/usuarios/busca/" class="navbar-item">Buscar</a>
      <a href="/usuarios/postar/" class="navbar-item">Postar</a>
      <a href="/usuarios/perfil/" class="navbar-item">Perfil</a>
    </div>

    <!-- Área do usuário -->
    <div class="navbar-user-area">
      <img src="/uploads/imgPadrao.png" class="profile-img-mini" alt="Perfil">
      <button class="profile-btn">Login</button>
    </div>
  </div>
</nav>

<script src="/js/navbarController.js"></script>

<!-- Vlibras -->
<div vw class="enabled">
  <div vw-access-button class="active"></div>
  <div vw-plugin-wrapper>
    <div class="vw-plugin-top-wrapper"></div>
  </div>
</div>
<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
<script>
  if (window.VLibras) {
    new window.VLibras.Widget('https://vlibras.gov.br/app');
  }
</script>