{{-- filepath: /workspaces/Fatec_Meets_Web/FatecMeets/resources/views/welcome.blade.php --}}
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed - Fatec Meet</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('view/css/dark-mode.css') }}">
    <link rel="stylesheet" href="{{ asset('view/css/estilo-feeds.css') }}">
    <link rel="stylesheet" href="{{ asset('components/navbar.css') }}">
</head>

<body>
    {{-- Inclui a barra de navegação --}}
    @include('componentes.navbar')

    <div class="feed">
        {{-- Exibe mensagem se não houver eventos --}}
        @if(count($eventos ?? []) === 0)
            <p style="text-align:center;">Nenhum evento ainda. Seja o primeiro a postar!</p>
        @else
            {{-- Exibe cada evento do banco de dados --}}
            @foreach($eventos as $evento)
                <div class="post">
                    @if($evento->imagem)
                        <!-- Imagem do post -->
                        <a href="{{ url('view/Evento.php?id=' . $evento->id) }}">
                            <div class="post-image">
                                <img src="{{ asset($evento->imagem) }}" alt="Imagem do evento">
                            </div>
                        </a>
                    @endif
                    <div class="post-content">
                        <h3>
                            <a href="{{ url('view/Evento.php?id=' . $evento->id) }}">
                                {{ $evento->titulo }}
                            </a>
                        </h3>
                        <p><strong>Local:</strong> {{ $evento->local }}</p>
                        <p><strong>Categoria:</strong> {{ $evento->categoria }}</p>
                        <p><strong>Quando:</strong> {{ \Carbon\Carbon::parse($evento->data_evento)->format('d/m/Y H:i') }}</p>
                        <p>{!! nl2br(e($evento->descricao)) !!}</p>
                        <div class="post-footer">
                            Publicado em {{ \Carbon\Carbon::parse($evento->data_criacao)->format('d/m/Y H:i') }} por:
                            <u>{{ $evento->nome }}</u>
                            @php
                                $fotoPerfil = !empty($evento->foto) && file_exists(public_path($evento->foto))
                                    ? asset($evento->foto)
                                    : asset('uploads/imgPadrao.png');
                            @endphp
                            <img src="{{ $fotoPerfil }}" class="profile-img-mini" alt="Foto perfil">
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <script>
        // Script para alternar menu mobile
        const menuToggle = document.querySelector('.menu-toggle');
        const navbarLinks = document.querySelector('.navbar-links');
        menuToggle?.addEventListener('click', () => {
            navbarLinks.classList.toggle('active');
        });
    </script>
</body>
</html>