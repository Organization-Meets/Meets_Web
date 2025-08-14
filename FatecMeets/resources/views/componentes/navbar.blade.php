{{-- filepath: /workspaces/Fatec_Meets_Web/FatecMeets/resources/views/componentes/navbar.blade.php --}}
<link rel="stylesheet" href="css/navbar.css">

<nav class="navbar">
  <div class="navbar-container">
    <a href="../" class="navbar-logo">Fatec Meet</a>

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
      <a href="" class="navbar-item">Página inicial</a>
      <a href="view/busca" class="navbar-item">Buscar</a>
      <a href="view/postar" class="navbar-item">Postar</a>
      <a href="view/perfil" class="navbar-item">Perfil</a>
    </div>

    <!-- Área do usuário -->
    <div class="navbar-user-area">
      @if(session('usuario'))
        @php
          $foto = session('usuario.foto') ?? '';
          $caminhoPadrao = asset('uploads/imgPadrao.png');
          $caminhoFoto = $foto && file_exists(public_path($foto))
            ? asset($foto)
            : $caminhoPadrao;
        @endphp
        <img src="{{ $caminhoFoto }}" class="profile-img-mini" alt="Perfil">
        <a href="usuario/logout"><button class="profile-btn">Logout</button></a>
      @else
        <a href="{{ url('view/Login"><button class="profile-btn">Login</button></a>
      @endif
    </div>
  </div>
</nav>

<script>
const themeSwitch = document.getElementById('theme-switch');
const body = document.body;

if (localStorage.getItem('theme') === 'dark') {
    body.classList.add('dark-mode');
    themeSwitch.checked = true;
}

themeSwitch.addEventListener('change', () => {
    if (themeSwitch.checked) {
        body.classList.add('dark-mode');
        localStorage.setItem('theme', 'dark');
    } else {
        body.classList.remove('dark-mode');
        localStorage.setItem('theme', 'light');
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
  new window.VLibras.Widget('https://vlibras.gov.br/app');
</script>

<script>
const menuToggle = document.querySelector('.menu-toggle');
const navbarLinks = document.querySelector('.navbar-links');
menuToggle?.addEventListener('click', () => {
  navbarLinks.classList.toggle('active');
});
</script>