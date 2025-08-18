@include('componentes.header')
<link rel="stylesheet" href="/css/estilo-perfil.css">
<section class="profile-container">
    <div class="profile-header">
        <div class="profile-img-container">
            <img src="{{ asset($usuario->imagem_usuario ?? 'uploads/imgPadrao.png') }}" alt="Foto de Perfil" class="profile-img">
        </div>
        <div class="profile-info">
            <div class="profile-actions">
                <h1 class="profile-username">
                    {{ session('usuario_nome') ?? $usuario->nome ?? 'Usuário' }}
                </h1>
                <div class="action-buttons">
                    <a href="/usuarios/{{ $usuario->id_usuario }}/edit/" class="btn-edit">
                        <button class="edit-btn">Editar perfil</button>
                    </a>
                    <button class="settings-btn" aria-label="Configurações">
                        <i class="fas fa-cog"></i>
                    </button>
                </div>
            </div>
            <div class="profile-stats">
                <div class="stat-item">
                    <span class="stat-count">{{ $usuarioController->countEventos($usuario->id_usuario) ?? 0 }}</span>
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
                <h2 class="bio-name">{{ session('usuario_nome') ?? $usuario->nome ?? '' }}</h2>
                <p class="bio-text">@ {{ $usuario->nickname ?? '' }}</p>
                <p class="bio-text">✉️ {{ $usuario->email ?? '' }}</p>
                <p class="bio-text">📞 {{ $usuario->numero ?? '' }}</p>
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
    <div class="gallery">
        @forelse($usuario->eventos as $evento)
            <div class="photo">
                <img src="{{ asset($evento->imagem_evento ?? 'assets/default-event.jpg') }}" alt="{{ $evento->nome_evento }}">
                <div class="event-info">
                    <strong>{{ $evento->nome_evento }}</strong><br>
                    <span>{{ \Carbon\Carbon::parse($evento->data_inicio_evento)->format('d/m/Y') }}</span>
                </div>
            </div>
        @empty
            <div class="no-eventos">
                <i class="fas fa-calendar-plus"></i>
                <p>Você ainda não criou nenhum evento</p>
                <a href="/eventos/create/" class="btn-create-event">
                    Criar primeiro evento
                </a>
            </div>
        @endforelse
    </div>
</section>
@include('componentes.footer')