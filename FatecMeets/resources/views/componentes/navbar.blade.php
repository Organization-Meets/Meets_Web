{{-- filepath: /workspaces/Fatec_Meets_Web/FatecMeets/resources/views/componentes/navbar.blade.php --}}
<link rel="stylesheet" href="/css/navbar.css">

<nav class="navbar">
  <div class="navbar-container">
    <a href="/home/" class="navbar-logo">Fatec Meet</a>

    <div class="menu-toggle">
      <i class="fas fa-bars"></i>
    </div>

    <!-- dark mode -->
    <div class="navbar-user-area">
      <label for="theme-switch">Modo:</label>
      <div class="theme-toggle">
        <input type="checkbox" id="theme-switch">
        <label for="theme-switch" class="switch"></label>
      </div>
    </div>

    <!-- Botões de navegação -->
    <div class="navbar-links">
      <a href="/home/" class="navbar-item">Página inicial</a>
      <a href="/usuarios/busca/" class="navbar-item">Buscar</a>
      <a href="/usuarios/postar/" class="navbar-item">Postar</a>
      <a href="/usuarios/perfil/" class="navbar-item">Perfil</a>
    </div>

    <!-- Área do usuário -->
    <div class="navbar-user-area">
      @php
        $usuarioId = session('usuario_id');
        $usuario = null;
        if ($usuarioId) {
          $usuario = \App\Models\Usuario::find($usuarioId);
        }
        $caminhoPadrao = asset('uploads/imgPadrao.png');
        $caminhoFoto = $caminhoPadrao;
        if ($usuario && $usuario->imagem_usuario) {
          $caminhoFoto = asset($usuario->imagem_usuario);
        }
      @endphp
      @if($usuario)
        <img src="{{ $caminhoFoto }}" class="profile-img-mini" alt="Perfil">
        <a href="/usuarios/logout/"><button class="profile-btn">Logout</button></a>
      @else
        <a href="/usuarios/loginForm/"><button class="profile-btn">Login</button></a>
      @endif
    </div>
  </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Dark mode toggle
  const themeSwitch = document.getElementById('theme-switch');
  const body = document.body;
  if (themeSwitch && localStorage.getItem('theme') === 'dark') {
      body.classList.add('dark-mode');
      themeSwitch.checked = true;
  }
  if (themeSwitch) {
    themeSwitch.addEventListener('change', () => {
      body.classList.toggle('dark-mode', themeSwitch.checked);
      localStorage.setItem('theme', themeSwitch.checked ? 'dark' : 'light');
    });
  }

  // Menu mobile toggle
  const menuToggle = document.querySelector('.menu-toggle');
  const navbarLinks = document.querySelector('.navbar-links');
  if (menuToggle && navbarLinks) {
    menuToggle.addEventListener('click', () => {
      navbarLinks.classList.toggle('active');
    });
  }
});
</script>

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