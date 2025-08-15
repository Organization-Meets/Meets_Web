{{-- filepath: /workspaces/Fatec_Meets_Web/FatecMeets/resources/views/welcome.blade.php --}}
    @include('componentes.header')
    <link rel="stylesheet" href="/css/estilo-feeds.css">

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
    @include('componentes.footer')
