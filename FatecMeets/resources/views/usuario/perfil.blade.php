@include('componentes.header')
<link rel="stylesheet" href="/css/estilo-perfil.css">

<section class="profile-container">
    <div class="profile-header">
        <div id="imagem-container" class="profile-img-container"></div>

        <div class="profile-info">
            <div class="profile-actions">
                <h1 class="profile-username">Usuário</h1>
                <div class="action-buttons">
                    <a id="edit-profile-link" class="btn-edit">
                        <button class="edit-btn">Editar perfil</button>
                    </a>
                    <button class="settings-btn" aria-label="Configurações">
                        <i class="fas fa-cog"></i>
                    </button>
                </div>
            </div>

            <div class="profile-stats">
                <div class="stat-item">
                    <span id="stat-eventos" class="stat-count">0</span>
                    <span class="stat-label">Eventos</span>
                </div>
                <div class="stat-item">
                    <span class="stat-count">0</span>
                    <span class="stat-label">Seguidores</span>
                </div>
                <div class="stat-item">
                    <span class="stat-count">0</span>
                    <span class="stat-label">Seguindo</span>
                </div>
            </div>

            <div class="profile-bio">
                <h2 class="bio-name"></h2>
                <p class="bio-text bio-nickname"></p>
                <p class="bio-text bio-email"></p>
                <p class="bio-text bio-telefone"></p>
            </div>
        </div>
    </div>

    <div class="profile-tabs">
        <div class="tab active">
            <i class="fas fa-calendar-alt"></i>
            <span>Meus Eventos</span>
        </div>
        <div class="tab">
            <i class="far fa-bookmark"></i>
            <span>Eventos Salvos</span>
        </div>
        <div class="tab">
            <i class="fas fa-users"></i>
            <span>Participando</span>
        </div>
    </div>
        <i class="fas fa-calendar-plus"></i>
        <p>Criar Evento</p>
        <a href="/eventos/create/" class="btn-create-event">Criar primeiro evento</a>
    <div class="gallery"></div>
</section>
<script>
    const usuario = @json($usuario);
</script>

<script src="/js/controllers/perfilUsuarioController.js"></script>
@include('componentes.footer')
